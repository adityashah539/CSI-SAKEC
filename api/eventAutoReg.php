<?php
require_once "../config.php";
$registration = NULL;
$registered = NULL;
$error = NULL;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $eventId = $_POST['eventId'];
    if (isset($email) && isset($eventId)) {
        $user_id = getSpecificValue("SELECT `csi_userdata`.`id` as `user_id` FROM `csi_userdata` WHERE `emailID`='$email'", "user_id");
        $registered = getNumRows("SELECT `id` FROM `csi_collection` WHERE `event_id`= '$eventId' AND `user_id`='$user_id'");
        if ($registered == 0) {
            $sql = "INSERT INTO `csi_collection`(`event_id`,`user_id`,`confirmed`,`confirmed_by`) VALUES ('$eventId','$user_id','1','auto')";
            if (execute($sql)) {
                $registration = true;
            } else {
                $registration = false;
            }
        }
    }else{
        $error = 'Insufficient Data.';
    }
    
}else {
    $error = 'Access Denied';
}
$data = array(
    "registration"=>$registration,
    "registered"=>$registered,
    "error"=>$error
);
echo json_encode($data);
?>