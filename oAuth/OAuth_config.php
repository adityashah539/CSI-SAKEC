<?php

//start session on web page
session_start();

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('159353966442-gr7au60l9noshlk968icbhd5592ga3fc.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('utPKB1N2vMDESlHrp9BXcDpD');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/CSI-SAKEC/index.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>