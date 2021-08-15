<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/csi-logo.png">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="../css/changeuserdata.css?v=<?php echo time(); ?>">
    <title> Membership</title>
    <?php
    require_once "../config.php";
    session_start();

    $email = $_SESSION['email'];
    $userid = getSpecificValue("SELECT `id` from `csi_userdata` where emailID = '$email'", 'id');

    $noOfRows = getNumRows("SELECT `id` ,`userid` FROM `csi_membership` WHERE userid = $userid");

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
        $amount = $_POST['amount'];
        if ($noOfRows == 0) {
            $pemail = $_POST['pemail'];
            $regno = $_POST['registration_number'];
            $dob = $_POST['dob'];
            $syear = $_POST['syear'];
            $eyear = $_POST['eyear'];
            execute("INSERT INTO `csi_membership`(`userid`, `dob`, `primaryEmail`, `startingYear`, `passingYear`, `r_number`)
                                            VALUES ('$userid','$dob','$pemail','$syear','$eyear','$regno')");
        }
        $membership_id = getSpecificValue("SELECT `id` from `csi_membership` where userid = '$userid'", 'id');

        // Insert bill in a folder
        $image = fileTransfer('billphoto', 'Membership_Bill');
        if ($image['error'] == NULL) {
            $file_new_bill = $image['file_new_name'];
            $no_of_year = $_POST['member_period'];
            $membership_ends = getSpecificValue("SELECT `duration` FROM `csi_membership` WHERE userid = $userid", 'duration');
            if ($membership_ends > date("Y-m-d")) {
                $membership_taken = $membership_ends;
            } else {
                $membership_taken = date("Y-m-d H:i:s", time());
            }
            execute("INSERT INTO `csi_membership_bills`(`membership_id`, `bill_photo`, `amount`, `membership_taken`, `no_of_year`,`accepted`)
                                                VALUES ('$membership_id','$file_new_bill','$amount','$membership_taken','$no_of_year','0')");
        } else {
            function_alert($image['error']);
        }
    }
    ?>
</head>

<body>
    <header>
        <h2 class="text-center">Membership</h2>
    </header>
    <?php
    // Shows the status of the membership
    if ($noOfRows != 0) {
        // Membership exists
        $membership_ends = getSpecificValue("SELECT `duration` FROM `csi_membership` WHERE userid = $userid", 'duration');

        if ($membership_ends >= date("Y-m-d")) {
            echo    "<div class='alert alert-success text-center' role='alert' >
                            Your Current Membership expires on " . date("d-m-Y", strtotime($membership_ends)) . "
                        </div>";
        } else if ($membership_ends) {
            echo    "<div class='alert alert-danger text-center ' role='alert' >
                            Your last Membership expired on " . date("d-m-Y", strtotime($membership_ends)) . "
                        </div>";
        }
    } else {
        // No membership
        echo    "<div class='alert alert-primary text-center' role='alert' >
                        You have not taken membership yet
                    </div>";
    }

    // Shows any pending status of membership
    $bill = getNumRows("SELECT b.id
                            from csi_userdata as u, csi_membership as m, csi_membership_bills as b
                            where accepted = 0 and b.membership_id = m.id and m.userid = u.id and u.id = $userid", 'id');
    if ($bill > 0) {
        echo    "<div class='alert alert-warning text-center' role='alert' >
                        Your current bill is pending for acceptance
                    </div>";
    } else {
    ?>
        <div class="spacer" style="height:50px;"></div>
        <div id="error"></div>
        <div class="spacer" style="height:15px;"></div>
        <div class="registration">
            <div class="container">
                <h4>Student Membership Registration </h4>
                <p>Fill all the fields carefully</p>
                <hr>
                <div class="spacer" style="height:35px;"></div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <?php
                    if ($noOfRows == 0) {
                    ?>
                        <div class="spacer" style="height:35px;"></div>
                        <div class="row">
                            <div class="col-sm-5">
                                <label for="">Date of Birth </label>
                            </div>
                            <div class="col-sm-7">
                                <input type="date" name="dob" required="required">
                            </div>
                        </div>
                        <div class="spacer" style="height:20px;"></div>
                        <div class="row">
                            <div class="col-sm-5">
                                <label for="">Primary Email </label>
                            </div>
                            <div class="col-sm-7">
                                <input type="email" name="pemail" required="required">
                            </div>
                        </div>
                        <div class="spacer" style="height:20px;"></div>
                        <div class="row">
                            <div class="col-sm-5">
                                <label for="">Starting year </label>
                            </div>
                            <div class="col-sm-7">
                                <input type="number" name="syear" required="required">
                            </div>
                        </div>
                        <div class="spacer" style="height:20px;"></div>
                        <div class="row">
                            <div class="col-sm-5">
                                <label for="">Ending year </label>
                            </div>
                            <div class="col-sm-7">
                                <input type="number" name="eyear" required="required">
                            </div>
                        </div>
                        <div class="spacer" style="height:20px;"></div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="labels">
                                    <label for="rnumber">College Registration Number :</label>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="texts">
                                    <input type="number" id="rnumber" name="registration_number" value="" required="required">
                                    <small id="rnumberlHelp" class="form-text text-muted">As printed on your ID card</small>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="spacer" style="height:40px;"></div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label class="control-label">Amount paid :</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" name="amount" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label class="control-label">Membership in years :</label>
                        </div>
                        <div class="col-sm-7">
                            <div class="texts">
                                <select name="member_period" class="custom-select mb-3" required="required">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label class="control-label">Bill photo :</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="file" name="billphoto" required>
                        </div>
                    </div>
                    <div class="spacer" style="height:40px;"></div>
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4 text-center">
                            <div class="register">
                                <button type="submit" name="submit" class="btn btn-primary">Submit Application</button>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="spacer" style="height:50px;"></div>
        <div class="spacer" style="height:50px;"></div>
    <?php
    }
    ?>
    <!-- Footer -->

    <!-- Footer -->


    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->
    <script>
        $(document).ready(function() {
            //jquery for loading the fields for renewal and the Filling the details 


            //jquery for taking membership 


        });
    </script>
</body>

</html>