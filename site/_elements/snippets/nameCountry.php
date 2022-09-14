$output = $modx->runSnippet('FormItCountryOptions',array('tpl'=>'@CODE [[+text]]','limited'=>$country));
$modx->log(modX::LOG_LEVEL_ERROR, "Country value is ".print_r($country, 1));
$modx->log(modX::LOG_LEVEL_ERROR, "Output is ".print_r($output, 1));
return $output;