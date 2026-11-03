<?php
/**
 * asi_widget_builder
 *
 * Code builder for the search widget (Tools > Search widget): choose an institution (optional) and
 * whether the latest finding aids are shown, see a preview and copy the iframe code.
 *
 * Properties:
 * - widgetUri  URI of the widget resource in the web context (default: widget/search/)
 */
require_once MODX_CORE_PATH . 'components/asi/autoload.php';

use asi\WidgetManager;

$lang = $modx->getOption('cultureKey') ?: 'en';
$modx->lexicon->load($lang . ':asi:default', $lang . ':asi:solr');

$widgetUri = $modx->getOption('widgetUri', $scriptProperties, 'widget/search/');
$widgetId = $modx->findResource($widgetUri, 'web');
if (!$widgetId) {
    $modx->log(\xPDO\xPDO::LOG_LEVEL_ERROR, '[asi_widget_builder] Widget resource "' . $widgetUri . '" not found in the web context');
    return '';
}

$e = function ($value) {
    $html = htmlspecialchars((string) $value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    return str_replace(['[', ']', '{', '}', '`'], ['&#91;', '&#93;', '&#123;', '&#125;', '&#96;'], $html);
};

$widget = new WidgetManager($modx);
$institutions = $widget->getInstitutionList();

// Label shown in the list: "Name (Country)". If two institutions get the same label, the id is added.
$labels = [];
foreach ($institutions as $i => $inst) {
    $country = $widget->countryLabel($inst['country']);
    $institutions[$i]['label'] = $country !== '' ? $inst['name'] . ' (' . $country . ')' : $inst['name'];
    $labels[$institutions[$i]['label']] = ($labels[$institutions[$i]['label']] ?? 0) + 1;
}
$options = '';
foreach ($institutions as $inst) {
    $label = $labels[$inst['label']] > 1 ? $inst['label'] . ' #' . $inst['id'] : $inst['label'];
    $options .= '<option value="' . $e($label) . '" data-id="' . (int) $inst['id'] . '"></option>';
}

return $modx->getChunk('asi_widget_builder', [
    'widget_url' => $e($modx->makeUrl($widgetId, 'web', '', 'full')),
    'options' => $options,
]);
