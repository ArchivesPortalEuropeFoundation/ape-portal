<?php return array (
  '066d3e6d55facb4452157457b6bf8a5f' => 
  array (
    'criteria' => 
    array (
      'name' => 'csssweet',
    ),
    'object' => 
    array (
      'name' => 'csssweet',
      'path' => '{core_path}components/csssweet/',
      'assets_path' => '{assets_path}components/csssweet/',
    ),
  ),
  'f113b89d580c85602456b76d96c1fbc8' => 
  array (
    'criteria' => 
    array (
      'category' => 'cssSweet',
    ),
    'object' => 
    array (
      'id' => 34,
      'parent' => 0,
      'category' => 'cssSweet',
      'rank' => 0,
    ),
  ),
  '3773ca89de3b12484873f0988d089069' => 
  array (
    'criteria' => 
    array (
      'name' => 'saveCustomCss',
    ),
    'object' => 
    array (
      'id' => 31,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'saveCustomCss',
      'description' => '',
      'editor_type' => 0,
      'category' => 34,
      'cache_type' => 0,
      'plugincode' => '/**
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

// Never fire on the front end
if ($modx->context->get(\'key\') !== \'mgr\') return;

// In case the wrong event is enabled in plugin properties
$allowedEvents = array(\'OnSiteRefresh\',\'OnChunkFormSave\',\'ClientConfig_ConfigChange\');
if (!in_array($modx->event->name, $allowedEvents)) return;

// Grab the cssSweet class
$csssweet = null;
$cssSweetPath = $modx->getOption(\'csssweet.core_path\', null, $modx->getOption(\'core_path\') . \'components/csssweet/\');
$cssSweetPath .= \'model/csssweet/\';
if (file_exists($cssSweetPath . \'csssweet.class.php\')) $csssweet = $modx->getService(\'csssweet\', \'CssSweet\', $cssSweetPath);

if (!$csssweet || !($csssweet instanceof CssSweet)) {

    $modx->log(modX::LOG_LEVEL_ERROR, \'[SaveCustomCss] could not load the required csssweet class!\');
	return;

}

// Dev mode option
$mode = $modx->getOption(\'dev_mode\', $scriptProperties, \'custom\', true);
// Letting folks know what\'s going on
$modx->log(modX::LOG_LEVEL_INFO, \'saveCustomCss plugin is running in mode: \' . $mode);

// Override properties with mode props
$properties = $scriptProperties;
foreach ($properties as $key => $val) {
    // skip any mode props
    if (strpos($key, $mode) === 0) continue;
    // these are standard scriptProperties
    $properties[$key] = (isset($properties[$mode . \'_\' . $key])) ? $properties[$mode . \'_\' . $key] : $val;
}

// Specify a comma-separated list of chunk names in plugin properties
$chunks = $csssweet->explodeAndClean($modx->getOption(\'scss_chunks\', $properties, \'\'));
// If no chunk names specified, there\'s nothing to do.
if (empty($chunks)) {
    $modx->log(modX::LOG_LEVEL_WARN, \'No chunks were set in the saveCustomCss plugin property scss_chunks. No action performed.\');
    return;
}

// Don\'t run this for every ChunkSave event
if ($modx->event->name === \'OnChunkFormSave\' && !in_array($chunk->get(\'name\'), $chunks)) return;

// Specify an output file name in plugin properties
$filename = $modx->getOption(\'css_filename\', $properties, \'\');
if (empty($filename)) return;

// Optionally choose an output format if not minified
$css_output_format = $modx->getOption(\'css_output_format\', $properties, \'Expanded\');
$css_output_format_options = array(\'Expanded\',\'Nested\',\'Compact\');
if (!in_array($css_output_format, $css_output_format_options)) $css_output_format = \'Expanded\';

// Optionally minify the output, defaults to \'true\'
$minify_custom_css = (bool) $modx->getOption(\'minify_custom_css\', $properties, true);
$css_output_format = ($minify_custom_css) ? \'Compressed\' : $css_output_format;

// Strip CSS comment blocks; defaults to \'false\'
$strip_comments = (bool) $modx->getOption(\'strip_css_comment_blocks\', $properties, false);
$css_output_format = ($minify_custom_css && $strip_comments) ? \'Crunched\' : $css_output_format;

// Optionally set base_path for scss imports
$scss_import_paths = $modx->getOption(\'scss_import_paths\', $properties, \'\');
$scss_import_paths = (empty($scss_import_paths)) ? array() : $csssweet->explodeAndClean($scss_import_paths);

// Get the output path; construct fallback; log for debugging
$csssCustomCssPath = $modx->getOption(\'css_path\', $properties, \'\');
if (empty($csssCustomCssPath)) $csssCustomCssPath = $modx->getOption(\'assets_path\') . \'components/csssweet/\' . $mode . \'/\';
$modx->log(modX::LOG_LEVEL_INFO, \'$csssCustomCssPath is: \' . $csssCustomCssPath . \' on line: \' . __LINE__);
$csssCustomCssPath = rtrim($csssCustomCssPath, \'/\') . \'/\';

// If directory exists but isn\'t writable we have a problem, Houston
if (file_exists($csssCustomCssPath) && !is_writable($csssCustomCssPath)) {
    $modx->log(modX::LOG_LEVEL_ERROR, \'The directory at \' . $csssCustomCssPath . \'is not writable!\',\'\',\'saveCustomCss\');
    return;
}

// Check if directory exists, if not, create it
if (!file_exists($csssCustomCssPath)) {
    if (mkdir($csssCustomCssPath, 0755, true)) {
        $modx->log(modX::LOG_LEVEL_INFO, \'Directory created at \' . $csssCustomCssPath, \'\', \'saveCustomCss\');
    } else {
        $modx->log(modX::LOG_LEVEL_ERROR, \'Directory could not be created at \' . $csssCustomCssPath, \'\', \'saveCustomCss\');
        return;
    }
}

// Initialize settings array
$settings = array();

// Get context settings
$settings_ctx = $modx->getOption(\'context_settings_context\', $properties, \'\');
if (!empty($settings_ctx)) {
    $settings_ctx = $modx->getContext($settings_ctx);
    if ($settings_ctx && is_array($settings_ctx->config)) $settings = array_merge($settings, $settings_ctx->config);
}

// Attempt to get Client Config settigs
$settings = $csssweet->getClientConfigSettings($settings);

/* Make settings available as [[++tags]] */
$modx->setPlaceholders($settings, \'+\');

// Parse chunk with $settings array
$contents = $csssweet->processChunks($chunks, $settings);
// If there\'s no result, what\'s the point?
if (empty($contents)) return;

// CSS comments
$contents = \'/* Contents generated by MODX - this file will be overwritten. */\' . PHP_EOL . $contents;
// The scssphp parser keeps comments with !
if (!$strip_comments) $contents = str_replace(\'/*\', \'/*!\', $contents);

// Define target file
$file = $csssCustomCssPath . $filename;

// Init scssphp
$scssMin = $csssweet->scssphpInit($scss_import_paths, $css_output_format);
if ($scssMin) {

    try {
        $contents = $scssMin->compile($contents);
    }
    catch (Exception $e) {
        $modx->log(modX::LOG_LEVEL_ERROR, $e->getMessage() . \' scss not compiled. minification not performed.\',\'\',\'saveCustomCss\');
    }

} else {
    $modx->log(modX::LOG_LEVEL_ERROR, \'Failed to load scss class. scss not compiled. minification not performed.\',\'\',\'saveCustomCss\');
}

// If we failed scss and minification at least output what we have
file_put_contents($file, $contents);
if (file_exists($file) && is_readable($file)) $modx->log(modX::LOG_LEVEL_INFO, \'Success! Custom CSS saved to file "\' . $file . \'"\', \'\', \'saveCustomCss\');',
      'locked' => 0,
      'properties' => 'a:9:{s:24:"context_settings_context";a:7:{s:4:"name";s:24:"context_settings_context";s:4:"desc";s:79:"The key of a single context from which to pull context settings for CSS values.";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:0:"";s:7:"lexicon";s:19:"csssweet:properties";s:4:"area";s:0:"";}s:12:"css_filename";a:7:{s:4:"name";s:12:"css_filename";s:4:"desc";s:43:"Name of file to output custom compiled CSS.";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:9:"inbox.css";s:7:"lexicon";s:19:"csssweet:properties";s:4:"area";s:0:"";}s:8:"css_path";a:7:{s:4:"name";s:8:"css_path";s:4:"desc";s:62:"Full path for directory to which to OUTPUT the final CSS file.";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:10:"../assets/";s:7:"lexicon";s:19:"csssweet:properties";s:4:"area";s:0:"";}s:11:"scss_chunks";a:7:{s:4:"name";s:11:"scss_chunks";s:4:"desc";s:77:"Name of chunk, or comma-separated list of chunks, from which to parse (S)CSS.";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:6:"styles";s:7:"lexicon";s:19:"csssweet:properties";s:4:"area";s:0:"";}s:8:"dev_mode";a:7:{s:4:"name";s:8:"dev_mode";s:4:"desc";s:16:"Enable DEV mode.";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:6:"custom";s:7:"lexicon";s:19:"csssweet:properties";s:4:"area";s:4:"Mode";}s:17:"css_output_format";a:7:{s:4:"name";s:17:"css_output_format";s:4:"desc";s:98:"Choose either \'Expanded\' (default), \'Nested\' or \'Compact\' CSS output, IF minification is DISABLED.";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:8:"Expanded";s:7:"lexicon";s:19:"csssweet:properties";s:4:"area";s:21:"SCSS and Minification";}s:17:"minify_custom_css";a:7:{s:4:"name";s:17:"minify_custom_css";s:4:"desc";s:58:"Minify CSS on output. MUST be enabled for SCSS processing.";s:4:"type";s:13:"combo-boolean";s:7:"options";a:0:{}s:5:"value";b:1;s:7:"lexicon";s:19:"csssweet:properties";s:4:"area";s:21:"SCSS and Minification";}s:17:"scss_import_paths";a:7:{s:4:"name";s:17:"scss_import_paths";s:4:"desc";s:99:"Optionally set import paths to check for SCSS imports. All @import paths must be relative to these.";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:0:"";s:7:"lexicon";s:19:"csssweet:properties";s:4:"area";s:21:"SCSS and Minification";}s:24:"strip_css_comment_blocks";a:7:{s:4:"name";s:24:"strip_css_comment_blocks";s:4:"desc";s:69:"Strips CSS comment blocks on output, only IF minification is ENABLED.";s:4:"type";s:13:"combo-boolean";s:7:"options";a:0:{}s:5:"value";b:1;s:7:"lexicon";s:19:"csssweet:properties";s:4:"area";s:21:"SCSS and Minification";}}',
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
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

// Never fire on the front end
if ($modx->context->get(\'key\') !== \'mgr\') return;

// In case the wrong event is enabled in plugin properties
$allowedEvents = array(\'OnSiteRefresh\',\'OnChunkFormSave\',\'ClientConfig_ConfigChange\');
if (!in_array($modx->event->name, $allowedEvents)) return;

// Grab the cssSweet class
$csssweet = null;
$cssSweetPath = $modx->getOption(\'csssweet.core_path\', null, $modx->getOption(\'core_path\') . \'components/csssweet/\');
$cssSweetPath .= \'model/csssweet/\';
if (file_exists($cssSweetPath . \'csssweet.class.php\')) $csssweet = $modx->getService(\'csssweet\', \'CssSweet\', $cssSweetPath);

if (!$csssweet || !($csssweet instanceof CssSweet)) {

    $modx->log(modX::LOG_LEVEL_ERROR, \'[SaveCustomCss] could not load the required csssweet class!\');
	return;

}

// Dev mode option
$mode = $modx->getOption(\'dev_mode\', $scriptProperties, \'custom\', true);
// Letting folks know what\'s going on
$modx->log(modX::LOG_LEVEL_INFO, \'saveCustomCss plugin is running in mode: \' . $mode);

// Override properties with mode props
$properties = $scriptProperties;
foreach ($properties as $key => $val) {
    // skip any mode props
    if (strpos($key, $mode) === 0) continue;
    // these are standard scriptProperties
    $properties[$key] = (isset($properties[$mode . \'_\' . $key])) ? $properties[$mode . \'_\' . $key] : $val;
}

// Specify a comma-separated list of chunk names in plugin properties
$chunks = $csssweet->explodeAndClean($modx->getOption(\'scss_chunks\', $properties, \'\'));
// If no chunk names specified, there\'s nothing to do.
if (empty($chunks)) {
    $modx->log(modX::LOG_LEVEL_WARN, \'No chunks were set in the saveCustomCss plugin property scss_chunks. No action performed.\');
    return;
}

// Don\'t run this for every ChunkSave event
if ($modx->event->name === \'OnChunkFormSave\' && !in_array($chunk->get(\'name\'), $chunks)) return;

// Specify an output file name in plugin properties
$filename = $modx->getOption(\'css_filename\', $properties, \'\');
if (empty($filename)) return;

// Optionally choose an output format if not minified
$css_output_format = $modx->getOption(\'css_output_format\', $properties, \'Expanded\');
$css_output_format_options = array(\'Expanded\',\'Nested\',\'Compact\');
if (!in_array($css_output_format, $css_output_format_options)) $css_output_format = \'Expanded\';

// Optionally minify the output, defaults to \'true\'
$minify_custom_css = (bool) $modx->getOption(\'minify_custom_css\', $properties, true);
$css_output_format = ($minify_custom_css) ? \'Compressed\' : $css_output_format;

// Strip CSS comment blocks; defaults to \'false\'
$strip_comments = (bool) $modx->getOption(\'strip_css_comment_blocks\', $properties, false);
$css_output_format = ($minify_custom_css && $strip_comments) ? \'Crunched\' : $css_output_format;

// Optionally set base_path for scss imports
$scss_import_paths = $modx->getOption(\'scss_import_paths\', $properties, \'\');
$scss_import_paths = (empty($scss_import_paths)) ? array() : $csssweet->explodeAndClean($scss_import_paths);

// Get the output path; construct fallback; log for debugging
$csssCustomCssPath = $modx->getOption(\'css_path\', $properties, \'\');
if (empty($csssCustomCssPath)) $csssCustomCssPath = $modx->getOption(\'assets_path\') . \'components/csssweet/\' . $mode . \'/\';
$modx->log(modX::LOG_LEVEL_INFO, \'$csssCustomCssPath is: \' . $csssCustomCssPath . \' on line: \' . __LINE__);
$csssCustomCssPath = rtrim($csssCustomCssPath, \'/\') . \'/\';

// If directory exists but isn\'t writable we have a problem, Houston
if (file_exists($csssCustomCssPath) && !is_writable($csssCustomCssPath)) {
    $modx->log(modX::LOG_LEVEL_ERROR, \'The directory at \' . $csssCustomCssPath . \'is not writable!\',\'\',\'saveCustomCss\');
    return;
}

// Check if directory exists, if not, create it
if (!file_exists($csssCustomCssPath)) {
    if (mkdir($csssCustomCssPath, 0755, true)) {
        $modx->log(modX::LOG_LEVEL_INFO, \'Directory created at \' . $csssCustomCssPath, \'\', \'saveCustomCss\');
    } else {
        $modx->log(modX::LOG_LEVEL_ERROR, \'Directory could not be created at \' . $csssCustomCssPath, \'\', \'saveCustomCss\');
        return;
    }
}

// Initialize settings array
$settings = array();

// Get context settings
$settings_ctx = $modx->getOption(\'context_settings_context\', $properties, \'\');
if (!empty($settings_ctx)) {
    $settings_ctx = $modx->getContext($settings_ctx);
    if ($settings_ctx && is_array($settings_ctx->config)) $settings = array_merge($settings, $settings_ctx->config);
}

// Attempt to get Client Config settigs
$settings = $csssweet->getClientConfigSettings($settings);

/* Make settings available as [[++tags]] */
$modx->setPlaceholders($settings, \'+\');

// Parse chunk with $settings array
$contents = $csssweet->processChunks($chunks, $settings);
// If there\'s no result, what\'s the point?
if (empty($contents)) return;

// CSS comments
$contents = \'/* Contents generated by MODX - this file will be overwritten. */\' . PHP_EOL . $contents;
// The scssphp parser keeps comments with !
if (!$strip_comments) $contents = str_replace(\'/*\', \'/*!\', $contents);

// Define target file
$file = $csssCustomCssPath . $filename;

// Init scssphp
$scssMin = $csssweet->scssphpInit($scss_import_paths, $css_output_format);
if ($scssMin) {

    try {
        $contents = $scssMin->compile($contents);
    }
    catch (Exception $e) {
        $modx->log(modX::LOG_LEVEL_ERROR, $e->getMessage() . \' scss not compiled. minification not performed.\',\'\',\'saveCustomCss\');
    }

} else {
    $modx->log(modX::LOG_LEVEL_ERROR, \'Failed to load scss class. scss not compiled. minification not performed.\',\'\',\'saveCustomCss\');
}

// If we failed scss and minification at least output what we have
file_put_contents($file, $contents);
if (file_exists($file) && is_readable($file)) $modx->log(modX::LOG_LEVEL_INFO, \'Success! Custom CSS saved to file "\' . $file . \'"\', \'\', \'saveCustomCss\');',
    ),
  ),
  'c1835065439082df420c8970ae03a2bc' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 31,
      'event' => 'OnSiteRefresh',
    ),
    'object' => 
    array (
      'pluginid' => 31,
      'event' => 'OnSiteRefresh',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'ffc6504555e5368b25ff5ddb084b2681' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 31,
      'event' => 'OnChunkFormSave',
    ),
    'object' => 
    array (
      'pluginid' => 31,
      'event' => 'OnChunkFormSave',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '4ad9a0c3cd96d9d41ce5aab558ca2efd' => 
  array (
    'criteria' => 
    array (
      'name' => 'saveCustomJs',
    ),
    'object' => 
    array (
      'id' => 32,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'saveCustomJs',
      'description' => '',
      'editor_type' => 0,
      'category' => 34,
      'cache_type' => 0,
      'plugincode' => '/**
 * saveCustomJs
 * @author @sepiariver
 * Copyright 2013 - 2015 by YJ Tso <yj@modx.com> <info@sepiariver.com>
 *
 * saveCustomJs and cssSweet is free software;
 * you can redistribute it and/or modify it under the terms of the GNU General
 * Public License as published by the Free Software Foundation;
 * either version 2 of the License, or (at your option) any later version.
 *
 * saveCustomJs and cssSweet is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * saveCustomJs and cssSweet; if not, write to the Free Software Foundation, Inc.,
 * 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package cssSweet
 *
 */

// Never fire on the front end
if ($modx->context->get(\'key\') !== \'mgr\') return;

// In case the wrong event is enabled in plugin properties
$allowedEvents = array(\'OnSiteRefresh\',\'OnChunkFormSave\',\'ClientConfig_ConfigChange\');
if (!in_array($modx->event->name, $allowedEvents)) return;

// Grab the cssSweet clas
$csssweet = null;
$cssSweetPath = $modx->getOption(\'csssweet.core_path\', null, $modx->getOption(\'core_path\') . \'components/csssweet/\');
$cssSweetPath .= \'model/csssweet/\';
if (file_exists($cssSweetPath . \'csssweet.class.php\')) $csssweet = $modx->getService(\'csssweet\', \'CssSweet\', $cssSweetPath);

if (!$csssweet || !($csssweet instanceof CssSweet)) {

    $modx->log(modX::LOG_LEVEL_ERROR, \'[SaveCustomCss] could not load the required csssweet class!\');
	return;

}

// Dev mode option
$mode = $modx->getOption(\'dev_mode\', $scriptProperties, \'custom\', true);
// Letting folks know what\'s going on
$modx->log(modX::LOG_LEVEL_INFO, \'saveCustomJs plugin is running in mode: \' . $mode);

// Override properties with mode props
$properties = $scriptProperties;
foreach ($properties as $key => $val) {
    // skip any mode props
    if (strpos($key, $mode) === 0) continue;
    // these are standard scriptProperties
    $properties[$key] = (isset($properties[$mode . \'_\' . $key])) ? $properties[$mode . \'_\' . $key] : $val;
}

// Specify a comma-separated list of chunk names in plugin properties
$chunks = $csssweet->explodeAndClean($modx->getOption(\'js_chunks\', $properties, \'\'));
// If no chunk names specified, there\'s nothing to do.
if (empty($chunks)) {
    $modx->log(modX::LOG_LEVEL_WARN, \'No chunks were set in the saveCustomJs plugin property js_chunks. No action performed.\');
    return;
}

// Don\'t run this for every ChunkSave event
if ($modx->event->name === \'OnChunkFormSave\' && !in_array($chunk->get(\'name\'), $chunks)) return;

// Specify an output file name in plugin properties
$filename = $modx->getOption(\'js_filename\', $properties, \'\');
if (empty($filename)) return;

// Optionally minify the output, defaults to \'true\'
$minify_custom_js = (bool) $modx->getOption(\'minify_custom_js\', $properties, true);

// Strip comment blocks; defaults to \'false\'
$strip_comments = (bool) $modx->getOption(\'strip_js_comment_blocks\', $properties, false);
$preserve_comments = ($strip_comments) ? false : true;

// Get the output path; construct fallback; log for info/debugging
$csssCustomJsPath = $modx->getOption(\'js_path\', $properties, \'\');
if (empty($csssCustomJsPath)) $csssCustomJsPath = $modx->getOption(\'assets_path\') . \'components/csssweet/\' . $mode . \'/js/\';
$modx->log(modX::LOG_LEVEL_INFO, \'$csssCustomJsPath is: \' . $csssCustomJsPath . \' on line: \' . __LINE__);
$csssCustomJsPath = rtrim($csssCustomJsPath, \'/\') . \'/\';

// If directory exists but isn\'t writable we have a problem, Houston
if (file_exists($csssCustomJsPath) && !is_writable($csssCustomJsPath)) {
    $modx->log(modX::LOG_LEVEL_ERROR, \'The directory at \' . $csssCustomJsPath . \'is not writable!\');
    return;
}

// Check if directory exists, if not, create it
if (!file_exists($csssCustomJsPath)) {
    if (mkdir($csssCustomJsPath, 0755, true)) {
        $modx->log(modX::LOG_LEVEL_INFO, \'Directory created at \' . $csssCustomJsPath);
    } else {
        $modx->log(modX::LOG_LEVEL_ERROR, \'Directory could not be created at \' . $csssCustomJsPath);
        // We can\'t continue in this case
        return;
    }
}

// Initialize settings array
$settings = array();

// Get context settings
$settings_ctx = $modx->getOption(\'context_settings_context\', $properties, \'\');
if (!empty($settings_ctx)) {
    $settings_ctx = $modx->getContext($settings_ctx);
    if ($settings_ctx && is_array($settings_ctx->config)) $settings = array_merge($settings, $settings_ctx->config);
}

// Attempt to get Client Config settigs
$settings = $csssweet->getClientConfigSettings($settings);

/* Make settings available as [[++tags]] */
$modx->setPlaceholders($settings, \'+\');

// Parse chunk with $settings array
$contents = $csssweet->processChunks($chunks, $settings);

// If there\'s no result, what\'s the point?
if (empty($contents)) return;

// Comments
$contents = \'/* Contents generated by MODX - this file will be overwritten. */\' . PHP_EOL . $contents;
if ($preserve_comments) {
    // Add \'!\' token to preserve all comments
    $contents = str_replace(array(\'/*\',\'/*!\'), \'/*!\', $contents);
} else {
    // We discard flagged comments if the strip_js_comment_blocks property is true. Good idea or no?
    $contents = str_replace(\'/*!\', \'/*\', $contents);
}

// Define target file
$file = $csssCustomJsPath . $filename;

// Status report
$status = \'not\';
if ($minify_custom_js) {

		$jshrink = $csssweet->jshrinkInit();

	    // If we got the class, try minification. Log failures.
	    if ($jshrink) {

	        try {
	            $contents = $jshrink::minify($contents, array(\'flaggedComments\' => $preserve_comments));
	            $status = \'\';
	        }
	        catch (Exception $e) {
	            $modx->log(modX::LOG_LEVEL_ERROR, $e->getMessage() . \'— js not compiled. Minification not performed.\');
	        }

	    } else {
	        $modx->log(modX::LOG_LEVEL_ERROR, \'Failed to load js Minifier class — js not compiled. Minification not performed.\');
	    }

}

// None of the minifiers seem to handle this correctly?
$contents = str_replace(\'!function\', PHP_EOL . \'!function\', $contents);

// If we didnt\' minify, output what we have
file_put_contents($file, $contents);
if (file_exists($file) && is_readable($file)) $modx->log(modX::LOG_LEVEL_INFO, \'Minification was \'. $status . \' performed. Custom JS saved to file: \' . $file);',
      'locked' => 0,
      'properties' => 'a:7:{s:9:"js_chunks";a:7:{s:4:"name";s:9:"js_chunks";s:4:"desc";s:73:"Name of chunk, or comma-separated list of chunks, from which to parse JS.";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:19:"csssweet:properties";s:4:"area";s:0:"";}s:11:"js_filename";a:7:{s:4:"name";s:11:"js_filename";s:4:"desc";s:42:"Name of file to output custom compiled JS.";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:16:"custom_js.min.js";s:7:"lexicon";s:19:"csssweet:properties";s:4:"area";s:0:"";}s:8:"dev_mode";a:7:{s:4:"name";s:8:"dev_mode";s:4:"desc";s:16:"Enable DEV mode.";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:6:"custom";s:7:"lexicon";s:19:"csssweet:properties";s:4:"area";s:4:"Mode";}s:7:"js_path";a:7:{s:4:"name";s:7:"js_path";s:4:"desc";s:61:"Full path for directory to which to OUTPUT the final JS file.";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:19:"csssweet:properties";s:4:"area";s:0:"";}s:24:"context_settings_context";a:7:{s:4:"name";s:24:"context_settings_context";s:4:"desc";s:79:"The key of a single context from which to pull context settings for CSS values.";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:19:"csssweet:properties";s:4:"area";s:0:"";}s:16:"minify_custom_js";a:7:{s:4:"name";s:16:"minify_custom_js";s:4:"desc";s:20:"Minify JS on output.";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:19:"csssweet:properties";s:4:"area";s:12:"Minification";}s:23:"strip_js_comment_blocks";a:7:{s:4:"name";s:23:"strip_js_comment_blocks";s:4:"desc";s:35:"Strips JS comment blocks on output.";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:0;s:7:"lexicon";s:19:"csssweet:properties";s:4:"area";s:12:"Minification";}}',
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * saveCustomJs
 * @author @sepiariver
 * Copyright 2013 - 2015 by YJ Tso <yj@modx.com> <info@sepiariver.com>
 *
 * saveCustomJs and cssSweet is free software;
 * you can redistribute it and/or modify it under the terms of the GNU General
 * Public License as published by the Free Software Foundation;
 * either version 2 of the License, or (at your option) any later version.
 *
 * saveCustomJs and cssSweet is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * saveCustomJs and cssSweet; if not, write to the Free Software Foundation, Inc.,
 * 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package cssSweet
 *
 */

// Never fire on the front end
if ($modx->context->get(\'key\') !== \'mgr\') return;

// In case the wrong event is enabled in plugin properties
$allowedEvents = array(\'OnSiteRefresh\',\'OnChunkFormSave\',\'ClientConfig_ConfigChange\');
if (!in_array($modx->event->name, $allowedEvents)) return;

// Grab the cssSweet clas
$csssweet = null;
$cssSweetPath = $modx->getOption(\'csssweet.core_path\', null, $modx->getOption(\'core_path\') . \'components/csssweet/\');
$cssSweetPath .= \'model/csssweet/\';
if (file_exists($cssSweetPath . \'csssweet.class.php\')) $csssweet = $modx->getService(\'csssweet\', \'CssSweet\', $cssSweetPath);

if (!$csssweet || !($csssweet instanceof CssSweet)) {

    $modx->log(modX::LOG_LEVEL_ERROR, \'[SaveCustomCss] could not load the required csssweet class!\');
	return;

}

// Dev mode option
$mode = $modx->getOption(\'dev_mode\', $scriptProperties, \'custom\', true);
// Letting folks know what\'s going on
$modx->log(modX::LOG_LEVEL_INFO, \'saveCustomJs plugin is running in mode: \' . $mode);

// Override properties with mode props
$properties = $scriptProperties;
foreach ($properties as $key => $val) {
    // skip any mode props
    if (strpos($key, $mode) === 0) continue;
    // these are standard scriptProperties
    $properties[$key] = (isset($properties[$mode . \'_\' . $key])) ? $properties[$mode . \'_\' . $key] : $val;
}

// Specify a comma-separated list of chunk names in plugin properties
$chunks = $csssweet->explodeAndClean($modx->getOption(\'js_chunks\', $properties, \'\'));
// If no chunk names specified, there\'s nothing to do.
if (empty($chunks)) {
    $modx->log(modX::LOG_LEVEL_WARN, \'No chunks were set in the saveCustomJs plugin property js_chunks. No action performed.\');
    return;
}

// Don\'t run this for every ChunkSave event
if ($modx->event->name === \'OnChunkFormSave\' && !in_array($chunk->get(\'name\'), $chunks)) return;

// Specify an output file name in plugin properties
$filename = $modx->getOption(\'js_filename\', $properties, \'\');
if (empty($filename)) return;

// Optionally minify the output, defaults to \'true\'
$minify_custom_js = (bool) $modx->getOption(\'minify_custom_js\', $properties, true);

// Strip comment blocks; defaults to \'false\'
$strip_comments = (bool) $modx->getOption(\'strip_js_comment_blocks\', $properties, false);
$preserve_comments = ($strip_comments) ? false : true;

// Get the output path; construct fallback; log for info/debugging
$csssCustomJsPath = $modx->getOption(\'js_path\', $properties, \'\');
if (empty($csssCustomJsPath)) $csssCustomJsPath = $modx->getOption(\'assets_path\') . \'components/csssweet/\' . $mode . \'/js/\';
$modx->log(modX::LOG_LEVEL_INFO, \'$csssCustomJsPath is: \' . $csssCustomJsPath . \' on line: \' . __LINE__);
$csssCustomJsPath = rtrim($csssCustomJsPath, \'/\') . \'/\';

// If directory exists but isn\'t writable we have a problem, Houston
if (file_exists($csssCustomJsPath) && !is_writable($csssCustomJsPath)) {
    $modx->log(modX::LOG_LEVEL_ERROR, \'The directory at \' . $csssCustomJsPath . \'is not writable!\');
    return;
}

// Check if directory exists, if not, create it
if (!file_exists($csssCustomJsPath)) {
    if (mkdir($csssCustomJsPath, 0755, true)) {
        $modx->log(modX::LOG_LEVEL_INFO, \'Directory created at \' . $csssCustomJsPath);
    } else {
        $modx->log(modX::LOG_LEVEL_ERROR, \'Directory could not be created at \' . $csssCustomJsPath);
        // We can\'t continue in this case
        return;
    }
}

// Initialize settings array
$settings = array();

// Get context settings
$settings_ctx = $modx->getOption(\'context_settings_context\', $properties, \'\');
if (!empty($settings_ctx)) {
    $settings_ctx = $modx->getContext($settings_ctx);
    if ($settings_ctx && is_array($settings_ctx->config)) $settings = array_merge($settings, $settings_ctx->config);
}

// Attempt to get Client Config settigs
$settings = $csssweet->getClientConfigSettings($settings);

/* Make settings available as [[++tags]] */
$modx->setPlaceholders($settings, \'+\');

// Parse chunk with $settings array
$contents = $csssweet->processChunks($chunks, $settings);

// If there\'s no result, what\'s the point?
if (empty($contents)) return;

// Comments
$contents = \'/* Contents generated by MODX - this file will be overwritten. */\' . PHP_EOL . $contents;
if ($preserve_comments) {
    // Add \'!\' token to preserve all comments
    $contents = str_replace(array(\'/*\',\'/*!\'), \'/*!\', $contents);
} else {
    // We discard flagged comments if the strip_js_comment_blocks property is true. Good idea or no?
    $contents = str_replace(\'/*!\', \'/*\', $contents);
}

// Define target file
$file = $csssCustomJsPath . $filename;

// Status report
$status = \'not\';
if ($minify_custom_js) {

		$jshrink = $csssweet->jshrinkInit();

	    // If we got the class, try minification. Log failures.
	    if ($jshrink) {

	        try {
	            $contents = $jshrink::minify($contents, array(\'flaggedComments\' => $preserve_comments));
	            $status = \'\';
	        }
	        catch (Exception $e) {
	            $modx->log(modX::LOG_LEVEL_ERROR, $e->getMessage() . \'— js not compiled. Minification not performed.\');
	        }

	    } else {
	        $modx->log(modX::LOG_LEVEL_ERROR, \'Failed to load js Minifier class — js not compiled. Minification not performed.\');
	    }

}

// None of the minifiers seem to handle this correctly?
$contents = str_replace(\'!function\', PHP_EOL . \'!function\', $contents);

// If we didnt\' minify, output what we have
file_put_contents($file, $contents);
if (file_exists($file) && is_readable($file)) $modx->log(modX::LOG_LEVEL_INFO, \'Minification was \'. $status . \' performed. Custom JS saved to file: \' . $file);',
    ),
  ),
  '5b5342878690954a1c185c56508c1eca' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 32,
      'event' => 'OnSiteRefresh',
    ),
    'object' => 
    array (
      'pluginid' => 32,
      'event' => 'OnSiteRefresh',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '25f398d5959e84841caf85693f6d5fe7' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 32,
      'event' => 'OnChunkFormSave',
    ),
    'object' => 
    array (
      'pluginid' => 32,
      'event' => 'OnChunkFormSave',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
);