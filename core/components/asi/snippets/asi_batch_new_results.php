<?php
// this script runs a batch of new results
error_reporting(E_ALL);
ini_set("display_errors", 1);

// @TODO - parameterise these into modx config
$batch_password = "gow672nf";
$batch_size = 5;
$batch_date_int = "P1M";
$test_mode = true;

if(!isset($_REQUEST['token']) || $_REQUEST['token'] != $batch_password) {
    exit();
}

$now = new \DateTime();
$now->sub(new \DateInterval($batch_date_int));
$before_date_string = $now->format("Y-m-d");

// checking the user profile is a pain, grab them all and update regardless
// then we'll check the user profile and only email if yes
$sql = "SELECT s.* FROM modx_asi_search s WHERE (s.last_checked < '$before_date_string 00:00:00' OR s.last_checked IS NULL) ORDER BY s.last_checked ASC LIMIT $batch_size";
//echo $sql;

$result = $modx->query($sql);

if (is_object($result)) {
    $results = $result->fetchAll(\PDO::FETCH_ASSOC);

    //echo "<pre>".print_r($results, 1)."</pre>";

    foreach($results AS $row) {

        $url_parts = explode("/", $row['url']);
        $request = $modx->getOption("site_url")."get-results/?section=".$row['archive_type']."&".substr($url_parts[3], 1)."&since=".substr($row['last_checked'], 0, 10);
        echo $request;
        $json = file_get_contents($request);
        $obj = json_decode($json);
        //echo "<pre>".strip_tags(print_r($obj, 1))."</pre>";
        echo "COUNT IS ".$obj->count;

        $today_string = date("Y-m-d H:i:s");
        $sql = "UPDATE modx_asi_search SET last_checked = '".$today_string."' WHERE id = ".$row['id']." LIMIT 1";
        //echo $sql;
        $result = $modx->query($sql);

        if(isset($obj->count) && $obj->count > 0) {

            // get the user and see if they want an email update...
            $user = $modx->getObject('modUser', $row['user_id']);
            if(is_object($user)) {

                $profile = $user->getOne('Profile');
                $extended = $profile->get('extended');
                echo "<pre>".print_r($extended)."</pre>";
                if($extended['userpref_updates'] == "yes") {

                    $email_address = ($test_mode == true) ? "mark@gelstudios.co.uk" : $profile->get("email");
                    $content = "<p>You have ".$obj->count." new results for your saved search; '".$row['name']."'</p>";
                    $content.="<p>Please visit this link to view ".$modx->getOption('site_url').$row['url']."&since=".substr($row['last_checked'], 0, 10)."</p>";

                    $message = $content;
                    $modx->getService('mail', 'mail.modPHPMailer');
                    $modx->mail->set(modMail::MAIL_BODY, $message);
                    $modx->mail->set(modMail::MAIL_FROM, $modx->getOption('contact_email'));
                    $modx->mail->set(modMail::MAIL_FROM_NAME,$modx->getOption('site_name'));
                    $modx->mail->set(modMail::MAIL_SUBJECT,"New results were found for your saved search");
                    $modx->mail->address('to',$modx->getOption('contact_email'));
                    //$modx->mail->address('reply-to','me@xexample.org');
                    $modx->mail->setHTML(true);
                    if (!$modx->mail->send()) {
                        $modx->log(modX::LOG_LEVEL_ERROR,'An error occurred while trying to send the email: '.$modx->mail->mailer->ErrorInfo);
                    }
                    $modx->mail->reset();
                }
            }
            else {
                echo "User ".$row['user_id']." could not be found!";
            }
        }

    }
}