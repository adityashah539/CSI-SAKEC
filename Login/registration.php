<?php
require_once "../config.php";
require_once('../oAuth/OAuth_config.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_SESSION['input'] == "sakec") {
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
        if (strpos($email, "@sakec.ac.in") > 0) {
            $sql = "SELECT `csi_password`.`password` FROM `csi_password`,`csi_userdata` WHERE `csi_userdata`.`emailID`='$email' AND `csi_password`.`user_id`=`csi_userdata`.`id` ";
            $query = mysqli_query($conn, $sql);
            if (mysqli_num_rows($query) == 0) {
                $password = trim($_POST["password"]);
                $confirmpassword = trim($_POST["confirmpassword"]);
                if ($password === $confirmpassword) {
                    if (doesEmailIdExists($email)) {
                        $sql = "SELECT `id`  FROM `csi_userdata` WHERE `email`='$email'";
                        $result = mysqli_query($conn, $sql);
                        $user = mysqli_fetch_assoc($result);
                        $sql = "INSERT INTO `csi_password`(`user_id`,`password`) VALUES (" . $user['id'] . ",'$password')";
                        mysqli_query($conn, $sql);
                        echo "<script>location.href='/csi-sakec/Login/login.php';</script>";
                    } else {
                        $gender = trim($_POST["gender"]);
                        $sql = "SELECT  `d`.`sem_id`, `d`.`std_roll_no`, `i`.`division`, `student_name`, `email`, `s_phone`,`admission_type`,`s`.`program`
                                FROM `division_details` as `d`, `intake` as `i`, `student_table` as `s`
                                WHERE  `s`.`email`= '$email' AND `d`.`std_id` = `s`.`std_id` and `d`.`sem_id` = `i`.`sem_id`";
                        $auto_fetch = getValue($sql);
                        $name = $auto_fetch['student_name'] ;
                        $year = $auto_fetch['admission_type'] ;
                        $division = $auto_fetch['division'];
                        $rollno = $auto_fetch['std_roll_no'];
                        $phonenumber= $auto_fetch['s_phone'];
                        $branch =$auto_fetch['program'];
                        $password = password_hash($password, PASSWORD_BCRYPT);
                        $role = getSpecificValue("SELECT `id` FROM `csi_role` WHERE `role_name`='student'","id");
                        $sql = "INSERT INTO `csi_userdata`(`name`,`year`,`division`, `rollNo`, `emailID`, `phonenumber`, `branch`, `role`, `gender`) 
                                                VALUES   ('$name','$year','$division','$rollno', '$email','$phonenumber','$branch','$role','$gender')";
                        execute( $sql);
                        $user_id = mysqli_insert_id($conn);
                        $sql = "INSERT INTO `csi_password`(`user_id`,`password`) VALUES ('$user_id','$password')";
                        execute( $sql);
                        echo "<script>location.href='/csi-sakec/Login/login.php';</script>";
                    }  
                } else {
                    echo ("Plese enter the corrrect password". strpos($email, "@sakec.ac.in"));
                }
            } else {
                echo ("You have alredy signed up.");
            }
        } else {
            echo ("Pls enter the college email Id");
        }
    } else {
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
        $sql = "SELECT `csi_password`.`password` FROM `csi_password`,`csi_userdata` WHERE `csi_userdata`.`emailID`='$email' AND `csi_password`.`user_id`=`csi_userdata`.`id`";
        $query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query) == 0) {
            $phonenumber = trim($_POST["phonenumber"]);
            if ($phonenumber > 1000000000 && $phonenumber < 9999999999) {
                $password = trim($_POST["password"]);
                $confirmpassword = trim($_POST["confirmpassword"]);
                if ($password === $confirmpassword) {
                    $password = password_hash($password, PASSWORD_BCRYPT);
                    if (doesEmailIdExists($email)) {
                        $sql = "SELECT `id`  FROM `csi_userdata` WHERE `email`='$email'";
                        $result = mysqli_query($conn, $sql);
                        $user = mysqli_fetch_assoc($result);
                        $sql = "INSERT INTO `csi_password`(`user_id`,`password`) VALUES (" . $user['id'] . ",'$password')";
                        mysqli_query($conn, $sql);
                        echo "<script>location.href='/csi-sakec/Login/login.php';</script>";
                    } else {
                        $role = getSpecificValue("SELECT `id` FROM `csi_role` WHERE `role_name`='student'","id");
                        $branch = trim($_POST["branch"]);
                        $year = trim($_POST["year"]);
                        $name = trim($_POST["name"]);
                        $organization = trim($_POST["organization"]);
                        $gender = trim($_POST["gender"]);
                        $sql = "INSERT INTO `csi_userdata`(`name`, `year`, `emailID`, `phonenumber`, `branch`, `role`, `gender`,`organization`) 
                                                VALUES ('$name','$year', '$email','$phonenumber','$branch','$role','$gender','$organization')";
                        mysqli_query($conn, $sql);
                        $user_id = mysqli_insert_id($conn);
                        $sql = "INSERT INTO `csi_password`(`user_id`,`password`) VALUES ('$user_id','$password')";
                        execute($sql);
                        echo "<script>location.href='/csi-sakec/Login/login.php';</script>";
                    }
                } else {
                    echo ("Plese enter the corrrect password");
                }
            } else {
                echo ("Phone number does not contains 10-digit.");
            }
        } else {
            echo ("You have alredy signed up.");
        }
    }
}