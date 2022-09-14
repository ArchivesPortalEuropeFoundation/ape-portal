<?php
$modx->log(xPDO::LOG_LEVEL_ERROR,'In setup Profile snippet...');


// MAILCHIMP ///////////
$enable = $modx->getoption('enable_mailchmip');
if($enable == 1) {
    $modx->log(xPDO::LOG_LEVEL_ERROR,'Mailchimp is enabled...');
    $setting_apikey = $modx->getoption('mailchimp_key');
    $setting_listid = $modx->getoption('mailchimp_list_id');
    $parts = explode(" ", $hook->getValue('customer_name'));
    $setting_lastname = array_pop($parts);
    $setting_firstname = implode(" ", $parts);

    $MailChimp = new MailChimp($setting_apikey);
    $result = $MailChimp->call('lists/subscribe', array(
        'id' => $setting_listid,
        'email' => array('email' => $hook->getValue('customer_email')),
        'merge_vars' => array(
            'FNAME' => $setting_firstname,
            'LNAME' => $setting_lastname,
            'ADDRESS' => strtoupper($hook->getValue('customer_address')),
            'POSTCODE' => strtoupper($hook->getValue('customer_postcode')),
        ),
        'double_optin' => false,
        'update_existing' => true,
        'replace_interests' => false
    ));

    if( $result === false ) {
        // response wasn't even json
        $modx->log(xPDO::LOG_LEVEL_ERROR,'addToMailchimp : Response wasnt even json.');
        return true;
    }
    else if( isset($result->status) && $result->status == 'error' ) {
        // Error info: $result->status, $result->code, $result->name, $result->error
        $modx->log(xPDO::LOG_LEVEL_ERROR, 'addToMailChimp : ' . $result->status . ' ' . $result->code . ' ' . $result->name . ' ' . $result->error);
        return true;
    }
}