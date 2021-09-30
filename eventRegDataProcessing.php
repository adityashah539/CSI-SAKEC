<?php
require_once "config.php";
$part1 = '<div class="alert alert-success alert-dismissible fade show" role="alert">';
$part2 = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></div>';
if (($_SERVER['REQUEST_METHOD'] == "POST")) {
    $email = $_POST['email'];
    $typeOfUser = $_POST['typeOfUser'];
    $eventId = $_POST['eventId'];
    $fee = $_POST['feeOfEvent'];
    if (($typeOfUser == "1000") || ($typeOfUser == "1001")) {
        $count = $_POST['count'];
        if ($count != 0) {
            //insert the data in userdata from dims
            $sql = "SELECT  `d`.`sem_id`, `d`.`std_roll_no`, `i`.`division`, `student_name`, `email`, `s_phone`,`admission_type`,`s`.`program`
                    FROM `division_details` as `d`, `intake` as `i`, `student_table` as `s`
                    WHERE  `s`.`email`= '$email' AND `d`.`std_id` = `s`.`std_id` and `d`.`sem_id` = `i`.`sem_id`";
            $dimsData = getValue($sql);
            $name = $dimsData['student_name'];
            $year = $dimsData['admission_type'];
            $phonenumber = $dimsData['s_phone'];
            $branch = $dimsData['program'];
            $division = $dimsData['division'];
            $rollno = $dimsData['std_roll_no'];
            $organisation = "sakec";
        } else {
            $name = $_POST['name'];
            $year = $_POST['year'];
            $phonenumber = $_POST['phonenumber'];
            $branch = $_POST['branch'];
            $division = NULL;
            $rollno = NULL;
            $organisation = $_POST['collegeName'];
        }
        $gender = $_POST['gender'];
        $sql = execute("INSERT INTO `csi_userdata`(`name`, `year`, `division`, `rollNo`, `emailID`, `phonenumber`, `branch`, `role`, `gender`, `organization`) VALUES ('$name','$year','$division','$rollno','$email','$phonenumber','$branch','6','$gender','$organisation')");
        $userId = getSpecificValue("SELECT `id`FROM `csi_userdata` WHERE `emailID`='$email'", "id");
        if ($fee == 0) {
            $sqlEvent = execute("INSERT INTO `csi_collection`(`event_id`, `user_id`,`confirmed`, `confirmed_by`) VALUES ($eventId,$userId,1,'auto')");
            echo "true";
            //redirect_after_msg("Registration Successfull","http://localhost/CSI-SAKEC/event.php?event_id=$eventId");
        }
    }
    if (($typeOfUser == "1101") || ($typeOfUser == "1001")||($typeOfUser == "0101")) {
        $userId = getSpecificValue("SELECT `id`FROM `csi_userdata` WHERE `emailID`='$email'", "id");
        $imageStatus = fileTransfer('bill_photo', "Eventmanagement/Event_Bill");
        if (!isset($imageStatus['error'])) {
            $eventBill = $imageStatus['file_new_name'];
            if (execute("INSERT INTO `csi_collection`(`event_id`,`user_id`,`bill_photo`,`amount`) VALUES ($eventId,$userId,'$eventBill','$fee')")) {
                echo "true";
               //redirect_after_msg("Waiting for confirmation","http://localhost/CSI-SAKEC/event.php?event_id=$eventId");
            }
        } else {
            echo $part1 . $imageStatus['file_new_name'] . $part2;
        }
    }
}
