$recipient = $hook->getValue('recipient');

if ($recipient == 'toTopic') {
    $address = $hook->formit->config['emailTopic'];
} elseif ($recipient == 'toTranslation') {
    $address = $hook->formit->config['emailTranslation'];
} elseif ($recipient == 'toConnect') {
    $address = $hook->formit->config['emailConnect'];
} elseif ($recipient == 'toOther') {
    $address = $hook->formit->config['emailOther'];
} else {
    return false;
}

$hook->formit->config['emailTo'] = $address;

return true;