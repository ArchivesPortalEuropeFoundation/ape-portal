// load package
$seoPro = $modx->getService('seopro','seoPro',$modx->getOption('seopro.core_path',null,$modx->getOption('core_path').'components/seopro/').'model/seopro/',$scriptProperties);
if (!($seoPro instanceof seoPro)) return '';
 
// get keywords object of current resource
$seoKeywords = $modx->getObject('seoKeywords', array('resource' => $modx->resource->get('id')));
$keywords = '';
if($seoKeywords){
	$keywords = $seoKeywords->get('keywords');
}
return $keywords;