<?php

class Fb_login extends CI_Controller {

    private $uid;
    private $access_tokken;

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL);
        ini_set("display_errors", "1");
    }

    public function index() {
        $facebook = new Facebook(array(
            //'appId' => '1918734348368216',
            'appId' => '602795363233358',
            //'secret' => 'aa7d0414b032631d6bb51585cd18353f',
            'secret' => 'd8bbaaee5c0a14f159259d85ac87dfa6',
            'redirect_uri'=>base_url('home/fb_login')
        ));
        $fbuser = $facebook->getUser();
        //pr($fbuser);exit;
        if ($fbuser) {
            try {
                $me = $facebook->api('/me?fields=id,name,email');
                  pr($me);
                exit;
            } catch (FacebookApiException $e) {
                $fbuser = NULL;
            }
        } else {
            $login_url = $facebook->getLoginUrl(array(
                'redirect_uri' => base_url('home/fb_login'),
                'scope' => 'publish_actions,email')
            );
            header('Location: ' . $login_url);
        }
    }

}

?>
