<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="../css/login.css?v=<?php echo time(); ?>">
    <title>CSI-SAKEC</title>
    <?php
    require_once "../config.php";
    function function_alert($message)
    {
        echo
            "<SCRIPT>
            window.location.replace('signup.php')
            alert('$message');
        </SCRIPT>";
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $sql = "SELECT * FROM csi_userdata WHERE emailId = ? or phonenumber= ?";
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
                                $password = password_hash( $password, PASSWORD_BCRYPT);
                                $sql="SELECT `id` FROM `csi_role` WHERE `role_name`='student'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $role = $row['id'];
                                $branch = trim($_POST["branch"]);
                                $year = trim($_POST["year"]);
                                $firstname = trim($_POST["firstname"]);
                                $lastname = trim($_POST["lastname"]);
                                $middlename = trim($_POST["middlename"]);
                                $rollno = trim($_POST["rollno"]);
                                $division = trim($_POST["division"]);
                                $gender = trim($_POST["gender"]);
                                $sql = "INSERT INTO `csi_userdata`(`firstName`, `middleName`, `lastName`, `year`, `division`, `rollNo`, `emailID`, `phonenumber`, `branch`, `password`, `role`, `gender`) 
                                                    VALUES   ('$firstname','$middlename','$lastname','$year','$division','$rollno',  '$email','$phonenumber','$branch','$password', '$role','$gender')";
                                // $sql = "INSERT INTO userdata (  firstName  , lastName  , emailID,  phonenumber  , branch  , year  , password  ,   role) 
                                //                     VALUES   ('$firstname','$lastname','$email ','$phonenumber','$branch','$year','$password' , '$role')";
                                $result = mysqli_query($conn, $sql);
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
                <input data-toggle="tooltip" data-placement="bottom" title="Your Middle name" id="text" type="text" class="g" name="middlename" placeholder="Middle Name" required /></br>
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
                    <div class="grid-item item3">
                        <div class="texts">
                            <select id="classyear" name="division" required="required" class="custom-select mb-3">
                                <option disabled>Select Division</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid-item item4">
                        <div class="texts">
                            <select id="classyear" name="gender" required="required" class="custom-select mb-3">
                                <option disabled>Select Division</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                </div>
                <i class="fas fa-mobile-alt" style="font-size:30px;"></i>
                <input data-toggle="tooltip" data-placement="bottom" title="Your Roll number" id="text" type="text" class="g" name="rollno" placeholder="Roll Number" required />
                </br>
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
    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->

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