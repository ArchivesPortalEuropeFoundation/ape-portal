<?php
/**
 * Creates or updates the elements and resources of the search widget. Safe to run more than once.
 *
 *   php core/components/asi/setup/search_widget.php
 *
 * - static templates 98_Search_Widget_Embed_Template and 13b_Search_Widget_Info_Template
 * - static snippets asi_widget, asi_widget_builder and chunks asi_widget, asi_widget_institution,
 *   asi_widget_recent_item, asi_widget_builder (category "asi")
 * - resource widget/search/ (web context, under "DO NOT EDIT"): the page that is embedded in the iframe
 * - the "Search widget" pages (tools/search-widget/ in web and de) get the info template and are published
 *
 * The element files are the source: after saving, each file is written back with its original
 * content, so the script never changes them. Clear the MODX cache afterwards.
 */
if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit('CLI only');
}

$root = dirname(__DIR__, 4) . '/';
require $root . 'config.core.php';
require MODX_CORE_PATH . 'vendor/autoload.php';

use MODX\Revolution\modCategory;
use MODX\Revolution\modChunk;
use MODX\Revolution\modResource;
use MODX\Revolution\modSnippet;
use MODX\Revolution\modTemplate;
use MODX\Revolution\modX;

$modx = new modX();
$modx->initialize('mgr');
$modx->setLogTarget('ECHO');
$modx->setLogLevel(modX::LOG_LEVEL_WARN);

function out($msg)
{
    echo $msg . PHP_EOL;
}

$category = $modx->getObject(modCategory::class, ['category' => 'asi']);
$categoryId = $category ? $category->get('id') : 0;

/**
 * Static element whose file is the source of truth.
 */
function staticElement(modX $modx, string $class, string $nameField, string $name, string $file, int $categoryId, string $description)
{
    $path = MODX_BASE_PATH . $file;
    if (!is_file($path)) {
        throw new RuntimeException("Missing file $file");
    }
    $original = file_get_contents($path);

    $element = $modx->getObject($class, [$nameField => $name]);
    $isNew = !$element;
    if ($isNew) {
        $element = $modx->newObject($class);
        $element->set($nameField, $name);
    }
    $element->fromArray([
        'description' => $description,
        'category' => $categoryId,
        'static' => 1,
        'source' => 1,
        'static_file' => $file,
    ]);
    $content = $original;
    if ($class === modSnippet::class) {
        $content = preg_replace('/^\s*<\?php\s*/', '', $content);
    }
    // templates keep their code in "content", snippets and chunks in "snippet"
    $element->set($class === modTemplate::class ? 'content' : 'snippet', $content);
    if (!$element->save()) {
        throw new RuntimeException("Could not save $name");
    }
    // keep the file exactly as it is in git
    if (file_get_contents($path) !== $original) {
        file_put_contents($path, $original);
    }
    out(($isNew ? 'created ' : 'updated ') . "$name (id {$element->get('id')}) -> $file");
    return $element;
}

$embedTemplate = staticElement($modx, modTemplate::class, 'templatename', '98_Search_Widget_Embed_Template',
    'site/_elements/templates/98_Search_Widget_Embed_Template.tpl', 0, 'Search widget page shown in an iframe on other sites');
$infoTemplate = staticElement($modx, modTemplate::class, 'templatename', '13b_Search_Widget_Info_Template',
    'site/_elements/templates/13b_Search_Widget_Info_Template.tpl', 0, 'Tools > Search widget: code builder and preview');

staticElement($modx, modSnippet::class, 'name', 'asi_widget', 'core/components/asi/snippets/asi_widget.php', $categoryId,
    'Search widget (iframe). GET: ai or repositoryCode, recent=1');
staticElement($modx, modSnippet::class, 'name', 'asi_widget_builder', 'core/components/asi/snippets/asi_widget_builder.php', $categoryId,
    'Code builder for the search widget');
foreach (['asi_widget', 'asi_widget_institution', 'asi_widget_recent_item', 'asi_widget_builder'] as $chunk) {
    staticElement($modx, modChunk::class, 'name', $chunk, "core/components/asi/chunks/$chunk.tpl", $categoryId, 'Search widget');
}

// Widget resource, under "DO NOT EDIT" like get-results and asi-ajax
$parent = $modx->getObject(modResource::class, ['context_key' => 'web', 'alias' => 'source', 'parent' => 0]);
$widget = $modx->getObject(modResource::class, ['context_key' => 'web', 'uri' => 'widget/search/']);
$isNew = !$widget;
if ($isNew) {
    $widget = $modx->newObject(modResource::class);
}
$widget->fromArray([
    'pagetitle' => 'Search widget (iframe)',
    'longtitle' => '',
    'description' => 'Embedded in an iframe on other sites. Do not delete: the URL is used on external sites.',
    'alias' => 'search-widget-embed',
    'uri' => 'widget/search/',
    'uri_override' => 1,
    'parent' => $parent ? $parent->get('id') : 0,
    'template' => $embedTemplate->get('id'),
    'content' => '',
    'context_key' => 'web',
    'content_type' => 1,
    'published' => 1,
    'hidemenu' => 1,
    'searchable' => 0,
    'cacheable' => 0,
    'richtext' => 0,
]);
if (!$widget->save()) {
    throw new RuntimeException('Could not save the widget resource');
}
out(($isNew ? 'created' : 'updated') . " resource widget/search/ (id {$widget->get('id')})");

// SEO Suite: noindex, nofollow, not in the sitemap (as get-results and asi-ajax)
$seoClass = 'Sterc\\SeoSuite\\Model\\SeoSuiteResource'; // registered by the bootstrap of SEO Suite
if (class_exists($seoClass)) {
    $seo = $modx->getObject($seoClass, ['resource_id' => $widget->get('id')]) ?: $modx->newObject($seoClass);
    $seo->fromArray(['resource_id' => $widget->get('id'), 'index_type' => 0, 'follow_type' => 0, 'sitemap' => 0]);
    $seo->save();
    out('SEO Suite: widget resource set to noindex, nofollow, no sitemap');
} else {
    out('SEO Suite not found: set noindex/nofollow/no sitemap for the widget resource in the Manager');
}

// Info pages (Babel pair) get the builder template
foreach (['web', 'de'] as $ctx) {
    $page = $modx->getObject(modResource::class, ['context_key' => $ctx, 'uri' => 'tools/search-widget/']);
    if (!$page) {
        out("no tools/search-widget/ page in context $ctx");
        continue;
    }
    $page->set('template', $infoTemplate->get('id'));
    $page->set('published', 1);
    if (!$page->get('publishedon')) {
        $page->set('publishedon', time());
    }
    $page->save();
    out("resource {$page->get('id')} ($ctx, tools/search-widget/) -> template {$infoTemplate->get('id')}, published");
}

$modx->getCacheManager()->refresh();
out('cache refreshed');
