<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/csi-logo.png">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="../css/login.css?v=<?php echo time(); ?>">
    <title>CSI-SAKEC</title>
    <?php
    require_once "../config.php";
    require_once('../oAuth/OAuth_config.php');
    session_start();
    $google_client = googleObject('http://localhost/CSI-SAKEC/Login/signup.php');
    ?>
</head>


<body>
    <div class="spacer" style="height:50px;"></div>
    <div id="user-login">
        <p class="login"><b>WELCOME !</b></p>
        <div id="error"></div>
        <!-- </br></br><i class="fas fa-user-circle" style="font-size:80px;"></i></p></br> -->
        <div class="container text-center">
            <?php
            if (!isset($_GET["code"])) {
            ?>
                <div class="spacer" style="height:20px;"></div>
                <h4>Step 1: Choose a option </h4>
                <div class="spacer" style="height:20px;"></div>
                <div id="option" class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-outline-light">
                        <input type="radio" name='option' value="sakec"> Sakec Student
                    </label>
                    <label class="btn btn-outline-light ">
                        <input type="radio" name='option' value="non-sakec"> Other College Student
                    </label>
                </div>
                <div class="spacer" style="height:30px;"></div>
                <div id="sakec" class="d-none">
                    <h4>Step 2: Click and choose your Sakec account </h4>
                    <div class="spacer" style="height:20px;"></div>
                    <p><a href="<?php echo $google_client->createAuthUrl(); ?>">Choose Sakec account With Google</a></p>
                </div>
                <div id="non-sakec" class="d-none">
                    <h4>Step 2: Click and choose any Google account </h4>
                    <div class="spacer" style="height:20px;"></div>
                    <p><a href="<?php echo $google_client->createAuthUrl(); ?>">Choose any Google account</a></p>
                </div>
            <?php
            } else if (isset($_GET["code"]) && isset($_SESSION['input']) && $_SESSION["input"] == "sakec") {
                $email = loginWithGoogle($_GET["code"], $google_client);
                if (isset($email)) {
                    if (!doesEmailIdExists($email)) {
            ?>
                        <input type="text" name="email" value="<?php echo $email; ?>" hidden>
                        <div class="grid-item item3">
                        </div>
                        <div class="grid-item item3">
                            <div class="texts">
                                <select id="gender" required="required" class="custom-select mb-3 ddm">
                                    <option disabled>Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <i class="fas fa-lock" style="font-size:30px;"></i>
                        <input data-toggle="tooltip" data-placement="bottom" title="8 characters minimum" type="password" name="password" class="g" placeholder=" Create Password" required /></br>
                        <i class="fa fa-key" style="font-size:30px;"></i>
                        <input data-toggle="tooltip" data-placement="bottom" title="Should be same as above" type="password" name="confirmpassword" class="g" placeholder=" Retype Password" required />
                        </br>
                        <button class="btn btn-primary" name="sign_up_sakec">Sign Up <i class="fas fa-user-plus "></i></button></br></br>
            <?php
                    } else {
            ?>
                        <!-- TO Do if data already exist's -->
            <?php
                    }
                }
            } else if (isset($_GET["code"]) && isset($_SESSION['input']) && $_SESSION["input"] == "non-sakec") {
                $email = loginWithGoogle($_GET["code"], $google_client);
                if (isset($email)) {
                    if (!doesEmailIdExists($email)) {
            ?>
                        <input type="text" name="email" value="<?php echo $data['email']; ?>" hidden>
                        <div class="spacer" style="height:30px;"></div>
                        <i class="fas fa-file-signature" style="font-size:30px;"></i>
                        <input data-toggle="tooltip" data-placement="bottom" title="Your  name" id="text" type="text" class="g" name="name" placeholder=" Name" required /></br>
                        <div class="grid-container">
                            <div class="grid-item item1">
                                <div class="texts">
                                    <select id="branch" required="required" class="custom-select mb-3 ddm">
                                        <option disabled>Select Branch</option>
                                        <option value="CS">Computer Science</option>
                                        <option value="IT">Information Technology</option>
                                        <option value="Electronics"> Electronics</option>
                                        <option value="EXTC">EXTC</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid-item item1">
                                <div class="texts">
                                    <select id="gender" required="required" class="custom-select mb-3 ddm">
                                        <option disabled>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid-item item2">
                                <div class="texts">
                                    <select id="year" required="required" class="custom-select mb-3 ddm">
                                        <option disabled>Select Class</option>
                                        <option value="FE">FE</option>
                                        <option value="SE">SE</option>
                                        <option value="TE">TE</option>
                                        <option value="BE">BE</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <i class="fas fa-university" style="font-size:30px;"></i>
                        <input data-toggle="tooltip" data-placement="bottom" title="Type your Organization or College name" type="text" class="g" name="organization" placeholder=" Organization or College name " required />
                        </br>
                        <i class="fas fa-phone" style="font-size:30px;"></i>
                        <input data-toggle="tooltip" data-placement="bottom" title="Type Phone Number" type="number" class="g" name="phonenumber" placeholder=" Phone Number" required />
                        </br>
                        <i class="fas fa-lock" style="font-size:30px;"></i>
                        <input data-toggle="tooltip" data-placement="bottom" title="8 characters minimum" type="password" name="password" class="g" placeholder=" Create Password" required /></br>
                        <i class="fa fa-key" style="font-size:30px;"></i>
                        <input data-toggle="tooltip" data-placement="bottom" title="Should be same as above" type="password" name="confirmpassword" class="g" placeholder=" Retype Password" required />
                        </br>
                        <button class="btn btn-primary" name="sign_up_non-sakec">Sign Up <i class="fas fa-user-plus "></i></button></br></br>
                        <p>Existing User <a style="color: rgb(168, 192, 212)" ; href="login.php">Login</a></p>
                        <div class="spacer" style="height:30px;"></div>
            <?php
                    } else {
            ?>
                        <!-- TO Do if data already exist's -->
            <?php
                    }
                }
            }
            ?>
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
            var winHeightImg = $(window).height();
            $('#user-login').css('height', winHeightImg);
            $("input[name='option']").click(function() {
                var radioValue = $("input[name='option']:checked").val();
                if (radioValue == 'sakec') {
                    $("#sakec").removeClass("d-none");
                    var check = $("#non-sakec").hasClass("d-none")
                    if (!check) {
                        $("#non-sakec").addClass("d-none");
                    }
                    $.post("datainput.php", {
                        input: "sakec"
                    });
                } else {
                    $("#non-sakec").removeClass("d-none");
                    var check = $("#sakec").hasClass("d-none")
                    if (!check) {
                        $("#sakec").addClass("d-none");
                    }
                    $.post("datainput.php", {
                        input: "non-sakec"
                    });
                }
            });
            $("button[name='sign_up_sakec']").click(function() {
                var password = $("input[name='password']").val();
                var confirmpassword = $("input[name='confirmpassword']").val();
                var email = $("input[name='email']").val();
                var division = $("#division").val();
                var gender = $("#gender").val();
                var rollno = $("input[name='rollno']").val();
                // alert( email+' '+division+' '+rollno+' '+gender+' '+password);
                $("#error").load("registration.php", {
                    email: email,
                    gender: gender,
                    password: password,
                    confirmpassword: confirmpassword
                });
            });
            $("button[name='sign_up_non-sakec']").click(function() {
                var password = $("input[name='password']").val();
                var confirmpassword = $("input[name='confirmpassword']").val();
                var email = $("input[name='email']").val();
                var phonenumber = $("input[name='phonenumber']").val();
                var name = $("input[name='name']").val();
                var branch = $("#branch").val();
                var gender = $("#gender").val();
                var year = $("#year").val();
                var organization = $("input[name='organization']").val();
                // alert( branch+' '+year+' '+organization+' '+password);
                $("#error").load("registration.php", {
                    email: email,
                    branch: branch,
                    phonenumber: phonenumber,
                    name: name,
                    gender: gender,
                    year: year,
                    organization: organization,
                    password: password,
                    confirmpassword: confirmpassword
                });
            });
        })
    </script>
</body>

</html>