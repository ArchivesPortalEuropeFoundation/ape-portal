<?php
// this acts as a basic router for most ajax requests so you don't have to keep adding snippets...

$modx->log(\modX::LOG_LEVEL_ERROR, print_r($_REQUEST, 1));

// include mailchimp
require_once $modx->getOption('core_path') . 'components/mailchimpv3/autoload.php';
use DrewM\MailChimp\GelMailchimp AS GelMailchimp; // helper class for tags etc
GelMailchimp::init($modx);

$success = false;
$response = array('status' => 400, 'message' => 'sorry, something went wrong, please try again.');

switch ($_REQUEST['action']) {

    case "blog_subscribe":
        GelMailchimp::quickSubscribe($_REQUEST['email'], null);
        GelMailchimp::addOrCreateTagToMember($_REQUEST['email'], "newsletter", true);

        $response['status'] = 200;
        $response['message'] = "User added to mailing list";
        break;

    default:
        $response['status'] = 400;
        $response['message'] = "Action could not be found.";
}

header_remove();
http_response_code($response['status']);
header('Content-Type: application/json');
echo json_encode($response);