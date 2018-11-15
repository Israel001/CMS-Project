<?php
/**
 * Created by PhpStorm.
 * User: israe
 * Date: 22/09/2018
 * Time: 10:08
 */

    include_once "includes/db.php";
    include_once "admin/functions.php";
    session_start();

    //----------Processing User Information from Google----------\\
    require_once "config.php";

    if(isset($_GET['code'])){
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $_SESSION['token'] = $token;

        $auth = new Google_Service_Oauth2($client);
        $data = $auth->userinfo_v2_me->get();

        if(email_exist($data['email'])){
            if(!checkTokenForEmail($data['email'])) {
                $email = $data['email'];
                if (loggedInUserRole($email)) {
                    $_SESSION['user_email'] = $email;
                    $_SESSION['username'] = loggedInUserName($email);
                    $_SESSION['firstname'] = loggedInUserFirstName($email);
                    $_SESSION['lastname'] = loggedInUserLastName($email);
                    $_SESSION['user_role'] = loggedInUserRole($email);
                    $_SESSION['user_password'] = loggedInUserPassword($email);
                    redirect('admin');
                }
            } else {
                ?>
                <script>
                    alert("Your account is not active. Please verify your email");
                    location.replace("login.php");
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert('This account is not registered on our website');
                location.replace("login.php");
            </script>
            <?php
        }
    }

    //----------Processing User Information on Facebook----------\\
    try {
        $accessToken = $helper->getAccessToken();
    } catch (\Facebook\Exceptions\FacebookResponseException $e){
        echo "Response Exception: ".$e->getMessage();
        exit();
    } catch (\Facebook\Exceptions\FacebookSDKException $e){
        echo "SDK Exception: ".$e->getMessage();
        exit();
    }

    if(!$accessToken){
        redirect('index.php');
    }

    $fb_auth = $fb_client->getOAuth2Client();
    if(!$accessToken->isLongLived()) {
        try {
            $accessToken = $fb_auth->getLongLivedAccessToken($accessToken);
        } catch (\Facebook\Exceptions\FacebookSDKException $e){
            echo "SDK Exception: ".$e->getMessage();
            exit();
        }
    }

    try {
        $response = $fb_client->get("/me?fields=email");
        $fb_data = $response->getGraphNode()->asArray();
        echo $fb_data['email'];
    } catch (\Facebook\Exceptions\FacebookSDKException $e){
        echo "SDK Exception: ".$e->getMessage();
    }

?>