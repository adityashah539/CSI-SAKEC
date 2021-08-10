<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/csi-logo.png">
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/changeuserdata.css?v=<?php echo time(); ?>">
    <title>Event Registration</title>
    <?php
    require_once "../config.php";
    require_once('../oAuth/OAuth_config.php');
    session_start();

    if (isset($_POST['event_id'])) {
        $event_id = $_POST['event_id'];
    } else if (isset($_SESSION['event_id'])) {
        $event_id = $_SESSION['event_id'];
    }else if (isset($_GET['event_id'])){
        $event_id = $_GET['event_id'];
    }
    $sqlevent = "SELECT * FROM csi_event WHERE id='$event_id'";
    $rowevent = getValue($sqlevent);

    // Fetching Access Details
    $access = $email = NULL;
    if (isset($_SESSION["role_id"])) {
        $role_id = $_SESSION["role_id"];
        $sql = "SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id";
        $query =  mysqli_query($conn, $sql);
        $access = mysqli_fetch_assoc($query);
    }
    $google_client = googleObject('http://localhost/CSI-SAKEC/Eventmanagement/eventregistration.php');
    if (isset($_SESSION['registrationEmail'])) {
        $email = $_SESSION['registrationEmail'];
    }
    if (isset($_GET["code"])) {
        $_SESSION['registrationEmail'] = loginWithGoogle($_GET["code"], $google_client);
        $email = $_SESSION['registrationEmail'];
    }
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    }
    function destroyDataInput()
    {
        unset($_SESSION['input']);
        unset($_SESSION['event_id']);
        unset($_SESSION['membership']);
        unset($_SESSION['registrationEmail']);
    }
    function autoRegistration($email, $event_id)
    {
        $sql = "SELECT `csi_userdata`.`id` as `user_id` FROM `csi_userdata` WHERE `emailID`='$email'";
        $user_id = getSpecificValue($sql, "user_id");
        $sql = "INSERT INTO `csi_collection`(`event_id`,`user_id`,`confirmed`,`confirmed_by`) VALUES ('$event_id','$user_id','1','auto')";
        destroyDataInput();
        if (execute($sql))
            header("location:../event.php?event_id=$event_id");
        else {
            redirect_after_msg("Registration Failed", "eventregistration.php?event_id=$event_id");
        }
    }
    function paidRegistration($email, $event_id, $fee, $billPhotoName, $membershipPhotoName)
    {
        $sql = "SELECT `csi_userdata`.`id` as `user_id` FROM `csi_userdata` WHERE `emailID`='$email'";
        $user_id = getSpecificValue($sql, "user_id");
        $bill = $member = NULL;
        if (isset($billPhotoName))
            $bill = fileTransfer($billPhotoName, "Event_Bill");
        if (isset($membershipPhotoName))
            $member =  fileTransfer($membershipPhotoName, "Membership");
        if (isset($billPhotoName) && $bill['error'] == NULL && isset($membershipPhotoName) && $member['error'] == NULL) {
            $billFileName = $bill['file_new_name'];
            $membershipFileName = $member['file_new_name'];
            destroyDataInput();
            if (execute("INSERT INTO `csi_collection`(`event_id`,`user_id`,`bill_photo`,`amount`,`membership_photo`) VALUES ('$event_id','$user_id','$billFileName','$fee','$membershipFileName' )"))
                header("location:../event.php?event_id=$event_id");
            else {
                redirect_after_msg("Registration Failed", "eventregistration.php?event_id=$event_id");
            }
        } else if (isset($billPhotoName) && $bill['error'] == NULL) {
            destroyDataInput();
            $billFileName = $bill['file_new_name'];
            if (execute("INSERT INTO `csi_collection`(`event_id`,`user_id`,`bill_photo`,`amount`) VALUES ('$event_id','$user_id','$billFileName','$fee')"))
                header("location:../event.php?event_id=$event_id");
            else {
                redirect_after_msg("Registration Failed", "eventregistration.php?event_id=$event_id");
            }
        } else if (isset($membershipPhotoName) && $member['error'] == NULL) {
            destroyDataInput();
            $membershipFileName = $member['file_new_name'];
            if (execute("INSERT INTO `csi_collection`(`event_id`,`user_id`,`amount`,`membership_photo`) VALUES ('$event_id','$user_id','$fee','$membershipFileName')"))
                header("location:../event.php?event_id=$event_id");
            else {
                redirect_after_msg("Registration Failed", "eventregistration.php?event_id=$event_id");
            }
        } else {
            if (isset($bill['error']) && isset($member['error'])) {
                destroyDataInput();
                redirect_after_msg("Bill photo :" . $bill['error'] . "\n" . "Membership photo :" . $bill['error'], "eventregistration.php?event_id=$event_id");
            } else if (isset($bill['error'])) {
                destroyDataInput();
                deleteFile("Member", $member['file_new_name']);
                redirect_after_msg("Bill photo : " . $bill['error'], "eventregistration.php?event_id=$event_id");
            } else if (isset($member['error'])) {
                destroyDataInput();
                deleteFile("Event_Bill", $bill['file_new_name']);
                redirect_after_msg("Membership photo : " . $member['error'], "eventregistration.php?event_id=$event_id");
            }
        }
    }
    if (isset($email)) {
        if (isset($access)) {
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
            if (isset($_SESSION['input']) && $_SESSION["input"] == "sakec") {
                if (strpos($email, "@sakec.ac.in") !== false) {
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
                                        VALUES   ('$name','$year','$division','$rollno', '$email','$phonenumber','$branch','$role','NULL')";
                        execute($sql);
                    }
                    if (isset($_SESSION['membership']) && ($_SESSION['membership'] == '1') && isset($_POST['membershipRegistration'])) {
                        if ($rowevent['fee_m'] == '0') {
                            paidRegistration($email, $event_id, 0, NULL, "membershipPhoto");
                        } else {
                            paidRegistration($email, $event_id, $rowevent['fee_m'], "bill_photo", "membershipPhoto");
                        }
                    } else {
                        if (($rowevent['fee'] == '0')) {
                            autoRegistration($email, $event_id);
                        } else if (isset($_POST['membershipRegistration'])) {
                            paidRegistration($email, $event_id, $rowevent['fee'], "bill_photo", NULL);
                        }
                    }
                } else {
                    //header("location:eventregistration.php?event_id=" . $event_id);
                    destroyDataInput();
                    redirect_after_msg("Pls use SAKEC account", "eventregistration.php?event_id=$event_id");
                }
            } else if (isset($_SESSION['input']) && $_SESSION["input"] == "non-sakec") {
                if (isset($email)) {
                    if (!doesEmailIdExists($email)) {
                        if (isset($_POST['externalRegistration'])) {
                            $sql = "SELECT `id` FROM `csi_role` WHERE `role_name`='student'";
                            $role = getSpecificValue($sql, 'id');
                            $branch = trim($_POST["branch"]);
                            $year = trim($_POST["year"]);
                            $name = trim($_POST["name"]);
                            $organization = trim($_POST["organization"]);
                            $gender = trim($_POST["gender"]);
                            $phonenumber = trim($_POST["phonenumber"]);
                            $sql = "INSERT INTO `csi_userdata`(`name`, `year`, `emailID`, `phonenumber`, `branch`, `role`, `gender`,`organization`) 
                                                        VALUES ('$name','$year', '$email','$phonenumber','$branch','$role','$gender','$organization')";
                            execute($sql);
                        }
                    }
                    if ($rowevent['fee'] == '0') {
                        if (doesEmailIdExists($email))
                            autoRegistration($email, $event_id);
                    } else {
                        if (isset($_POST['externalRegistration']) && doesEmailIdExists($email)) {
                            paidRegistration($email, $event_id, $rowevent['fee_m'], "bill_photo", NULL);
                        }
                    }
                }
            }
        }
    }

    ?>
</head>

<body>
    <header>
        <h1 style="text-align: center;">Event Registration of <?php echo $rowevent['title']; ?></h1>
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
                    <div class="spacer" style="height:28px;"></div>
                    <div id="member" class="d-none">
                        <h4>Step 2: Do you have Csi-Sakec Membership </h4>
                        <div class="spacer" style="height:20px;"></div>
                        <div id="memberOption" class="btn-group btn-group-toggle " data-toggle="buttons">
                            <label class="btn btn-outline-secondary">
                                <input type="radio" name='membership' value="membership"> Membership
                            </label>
                            <label class="btn btn-outline-secondary ">
                                <input type="radio" name='membership' value="non-membership"> Non-Membership
                            </label>
                        </div>
                    </div>
                    <div class="spacer" style="height:28px;"></div>
                    <div id="sakec" class="d-none">
                        <h4>Step 3: Click and choose your Sakec account </h4>
                        <div class="spacer" style="height:20px;"></div>
                        <a type="button" class="btn btn-danger" href="<?php echo $google_client->createAuthUrl(); ?>"><i class="fab fa-google"></i> | Register with Sakec Account</a>
                    </div>
                    <div id="non-sakec" class="d-none">
                        <h4>Step 2: Click and choose any Google account </h4>
                        <div class="spacer" style="height:20px;"></div>
                        <a type="button" class="btn btn-danger" href="<?php echo $google_client->createAuthUrl(); ?>"><i class="fab fa-google"></i> | Register with Google</a>
                    </div>
                <?php
                } else if (isset($email) && isset($_SESSION['input']) && $_SESSION["input"] == "sakec") {
                ?>
                    <h4>Step 4: Click and choose your Sakec account </h4>
                    <div class="spacer" style="height:20px;"></div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                        <?php
                            $fee;
                            if (isset($_SESSION['membership']) && $_SESSION['membership'] == '1') {
                                $fee=$rowevent['fee_m'];
                            }else{
                                $fee=$rowevent['fee'];
                            }
                        if ($fee>0) {
                        ?>
                            <p>You have to upload a bill photo that has the transaction id and the Rs.<?php echo $fee; ?> transfer should be </p>
                            <label class="control-label">Upload a bill Photo :</label>
                            <input type="file" name="bill_photo" required />
                        <?php
                        }
                        if (isset($_SESSION['membership']) && $_SESSION['membership'] == '1') {
                        ?>
                            <label class="control-label">Member :</label>
                            <input type="file" name="membershipPhoto" required />
                        <?php
                        }
                        ?>
                        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>" />
                        <div class="spacer" style="height:20px;"></div>
                        <button type="submit" value="membershipRegistration" name="membershipRegistration" class="btn btn-primary">Sumbit</button>
                    </form>
                    <?php
                } else if (isset($email) && isset($_SESSION['input']) && $_SESSION["input"] == "non-sakec") {
                    if (isset($email)) {
                    ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <input type="text" name="email" value="<?php echo $data['email']; ?>" hidden>
                            <?php
                            if (!doesEmailIdExists($email)) {
                            ?>
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
                            <?php
                            }
                            if ($rowevent['fee'] > 0) {
                            ?>
                                <label class="control-label">Bills Photo :</label>
                                <input type="file" name="bill_photo" required />
                                <br>
                            <?php
                            }
                            ?>
                            <button type="submit" name="externalRegistration" value="externalRegistration"  class="btn btn-primary">Sumbit</button>
                        </form>
            <?php
                    }
                }
            }
            ?>
        </div>
    </div>
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
            $
            $("input[name='option']").click(function() {
                var radioValue = $("input[name='option']:checked").val();
                if (radioValue == 'sakec') {
                    var check = $("#member").hasClass("d-none");
                    if (check) {
                        $("#member").removeClass("d-none");
                    }
                    var check = $("#non-sakec").hasClass("d-none");
                    if (!check) {
                        $("#non-sakec").addClass("d-none");
                    }
                    $.post("datainput.php", {
                        input: "sakec"
                    });
                } else {
                    var check = $("#member").hasClass("d-none");
                    if (!check) {
                        $("#member").addClass("d-none");
                    }
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
            $("input[name='membership']").click(function() {
                var radioValue = $("input[name='option']:checked").val();
                if (radioValue == 'sakec') {
                    $("#sakec").removeClass("d-none");
                    var check = $("#non-sakec").hasClass("d-none");
                    if (!check) {
                        $("#non-sakec").addClass("d-none");
                    }
                }
                radioValue = $("input[name='membership']:checked").val();
                var membership;
                if (radioValue == "membership") {
                    membership = 1;
                } else {
                    membership = 0;
                }
                $.post("datainput.php", {
                    membership: membership
                });
            });
        });
    </script>
</body>

</html>