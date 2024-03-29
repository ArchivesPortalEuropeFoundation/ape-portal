<?php
/**
 * saveCustomCss
 * @author @sepiariver
 * Copyright 2013 - 2015 by YJ Tso <yj@modx.com> <info@sepiariver.com>
 *
 * saveCustomCss and cssSweet is free software; 
 * you can redistribute it and/or modify it under the terms of the GNU General 
 * Public License as published by the Free Software Foundation; 
 * either version 2 of the License, or (at your option) any later version.
 *
 * saveCustomCss and cssSweet is distributed in the hope that it will be useful, 
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or 
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * saveCustomCss and cssSweet; if not, write to the Free Software Foundation, Inc., 
 * 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package cssSweet
 *
 */

// In case the wrong event is enabled in plugin properties
if ($modx->event->name !== 'OnSiteRefresh' && $modx->event->name !== 'OnChunkFormSave') return;

// Dev mode option
$mode = ($modx->getOption('dev_mode', $scriptProperties, 0)) ? 'dev' : 'custom';

// Optionally a comma-separated list of chunk names can be specified in plugin properties
$chunks = array_map('trim', explode(',', $modx->getOption($mode . '_css_chunk', $scriptProperties, 'csss.custom.css')));

// Don't run this for every ChunkSave event
if ($modx->event->name === 'OnChunkFormSave' && !in_array($chunk->get('name'), $chunks)) return;

// Optionally a file name can be specified in plugin properties
$filename = $modx->getOption($mode . '_css_filename', $scriptProperties, 'csss.compiled.css');

// Optionally minify the output, defaults to 'true' 
$minify_custom_css = (bool) $modx->getOption('minify_custom_css', $scriptProperties, true);

// Optionally choose an output format if not minified
$css_output_format = $modx->getOption('css_output_format', $scriptProperties, 'standard');
$css_output_format = ($css_output_format === 'nested') ? 'scss_formatter_nested' : 'scss_formatter';

// This is for the formatter class
$css_output_format = ($minify_custom_css) ? 'scss_formatter_compressed' : $css_output_format;

// Strip CSS comment blocks; defaults to 'false'
$strip_comments = (bool) $modx->getOption('strip_css_comment_blocks', $scriptProperties, false);
$preserve_comments = ($strip_comments) ? false : true;

// Optionally set base_path for scss imports
$scss_import_paths = $modx->getOption('scss_import_paths', $scriptProperties, '');
$scss_import_paths = (empty($scss_import_paths)) ? array() : array_map('trim', explode(',', $scss_import_paths));

// Get the output path; construct fallback; log for debugging
$csssCustomCssPath = $modx->getOption('custom_css_path', $scriptProperties, '');
if (empty($csssCustomCssPath)) $csssCustomCssPath = $modx->getOption('assets_path') . 'components/csssweet/';
$modx->log(modX::LOG_LEVEL_INFO, '$csssCustomCssPath is: ' . $csssCustomCssPath . ' on line: ' . __LINE__);
$csssCustomCssPath = rtrim($csssCustomCssPath, '/') . '/';

// If directory exists but isn't writable we have a problem, Houston
if (file_exists($csssCustomCssPath) && !is_writable($csssCustomCssPath)) {
    $modx->log(modX::LOG_LEVEL_ERROR, 'The directory at ' . $csssCustomCssPath . 'is not writable!','','saveCustomCss');
    return;
}

// Check if directory exists, if not, create it
if (!file_exists($csssCustomCssPath)) {
    if (mkdir($csssCustomCssPath, 0755, true)) {
        $modx->log(modX::LOG_LEVEL_INFO, 'Directory created at ' . $csssCustomCssPath, '', 'saveCustomCss');
    } else {
        $modx->log(modX::LOG_LEVEL_ERROR, 'Directory could not be created at ' . $csssCustomCssPath, '', 'saveCustomCss');
        return;
    }
}

// Grab the ClientConfig class
$ccPath = $modx->getOption('clientconfig.core_path', null, $modx->getOption('core_path') . 'components/clientconfig/');
$ccPath .= 'model/clientconfig/';
if (file_exists($ccPath . 'clientconfig.class.php')) $clientConfig = $modx->getService('clientconfig','ClientConfig', $ccPath);
$settings = array();

// If we got the class (which means it's installed properly), include the settings
if ($clientConfig instanceof ClientConfig) {
    $settings = $clientConfig->getSettings();
    /* Make settings available as [[++tags]] */
    $modx->setPlaceholders($settings, '+');
} else { 
    $modx->log(modX::LOG_LEVEL_WARN, 'Failed to load ClientConfig class. ClientConfig settings not included.','','saveCustomCssClientConfig'); 
}

// Parse chunk with $settings array
$contents = '';
foreach ($chunks as $current) {
    $modx->log(modX::LOG_LEVEL_INFO, 'Starting to process ' . $current, '', 'saveCustomCss');

    $processed = '';
    if ($current) {
        try {
            $modx->log(modX::LOG_LEVEL_INFO, 'Processing ' . $current, '', 'saveCustomCss');
            $processed = $modx->getChunk($current, $settings);
            if ($processed) {
                $contents .= $processed;
                $modx->log(modX::LOG_LEVEL_INFO, $current . ' has been processed.', '', 'saveCustomCss');
            } else {
                $err = '$modx->getChunk() failed on line: ' . __LINE__;
                throw new Exception($err);
            }
            
        } catch (Exception $err) {
            $modx->log(modX::LOG_LEVEL_ERROR, $err->getMessage() , '', 'saveCustomCss');
        }
    }
    
}
// If there's no result, what's the point?
if (empty($contents)) {
    $modx->log(modX::LOG_LEVEL_ERROR, 'Empty $contents. Aborted on line: ' . __LINE__ , '', 'saveCustomCss');
    return;
}
// CSS comments
$contents = '/* Contents generated by MODX - this file will be overwritten. */' . PHP_EOL . $contents;
if ($preserve_comments) $contents = str_replace('/*', '/*!', $contents);

// Define target file
$file = $csssCustomCssPath . $filename;
$modx->log(modX::LOG_LEVEL_INFO, 'Target file is: ' . $file, '', 'saveCustomCss');

// Grab the SCSS processor class
$cssSweetLibsPath = $modx->getOption('csssweet.core_path', null, $modx->getOption('core_path') . 'components/csssweet/');
$cssSweetLibsPath .= 'model/cssSweet/libs/';
$cssSweetcssMinFile = 'scssphp/scss.inc.php';

if (file_exists($cssSweetLibsPath . $cssSweetcssMinFile)) {
    include_once $cssSweetLibsPath . $cssSweetcssMinFile;
    $scssMin = new scssc();
} else {
    $modx->log(modX::LOG_LEVEL_ERROR, 'SCSS processor lib is missing from: ' . $cssSweetLibsPath . $cssSweetcssMinFile, '', 'saveCustomCss');
}

// If we got the class, try minification and scss processing. Log failures.    
if ($scssMin instanceof scssc) {

    try {
        $scssMin->setImportPaths($scss_import_paths);
        $scssMin->setFormatter($css_output_format);
        $contents = $scssMin->compile($contents);
    } 
    catch (Exception $e) {
        $modx->log(modX::LOG_LEVEL_ERROR, $e->getMessage() . ' scss not compiled. minification not performed.','','saveCustomCss'); 
    }

} else { 
    $modx->log(modX::LOG_LEVEL_ERROR, 'Failed to load scss class. scss not compiled. minification not performed.','','saveCustomCss'); 
}

// If we failed scss and minification at least output what we have
file_put_contents($file, $contents);
if (file_exists($file) && is_readable($file)) $modx->log(modX::LOG_LEVEL_INFO, 'Success! Custom CSS saved to file "' . $file . '"', '', 'saveCustomCss');