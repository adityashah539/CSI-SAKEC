<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/csi-logo.png">
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/membership.css?v=<?php echo time(); ?>">
    <title>Event Registration</title>
    <?php
    require_once "../config.php";
    require_once('../oAuth/OAuth_config.php');
    session_start();
    $google_client = googleObject('http://localhost/CSI-SAKEC/Eventmanagement/eventregistration.php');
    // Fetching Access Details
    $access = NULL;
    if (isset($_SESSION["role_id"])) {
        $role_id = $_SESSION["role_id"];
        $sql = "SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id";
        $query =  mysqli_query($conn, $sql);
        $access = mysqli_fetch_assoc($query);
    }
    function autoRegistration($email, $event_id){
        $sql = "SELECT `csi_userdata`.`id` as `user_id` FROM `csi_userdata` WHERE `emailID`='$email'";
        $user_id = getSpecificValue($sql, "user_id");
        $sql = "INSERT INTO `csi_collection`(`event_id`,`user_id`,`confirmed`,`confirmed_by`) VALUES ('$event_id','$user_id','1','auto')";
        execute($sql);
        header("location:event.php?event_id=$event_id");
    }
    function paidRegistration($email, $event_id, $fee, $billPhotoName, $membershipPhotoName){
        $sql = "SELECT `csi_userdata`.`id` as `user_id` FROM `csi_userdata` WHERE `emailID`='$email'";
        $user_id = getSpecificValue($sql, "user_id");
        $billFileName = fileTransfer($billPhotoName, "Event_Bill");
        $membershipFileName = NULL;
        if (isset($membershipPhotoName))
            $membershipFileName = fileTransfer($membershipPhotoName, "ExternalStudentMembership");
        $sql = "INSERT INTO `csi_collection`(`event_id`,`user_id`,`bill_photo`,`amount`,`externalstudentmembership`) VALUES ('$event_id','$user_id','$billFileName','$fee','$membershipFileName' )";
        execute($sql);
        header("location:../event.php?event_id=$event_id");
    }
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if(isset($_POST['event_id'])){
            $event_id = $_POST['event_id'];
        }
        else if(isset($_SESSION['event_id'])){
            $event_id = $_POST['event_id'];
        }
        $sqlevent = "SELECT * FROM csi_event WHERE id='$event_id'";
        $rowevent = getValue($sqlevent);
        if (isset($access)) {
            $email = $_SESSION['email'];
            if (($rowevent['fee'] == '0') || (($rowevent['fee_m'] == '0') && ($access['role_name'] == "member" || strpos($access['role_name'], "Coordinator") != false || strpos($access['role_name'], "General") != false || strpos($access['role_name'], "Team") != false))) {
                autoRegistration($email, $event_id);
            } else {
                if (isset($_POST['paid_registration'])) {
                    if ($access['role_name'] == "member" || strpos($access['role_name'], "Coordinator") != false || strpos($access['role_name'], "General") != false || strpos($access['role_name'], "Team") != false) {
                        $fee = $rowevent['fee_m'];
                    } else {
                        $fee = $rowevent['fee'];
                    }
                    paidRegistration($email, $event_id, $fee, "bill_photo", NULL);
                }
            }
        } else {
            if ((isset($_GET["code"]) && isset($_SESSION['input']) && $_SESSION["input"] == "sakec")) {
                $email = loginWithGoogle($_GET["code"], $google_client);
                if (isset($email)) {
                    if (($rowevent['fee'] == '0') || (($rowevent['fee_m'] == '0') && $_POST['member'])) {
                        if (!doesEmailIdExists($email)) {
                            $sql = "SELECT  `d`.`sem_id`, `d`.`std_roll_no`, `i`.`division`, `student_name`, `email`, `s_phone`,`admission_type`,`s`.`program`
                                    FROM `division_details` as `d`, `intake` as `i`, `student_table` as `s`
                                    WHERE  `s`.`email`= '$email' AND `d`.`std_id` = `s`.`std_id` and `d`.`sem_id` = `i`.`sem_id`";
                            $auto_fetch = getValue($sql);
                            $name = $auto_fetch['student_name'];
                            $year = $auto_fetch['admission_type'];
                            $division = $auto_fetch['division'];
                            $rollno = $auto_fetch['std_roll_no'];
                            $phonenumber = $auto_fetch['s_phone'];
                            $branch = $auto_fetch['program'];
                            $sql = "SELECT `id` FROM `csi_role` WHERE `role_name`='student'";
                            $role = getSpecificValue($sql, 'id');
                            $sql = "INSERT INTO `csi_userdata`(`name`,`year`,`division`, `rollNo`, `emailID`, `phonenumber`, `branch`, `role`, `gender`) 
                                                    VALUES   ('$name','$year','$division','$rollno', '$email','$phonenumber','$branch','$role','$gender')";
                            execute($sql);
                        }
                        autoRegistration($email, $event_id);
                    }elseif (($rowevent['fee'] == '0')){

                    }
                }
            }
            else if (isset($_GET["code"]) && isset($_SESSION['input']) && $_SESSION["input"] == "non-sakec") {
                $email = loginWithGoogle($_GET["code"], $google_client);
                if (isset($email)) {
                    if (doesEmailIdExists($email)) {
                        if(isset($_POST['membership'])){
                            if ($rowevent['fee_m']=='0'){

                            }else{

                            }
                        }
                        else if ($rowevent['fee']=='0')
                            autoRegistration($email, $event_id);
                        else
                            paidRegistration($email, $event_id, $fee, "bill_photo", NULL);
                    }else if($email){
                        
                    }
                }
            }
            if (isset($_POST['membership'])) {
                if ($rowevent['fee_m'] == '0') {
                } else {
                }
            } else {
                if ($rowevent['fee'] == '0') {
                    if (!doesEmailIdExists($email)) {
                        $sql = "SELECT `id` FROM `csi_role` WHERE `role_name`='student'";
                        $role = getSpecificValue($sql, 'id');
                        $branch = trim($_POST["branch"]);
                        $year = trim($_POST["year"]);
                        $name = trim($_POST["name"]);
                        $organization = trim($_POST["organization"]);
                        $gender = trim($_POST["gender"]);
                        $sql = "INSERT INTO `csi_userdata`(`name`, `year`, `emailID`, `phonenumber`, `branch`, `role`, `gender`,`organization`) 
                                                VALUES ('$name','$year', '$email','$phonenumber','$branch','$role','$gender','$organization')";
                        mysqli_query($conn, $sql);
                    }
                } else {
                }
            }
        }
    }
    
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
            if (isset($access)) {
            ?>
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                            <label class="control-label">Bills Photo :</label>
                            <input type="file" name="bill_photo" required />
                            <input type="hidden" name="event_id" value="<?php echo $event_id; ?>" />
                            <div class="spacer" style="height:20px;"></div>
                            <button type="submit" value="paid_registration" name="paid_registration" class="btn btn-primary">Sumbit</button>
                        </form>
                    </div>
                </div>
                <?php
            } else {
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
            }
            ?>
        </div>
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
    <!-- DO NOT DELETE THIS  -->
    <script>

        $(document).ready(function() {
            $.post("datainput.php", {
                event_id: <?php echo $event_id; ?>
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
                        input: "sakec"
                    });
                } else {
                    $("#non-sakec").removeClass("d-none");
                    var check = $("#sakec").hasClass("d-none");
                    if (!check) {
                        $("#sakec").addClass("d-none");
                    }
                    $.post("datainput.php", {
                        input: "non-sakec",
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