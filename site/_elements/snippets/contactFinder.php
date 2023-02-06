<?php
//Identify the emails the various forms should be sent to
$APIbase      = $modx->getOption("ape_api");

//if ($type=='contact_form_explore'){
//    $type2 = 'contact_form_detail_page';
//}
//else if ($type=='rating_form_explore'){
//    $type2 = 'rating_form_detail_page';
//}
//else if ($type=='suggestion_form_explore'){
//    $type2 = 'suggestion_form_detail_page';
//}
//else {
//    $type2 = $type;
//}

$contactFinderUrl = "{$APIbase}Dashboard/contactFinderApi.action?aiRepositoryCode={$repoCode}&type={$type}";
error_log($contactFinderUrl,0);
$contactPersonDetails = json_decode(file_get_contents($contactFinderUrl));
if (isset($contactPersonDetails->errors)){
    error_log("Error loading contact person's email!", 0);
    $to = "info@archivesportaleurope.net";
    $placeholders[$type.'_to'] = $to;
}
else {
    $to = $contactPersonDetails->contactInformation->to;
    $cc = $contactPersonDetails->contactInformation->cc;
    $bcc = $contactPersonDetails->contactInformation->bcc;

    $placeholders[$type.'_to'] = $to;
    $placeholders[$type.'_cc'] = $cc;
    $placeholders[$type.'_bcc'] = $bcc;

//    error_log("TO: ".$to,0);
//    error_log("CC: ".$cc,0);
//    error_log("BCC: ".$bcc,0);
    
}

// Set placeholders to page
$modx->toPlaceholders($placeholders);

//return $placeholders;