<?php
// include mailchimp
require_once $modx->getOption('core_path') . 'components/mailchimpv3/autoload.php';
use DrewM\MailChimp\GelMAilchimp AS GelMailchimp; // helper class for tags etc
GelMailchimp::init($modx);

// grab the current user
$user = $modx->user;
$user_id = $user->get("id");

// grab the email, in case we need to delete the mailer stuff
$profile = $modx->user->getOne('Profile');
$email_address = $profile->get("email");
if(is_numeric($user_id)) {

    // delete the searches
    $sql = "DELETE FROM modx_asi_search WHERE user_id = $user_id";
    $result = $modx->query($sql);

    // delete the bookmarks
    $sql = "DELETE FROM modx_asi_bookmark WHERE user_id = $user_id";
    $result = $modx->query($sql);

    // delete the collections
    $sql = "DELETE FROM modx_asi_collection WHERE user_id = $user_id";
    $result = $modx->query($sql);

    // log the user out
    $user->removeSessionContext('web');

    // delete the user
    $user->remove();

    // if remove mail, unsubscribe the user from mailchimp
    if(isset($_REQUEST['remove_mail']) && $_REQUEST['remove_mail'] == 1) {

        GelMailchimp::unsubscribe($email_address);
    }
}