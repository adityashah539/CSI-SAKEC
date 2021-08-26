<?php
    session_start();
    require_once "../config.php";
    $step = 1;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['email'])) {
            $_SESSION['email'] = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
            $email = $_SESSION['email'];
            $query = execute("SELECT * FROM `csi_userdata` WHERE  emailID='$email'");
            $emailcount = mysqli_num_rows($query);
            if ($emailcount == 1) {
                $_SESSION['otp'] = rand(100001, 999999);
                $userdata = mysqli_fetch_array($query);
                $name = $userdata['name'];
                $subject = "Password Reset ";
                $body = "Hello, " . $name . " your O.T.P. for resting the password from Sakec csi website is " . $_SESSION['otp'];
                $headers = "From: guptavan96@gmail.com";
                if (mail($email, $subject, $body, $headers)) {
                    $step = 2;
                    echo $email . "</br>" . $subject . "</br>" . $body . "</br>" . $headers;
                } else {
                    $step = null;
                    function_alert("Email was unsucessful...");
                }
                $_SESSION['time'] = time();
            } else {
                function_alert("This email is not signup.");
            }
        } else if (isset($_POST["submit_opt"])) {
            if (isset($_POST["otp"])) {
                $user_otp = trim($_POST["otp"]);
                $dif_time = time() - $_SESSION['time'];
                if ($user_otp == $_SESSION['otp']) {
                    if ($dif_time < 120) {
                        $step = 3;
                    } else {
                        $step = 2;
                        function_alert("Time Limit exceeded.");
                    }
                } else {
                    $step = 2;
                    function_alert("Entered opt is worng.");
                }
            }
        } else if (isset($_POST['resend_opt'])) {
            $step = 2;
            $email = $_SESSION['email'];
            $_SESSION['otp'] = rand(100001, 999999);
            $subject = "Password Reset";
            $body = " Your O.T.P. for resting the password from Sakec csi website is " . $_SESSION['otp'];
            $headers = "From: guptavan96@gmail.com";
            if (mail($email, $subject, $body, $headers)) {
                function_alert("OTP has been re-send.");
            } else {
                function_alert("Email was unsucessful...");
            }
            $_SESSION['time'] = time();
        } else if (isset($_POST['new_password'])) {
            $new_password = password_hash(trim($_POST['new_password']), PASSWORD_BCRYPT);
            $confrim_password = trim($_POST['confirm_password']);
            if ($confrim_password == $new_password) {
                $email = $_SESSION['email'];
                $query = execute("UPDATE `csi_userdata` SET `password`='$new_password' WHERE emailID = '$email'");
                unset($_SESSION['email'], $_SESSION['otp'], $_SESSION['time']);
                header("location:login.php");
            } else {
                $step = 3;
                function_alert("Passwords does not match");
            }
        }
    }
    ?>