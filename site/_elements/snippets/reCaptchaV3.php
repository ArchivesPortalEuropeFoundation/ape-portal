<?php
if(!function_exists("getSenderIp")) {
function getSenderIp() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {$ip=$_SERVER['HTTP_CLIENT_IP'];}
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];}
    else {$ip=$_SERVER['REMOTE_ADDR'];}
    return $ip;
}
}
$data = array (
    'url'       => 'https://www.google.com/recaptcha/api/siteverify',
    'secret'    => $modx->getOption('recaptcha_secret_key'),
    'token'     => $hook->getValue('recaptcha_token'),
    'score'     => $modx->getOption('recaptcha_score') / 100,
    'message'   => $modx->getOption('recaptcha_error_message')
);

if (!isset($data['secret'])) {
    //Not setup
    return true;
}

if (!isset($data['token'])){
    $modx->setPlaceholder('fi.error.captcha', $data['message']);
    return false;
}

$ch = curl_init($data['url']);

curl_setopt_array($ch, array(
    CURLOPT_RETURNTRANSFER  => true,
    CURLOPT_POSTFIELDS      => array(
        'secret'    => $data['secret'],
        'response'  => $data['token'],
    )
));

$raw_reply = curl_exec($ch);
$reply = json_decode($raw_reply, 1);
curl_close($ch);

$modx->setPlaceholder('captcha_score', $reply['score']);
//error_log("reCaptcha score: ".$reply['score'], 0);

//Do we fail the minimum score?
if ($reply['score'] < $data['score']) {
    $modx->setPlaceholder('fi.error.captcha', $data['message']);
    return false;
}

return true;
