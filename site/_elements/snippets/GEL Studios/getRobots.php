<?php
/**
 * getRobots: value for <meta name="robots"> of the current resource, e.g. "index,follow".
 * Reads the SEO Suite settings of the resource (migrated from SEO Tab), with the SEO Suite defaults as fallback.
 * Replaces the old [[+seoTab.robotsTag]] placeholder of SEO Tab.
 */
use Sterc\SeoSuite\Model\SeoSuiteResource;

$seoResource = $modx->getObject(SeoSuiteResource::class, ['resource_id' => $modx->resource->get('id')]);
if ($seoResource) {
    $index  = (bool) $seoResource->get('index_type');
    $follow = (bool) $seoResource->get('follow_type');
} else {
    $index  = (bool) $modx->getOption('seosuite.tab_seo_default_index_type', null, 1);
    $follow = (bool) $modx->getOption('seosuite.tab_seo_default_follow_type', null, 1);
}

return ($index ? 'index' : 'noindex') . ',' . ($follow ? 'follow' : 'nofollow');