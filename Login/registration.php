<?php
require_once "../config.php";
require_once "../dims_config.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_SESSION['input'] == "sakec") {
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
        if (strpos($email, "@sakec.ac.in") !== false) {
            $sql = "SELECT `csi_password`.`password` FROM `csi_password`,`csi_userdata` WHERE `csi_userdata`.`emailID`='$email' AND `csi_password`.`user_id`=`csi_userdata`.`id` ";
            $query = mysqli_query($conn, $sql);
            if (mysqli_num_rows($query) == 0) {
                    $password = trim($_POST["password"]);
                    $confirmpassword = trim($_POST["confirmpassword"]);
                    if ($password === $confirmpassword) {
                        $division= trim($_POST["division"]);
                        $rollno= trim($_POST["rollno"]);
                        $gender = trim($_POST["gender"]);
                        $sql="SELECT   `student_name`, `s_phone`,`admission_type`,`program`  FROM `student_table` WHERE `email`='$email'";
                        $result = mysqli_query($dims_conn, $sql);
                        $auto_fetch = mysqli_fetch_assoc($result);
                        $password = password_hash($password, PASSWORD_BCRYPT);
                        $sql = "SELECT `id` FROM `csi_role` WHERE `role_name`='student'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $role = $row['id'];
                        $sql = "INSERT INTO `csi_userdata`(`name`, `year`, `division`, `rollNo`, `emailID`, `phonenumber`, `branch`, `role`, `gender`) 
                                                    VALUES   ('".$auto_fetch['student_name']."','".$auto_fetch['admission_type']."','$division','$rollno',  '$email','".$auto_fetch['s_phone']."','".$auto_fetch['program']."','$role','$gender')";
                        mysqli_query($conn, $sql);
                        $user_id = mysqli_insert_id($conn);
                        $sql = "INSERT INTO `csi_password`(`user_id`,`password`) VALUES ('$user_id','$password')";
                        mysqli_query($conn, $sql);
                        echo "<script>location.href='/csi-sakec/Login/login.php';</script>";
                    } else {
                        echo ("Plese enter the corrrect password");
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
                    $sql = "SELECT `id` FROM `csi_role` WHERE `role_name`='student'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $role = $row['id'];
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
                    mysqli_query($conn, $sql);
                    echo "<script>location.href='/csi-sakec/Login/login.php';</script>";
                } else {
                    echo ("Plese enter the corrrect password");
                }
            } else {
                echo ("Phone numeber does not contains 10-digit.");
            }
        } else {
            echo ("You have alredy signed up.");
        }
    }
}
