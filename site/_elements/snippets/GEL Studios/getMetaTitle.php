<?php
/**
 * getMetaTitle: <title> of the current resource. Replaces the old [[+seoPro.title]] placeholder of SEO Pro
 * and produces the same output as SEO Pro did with the site's settings (delimiter "|", site name appended):
 *  - home page (site_start): longtitle, or the site name
 *  - other pages: "longtitle | site name", or "pagetitle | site name" when there is no longtitle
 */
$resource  = $modx->resource;
$siteName  = $modx->getOption('site_name');
$longtitle = $resource->get('longtitle');

if ((int) $resource->get('id') === (int) $modx->getOption('site_start')) {
    return !empty($longtitle) ? $longtitle : $siteName;
}

return (!empty($longtitle) ? $longtitle : $resource->get('pagetitle')) . ' | ' . $siteName;