<?php
require_once "../config.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $query = "SELECT `id` FROM `csi_newsletter` WHERE `emailid`='$email'";
    if (getNumRows($query)!=1){
        if(execute("INSERT INTO `csi_newsletter`( `emailid`) VALUES ('$email')")){
            $registration = true;
        }else{
            $registration = false;
        }
        $registered = false;
    }else{
        $registration = false;
        $registered = true; 
    }
    $data = array(
        "registration" => $registration,
        "registered" => $registered
    );
    echo json_encode($data);
}