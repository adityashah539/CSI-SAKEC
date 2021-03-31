<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css'
        integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <link rel="stylesheet" href="css/signup.css">
    <title>CSI-SAKEC</title>
    <?php
    require_once "config.php";
    function function_alert($message)
    {
        echo
            "<SCRIPT>
            window.location.replace('signup.php')
            alert('$message');
        </SCRIPT>";
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $sql = "SELECT * FROM userdata WHERE emailId = ? or phonenumber= ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            $param_email = trim($_POST["email"]);
            $param_phonenumber = trim($_POST["phonenumber"]);
            mysqli_stmt_bind_param($stmt, "si", $param_email, $param_phonenumber);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    function_alert("The user already exits");
                } else {
                    $email = trim($_POST["email"]);
                    if (strpos($email, "@sakec.ac.in")) {
                        $phonenumber = trim($_POST["phonenumber"]);
                        if ($phonenumber < 999999999||$phonenumber > 1000000000) {
                            $password = trim($_POST["password"]);
                            $confrimpassword = trim($_POST["confrimpassword"]);
                            if ($password === $confrimpassword) {
                                session_start();
                                $branch = trim($_POST["branch"]);
                                $class = trim($_POST["year"]);
                                $firstname = trim($_POST["firstname"]);
                                $lastname = trim($_POST["lastname"]);
                                $sql = "INSERT INTO userdata (  firstName  , lastName  , emailID,  phonenumber  , branch  , class  , password  ,role) 
                                                    VALUES   ('$firstname','$lastname','$email ','$phonenumber','$branch','$class','$password' , 's')";
                                $stmt = mysqli_query($conn, $sql);
                                header("location: login.php");
                                mysqli_close($conn);
                            } else {
                                function_alert("Plese enter the corrrect password");
                            }
                        }else{
                            function_alert("Phone numeber does not contains 10-digit.");
                        }
                    } else {
                        function_alert("Pls enter the college email Id");
                    }
                }
            }
        }
    }
    ?>
</head>

<body>
    <div class="container text-center">
        <div class="spacer" style="height:50px;"></div>
        <div id="user-login">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <p class="login"><b>WELCOME !</b></p>
                <!-- </br></br><i class="fas fa-user-circle" style="font-size:80px;"></i></p></br> -->
                <div class="spacer" style="height:30px;"></div>
                <i class="fas fa-file-signature" style="font-size:30px;"></i>
                <input data-toggle="tooltip" data-placement="bottom" title="Your First name" id="text" type="text" class="g" name="firstname" placeholder=" First Name" required /></br>
                <i class="fas fa-signature" style="font-size:30px;"></i>
                <input data-toggle="tooltip" data-placement="bottom" title="Your Last name" id="text" type="text" class="g" name="lastname" placeholder="Last Name" required /></br>
                <div class="grid-container">
                    <div class="grid-item item1">
                        <div class="texts">
                            <select id="classyear" name="branch" required="required" class="custom-select mb-3">
                                <option disabled>Select Branch</option>
                                <option value="CS">Computer Science</option>
                                <option value="IT">Information Technology</option>
                                <option value="Electronics"> Electronics</option>
                                <option value="EXTC">EXTC</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid-item item2">
                        <div class="texts">
                            <select id="classyear" name="year" required="required" class="custom-select mb-3">
                                <option disabled>Select Class</option>
                                <option value="FE">FE</option>
                                <option value="SE">SE</option>
                                <option value="TE">TE</option>
                                <option value="BE">BE</option>
                            </select>
                        </div>
                    </div>
                </div>
                <i class="fas fa-mobile-alt" style="font-size:30px;"></i>
                <input data-toggle="tooltip" data-placement="bottom" title="Your Phone number" id="text" type="text" class="g" name="phonenumber" placeholder=" Phone Number" required />
                </br>
                <i class="far fa-envelope" style="font-size:30px;"></i>
                <input data-toggle="tooltip" data-placement="bottom" title="Type your email" id="text" type="text" class="g" name="email" placeholder=" Email" required />
                </br>
                <i class="fas fa-lock" style="font-size:30px;"></i>
                <input data-toggle="tooltip" data-placement="bottom" title="8 characters minimum" id="pass" type="password" name="password" class="g" placeholder=" Create Password" required /></br>
                <i class="fa fa-key" style="font-size:30px;"></i>
                <input data-toggle="tooltip" data-placement="bottom" title="Should be same as above" id="pass" type="password" name="confrimpassword" class="g" placeholder=" Retype Password" required />
                </br>
                <!-- <input class="me" type="checkbox">Remember me</br> -->
                <button class="btn btn-primary">Sign Up <i class="fas fa-user-plus "></i></button></br></br>
                <p>Existing User <a style="color: rgb(168, 192, 212)" ; href="login.php">Login</a></p>
                <div class="spacer" style="height:30px;"></div>
        </div>
    </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            //image height
            var winHeight = $(window).height();
            var winHeightImg = $(window).height();
            $('#user-login').css('height', winHeightImg);
        })
    </script>
</body>

</html>