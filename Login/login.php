<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/csi-logo.png">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="../css/login.css?v=<?php echo time(); ?>" type="text/css">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/jwt-decode@2.2.0/build/jwt-decode.min.js"></script>
    <title>CSI-SAKEC</title>
    <?php
    require_once "../config.php";
    session_start();
    $err = "";
    if (isset($_GET["code"])) {
        $email = loginWithGoogle($_GET["code"], $google_client);
        if (isset($email)) {
            $query = execute("SELECT `csi_password`.`password` FROM `csi_password`,`csi_userdata` WHERE `csi_userdata`.`emailID`='$email' AND `csi_password`.`user_id`=`csi_userdata`.`id`");
            if (mysqli_num_rows($query) == '1') {
                $row = mysqli_fetch_assoc($query);
                $row = getValue("SELECT `role` from `csi_userdata` WHERE `emailID`='$email' ");
                $_SESSION["role_id"] = $row["role"];
                $_SESSION['email'] = $email;
                $_SESSION["role"] = $row["role"];
                header("location:../index.php");
            } else {
                if ($err == "")
                    $err .= "<br>";
                $err .= "Pls signup ";
            }
        } else {
            if ($err == "") {
                $err .= "<br>";
                $err .= "Pls enter the college email Id ";
            }
        }
    } else if ((isset($_GET['notlogin']))&&($_GET['notlogin'])) {
        $err .= "You need to login to access the feature.";
    } elseif (isset($_SESSION['email'])) {
        header("location: ../index.php");
        exit;
    } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
        $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
        if (empty($email) && empty($password)) {
            if ($err !== "")
                $err .= "<br>";
            $err .= "Please enter username and password";
        } else if (empty($email)) {
            if ($err !== "")
                $err .= "<br>";
            $err .= "Please enter username ";
        } else if (empty($password)) {
            if ($err !== "")
                $err .= "<br>";
            $err .= "Please enter password ";
        } else if (strpos($email, "@sakec.ac.in") === false) {
            if ($err !== "")
                $err .= "<br>";
            $err .= "Pls enter the college email Id ";
        } else {
            $sql = "SELECT `csi_password`.`password` FROM `csi_password`,`csi_userdata` WHERE `csi_userdata`.`emailID`='$email' AND `csi_password`.`user_id`=`csi_userdata`.`id`";
            $query = mysqli_query($conn, $sql);
            if (mysqli_num_rows($query) == 1) {
                $row = mysqli_fetch_assoc($query);
                $hash = $row['password'];
                if (password_verify($password, $hash)) {
                    $row = getValue("SELECT `role` from `csi_userdata` WHERE `emailID`='$email' ");
                    $_SESSION["role_id"] = $row["role"];
                    $_SESSION["email"] = $email;
                    header("location:../index.php");
                } else if ($email !== "") {
                    if ($err !== "")
                        $err .= "<br>";
                    $err .= "Wrong Password";
                }
            }
        }
    }
    if ((isset($err)) && ($err != "")) {
        //alert($err);
        echo "<SCRIPT> alert('$err');</SCRIPT>";
    }
    ?>
</head>

<body>
    <div class="container text-center">
        <div class="spacer" style="height:50px;"></div>
        <div id="user-login">
            <p class="login">
                <b>USER LOGIN</b>
                </br>
                </br>
                <i class="fas fa-user-circle fa-2x"></i>
            </p>
            </br>
            <div id="error" >
            </div>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <i class="far fa-user-circle" style="font-size:30px;"></i>
                <input title="your username" id="text" type="text" class="g" name="email" required="required" placeholder=" Username"></br>
                <i class="fas fa-lock" style="font-size:30px;"></i>
                <input title="your password" id="pass" type="password" class="g" name="password" required="required" placeholder=" Input Password"></br>
                <div class="spacer" style="height:30px;"></div>
                <button type="submit" value="submit" class="btn main_btn ">Login<i class="fas fa-sign-in-alt"></i></button>
            </form>
            </br>
            </br>
            <div id="googleButton">
                <div id="g_id_onload"
                    data-client_id="159353966442-gr7au60l9noshlk968icbhd5592ga3fc.apps.googleusercontent.com"
                    data-context="use"
                    data-ux_mode="popup"
                    data-callback="handleCredentialResponse"
                    data-auto_prompt="false">
                </div>

                <div class="g_id_signin"
                    data-type="standard"
                    data-shape="pill"
                    data-theme="outline"
                    data-text="signin_with"
                    data-size="large"
                    data-logo_alignment="left">
                </div>
            </div>
            </br>
            <p><a href="forgotpassword.php">Forgot password</a></p>
            <p><a href="signup.php">Sign Up</a></p>
        </div>
    </div>
    

    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->


    <script>
        $(document).ready(function() {
            //image height
            var winHeight = $(window).height();
            var winHeightImg = $(window).height() - 50;
            $('#user-login').css('height', winHeightImg);
        })
        function handleCredentialResponse(response) {
            var decodedToken = jwt_decode(response.credential);
            var email = decodedToken.email; 
            $("#error").load("../GoogleLogin/GoogleLogin.php", {
                authProvider : "<?php echo md5("Google");?>",
                email : email
            });
        }
    </script>
</body>

</html>