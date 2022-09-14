<?php
// update the password (@todo - test validaton)
$password = $hook->getValue('new_password');
//$modx->user->changePassword($password,'123456');

$user = $modx->user;

$modx->user->set('password', $hook->getValue('new_password'));

if (!$user->save()) {
    die('ERROR: Could not save user.');
}

// update the extended fields to confirm signup complete
$user =  $modx->getUser();
$profile = $user->getOne('Profile');
$extended = $profile->get('extended');
$extended['completed_signup'] = 1;
$profile->set('extended', $extended);
$user->addOne($profile);
$user->save();
return true;