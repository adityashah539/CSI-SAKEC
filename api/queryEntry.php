<?php
require_once "../config.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $message = $_POST['message'];
    $query = "INSERT INTO `csi_query`( `c_email`, `c_query`) VALUES ('$email','$message')";
    $dataEntry = null;
    if (execute($query)){
        $dataEntry = true;
    }else{
        $dataEntry = false;
    }
    $data = array("dataEntry" => $dataEntry);
    echo json_encode($data);
}