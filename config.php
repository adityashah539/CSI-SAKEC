<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'csi');
// Try connecting to the Database
// session_start();
// $_SESSION["role"] = "";
// $_SESSION["id"] = "";
// $_SESSION["loggedin"] = false;
// $_SESSION["email"] = "";
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
//Check the connection
if ($conn == false) {
    die('Error: Cannot connect');
} 