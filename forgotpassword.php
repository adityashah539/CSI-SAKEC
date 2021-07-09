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
    session_start();
    require_once "config.php";
    $step=1;
    function function_alert($message)
    {
        echo
            "<SCRIPT>
            alert('$message');
            </SCRIPT>";
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['email'])){
            $_SESSION['email'] =filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
            $email =$_SESSION['email'];
            $sql = "SELECT * FROM `csi_userdata` WHERE  emailID='$email'";
            $query = mysqli_query($conn, $sql);
            $emailcount = mysqli_num_rows($query);
            if ($emailcount == 1) {
                $_SESSION['otp']=rand(100001,999999);
                $userdata = mysqli_fetch_array($query);
                $firstName = $userdata['firstName'];
                $lastName = $userdata['lastName'];
                $subject = "Password Reset ";
                $body = "Hello, " . $firstName . " " . $lastName . " your O.T.P. for resting the password from Sakec csi website is " .$_SESSION['otp'];
                $headers = "From: guptavan96@gmail.com";
                if (mail($email, $subject, $body, $headers)) {
                    $step=2;
                    echo $email."</br>".$subject."</br>". $body."</br>". $headers;
                } else {
                    $step=null;
                    function_alert("Email was unsucessful...");
                }
                $_SESSION['time']=time();
            } else {
                function_alert("This email is not signup.");
            }
        }
        else if(isset($_POST["submit_opt"])){
            if(isset($_POST["otp"])){
                $user_otp=trim($_POST["otp"]);
                $dif_time=time()-$_SESSION['time'] ;
                if($user_otp==$_SESSION['otp']){
                    if($dif_time<120){
                        $step=3;
                    }else{
                        $step=2;
                        function_alert("Time Limit exceeded.");
                    }
                }
                else{
                    $step=2;
                    function_alert("Entered opt is worng.");
                }
            }
        }
        else if(isset($_POST['resend_opt'])){
            $step=2;
            $email =$_SESSION['email'];
            $_SESSION['otp']=rand(100001,999999);
            $subject = "Password Reset";
            $body =" Your O.T.P. for resting the password from Sakec csi website is " .$_SESSION['otp'];
            $headers = "From: guptavan96@gmail.com";
            if (mail($email, $subject, $body, $headers)) {
                function_alert("OTP has been re-send.");
            } else {
                function_alert("Email was unsucessful...");
            }
            $_SESSION['time']=time();
        }
        else if(isset($_POST['new_password'])){
            $new_password = trim($_POST['new_password']);
            $confrim_password = trim($_POST['confirm_password']);
            if($confrim_password==$new_password){
                $email =$_SESSION['email'];
                $sql = "UPDATE `csi_userdata` SET `password`='$new_password' WHERE emailID = '$email'";
                $query = mysqli_query($conn, $sql);
                unset($_SESSION['email'],$_SESSION['otp'],$_SESSION['time']);
                header("location:login.php");
            }
            else{
                $step= 3;
                function_alert("Passwords does not match");
            }
        }
    }
    ?>
</head>

<body>
    <div class="container text-center">
        <div class="spacer" style="height:50px;"></div>
        <div id="user-login">
            <p class="login"><b>Forgot Password</b></br></br><i class="fas fa-user-lock" style="font-size:80px;"></i></p>
            </br>
                <?php
                    if($step ==1){
                ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <i class="far fa-user-circle" style="font-size:30px;"></i>
                            <input title="Enter the email used for resetting" type="text" class="g" name="email" required="required" placeholder="Your Email "></br>
                            <button type="submit" value="submit" class="btn btn-primary">Submit Email</button>
                        </form>
                <?php
                    }
                    else if($step==2){
                ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <i class="fas fa-lock-open" style="font-size:30px;"></i>
                            <input title="Enter your opt that you got on email" type="number" class="g" name="otp" placeholder="Your OTP">
                            <input type="submit" value="Re-send Otp" name="resend_opt" class="btn btn-link"></br>
                            <div>Time left = <span id="timer"></span></div></br>
                            <input type="submit" value="Submit Otp" name="submit_opt" class="btn btn-primary">
                        </form>
                <?php
                    }
                    else if($step==3){
                ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <i class="fas fa-lock" style="font-size:30px;"></i>
                            <input title="Enter your new password" type="text" class="g" name="new_password" required="required" placeholder="Enter Your New Password "></br>
                            <i class="fas fa-lock" style="font-size:30px;"></i>
                            <input title="Enter your confirm password " type="text" class="g" name="confirm_password" required="required" placeholder="Confirm Password"></br>
                            <button type="submit" value="submit" class="btn btn-primary">Submit Password</button>
                        </form>
                        
                <?php
                    }
                ?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        let timerOn = true;
        function timer(remaining) {
        var m = Math.floor(remaining / 60);
        var s = remaining % 60; 
        m = m < 10 ? '0' + m : m;
        s = s < 10 ? '0' + s : s;
        document.getElementById('timer').innerHTML = m + ':' + s;
        remaining -= 1;
        if(remaining >= 0 && timerOn) {
            setTimeout(function() {
                timer(remaining);
            }, 1000);
            return;
        }
        if(!timerOn) {
            // Do validate stuff here
            return;
        }
        // Do timeout stuff here
        alert('Timeout for otp');
        }
        timer(120);
        </script>
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