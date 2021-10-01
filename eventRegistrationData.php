    <?php
    session_start();
    require_once "config.php";
    $part1 = '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    $part2 = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></div>';

    function autoRegistration($email, $event_id)
    {
        $sql = "SELECT `csi_userdata`.`id` as `user_id` FROM `csi_userdata` WHERE `emailID`='$email'";
        $user_id = getSpecificValue($sql, "user_id");
        $sql = "INSERT INTO `csi_collection`(`event_id`,`user_id`,`confirmed`,`confirmed_by`) VALUES ('$event_id','$user_id','1','auto')";
        //destroyDataInput();
        if (execute($sql)) {
            //echo $part1 . "Registration Successful" . $part2;
            $message = "You have been Registerd for the Event";
            //redirect_after_msg("You have been registerd for the event", "event.php?event_id=$event_id");
        } else {
            $message = "Registration Failed Contact Admin ERROR:ERDL18";
            //redirect_after_msg("Registration Failed", "../eventregistration.php?event_id=$event_id");
        }
        return $message;
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $message = " SOME ERROR OCCURED ERROR :ERDL21";
        $type = "1"; //not logged in
        $eventId = $_POST['eventId'];
        $email = $_POST["email"];
        $eventDetails = getValue("SELECT * FROM csi_event WHERE id='$eventId'");
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
                    $message = autoRegistration($email, $eventId);
                    echo '<div>' . $part1 . $message . $part2 . '</div>';
                    //$message = "You have been registerd for the event";
                } else {
                    $type .= "1"; //event type paid
                    // perform registration with bill details
    ?>
                    <div class="text-center h4 my-3">Step 2 : Enter the details</div>
                    <form id="part1" method="POST" enctype="multipart/form-data">
                        <input type="text" name="email" value="<?php echo $email; ?>" hidden>
                        <input type="text" name="typeOfUser" value="<?php echo $type; ?>" hidden>
                        <input type="text" name="eventId" value="<?php echo  $eventId; ?>" hidden>
                        <input type="text" name="feeOfEvent" value="<?php echo  $eventDetails['fee']; ?>" hidden>
                        <div class="my-4 text-black">
                            <p class = "text-center">Fee for the event : <?php echo  $eventDetails['fee']; ?></p>
                            <p class = "text-center">Note : The Bill photo must contain transaction number and amount transferred.</p>
                            <div class="form-group row justify-content-center ">
                                <label for="" class="col-sm-auto text-right">Bills Photo : </label>
                                <div class="col-sm-2"><input type="file" name="bill_photo" required /></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center my-3 grid-container">
                            <button type="submit" id="submit" name="submit" value="input" class="btn main_btn_gradient">Submit</button>
                        </div>
                    </form>
            <?php
                }
            } else {
                $type .= "1"; //registration status(registered)
                $status = getSpecificValue("SELECT `confirmed` FROM `csi_collection` WHERE `event_id`= $eventId and `user_id`= $user_id", "confirmed");
                //echo $status;
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
            <div class="text-center h4 my-3">Step 2 : Enter the details</div>
            <form id="part1" method="POST" enctype="multipart/form-data">
                <?php
                if ($count == 0) {
                ?>
                    <input type="text" name="email" value="<?php echo $email; ?>" hidden>
                    <div class="form-group row justify-content-center">
                        <label for="" class="col-sm-2 text-left">Name : </label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="name" required="required" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="" class="col-sm-2 text-left">College Name : </label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="collegeName" required="required" placeholder="College Name">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="" class="col-sm-2 text-left">Contact Number : </label>
                        <div class="col-sm-3">
                            <input type="text" minlength="10" maxlength="10" class="form-control" name="phonenumber" required="required" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="" class="col-sm-2 text-left">Branch : </label>
                        <div class="col-sm-3">
                            <select id="branch" name="branch" required="required" class="custom-select  bg-transparent text-black ">
                                <option disabled>Select Branch</option>
                                <option class="text-secondary" value="CS">Computer Science</option>
                                <option class="text-secondary" value="IT">Information Technology</option>
                                <option class="text-secondary" value="Electronics"> Electronics</option>
                                <option class="text-secondary" value="EXTC">EXTC</option>
                                <option class="text-secondary" value="Other">OTHER</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <label for="" class="col-sm-2 text-left"> Year of Study:</label>
                        <div class="col-sm-3">
                            <select id="year" name="year" required="required" class="custom-select bg-transparent text-black ">
                                <option disabled>Select Class</option>
                                <option class="text-secondary" value="FE">FE</option>
                                <option class="text-secondary" value="SE">SE</option>
                                <option class="text-secondary" value="TE">TE</option>
                                <option class="text-secondary" value="BE">BE</option>
                            </select>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="form-group row justify-content-center">
                    <label for="" class="col-sm-2 text-left"> Gender :</label>
                    <div class="col-sm-3">
                        <select id="gender" name="gender" required="required" class="custom-select bg-transparent text-black ">
                            <option disabled>Select Gender</option>
                            <option class="text-secondary" value="male">Male</option>
                            <option class="text-secondary" value="female">Female</option>
                        </select>
                    </div>
                </div>
                <?php
                //if event is free 
                if ($eventDetails['fee'] == 0) {
                    $type .= "0"; //event types
                } else {
                    $type .= "1"; //event type paid
                    // perform registration with bill details
                ?>
                    <div class="form-group row justify-content-center">
                        <label for="" class="col-sm-2 text-left">Bills Photo :</label>
                        <div class="col-sm-3">
                            <input type="file" name="bill_photo" required />
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="d-flex justify-content-center my-3 grid-container">
                    <button type="submit" id="submit" name="submit" value="input" class="btn main_btn_gradient">Submit</button>
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
                            $("#part1").html("");
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