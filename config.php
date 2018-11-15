<?php
/**
 * Created by PhpStorm.
 * User: israe
 * Date: 22/09/2018
 * Time: 09:55
 */

    //----------Google API Configuration----------\\
    require_once "GoogleAPI/vendor/autoload.php";
    $client = new Google_Client();
    $client->setClientId("196368149635-2jht96ius79u58olq0n5a48qjsgiq57d.apps.googleusercontent.com");
    $client->setClientSecret("52joNzs1XFtyZu_bB_fTiPo2");
    $client->setApplicationName("CMS Project");
    $client->setRedirectUri("http://localhost:8080/CMS%20Project/callback.php");
    $client->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

    //----------Facebook SDK Configuration----------\\
    require_once "Facebook/autoload.php";
    try {
        $fb_client = new \Facebook\Facebook([
            'app_id' => '329490334465403',
            'app_secret' => '7e5cd40c2c3b44da85f4a88fd9f1397e'
        ]);
    } catch (\Facebook\Exceptions\FacebookSDKException $e){
        echo "SDK Exception: ".$e->getMessage();
    }
    $helper = $fb_client->getRedirectLoginHelper();

?>