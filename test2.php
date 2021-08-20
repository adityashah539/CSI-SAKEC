<!-- <div > -->
<?php
session_start();
require_once "config.php";

$part1 = '<div class="alert alert-success alert-dismissible fade show" role="alert">';
$part2 = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></div>';

function autoRegistration($email, $event_id)
{
    //$part1 = '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    //$part2 = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></div>';

    $sql = "SELECT `csi_userdata`.`id` as `user_id` FROM `csi_userdata` WHERE `emailID`='$email'";
    $user_id = getSpecificValue($sql, "user_id");
    $sql = "INSERT INTO `csi_collection`(`event_id`,`user_id`,`confirmed`,`confirmed_by`) VALUES ('$event_id','$user_id','1','auto')";
    //destroyDataInput();
    if (execute($sql)) {
        //echo $part1 . "Registration Successful" . $part2;
        redirect_after_msg("You have been registerd for the event", "event.php?event_id=$event_id");
    } else {
        redirect_after_msg("Registration Failed", "../eventregistration.php?event_id=$event_id");
    }
}

function payment()
{
}
// if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
//     echo "success";
// }
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    //checking authenticate email Provider
    if ($_POST["authProvider"] == md5("Google")) {
        //To get email received from google auth service
        $email = $_POST["email"];

        $type = "1"; //not logged in

        //event id in database for which event user wants to register
        $eventId = $_POST["eventId"];
        //To get event details 
        $sqlevent = "SELECT * FROM csi_event WHERE id='$eventId'";
        $eventDetails = getValue($sqlevent);

        //If user's data already exist in user_data base
        if (doesEmailIdExists($email)) {

            $type .= "1"; //email exist 

            //gives status of users registration for the event
            $user_id = getSpecificValue("SELECT `id` FROM `csi_userdata` WHERE `emailID`='$email'", 'id');
            $registeredForEvent = getNumRows("SELECT `id` FROM `csi_collection` WHERE `event_id`='$eventId' and `user_id`='$user_id'");
            //if user is not registered for the event then proced
            if ($registeredForEvent == 0) {

                $type .= "0"; //registration status

                //if event is free
                if ($eventDetails['fee'] == 0) {

                    $type .= "0"; //event type

                    autoRegistration($email, $eventId);
                    //echo $part1 . "Registration Successful" . $part2;
                    //acknowledge the user he has been registered for the event 
                } else {
                    $type .= "1"; //event type
                    // perform registration with bill details
?>
                    <form id="part1" onSubmit="return false;"  method="POST" enctype="multipart/form-data">
                        <input type="text" name="userId" value="<?php echo $email; ?>" hidden>
                        <label class="control-label">Bills Photo :</label>
                        <input type="file" name="bill_photo" required />
                        <button type="submit" id="submit" name="submit" value="input" class="btn btn-danger">Submit</button>
                    </form>
            <?php
                }
            } else {

                $type .= "1"; //registration status
                //already registerd for event
                echo $part1 . "Already registered" . $part2;
            }
        }
        //part 2 user data is not available in csi_user_data database
        else {

            $type .= "0"; //email does not exist
            $type .= "0"; //not registered for the event

            $sql = "SELECT COUNT(`email`) as `count` FROM `student_table` WHERE `email`='$email'";
            $query = mysqli_query($conn, $sql);
            $count = mysqli_fetch_assoc($query);

            //if sakec student 

            if ($count['count'] == 1) {
                //insert the data in userdata from dims
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
            } else {
                $name = "";
                $year = "";
                $division = "";
                $rollno = "";
                $phonenumber = "";
                $branch = "";
            }

            ?>
            <input type="text" name="email" value="<?php echo $email; ?>" hidden>
            <div class="d-flex justify-content-center my-4">
                <label><i class="fas fa-file-signature fa-2x"></i></label>
                <input type="text" class="form-control w-25 p-3 mx-3" name="Name" required="required" value="<?php echo $name; ?>" placeholder="Name" <?php echo $hidden; ?>>
            </div>
            <div class="d-flex justify-content-center my-4">
                <label><i class="fas fa-university fa-2x"></i></label>
                <input type="text" class="form-control w-25 p-3 mx-3" name="collegeName" required="required" value="<?php echo $name; ?>" placeholder="College Name" <?php echo $hidden; ?>>
            </div>
            <div class="d-flex justify-content-center my-4">
                <label><i class="fas fa-phone fa-2x"></i></label>
                <input type="text" class="form-control w-25 p-3 mx-3" name="phonenumber" required="required" value="<?php echo $name; ?>" placeholder="Phone Number" <?php echo $hidden; ?>>
            </div>
            <div class="d-flex justify-content-center my-4 grid-container">
                <div class="grid-item item1">
                    <div class="texts">
                        <label><i class="fas fa-university fa-2x"></i></label>
                        <select id="branch" required="required" class="custom-select my-2 bg-transparent text-white w-auto">
                            <option disabled>Select Branch</option>
                            <option class="text-secondary" value="CS">Computer Science</option>
                            <option class="text-secondary" value="IT">Information Technology</option>
                            <option class="text-secondary" value="Electronics"> Electronics</option>
                            <option class="text-secondary" value="EXTC">EXTC</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center my-4 grid-container">
                <div class="grid-item item2">
                    <div class="texts">
                        <label><i class="fas fa-university fa-2x"></i></label>
                        <select id="year" name="year" required="required" class="custom-select my-2 bg-transparent text-white w-auto">
                            <option disabled>Select Class</option>
                            <option class="text-secondary" value="FE">FE</option>
                            <option class="text-secondary" value="SE">SE</option>
                            <option class="text-secondary" value="TE">TE</option>
                            <option class="text-secondary" value="BE">BE</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center my-4 grid-container">
                <div class="grid-item item1">
                    <div class="texts">
                        <select id="gender" name="gender" required="required" class="custom-select my-2 bg-transparent text-white w-auto">
                            <option disabled>Select Gender</option>
                            <option class="text-secondary" value="male">Male</option>
                            <option class="text-secondary" value="female">Female</option>
                        </select>
                    </div>
                </div>
            </div>
            <?php
            if ($eventDetails['fee'] == 0) {
                //$type .= "0";
                echo $type;
            ?>
                <button type="submit" name="submit" value="input" class="btn btn-danger">Submit</button>
            <?php
            } else {
                //$type .= "1";
                // perform registration with bill details
            ?>
                <label class="control-label">Bills Photo :</label>
                <input type="file" name="bill_photo" required />
                <button type="submit" name="submit" value="input" class="btn btn-danger">Submit</button>
        <?php
            }
        }
        ?>
        <input type="text" name="eventPaymentStatus" value="<?php echo $eventDetails['fee']; ?>" hidden>
<?php
    } else {
        $type = "error";
        echo $part1 . "Invalid auth Provider" . $part2;
    }
} else {
    echo $part1 . "Request Method is Not Post" . $part2;
}
?>
<input type="text" name="typeOfUser" value="<?php echo $type; ?>" hidden>
<input type="text" name="eventPaymentStatus" value="<?php echo $eventDetails['fee']; ?>" hidden>
<!-- </div> -->