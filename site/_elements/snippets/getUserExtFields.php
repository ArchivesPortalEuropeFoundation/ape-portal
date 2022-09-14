<?php

$profile = $modx->user->getOne('Profile');
$modx->toPlaceholders($profile->get('extended'), 'userExtFields');