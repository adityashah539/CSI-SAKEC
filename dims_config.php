<?php
    define('DB_NAMES', 'dims');
    $dims_conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAMES);
    if ($conn == false) {
        die('Error: Cannot connect');
    } 
?>