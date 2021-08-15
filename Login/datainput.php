<?php
session_start();
require_once "../config.php";
$part1 = '<div class="alert alert-success alert-dismissible fade show" role="alert">';
$part2 = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></div>';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_POST["authProvider"] == md5("Google")) {
        $email = $_POST["signupEmail"];
        $sql = "SELECT `csi_password`.`password` FROM `csi_password`,`csi_userdata` WHERE `csi_userdata`.`emailID`='$email' AND `csi_password`.`user_id`=`csi_userdata`.`id` ";
        if (getNumRows($sql) == 0) {
            $_SESSION["signupEmail"] = $email;
?>
            <h4>Step 2: Fill the details</h4>
<?php
            if (!doesEmailIdExists($email)) {
                $sql = "SELECT  `d`.`sem_id`, `d`.`std_roll_no`, `i`.`division`, `student_name`, `email`, `s_phone`,`admission_type`,`s`.`program`
                FROM `division_details` as `d`, `intake` as `i`, `student_table` as `s`
                WHERE  `s`.`email`= '$email' AND `d`.`std_id` = `s`.`std_id` and `d`.`sem_id` = `i`.`sem_id`";
                $row = getValue($sql);
?>
                <?php
                if (!isset($row['sem_id'])) {
                    $value = md5("non-sakec");
                ?>
                    <div class="d-flex justify-content-center my-4">
                        <label><i class="fas fa-file-signature fa-2x"></i></label>
                        <input type="text" class="form-control w-25 p-3 mx-3" name="Name" required="required" placeholder="Name">
                    </div>
                    <div class="d-flex justify-content-center my-4">
                        <label><i class="fas fa-university fa-2x"></i></label>
                        <input type="text" class="form-control w-25 p-3 mx-3" name="collegeName" required="required" placeholder="College Name">
                    </div>
                    <div class="d-flex justify-content-center my-4">
                        <label><i class="fas fa-phone fa-2x"></i></label>
                        <input type="text" class="form-control w-25 p-3 mx-3" name="phonenumber" required="required" placeholder="Phone Number">
                    </div>
                    <div class="grid-container">
                        <div class="grid-item item1">
                            <div class="texts">
                                <select id="branch" required="required" class="custom-select my-2 bg-transparent text-white w-auto">
                                    <option disabled>Select Branch</option>
                                    <option class="text-secondary" value="CS">Computer Science</option>
                                    <option class="text-secondary" value="IT">Information Technology</option>
                                    <option class="text-secondary" value="Electronics"> Electronics</option>
                                    <option class="text-secondary" value="EXTC">EXTC</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid-item item2">
                            <div class="texts">
                                <select id="year" required="required" class="custom-select my-2 bg-transparent text-white w-auto">
                                    <option disabled>Select Class</option>
                                    <option class="text-secondary" value="FE">FE</option>
                                    <option class="text-secondary" value="SE">SE</option>
                                    <option class="text-secondary" value="TE">TE</option>
                                    <option class="text-secondary" value="BE">BE</option>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                    $value = md5("sakec");
                }
                ?>
                <div class="grid-container">
                    <div class="grid-item item1">
                        <div class="texts">
                            <select id="gender" required="required" class="custom-select my-2 bg-transparent text-white w-auto">
                                <option disabled>Select Gender</option>
                                <option class="text-secondary" value="male">Male</option>
                                <option class="text-secondary" value="female">Female</option>
                            </select>
                        </div>
                    </div>
                </div>
                <?php
            }else{
                $value = md5("existingUser");
            }
            ?>
            <input type="text" name="registrationProcess" value="<?php echo $value; ?>" hidden>
            <div class="d-flex justify-content-center my-4">
                <label><i class="fas fa-lock fa-2x"></i></label>
                <input type="password" class="form-control w-25 p-3 mx-3" name="password" required="required" placeholder="Password">
            </div>
            <div class="d-flex justify-content-center my-4">
                <label><i class="fa fa-key fa-2x"></i></label>
                <input type="password" class="form-control w-25 p-3 mx-3" name="confirmPassword" required="required" placeholder="Confirm Password">
            </div>
            <button class="btn btn-primary" name="sign_up">Sign Up <i class="fas fa-user-plus "></i></button></br></br>
            <p>Existing User <a class="text-primary" href="login.php">Login</a></p>
<?php
        } else {
            echo $part1 . "This account has already been signed up." . $part2;
        }
    } else {
        echo $part1 . "Error in loading account." . $part2;
    }
} else {
    echo "Registration failed.";
}
?>