$path = $modx->getOption('sitexport.core_path', null, $modx->getOption('core_path') . 'components/sitexport/');
$path .= 'model/sitexport/';
$sitexport = $modx->getService('sitexport', 'sitexport', $path);

$tpl_id     = $modx->getOption('tpl', $scriptProperties, null);
$create_zip = (bool) $modx->getOption('zip', $scriptProperties, false);
$export_all = (bool) $modx->getOption('export_site', $scriptProperties, false);


$placeholders = [];
// Only export a single template
if(!is_null($tpl_id) && !$export_all) {
    try {
        $export = $sitexport->ExportSiteTpls($tpl_id, $create_zip);
        echo "<h1>Export successful, and ZIP file is here: {$export}</h1>";
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

// Export the entire site
if(is_null($tpl_id) && $export_all) {
    try {
        $export = $sitexport->ExportSite($tpl_id, $create_zip);
        echo "<h1>Exported all site templates successful, and ZIP file is here: {$export}</h1>";
    } catch (Exception $e) {
        return $e->getMessage();
    }
}





//return print_r($sitexport->ExportSite(8),1);