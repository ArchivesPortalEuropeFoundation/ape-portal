<?php

/**
 * Hook for selecting the right email address 
 * based on the institution ID 
 */

require_once(MODX_CORE_PATH . 'components/asi/autoload.php');
use asi\AsiManager AS asi;
asi::init($modx);

 $inst_id           = $hook->getValue('institution_id');
 $form_type         = $hook->getValue('form_type');

 $email_to          = $modx->getOption('contact_email'); // Get default email to 
 $email_name        = $modx->getOption('site_name');
 $default_email     = $modx->getOption('contact_email'); // Get default email to 
 $email_cc_to       = $hook->getValue('contact_email'); // Get default email to 

$institution_email  = null;
$user_email         = null;
$country_user_email = null;

// Get institution data 
if (!is_null($inst_id)) {
    if (!is_numeric($inst_id)) return (false); // if not int return false

    $institution_data = asi::doPostgreQuery("SELECT * FROM archival_institution WHERE id = ${$inst_id} ORDER BY id DESC LIMIT 5");
    if (empty($institution_data)) {
        return false;
    }

    $institution_email = $institution_data['feedback_email'];
}


// Get user data 
$institution_user_id    = $institution_data['user_id'];
$institution_user_data  = asi::doPostgreQuery("SELECT * FROM dashboard_user WHERE id = ${$institution_user_id} ORDER BY id DESC LIMIT 5");
if (!empty($institution_user_data)) {
    $user_email = $institution_user_data['email_address'];

    // Get Country user data 
    $country_id = $institution_user_data['country_id'];
    $country_user_data  = asi::doPostgreQuery("SELECT * FROM dashboard_user WHERE (country_id = ${$country_id} AND user_role_id = 1) ORDER BY id DESC LIMIT 5");
    if(!empty($country_user_data)) {
        $country_user_email = $country_user_data['email_address'];  
    }
}



// DIRECT
// RATE
// ENQUIRE
// SUGGEST
switch($form_type) {
    case 'DIRECT':
    case 'RATE':
    case 'ENQUIRE':

        if (!is_null($institution_email)) {
            $email_to   = $institution_email;
            $email_name = $institution_data['ainame'];
            // CC the Country manager as well 
            if(!is_null($country_user_email)) {
                $email_cc_to   = $country_user_email.','. $default_email;
            }
        } else {
            $email_to       = $country_user_email;
            $email_cc_to    = $default_email;
        }

    break;

    case 'SUGGEST':

        $email_to       = $country_user_email;
        $email_cc_to    = $default_email;

    break;
}

 $hook->setValue('emailToAddress', $email_to);
 $hook->setValue('emailToName', $email_name);
 $hook->setValue('emailCCAddress', $email_cc_to);

 return true;