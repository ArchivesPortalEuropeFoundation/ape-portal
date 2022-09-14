$profile = $modx->user->getOne('Profile');
    $name = $profile->get('fullname');
    $arr = explode(' ',trim($name));
    return $arr[0];
return;