<?php


// include mailchimp
require_once $modx->getOption('core_path') . 'components/mailchimpv3/autoload.php';
use DrewM\MailChimp\GelMailchimp AS GelMailchimp; // helper class for tags etc
GelMailchimp::init($modx);

// get user details
$profile = $modx->user->getOne('Profile');

if($modx->getOption('enable_mailchimp') == true) {
    //Add to mailchimp (in case they have changed their email etc)
    GelMailchimp::quickSubscribe($profile->get('email'), $profile->get('fullname'));

    // check form hooks
    $newsletter = ($hook->getValue('userpref_newsletter') == "yes") ? true : false;
    $materials = ($hook->getValue('userpref_materials') == "yes") ? true : false;
    $updates = ($hook->getValue('userpref_updates') == "yes") ? true : false;

    //Add / remove tags based on preferences
    GelMailchimp::addOrCreateTagToMember($profile->get('email'), "newsletter", $newsletter);
    GelMailchimp::addOrCreateTagToMember($profile->get('email'), "materials", $materials);
    GelMailchimp::addOrCreateTagToMember($profile->get('email'), "updates", $updates);
}
return true;