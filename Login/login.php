<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="../css/login.css?v=<?php echo time(); ?>"  type="text/css">
    <title>CSI-SAKEC</title>
    <?php
    require_once "../config.php";
    session_start();
    ob_start();
    function alert($message){
        echo "<SCRIPT> alert('$message');</SCRIPT>";
    }
    $err = "";
    if (isset($_GET['notlogin'])) {
        if ($_GET['notlogin']) {
            $err .= "You need to login to access the feature.";
        }
    }
    if (isset($_SESSION['email'])) {
        header("location: index.php");
        exit;
    } else {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
            } else if (strpos($email, "@sakec.ac.in")===false) {
                if ($err !== "")
                    $err .= "<br>";
                $err .= "Pls enter the college email Id ";
            } else {
                $sql = "SELECT emailID, password  FROM csi_userdata WHERE emailID = '$email'";
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) == 1) {
                    $row = mysqli_fetch_assoc($query);
                    $hash = $row['password'];
                    if (password_verify($password, $hash)) {
                        $sql = "SELECT `csi_role`.`role_name` from `csi_userdata`,`csi_role` WHERE `emailID`='$email' And `csi_role`.`id`=`csi_userdata`.`role`";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $_SESSION["role"] = $row["role_name"];
                        $_SESSION["email"] = $email;
                        if (isset($_POST['rememeber_me'])) {
                            setcookie('email', $email, time() + 86400);
                            setcookie('password', $password, time() + 86400);
                        }
                        header("location:../index.php");
                    } else if ($email !== "") {
                        if ($err !== "")
                            $err .= "<br>";
                        $err .= "Wrong Password";
                    }
                }
            }
        }
    }
    if((isset($err))&&($err!="")){
        //alert($err);
        echo "<SCRIPT> alert('$err');</SCRIPT>";
    }
    ?>
</head>

<body>
    <div class="container text-center">
        <div class="spacer" style="height:50px;"></div>
        <div id="user-login">
            <p class="login"><b>USER LOGIN</b></br></br><i class="fas fa-user-circle" style="font-size:80px;"></i></p>
            </br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <i class="far fa-user-circle" style="font-size:30px;"></i>
                <input title="your username" id="text" type="text" class="g" name="email" required="required" placeholder=" Username"></br>
                <i class="fas fa-lock" style="font-size:30px;"></i>
                <input title="your password" id="pass" type="password" class="g" name="password" required="required" placeholder=" Input Password"></br>
                <div class="spacer" style="height:10px;"></div>
                <input class="me" name="rememeber_me" type="checkbox">Remember me</br>
                <div class="spacer" style="height:30px;"></div>
                <button type="submit" value="submit" class="btn main_btn ">Login<i class="fas fa-sign-in-alt"></i></button>
            </form>
            </br></br>
            <p><a  href="forgotpassword.php">Forgot password</a></p>
            <p><a  href="signup.php">Sign Up</a></p>
        </div>
    </div>

    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery-3.4.1.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->

    <script>
        $(document).ready(function() {
            //image height
            var winHeight = $(window).height();
            var winHeightImg = $(window).height() - 50;
            $('#user-login').css('height', winHeightImg);
        })
    </script>
</body>

</html>