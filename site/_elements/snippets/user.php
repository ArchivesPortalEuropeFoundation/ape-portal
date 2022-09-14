<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once MODX_CORE_PATH . 'components/geltools/autoload.php'; // include useful tools

if ($modx->getUser()->get('id') != 0) {

    //echo "user detected...";


    //We have a logged in user, lets get some values

    $user =  $modx->getUser();
    $profile = $user->getOne('Profile');
    $extended = $profile->get('extended');

    //For firstname/lastname splitting
    $parts = explode(" ", $profile->get('fullname'));
    $lastname = array_pop($parts);
    $firstname = implode(" ", $parts);

    $details = array (
        'id'            => $user->get('id'),
        'fullname'      => $profile->get('fullname'),
        'firstname'     => $firstname,
        'lastname'      => $lastname,
        'email'         => $user->get('username'),
        'language'      => $extended['userpref_language'],
        'delete_confirm' => $extended['userpref_delete']
    );

    $details['is_admin'] = 0;

    if ($user->isMember('Administrator')) {
        $details['is_admin'] = 1;
        //echo "is admin";
    }

    $details['logged_in'] = 1;

    // check to see if this is a new signup who hasn't completed setup yet... (except admins)
    if( (!isset($extended['completed_signup']) || $extended['completed_signup'] != 1) && ($details['is_admin'] != 1)) {

        // force account area
        // 72 - dashboard (might need to add logout etc)
        if($modx->resource->id != 72) {
            $url = $modx->makeUrl(72);
            $modx->sendRedirect($url);
        }

        // force popup
        $modx->regClientHTMLBlock($modx->getChunk("welcomePopup"));

        $triggersJs = <<<hereDoc123
<script>
$(document).ready(function(){
    $('#welcomePopup').modal({backdrop: 'static', keyboard: false});
})
</script>
hereDoc123;


        $modx->regClientHTMLBlock(GelTools::minifyJs($triggersJs));
    }

} else {
    //Non logged in functions.
    $details = array('logged_in' => 0);

    /*
    // modx forwarding on not authed / 404 seems a bit hap-hazard, lets bolster it
    $resource = $modx->resource;
    echo $resource->get('id');
    var_dump($resource->getResourceGroupNames());

    echo "hello";
    exit();
    */
}

$modx->setPlaceholders($details, 'user.');