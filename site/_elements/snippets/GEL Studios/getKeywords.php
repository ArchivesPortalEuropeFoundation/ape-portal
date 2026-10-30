<?php
/**
 * getKeywords: focus keywords of the current resource, for <meta name="keywords">.
 * Reads them from SEO Suite (they were migrated there from SEO Pro).
 */
use Sterc\SeoSuite\Model\SeoSuiteResource;

$seoResource = $modx->getObject(SeoSuiteResource::class, ['resource_id' => $modx->resource->get('id')]);

return $seoResource ? (string) $seoResource->get('keywords') : '';