<?php
function googleObject($redirect_uri){
    //Include Google Client Library for PHP autoload file
    require_once '../vendor/autoload.php';
    //Make object of Google API Client for call Google API
    $google_client = new Google_Client();
    //Set the OAuth 2.0 Client ID
    $google_client->setClientId('159353966442-gr7au60l9noshlk968icbhd5592ga3fc.apps.googleusercontent.com');
    //Set the OAuth 2.0 Client Secret key
    $google_client->setClientSecret('utPKB1N2vMDESlHrp9BXcDpD');
    //Set the OAuth 2.0 Redirect URI
    $google_client->setRedirectUri($redirect_uri);
    // $google_client->setRedirectUri('http://localhost/CSI-SAKEC/Login/login.php');
    // to get the email and profile 
    $google_client->addScope('email');
    $google_client->addScope('profile');
    return $google_client;
}
function loginWithGoogle($code,$google_client){
    $token = $google_client->fetchAccessTokenWithAuthCode($code);
    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();
        return $data['email'];
    }else{
        return $token['error'];
    }
}
function removeDulicateRow(){
    $sql   = "DELETE FROM `csi_userdata` WHERE `id` IN ( SELECT `id` FROM `csi_userdata` GROUP BY `emailID` HAVING COUNT(*) >1)'";
    return execute($sql);
}
function doesEmailIdExists($email){
    $count   = getSpecificValue("SELECT COUNT(`id`) as `count` FROM `csi_userdata` WHERE `emailID`='$email'", 'count');
    if ($count==0){
        return false;
    }
    else if ($count==1){
        return true;
    }
    else if ($count>1){
        removeDulicateRow();
        return true;
    }
}
