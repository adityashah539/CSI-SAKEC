    <?php
    session_start();
    require_once "config.php";
    $part1 = '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    $part2 = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></div>';

    function autoRegistration($email, $event_id, $part1, $part2)
    {
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

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $message = "NO MESSAGE TO DISPLAY SOME ERROR OCCURED";
        $type = "1"; //not logged in
        $eventId = $_POST['eventId'];
        $email = $_POST["email"];
        $sqlevent = "SELECT * FROM csi_event WHERE id='$eventId'";
        $eventDetails = getValue($sqlevent);
        if (doesEmailIdExists($email)) {
            $type .= "1"; //email exist 
            $user_id = getSpecificValue("SELECT `id` FROM `csi_userdata` WHERE `emailID`='$email'", 'id');
            $registeredForEvent = getNumRows("SELECT `id` FROM `csi_collection` WHERE `event_id`='$eventId' and `user_id`='$user_id'");
            //if user is not registered for the event then proced
            if ($registeredForEvent == 0) {
                $type .= "0"; //registration status(not registered)
                //if event is free free
                if ($eventDetails['fee'] == 0) {
                    $type .= "0"; //event type
                    autoRegistration($email, $eventId, $part1, $part2);
                    $message = "You have been registerd for the event";
                } else {
                    $type .= "1"; //event type paid
                    // perform registration with bill details
    ?>
                    <form id="part1" method="POST" enctype="multipart/form-data">
                        <input type="text" name="email" value="<?php echo $email; ?>" hidden>
                        <input type="text" name="typeOfUser" value="<?php echo $type; ?>" hidden>
                        <input type="text" name="eventId" value="<?php echo  $eventId; ?>" hidden>
                        <input type="text" name="feeOfEvent" value="<?php echo  $eventDetails['fee']; ?>" hidden>
                        <label class="control-label">Bills Photo :</label>
                        <input type="file" name="bill_photo" required />
                        <button type="submit" id="submit" name="submit" value="input" class="btn btn-danger">Submit</button>
                    </form>
            <?php
                }
            } else {
                $type .= "1"; //registration status(registered)
                $status = getSpecificValue("SELECT `confirmed` FROM `csi_collection` WHERE `event_id`= $eventId and `user_id`= $user_id", "confirmed");
                echo $status;
                if ($status == 1) {
                    $message = "ALREADY REGISTERED";
                } else {
                    $message = "WAITING FOR CONFIRMATION CONTACT CO-ORDINATOR";
                }
            }
        } else {
            $type .= "0"; //email does not exist 
            $type .= "0"; //registration status(not registered)
            if (strpos($email, "sakec.ac.in")) {
                //serching data in dims database
                $sql = "SELECT COUNT(`email`) as `count` FROM `student_table` WHERE `email`='$email'";
                $query = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($query);
                $count = $row['count'];
            } else {
                $count = 0;
            }
            ?>
            <form id="part1" method="POST" enctype="multipart/form-data">
                <?php
                if ($count == 0) {
                ?>
                    <input type="text" name="email" value="<?php echo $email; ?>" hidden>
                    <div class="d-flex justify-content-center my-4">
                        <label><i class="fas fa-file-signature fa-2x"></i></label>
                        <input type="text" class="form-control w-25 p-3 mx-3" name="name" required="required" placeholder="Name">
                    </div>
                    <div class="d-flex justify-content-center my-4">
                        <label><i class="fas fa-university fa-2x"></i></label>
                        <input type="text" class="form-control w-25 p-3 mx-3" name="collegeName" required="required" placeholder="College Name">
                    </div>
                    <div class="d-flex justify-content-center my-4">
                        <label><i class="fas fa-phone fa-2x"></i></label>
                        <input type="text" class="form-control w-25 p-3 mx-3" name="phonenumber" required="required" placeholder="Phone Number">
                    </div>
                    <div class="d-flex justify-content-center my-4 grid-container">
                        <div class="grid-item item1">
                            <div class="texts">
                                <label><i class="fas fa-university fa-2x"></i></label>
                                <select id="branch" name="branch" required="required" class="custom-select my-2 bg-transparent text-white w-auto">
                                    <option disabled>Select Branch</option>
                                    <option class="text-secondary" value="CS">Computer Science</option>
                                    <option class="text-secondary" value="IT">Information Technology</option>
                                    <option class="text-secondary" value="Electronics"> Electronics</option>
                                    <option class="text-secondary" value="EXTC">EXTC</option>
                                    <option class="text-secondary" value="Other">OTHER</option>
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
                <?php
                }
                ?>
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
                //if event is free free
                if ($eventDetails['fee'] == 0) {
                    $type .= "0"; //event types
                } else {
                    $type .= "1"; //event type paid
                    // perform registration with bill details
                ?>
                    <div class="d-flex justify-content-center my-4 grid-container">
                        <label class="control-label">Bills Photo :</label>
                        <input type="file" name="bill_photo" required />
                    </div>
                <?php
                }
                ?>
                <div class="d-flex justify-content-center my-4 grid-container">
                    <button type="submit" id="submit" name="submit" value="input" class="btn btn-danger">Submit</button>
                </div>
                <input type="text" name="email" value="<?php echo $email; ?>" hidden>
                <input type="text" name="typeOfUser" value="<?php echo $type; ?>" hidden>
                <input type="text" name="eventId" value="<?php echo  $eventId; ?>" hidden>
                <input type="text" name="count" value="<?php echo  $count; ?>" hidden>
                <input type="text" name="feeOfEvent" value="<?php echo  $eventDetails['fee']; ?>" hidden>
            </form>
    <?php

        }
    }
    ?>
    <input type="text" name="typeOfUser" value="<?php echo $type; ?>" hidden>
    <script>
        $(document).ready(function(e) {
            var typeOfUser = $("input[name='typeOfUser']").val();
            if ((typeOfUser == "1101") || (typeOfUser == "1001") || (typeOfUser == "1000")) {
                $("#part1").on("submit", (function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "eventRegDataProcessing.php",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            $("#error").html(data);
                        }
                    });
                }));
            } else if (typeOfUser == "111" || typeOfUser == "1100") {
                $("#error").html('<?php echo $part1 . $message . $part2; ?>');
            } else {
                $("#error").html('<?php echo $part1 . "SOME ERROR OCCURED" . $part2; ?>');
            }
        });
    </script>