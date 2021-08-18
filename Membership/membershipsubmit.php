<?php
    require_once "../config.php";
    session_start();

    $email = $_SESSION['email'];
    $userid = getSpecificValue("SELECT `id` from `csi_userdata` where emailID = '$email'", 'id');
    $noOfRows = getNumRows("SELECT `id` ,`userid` FROM `csi_membership` WHERE userid = $userid");


    $part1 = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">';
    $part2 = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></div>';
    
    $part3 = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">';
    $part4 = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></div>';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $amount = $_POST['amount'];
        if ($noOfRows == 0) {
            $pemail = $_POST['pemail'];
            $regno = $_POST['registration_number'];
            $dob = $_POST['dob'];
            $syear = $_POST['syear'];
            $eyear = $_POST['eyear'];
            execute("INSERT INTO `csi_membership`(`userid`, `dob`, `primaryEmail`, `startingYear`, `passingYear`, `r_number`)
                                            VALUES ('$userid','$dob','$pemail','$syear','$eyear','$regno')");
        }
        $membership_id = getSpecificValue("SELECT `id` from `csi_membership` where userid = '$userid'", 'id');

        // Insert bill in a folder
        $image = fileTransfer('billphoto', 'Membership_Bill');
        if ($image['error'] == NULL) {
            $file_new_bill = $image['file_new_name'];
            $no_of_year = $_POST['member_period'];
            $membership_ends = getSpecificValue("SELECT `duration` FROM `csi_membership` WHERE userid = $userid", 'duration');
            if ($membership_ends > date("Y-m-d")) {
                $membership_taken = $membership_ends;
            } else {
                $membership_taken = date("Y-m-d H:i:s", time());
            }
            execute("INSERT INTO `csi_membership_bills`(`membership_id`, `bill_photo`, `amount`, `membership_taken`, `no_of_year`,`accepted`)
                                                VALUES ('$membership_id','$file_new_bill','$amount','$membership_taken','$no_of_year','0')");
            echo ($part1."Membership form sent successfully".$part2);
        } else {
            echo ($part1.$image['error'].$part2);
        }
    }
?>