<?php
session_start();
require_once "../config.php";
$part1 = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
$part2 = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></div>';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST["authProvider"] == md5("Google")) {
        $email = $_POST["email"];
        $sql = "SELECT `csi_password`.`password` FROM `csi_password`,`csi_userdata` WHERE `csi_userdata`.`emailID`='$email' AND `csi_password`.`user_id`=`csi_userdata`.`id`";
        if (getNumRows($sql) == 1) {
            $row = getValue("SELECT `role` from `csi_userdata` WHERE `emailID`='$email' ");
            $_SESSION["role_id"] = $row["role"];
            $_SESSION["email"] = $email;
            goToFile("../index.php");
        } else {
            echo $part1."You have to sign up first".$part2;
        }
    } else {
        echo $part1."Authorization Failed".$part2;
    }
}
?>   