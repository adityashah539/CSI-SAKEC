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
</head>
<script>
    function validateEmail() {
        var email = document.getElementById("email").value;
        alert(email);
        // window.location.replace('fpotp.php')
        document.getElementById("user-login").style.display = "none";
        document.getElementById("errorMsg").style.display = "block";

        //  document.getElementById("user-login").style.display ="block";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.responseText);
                // document.getElementById("user-login").style.display ="block";
            }
        };
        xhttp.open("POST", "new.php", true);
        xhttp.send("value");
        alert(xhttp.responseText);

    }
</script>

<body>

    <div class="container text-center">
        <div class="spacer" style="height:50px;"></div>
        <div>
            <p class="login"><b> FORGET PASSWORD </b></br></br><i class="fas fa-user-circle" style="font-size:80px;"></i></p>
            </br>
            </br>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                <!-- <span id="errorMsg" style="display: none;">
                    
                <i class="far fa-user-circle" style="font-size:30px;"></i>
                <input data-toggle="tooltip" data-placement="bottom" title="one time password (OTP)" id="text1" type="number" class="g"  name="email" required="required" placeholder=" enter otp send on your mail "></br>
                <button type="submit" value="submit" class="btn btn-primary">
                    submit otp
                </button>
            </span> 
                     -->
                <span id="user-login" style.display="block" ;>
                    <div>
                        <p> please fill email used for login</p>
                        <i class="far fa-user-circle" style="font-size:30px;"></i>
                        <input data-toggle="tooltip" data-placement="bottom" title="your username" id="email" type="text" class="g" name="email" required="required" placeholder=" email used for login "></br>
                        <button type="submit" id="btn" value="submit" class="btn btn-primary">
                            send otp
                        </button>
                    </div>
                </span>

            </form>
        </div>
    </div>

    <?php
    session_start();
    require_once "config.php";

    function send_mail($to_email, $subject, $body, $headers)
    {

        if (mail($to_email, $subject, $body, $headers)) {
            echo "Email successfully sent to $to_email...";
        } else {
            echo "Email sending failed...";
        }
    }


    //window.location.replace('index.php')
    function function_alert($message)
    {
        echo
        "<SCRIPT>
        alert('$message');
    </SCRIPT>";
    }


    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $email = trim($_POST['email']);

        $emailquery = "SELECT * FROM `userdata` WHERE  emailID='$email'";

        $query = mysqli_query($conn, $emailquery);

        $emailcount = mysqli_num_rows($query);

        $_SESSION['OTP'] = 69;
        //rand(100001,999999);

        //pemail represents the email id of the user trying to forget password (used in newPassword.php) 
        $_SESSION['Pemail'] = $email;

        if ($emailcount == 1) {
            //$to_email="rahullsoni04@gmail.com";
            $userdata = mysqli_fetch_array($query);
            $firstName = $userdata['firstName'];
            $lastName = $userdata['lastName'];

            $subject = "Password reset ";

            $body = "hi," . $firstName . " " . $lastName . " your O.T.P. is " . $_SESSION['OTP'];

            $headers = "From: guptavan96@gmail.com";

            //send_mail($to_email,$subject,$body,$headers);
            if (mail($email, $subject, $body, $headers)) {
                $_SESSION['msg'] = "Reset link send to $email pleases check your email to reset your password";
                echo "Hello , " . $_SESSION['msg'];
                header("Location:fp.php");
            } else {
                //echo "Email Sending Failed";
                function_alert("Email Sending  Failed else of mail function");
                //window.location.replace('index.php');
            }
        } else {
            echo "NO EMAIL FOUND";
        }
    }
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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