<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/csi-logo.png">
    <link rel="stylesheet" href="plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/event.css?v=<?php echo time(); ?>">
    <title>Event</title>
    <?php
    require_once "config.php";
    session_start();
    $access = NULL;
    if (isset($_SESSION["role_id"])) {
        $role_id = $_SESSION["role_id"];
        $access = getValue("SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id");
    }
    $eventId = $_GET['event_id'];
    $eventDetails = getValue("SELECT * FROM csi_event WHERE id='$eventId'");
    $eventSpeakerDetails = execute("SELECT * FROM csi_speaker WHERE event_id='$eventId'");
    $numberOfSpeakers = mysqli_num_rows($eventSpeakerDetails);
    $arrayEventCollaboration = getAllValues("SELECT `collab_body` FROM `csi_collaboration` WHERE event_id='$eventId'");
    $eventCollaboration = implode(', ', array_column($arrayEventCollaboration, 'collab_body'));
    ?>
</head>

<body>
    <!-- Navbar -->
    <?php require "usernavbar.php"; ?>
    <div class="spacer" style="height:85px;"></div>
    <!-- Navbar -->
    <!-- Content -->
    <div class="container ">
        <h1><?php echo $eventDetails['title']; ?></h1>
        <?php
        if (isset($eventCollaboration)) {
            echo "<h2>In collaboration with " . $eventCollaboration . "</h2>";
        }
        ?>
        <img class="main-img my-5" src="<?php echo "Banner/" . trim($eventDetails['banner']); ?>" alt="no image">
        <div class="event-header">
            <h1 class="pt-4"> <?php echo $eventDetails['subtitle']; ?></h1>
            <h4 class="mb-3">
                <?php
                if ($eventDetails['e_from_date'] == $eventDetails['e_to_date'])
                    echo date("jS  F Y", strtotime($eventDetails['e_from_date']));
                else
                    echo date("jS F Y", strtotime($eventDetails['e_from_date'])) . "-" . date("jS F Y", strtotime($eventDetails['e_to_date']));
                echo "<br>" . date(" h:i A", strtotime($eventDetails['e_from_time'])) . " to " . date("h:i A", strtotime($eventDetails['e_to_time']));
                ?>
            </h4>
            <div id="error" class="my-4"></div>
            <?php
            //To check wheather the event is going to be conducted our ended
            $eventDate = $eventDetails['e_from_date'];
            $eventTime = $eventDetails['e_from_time'];
            date_default_timezone_set("Asia/Kolkata");
            if (($eventDate >= date('Y-m-d')) && !(($eventDate == date('Y-m-d')) && ($eventTime < date("H:i:s")))) {
                if (isset($_SESSION["email"])) {
                    $email = $_SESSION["email"];
                    $user_id = getSpecificValue("SELECT `id` FROM `csi_userdata` WHERE `emailID`='$email'", 'id');
                    $registeredForEvent = getNumRows("SELECT `id` FROM `csi_collection` WHERE `event_id`='$eventId' and `user_id`='$user_id'");
                    if ($registeredForEvent == 0) {
            ?>
                        <div id="registrationDetails"></div>
                        <form action="eventRegistration.php" id="autoRegistrationLoginUser" method="GET">
                            <input type="hidden" name="event_id" value="<?php echo $eventId; ?>">
                            <button type="submit" name="register_now" class="btn main_btn_gradient">Register Now</button>
                        </form>
                        <?php
                    } else if ($registeredForEvent == 1) {
                        $not__registered = false;
                        $confirmationStatus = getSpecificValue("SELECT `confirmed` FROM `csi_collection`,`csi_userdata` WHERE `csi_collection`.`event_id`= '$eventId' AND `csi_collection`.`user_id` = `csi_userdata`.`id` AND `csi_userdata`.`emailID` = '$email' ", "confirmed");
                        if ($confirmationStatus == 1) {
                        ?>
                            <button type="button" class="btn btn-success">Registered</button>
                        <?php
                        } else if ($confirmationStatus == 0) {
                        ?>
                            <button type="button" class="btn btn-info">Waiting for Confirmation</button>
                    <?php
                        }
                    }
                } else {
                    ?>
                    <form action="eventRegistration.php" method="GET">
                        <input type="hidden" name="event_id" value="<?php echo $eventId; ?>">
                        <button type="submit" name="register_now" class="btn main_btn_gradient">Register Now</button>
                    </form>
                <?php
                }
            } else {
                ?>
                <div class="alert alert-danger w-25 mx-auto" role="alert">Registration is Closed.</div>
                <?php
                if ($eventDetails['feedback'] == 1) {
                ?>
                    <form action="feedback.php" method="GET">
                        <input type="hidden" name="e_id" value="<?php echo $eventDetails['id']; ?>">
                        <button type="submit" class="btn main_btn_gradient">Feedback</button>
                    </form>
            <?php
                }
            }
            ?>
            <div class="spacer" style="height:20px;"></div>
        </div>
        <div class="spacer" style="height:40px;"></div>
        <div class="row">
            <div class="spacer" style="height:40px;"></div>
            <p class="description">
                <?php echo $eventDetails['e_description']; ?>
            </p>
        </div>
        <hr class="supp1 my-5">
        <div class="row">
            <div class="col-sm-6">
                <div class="know-more">
                    <h3><b style="color: #941616;">Registration Fees</b> <i class="fas fa-dollar-sign"></i></h3>
                    <div class="spacer" style="height:20px;"></div>
                    <p>
                        CSI Members – Rs.<?php echo $eventDetails['fee_m']; ?>
                        <br>
                        Non-CSI Members – Rs.<?php echo $eventDetails['fee']; ?>
                    </p>
                    <div class="spacer" style="height:50px;"></div>
                    <?php
                    if ($numberOfSpeakers > 0) {
                    ?>
                        <div class="spacer" style="height:10px;"></div>
                        <h3><b style="color: #729416;">For Any Queries </b><i class="fas fa-question-circle"></i></h3>
                        <br>
                        <div class="spacer" style="height:0px;"></div>
                        <p>
                            <b>Contact:</b>
                            <?php
                            // Event coordinators details
                            $query_contact = execute("SELECT `c_name`,`c_phonenumber` FROM `csi_contact` WHERE `event_id`='$eventId'");
                            while ($row2 = mysqli_fetch_assoc($query_contact)) {
                                echo $row2['c_name'] . " - " . $row2['c_phonenumber'] . "<br>";
                            }
                            ?>
                        </p>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-6">
                <?php
                if ($numberOfSpeakers > 0) {
                ?>
                    <div class="speakers">
                        <h1>Speakers</h1>
                        <hr class="supp">
                        <br>
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                for ($i = 0; $i < $numberOfSpeakers; $i++) {
                                    $rowspeaker = mysqli_fetch_assoc($eventSpeakerDetails);
                                ?>
                                    <div class="carousel-item <?php if ($i == 0) echo ' active'; ?> card mb-4 rounded">
                                        <img class="card-img-top" src="Speaker_Image/<?php echo trim($rowspeaker['photo']); ?>" alt="<?php echo trim($rowspeaker['photo']); ?>">
                                        <div class="card-body text-center">
                                            <h3 class="card-title"><?php echo $rowspeaker['name']; ?></h3>
                                            <h4 class="card-text"><?php echo $rowspeaker['profession']; ?></h4>
                                            <p class="card-text"><?php echo $rowspeaker['description']; ?></pc>
                                            <div class="my-2" >
                                                <?php
                                                if ($rowspeaker['linkedIn'] != "") {
                                                ?>
                                                    <a href="<?php echo $rowspeaker['linkedIn']; ?>" ><i class="fab fa-linkedin fa-2x"></i></a>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <h3><b style="color: #729416;">For Any Queries </b><i class="fas fa-question-circle"></i></h3>
                    <br>
                    <div class="spacer" style="height:0px;"></div>
                    <p><b>Contact:</b>
                        <br>
                        <br>
                        <?php
                        // Event coordinators details
                        $query_contact = execute("SELECT `c_name`,`c_phonenumber` FROM `csi_contact` WHERE `event_id`='$eventId'");
                        while ($row2 = mysqli_fetch_assoc($query_contact)) {
                            echo $row2['c_name'] . " - " . $row2['c_phonenumber'] . "<br>";
                        }
                        ?>
                    </p>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Content -->
    <!-- DO NOT DELETE THIS  -->
    <script src="plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="plugins/jquery.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <script src="plugins/smtp.min.js"></script>
    <script src="plugins/google.gsi.client.js" async defer></script>
    <script src="plugins/jwt-decode.min.js"></script>
    <script src="js/email.js"></script>
    <script>
        $(document).ready(function(e) {
            var typeOfUser = $("input[name='typeOfUser']").val();
            if (typeOfUser == "0101") {
                $("#receiptOfLogUser").on("submit", (function(e) {
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
                            $("#receiptOfLogUser").html("");
                        }
                    });
                }));
            }
            <?php
            if (isset($_SESSION["email"])) {
                if((($_SESSION["role_id"]=='5'||($_SESSION['role_id']>='8'&&$_SESSION['role_id']<='24'))&&  $eventDetails['fee_m']=='0')||($_SESSION["role_id"]=='6'&&  $eventDetails['fee']=='0')){
            ?>
                $("#autoRegistrationLoginUser").on("submit", (function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "<?php echo $protocol.$domainName; ?>/api/eventAutoReg.php",
                        type: "POST",
                        data: {
                            "email": "<?php echo $_SESSION["email"]; ?>",
                            "eventId": <?php echo $eventId; ?>
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            var registration = response.registration;
                            var registered = response.registered;
                            var error = response.error;
                            if (response.error == null) {
                                if (response.registration) {
                                    $("#autoRegistrationLoginUser").remove();
                                    $("#registrationDetails").html('<button type="button" class="btn btn-success">Registered</button>');
                                } else if (response.registered) {
                                    $("#registrationDetails").html('<div class="alert alert-danger w-25 mx-auto" role="alert">You have Registered for this event.</div>');
                                }
                            } else {
                                $("#registrationDetails").html('<div class="alert alert-danger w-25 mx-auto" role="alert">' + response.error + '</div>');
                            }
                        }
                    });
                }));
            <?php
                }
            }
            ?>
        });
        <?php ?>
    </script>
    <!-- Footer -->
    <?php require_once 'footer.php'; ?>
    <!-- Footer -->
</body>

</html>