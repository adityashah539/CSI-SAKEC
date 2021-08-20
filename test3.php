<?php

// $sql = "SELECT  `d`.`sem_id`, `d`.`std_roll_no`, `i`.`division`, `student_name`, `email`, `s_phone`,`admission_type`,`s`.`program`
//                     FROM `division_details` as `d`, `intake` as `i`, `student_table` as `s`
//                     WHERE  `s`.`email`= '$email' AND `d`.`std_id` = `s`.`std_id` and `d`.`sem_id` = `i`.`sem_id`";
//                 $auto_fetch = getValue($sql);
//                 $name = $auto_fetch['student_name'];
//                 $year = $auto_fetch['admission_type'];
//                 $division = $auto_fetch['division'];
//                 $rollno = $auto_fetch['std_roll_no'];
//                 $phonenumber = $auto_fetch['s_phone'];
//                 $branch = $auto_fetch['program'];
require 'config.php';
session_start();
$part1 = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
$part2 = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></div>';
$userId="";


if(($_SERVER['REQUEST_METHOD']=="POST")) {
    echo $_POST['type'];
    $userId="";
    $eventId=$_GET['eventId'];
    if(($_POST['type'])=="1101"){
        $userId=$_POST['userId'];
        //GET BILL PHOTO AND FILL IT IN DATA BASE
    }else if(($_POST['type'])=="100"){
        $name=$_POST['name'];
        $year=$_POST['year'];
        $emailId=$_POST['emailId'];
        $branch=$_POST['branch'];
        $organisation=$_POST['organisation'];
        $role="1";
        $fee=$_POST['fee'];

        $sql=execute("INSERT INTO `csi_userdata`( `name`, `year`, `emailID`,  `branch`, `role`,`organization`)
                 VALUES ('$name','$year','$emailId','$branch','$role','$organisation')");
        $userId=getSpecificValue("SELECT `id`FROM `csi_userdata` WHERE `emailID`='$email'","id");
        $sqlEvent=execute("INSERT INTO `csi_collection`(`event_id`, `user_id`,`amount`, `attend`) 
            VALUES ('$eventId','$userId','$fee',0)");
    }
    if($_POST['fee']!=0){
        //process bill photo in database
        echo "a";
    }
}else{
    echo $part1."REQUEST METHOD IS NOT POST".$part2;
}
?>