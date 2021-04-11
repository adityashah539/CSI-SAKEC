<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <link rel="stylesheet" href="css/login.css">
    <title>CSI-SAKEC</title>
    <?php
    require_once "config.php";
    session_start();
    ob_start();
    function function_alert($message)
    {
        echo 
        "<SCRIPT>
            alert('$message');
        </SCRIPT>";
    }
    if(isset($_GET['notlogin'])){
        if($_GET['notlogin']){
            function_alert("You need to login to access the feature.");
        }
    }
    if (isset($_SESSION['email'])) {
        header("location: index.php");
        exit;
    }
    else{
        $username = $password = $err = "";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $email =filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
            $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
            if (empty($email) && empty($password)) {
                $err = "Please enter username and password";
            }
            else if(empty($email)){
                $err = "Please enter username ";
            } 
            else if(empty($password)){
                $err = "Please enter password ";
            }
            else if(!strpos(trim($_POST['email']),"@sakec.ac.in")){
                $err = "Pls enter the college email Id";
            }
            if(empty($err)) {
                $sql = "SELECT emailID, password  FROM userdata WHERE emailID = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 's', $param_email);
                $param_email = $email;
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        mysqli_stmt_bind_result($stmt, $email, $hashed_Password);
                        if (mysqli_stmt_fetch($stmt)) {
                            if ($password === $hashed_Password) {
                                $sql = "SELECT `userdata`.`id`,`role`.`role_name`  FROM `userdata` INNER JOIN `role` ON `userdata`.`role`=`role`.`id`WHERE `userdata`.`emailID` = '$email'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $_SESSION["role"] = $row["role_name"];
                                $_SESSION["id"] = $row["id"];
                                $_SESSION["email"] = $email;
                                if(isset($_POST['rememeber_me'])){
                                    setcookie('email',$email,time()+86400);
                                    setcookie('password',$password,time()+86400);
                                }
                                header("location:index.php");
                            } else {
                                function_alert("Plese enter the corrrect password");
                            }
                        }
                    }
                }
            }
            else{
                function_alert($err);
            }
        }
    }
    ?>
</head>

<body>
    <div class="container text-center">
        <div class="spacer" style="height:50px;"></div>
        <div id="user-login">
            <p class="login"><b>USER LOGIN</b></br></br><i class="fas fa-user-circle" style="font-size:80px;"></i></p>
            </br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <i class="far fa-user-circle" style="font-size:30px;"></i>
                <input title="your username" id="text" type="text" class="g" name="email" required="required" placeholder=" Username"></br>
                <i class="fas fa-lock" style="font-size:30px;"></i>
                <input  title="your password" id="pass" type="password" class="g" name="password" required="required" placeholder=" Input Password"></br>
                <input class="me" name="rememeber_me" type="checkbox">Remember me</br>
                <button type="submit" value="submit" class="btn btn-primary">Login<i class="fas fa-sign-in-alt"></i></button>
            </form>
            </br></br>
            <p><a style="color: rgb(168, 192, 212);" href="forgotpassword.php">Forgot password</a></p>
            <p><a style="color: rgb(168, 192, 212);" href="signup.php">Sign Up</a></p>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            //image height
            var winHeight = $(window).height();
            var winHeightImg = $(window).height() - 50;
            $('#user-login').css('height', winHeightImg);
        })
    </script>
</body>

</html>