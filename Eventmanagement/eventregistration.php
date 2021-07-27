<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/csi-logo.png">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/membership.css?v=<?php echo time(); ?>">
    <title>Event Registration</title>
    <?php
    require_once "../config.php";
    require_once('../oAuth/OAuth_config.php');
    session_start();
    function function_alert($message)
    {
        echo "<SCRIPT>alert('$message');</SCRIPT>";
    }
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (isset($_POST['register_now']) && isset($_POST['event_id']) && isset($_POST['fee']) && ($_POST['fee'] == 0) && isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            $event_id = $_POST['event_id'];
            $sql = "SELECT `csi_userdata`.`id` as `user_id` FROM `csi_userdata` WHERE `emailID`='$email'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $user_id = $row["user_id"];
            $sql = "INSERT INTO `csi_collection`(`event_id`,`user_id`,`confirmed`,`confirmed_by`) VALUES ('$event_id','$user_id','1','auto')";
            $result = mysqli_query($conn, $sql);
            header("location:event.php?event_id=$event_id");
            // for testing 
            echo $email . "<br>" . $event_id . "<br>" . $sql . "<br>" . $budget_id . "<br>" . $user_id . "<br>";
        } else if (isset($_POST['paid_registration']) && $_POST['paid_registration'] == "paid_registration") {
            $file_bill_photo_error = $_FILES["bill_photo"]['error'];
            $phpFileUploadErrors = array(
                0 => 'There is no error, the file uploaded with success',
                1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
                2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
                3 => 'The uploaded file was only partially uploaded',
                4 => 'No file was uploaded',
                6 => 'Missing a temorary folder',
                7 => 'Failed to write file to disk,',
                8 => 'A PHP extension stopped the file upload.',
            );
            if ($file_bill_photo_error == 0) {
                $extensions = array('jpg', 'jpeg', 'png');
                $file_bill_photo = explode(".", $_FILES["bill_photo"]["name"]);
                $file_ext_bill_photo = end($file_bill_photo);
                if (in_array($file_ext_bill_photo, $extensions)) {
                    $file_new_name = uniqid('', true) . "." . $file_ext_bill_photo;
                    $location_file = 'Event_Bill/' . $file_new_name;
                    move_uploaded_file($_FILES["bill_photo"]["tmp_name"], $location_file);
                    $email = $_SESSION['email'];
                    $event_id = $_POST['event_id'];
                    $sql = "SELECT `csi_userdata`.`id` as `user_id` FROM `csi_userdata` WHERE `emailID`='$email'";
                    //echo "<br>".$sql;
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $user_id = $row["user_id"];
                    $fee = $_POST['fee'];
                    $sql = "INSERT INTO `csi_collection`(`event_id`,`user_id`,`bill_photo`,`amount`,`confirmed`) VALUES ('$event_id','$user_id','$file_new_name','$fee','0')";
                    $result = mysqli_query($conn, $sql);
                    header("location:../event.php?event_id=$event_id");
                    // for testing 
                    //echo $email."<br>".$event_id."<br>".$sql."<br>".$user_id."<br>".$_POST['fee'];
                } else {
                    function_alert("The photo of the bill should be of jpg, jpeg, png.");
                }
            } else {
                function_alert($phpFileUploadErrors[$file_bill_photo_error]);
            }
        }
    } else if ($_SERVER['REQUEST_METHOD'] === "GET") {
        $event_id = $_GET['event_id'];
        $sqlevent = "SELECT * FROM csi_event WHERE id='$event_id'";
        $queryevent = mysqli_query($conn, $sqlevent);
        $rowevent = mysqli_fetch_assoc($queryevent);
    }
    
    $google_client = googleobject();
    $google_client->setRedirectUri('http://localhost/CSI-SAKEC/Eventmanagement/eventregistration.php');
    ?>
</head>

<body>
    <header>
        <h2 style="text-align: center;">Event Registration of <?php echo $rowevent['title']; ?></h2>
    </header>
    <div class="spacer" style="height:15px;"></div>
    <div class="registration">
        <div class="container">
            <h4>Register For The Event</h4>
            <p>Fill all the fields carefully</p>
            <hr>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
            ?>
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                            <label class="control-label">Bills Photo :</label>
                            <input type="file" name="bill_photo" required />
                            <div class="spacer" style="height:20px;"></div>
                            <button type="submit" value="paid_registration" name="paid_registration" class="btn btn-primary">Sumbit</button>
                            <?php
                            if (isset($_POST['event_id']) && isset($_POST['fee'])) {
                            ?>
                                <input type="hidden" name="event_id" value="<?php echo $_POST['event_id']; ?>" />
                                <input type="hidden" name="fee" value="<?php echo $_POST['fee']; ?>" />
                            <?php
                            }
                            ?>
                        </form>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="container text-center">
                    <?php
                    if (!isset($_GET["code"])) {
                    ?>
                        <div class="spacer" style="height:20px;"></div>
                        <h4>Step 1: Choose a option </h4>
                        <div class="spacer" style="height:20px;"></div>
                        <div id="option" class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-secondary">
                                <input type="radio" name='option' value="sakec"> Sakec Student
                            </label>
                            <label class="btn btn-outline-secondary ">
                                <input type="radio" name='option' value="non-sakec"> Other College Student
                            </label>
                        </div>
                        
                    <?php
                    }
                    ?>
                    <div class="spacer" style="height:30px;"></div>
                    <?php
                    if (!isset($_GET["code"])) {
                    ?>
                        <div id="sakec" class="d-none">
                            <h4>Step 2: Click and choose your Sakec account </h4>
                            <div class="spacer" style="height:20px;"></div>
                            <p><a href="<?php echo $google_client->createAuthUrl(); ?>">Choose Sakec account With Google</a></p>
                        </div>
                        <?php
                    } else if (isset($_GET["code"]) && isset($_SESSION['input']) && $_SESSION["input"] == "sakec") {
                        $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
                        if (!isset($token['error'])) {
                            $google_client->setAccessToken($token['access_token']);
                            $google_service = new Google_Service_Oauth2($google_client);
                            $data = $google_service->userinfo->get();
                            if (isset($data['email'])) {
                                if(doesEmailIdExists($data['email'])){

                                }else{
                        ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type="text" name="email" value="<?php echo $data['email']; ?>" hidden>
                                <div class="grid-item item3">
                                    <div class="texts">
                                        <select id="division" required="required" class="custom-select mb-3 ddm">
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
                                    <div class="grid-item item3">
                                        <div class="texts">
                                            <select id="gender" required="required" class="custom-select mb-3 ddm">
                                                <option disabled>Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <i class="fas fa-mobile-alt" style="font-size:30px;"></i>
                                <input data-toggle="tooltip" data-placement="bottom" title="Your Roll number" type="number" class="g" name="rollno" placeholder="Roll Number" required />
                                </br>
                                
                                <button class="btn btn-primary" name="event_registration_non-sakec">Event Registration <i class="fas fa-user-plus "></i></button></br></br>
                            </form>
                        <?php
                                }
                        ?>
                            
                    <?php
                            }
                        }
                    }
                    ?>
                    <?php
                    if (!isset($_GET["code"])) {
                    ?>
                        <div id="non-sakec" class="d-none">
                            <h4>Step 2: Click and choose any Google account </h4>
                            <div class="spacer" style="height:20px;"></div>
                            <p><a href="<?php echo $google_client->createAuthUrl(); ?>">Choose any Google account</a></p>
                        </div>
                        <?php
                    } else if (isset($_GET["code"]) && isset($_SESSION['input']) && $_SESSION["input"] == "non-sakec") {
                        $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
                        $var = 1 + 1;
                        if (!isset($token['error'])) {
                            $google_client->setAccessToken($token['access_token']);
                            $google_service = new Google_Service_Oauth2($google_client);
                            $data = $google_service->userinfo->get();
                            if (isset($data['email'])) {
                        ?>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                                
                                <button class="btn btn-primary" name="event_registration_sakec">Event Registration <i class="fas fa-user-plus "></i></button></br></br>
                            </form>
                                
                    <?php
                            }
                        }
                    }
                    ?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="spacer" style="height:50px;"></div>
    <div class="footer">
        <div class="spacer" style="height:2px;"></div>
        <a href="index.php"><i class="fas fa-home"></i></a>
        <div class="spacer" style="height:0px;"></div>
        <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
        <div class="spacer" style="height:1px;"></div>
    </div>
    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js "></script>
    <!-- DO NOT DELETE THIS  -->>
    <script>
        $(document).ready(function() {
            $.post("datainput.php", {
                        input: "sakec",
                        event_id: event_id
                    });
            $("input[name='option']").click(function() {
                var radioValue = $("input[name='option']:checked").val();
                if (radioValue == 'sakec') {
                    $("#sakec").removeClass("d-none");
                    var check = $("#non-sakec").hasClass("d-none");
                    if (!check) {
                        $("#non-sakec").addClass("d-none");
                    }
                    $.post("datainput.php", {
                        input: "sakec",
                        event_id: event_id
                    });
                } else {
                    $("#non-sakec").removeClass("d-none");
                    var check = $("#sakec").hasClass("d-none");
                    var event_id = <?php echo $event_id; ?>;
                    if (!check) {
                        $("#sakec").addClass("d-none");
                    }
                    $.post("datainput.php", {
                        input: "non-sakec",
                        event_id: event_id,

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
                $("#error").load("eventregistrationentry.php", {
                    email: email,
                    division: division,
                    gender: gender,
                    rollno: rollno
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
                $("#error").load("eventregistrationentry.php", {
                    email: email,
                    branch: branch,
                    phonenumber: phonenumber,
                    name: name,
                    gender: gender,
                    year: year,
                    organization: organization
                });
            });
        })
    </script>
</body>

</html>