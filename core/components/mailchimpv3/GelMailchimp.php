<?php
namespace DrewM\MailChimp;

use DrewM\MailChimp\MailChimp AS MailChimp;

// helper class for some functions
class GelMailchimp {

    protected static $modx;
    protected static $debug = true; // turn off to reduce logging

    protected static function log($msg) {
        $modx = self::$modx;
        $modx->log(\xPDO::LOG_LEVEL_ERROR, $msg);
    }

    public static function init($modx) {
        self::$modx = $modx;
    }

    // takes a fullname and splits it
    public static function quickSubscribe($email, $fullname = null) {

        $modx = self::$modx;

        $setting_apikey = $modx->getOption('mailchimp_key');
        $setting_listid = $modx->getOption('mailchimp_list');

        $setting_lastname = '';
        $setting_firstname ='';
        if(!is_null($fullname)) {
            $parts = explode(" ", $fullname);
            $setting_lastname = array_pop($parts);
            $setting_firstname = implode(" ", $parts);
        }

        $MailChimp = new MailChimp($setting_apikey);
        $result = $MailChimp->post("lists/$setting_listid/members", array(
            'email_address' => $email,
            'status'        => 'subscribed',
            'merge_fields' => array(
                'FNAME' => $setting_firstname,
                'LNAME' => $setting_lastname,
            ),
            'double_optin' => false,
            'update_existing' => true,
            'replace_interests' => false
        ));
        return self::handleResult($result);
    }

    // searches for tag_name and creates it if it doenst exist and adds it to user(s)
    // can give single email string, or array of email addresses
    // @params
    // $email mixed, string or array
    // $tag_name the name of the tag
    // $add_remove boolean true to add to tag, false to remove from tag
    public static function addOrCreateTagToMember($email, $tag_name, $add_remove=true) {

        $existing = self::getTags();

        $match = false;
        if(isset($existing['segments'])) {
            foreach($existing['segments'] AS $k => $v) {
                if($existing['segments'][$k]['name'] == $tag_name) {
                    $match = true;
                    $tag_id = $existing['segments'][$k]['id'];
                }
            }
        }
        if($match == false) {
            $tag_id = self::addNewTagToAudience($tag_name);
        }
        return self::addTagToMember($email, $tag_id, $add_remove);
    }

    public static function addTagToMember($email, $tag_id, $add_remove) {

        $modx = self::$modx;

        $setting_apikey = $modx->getOption('mailchimp_key');
        $setting_listid = $modx->getOption('mailchimp_list');

        $MailChimp = new MailChimp($setting_apikey);

        if($add_remove == true) {
            // POST /lists/{list_id}/segments/{segment_id}/members
            $result = $MailChimp->post("/lists/$setting_listid/segments/$tag_id/members", array(
                "email_address" => $email
            ));
        }else{
            // DELETE /lists/{list_id}/segments/{segment_id}/members/{subscriber_hash}
            $result = $MailChimp->delete("/lists/$setting_listid/segments/$tag_id/members/".self::getSubscriberHash($email), array());
        }
        return self::handleResult($result);
    }

    public static function getTags() {

        $modx = self::$modx;

        $setting_apikey = $modx->getOption('mailchimp_key');
        $setting_listid = $modx->getOption('mailchimp_list');

        $MailChimp = new MailChimp($setting_apikey);
        $result = $MailChimp->get("/lists/".$setting_listid."/segments", array());
        return $result;
    }

    public static function addNewTagToAudience($tag_name) {

        $modx = self::$modx;

        $setting_apikey = $modx->getOption('mailchimp_key');
        $setting_listid = $modx->getOption('mailchimp_list');

        $MailChimp = new MailChimp($setting_apikey);
        $result = $MailChimp->post("/lists/".$setting_listid."/segments", array(
            "name" => $tag_name,
            "static_segment" => array()
        ));

        if(self::handleResult($result)) return $result['id'];
        return false;
    }

    // logs errors etc in case of API failure etc
    protected static function handleResult($result) {

        $modx = self::$modx;

        if ($result === false) {
            // response wasn't even json
            self::log('MailChimp response : FAIL : Response wasnt even json.');
            return false;
        } else if (isset($result->status) && $result->status == 'error') {
            // Error info: $result->status, $result->code, $result->name, $result->error
            self::log('MailChimp response : FAIL : ' . $result->status . ' ' . $result->code . ' ' . $result->name . ' ' . $result->error);
            return false;
        }
        elseif($result['status'] == 400) {
            self::log('MailChimp response : FAIL : '.print_r($result, 1));
            return false;
        }
        else {
            self::log('MailChimp response : SUCCESS : '.print_r($result, 1));
            return $result;
        }
    }

    public static function getSubscriberHash($email) {
        return md5(strtolower($email));
    }

    public static function unsubscribe($email) {
        $modx = self::$modx;

        $setting_apikey = $modx->getOption('mailchimp_key');
        $setting_listid = $modx->getOption('mailchimp_list');

        $MailChimp = new MailChimp($setting_apikey);
        $result = $MailChimp->delete("/lists/$setting_listid/members/".self::getSubscriberHash($email), array());
        return self::handleResult($result);
    }
}