<?php
    require_once "../config.php";
    session_start();
    $err = "";
    if ((isset($_GET['notlogin'])) && ($_GET['notlogin'])) {
        $err .= "You need to login to access the feature.";
    } elseif (isset($_SESSION['email'])) {
        goToFile("../index.php");
        exit;
    } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
        $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
        if (empty($email) && empty($password)) {
            $err .= "Please enter username and password";
        } else if (empty($email)) {
            $err .= "Please enter username ";
        } else if (empty($password)) {
            $err .= "Please enter password ";
        }else {
            $sql = "SELECT `csi_password`.`password` FROM `csi_password`,`csi_userdata` WHERE `csi_userdata`.`emailID`='$email' AND `csi_password`.`user_id`=`csi_userdata`.`id`";
            $query = mysqli_query($conn, $sql);
            if (mysqli_num_rows($query) == 1) {
                $row = mysqli_fetch_assoc($query);
                $hash = $row['password'];
                if (password_verify($password, $hash)) {
                    $row = getValue("SELECT `role` from `csi_userdata` WHERE `emailID`='$email' ");
                    $_SESSION["role_id"] = $row["role"];
                    $_SESSION["email"] = $email;
                    goToFile("../index.php");
                } else  {
                    $err .= "Wrong Password";
                }
            }else{
                $err .= "You have to sign up first";
            }
        }
    }
    $part1 = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    $part2 = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></div>';
    if ((isset($err)) && ($err != "")) {
        echo "$part1$err$part2";
    }
    ?>