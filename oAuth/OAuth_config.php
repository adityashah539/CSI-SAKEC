<?php
function googleobject(){
    //Include Google Client Library for PHP autoload file
    require_once '../vendor/autoload.php';
    //Make object of Google API Client for call Google API
    $google_client = new Google_Client();
    //Set the OAuth 2.0 Client ID
    $google_client->setClientId('159353966442-gr7au60l9noshlk968icbhd5592ga3fc.apps.googleusercontent.com');
    //Set the OAuth 2.0 Client Secret key
    $google_client->setClientSecret('utPKB1N2vMDESlHrp9BXcDpD');
    //Set the OAuth 2.0 Redirect URI
    // $google_client->setRedirectUri('http://localhost/CSI-SAKEC/Login/login.php');
    // to get the email and profile 
    $google_client->addScope('email');
    $google_client->addScope('profile');
    return $google_client;
}
function removeDulicateRow($conn){
    $sql   = "DELETE FROM `csi_userdata` WHERE `id` IN ( SELECT `id` FROM `csi_userdata` GROUP BY `emailID` HAVING COUNT(*) >1)'";
    return mysqli_query($conn, $sql);
    
}
function doesEmailIdExists($email){
    require_once("config.php");
    $sql   = "SELECT COUNT(`id`) as `count` FROM `csi_userdata` WHERE `emailID`='$email'";
    $query = mysqli_query($conn, $sql);
    $row   = mysqli_fetch_assoc($query);
    if ($row['count']==0){
        return false;
    }
    else if ($row['count']==1){
        return true;
    }
    else if ($row['count']>1){
        removeDulicateRow($conn);
        return true;
    }
}


?>