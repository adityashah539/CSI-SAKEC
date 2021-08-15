<?php
require_once "../config.php";
session_start();
$part1 = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
$part2 = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></div>';
$err = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $registrationProcess = $_POST["registrationProcess"];
    if(isset($_SESSION['signupEmail'])){
        $email = trim($_SESSION['signupEmail']);
        unset($_SESSION['signupEmail']);
        unset($_SESSION['email']);
        $password = trim($_POST["password"]);
        $confirmpassword = trim($_POST["confirmpassword"]);
        if ($password === $confirmpassword) {
            $password = password_hash($password, PASSWORD_BCRYPT);
            if ($registrationProcess==md5("existingUser")) {
                $user_id = getSpecificValue("SELECT `id`  FROM `csi_userdata` WHERE `emailID`='$email'", 'id');
                execute("INSERT INTO `csi_password`(`user_id`,`password`) VALUES ('$user_id','$password')");
                goToFile('login.php');
            } else {
                $gender = trim($_POST["gender"]);
                $role = getSpecificValue("SELECT `id` FROM `csi_role` WHERE `role_name`='student'", "id");
                if ($registrationProcess == md5("sakec")) {
                    $gender = trim($_POST["gender"]);
                    $sql = "SELECT  `d`.`sem_id`, `d`.`std_roll_no`, `i`.`division`, `student_name`, `email`, `s_phone`,`admission_type`,`s`.`program`
                            FROM `division_details` as `d`, `intake` as `i`, `student_table` as `s`
                            WHERE  `s`.`email`= '$email' AND `d`.`std_id` = `s`.`std_id` and `d`.`sem_id` = `i`.`sem_id`";
                    $auto_fetch = getValue($sql);
                    $name = $auto_fetch['student_name'];
                    $year = $auto_fetch['admission_type'];
                    $division = $auto_fetch['division'];
                    $rollno = $auto_fetch['std_roll_no'];
                    $phonenumber = $auto_fetch['s_phone'];
                    $branch = $auto_fetch['program'];
                    execute("INSERT INTO `csi_userdata`(`name`,`year`,`division`, `rollNo`, `emailID`, `phonenumber`, `branch`, `role`, `gender`) VALUES ('$name','$year','$division','$rollno', '$email','$phonenumber','$branch','$role','$gender')");
                    $user_id = mysqli_insert_id($conn);
                    execute("INSERT INTO `csi_password`(`user_id`,`password`) VALUES ('$user_id','$password')");
                    goToFile('login.php');
                } else if ($registrationProcess == md5("non-sakec")) {
                    $phonenumber = trim($_POST["phonenumber"]);
                    if ($phonenumber >= 1000000000 && $phonenumber <= 9999999999) {
                        $name = trim($_POST["name"]);
                        $organization = trim($_POST["collegeName"]);
                        $branch = trim($_POST["branch"]);
                        $year = trim($_POST["year"]);
                        execute("INSERT INTO `csi_userdata`(`name`, `year`, `emailID`, `phonenumber`, `branch`, `role`, `gender`,`organization`) VALUES ('$name','$year', '$email','$phonenumber','$branch','$role','$gender','$organization')");
                        $user_id = mysqli_insert_id($conn);
                        execute("INSERT INTO `csi_password`(`user_id`,`password`) VALUES ('$user_id','$password')");
                        goToFile('login.php');
                    } else {
                        echo ($part1."Phone number does not contains 10-digit.".$part2);
                    }
                }
            }
        }else {
            echo ($part1."Please enter the correct password".$part2);
        }
    }else{
        echo ($part1."Email not Found !!".$part2);
    }
} 
