error_reporting(E_ALL);
ini_set("disaplay_errors", 1);

require_once MODX_CORE_PATH . 'components/asi/vendor/autoload.php';
use mikehaertl\wkhtmlto\Pdf;

$pdf = new Pdf($modx->getOption('site_url')."export-result-archives/?id=".$_GET['id']);
$filename = sha1(date(U)."_23i4g324_".rand(0,99999)).".pdf";

if (!$pdf->saveAs(MODX_CORE_PATH.'../uploads/generated_pdfs/'.$filename)) {
    $error = $pdf->getError();
    // ... handle error here
}
$modx->sendRedirect("/uploads/generated_pdfs/".$filename);
exit();