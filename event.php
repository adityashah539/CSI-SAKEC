<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/csi-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/event.css?v=<?php echo time(); ?>">

    <title>Event</title>
</head>

<body>
    <?php
    require_once "config.php";
    session_start();
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
            redirect_after_msg("You have been registerd for the event", "event.php?event_id=$event_id");
        } else {
            redirect_after_msg("Registration Failed", "../eventregistration.php?event_id=$event_id");
        }
    }
    // Fetching Access Details
    $access = NULL;
    if (isset($_SESSION["role_id"])) {
        $role_id = $_SESSION["role_id"];
        $access = getValue("SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id");
    }

    $event_id = $_GET['event_id'];

    $rowevent = getValue("SELECT * FROM csi_event WHERE id='$event_id'");
    $flag = true;
    $queryspeaker = execute("SELECT * FROM csi_speaker WHERE event_id='$event_id'");
    $number_of_speakers = mysqli_num_rows($queryspeaker);
    ?>

    <!-- Navbar -->
    <?php require "usernavbar.php"; ?>
    <!-- Navbar -->

    <!-- Spacer -->
    <div class="spacer" style="height:150px;"></div>
    <!-- Spacer -->

    <!-- Content -->
    <div class="container ">
        <h1>
            <?php
            // Title of event
            echo $rowevent['title'];
            ?>
            <?php
            // collaboration of event
            $querycollaboration = execute("SELECT * FROM csi_collaboration WHERE event_id='$event_id'");
            $collaboration = "";
            for ($i = mysqli_num_rows($querycollaboration); $i > 0; $i--) {
                $rowcollaboration = mysqli_fetch_assoc($querycollaboration);
                $collaboration = $collaboration . $rowcollaboration['collab_body'];
                if ($i != 1) $collaboration = $collaboration . ", ";
            }
            if (mysqli_num_rows($querycollaboration)) {
                echo "<h2>In collaboration with " . $collaboration . "</h2>";
            }
            ?>
        </h1>
        <div class="spacer" style="height:20px;"></div>
        <img class="main-img" src="<?php echo "Banner/" . trim($rowevent['banner']); ?>" alt="no image">
        <div class="spacer" style="height:35px;"></div>
        <div class="event-header">
            <div class="spacer" style="height:20px;"></div>
            <h1> <?php echo $rowevent['subtitle']; ?></h1>
            <h1><?php $rowevent['subtitle']; ?></h1>
            <h4>
                <?php
                if ($rowevent['e_from_date'] == $rowevent['e_to_date'])
                    echo date("jS  F Y", strtotime($rowevent['e_from_date']));
                else
                    echo date("jS F Y", strtotime($rowevent['e_from_date'])) . "-" . date("jS F Y", strtotime($rowevent['e_to_date']));
                echo "<br>" . date(" h:i A", strtotime($rowevent['e_from_time'])) . " to " . date("h:i A", strtotime($rowevent['e_to_time']));
                ?>
            </h4>
            <div class="spacer" style="height:20px;"></div>
            <?php
            $not__registered = false;
            if (isset($_SESSION["email"])) {
                $email = $_SESSION["email"];
                $user_id = getSpecificValue("SELECT `id` FROM `csi_userdata` WHERE `emailID`='$email'", 'id');
                $registeredForEvent = getNumRows("SELECT `id` FROM `csi_collection` WHERE `event_id`='$event_id' and `user_id`='$user_id'");
                if ($registeredForEvent == 0) {
                    $not__registered = true;
                } else if ($registeredForEvent == 1) {
                    $not__registered = false;
                    $confirmationStatus = getSpecificValue("SELECT `confirmed` FROM `csi_collection`,`csi_userdata` 
                    WHERE `csi_collection`.`event_id`= '$event_id' AND `csi_collection`.`user_id` = `csi_userdata`.`id` AND `csi_userdata`.`emailID` = '$email' ", "confirmed");
                    if ($confirmationStatus == 1) {
            ?>
                        <button type="button" class="btn btn-success">Registered</button>
                    <?php
                    } else if ($confirmationStatus == 0) {
                    ?>
                        <button type="button" class="btn btn-info">Waiting for Confirmation</button>
                    <?php
                    }
                    if ($rowevent['feedback'] == 1) {
                    ?>
                        <form action="feedback.php" method="GET">
                            <input type="hidden" name="e_id" value="<?php echo $rowevent['id']; ?>">
                            <button type="submit" class="btn btn-success">Feedback</button>
                        </form>
                <?php
                    }
                }
            }

            if (!isset($_SESSION['email'])) {
                ?>
                <div id="error" class="my-4"></div>
                <form action="eventRegistration.php" method="GET">
                    <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                    <button type="submit" name="register_now" class="btn btn-primary">Register Now</button>
                </form>
                <?php
            } else if ($not__registered) {
                if ($role_id == 6) {
                    $fee = $rowevent['fee'];
                } else {
                    $fee = $rowevent['fee_m'];
                }
                if ($fee == 0) {
                    $email = $_SESSION['email'];
                    if (isset($_POST['registerNow'])) {
                        autoRegistration($email, $event_id);
                    }
                ?>
                    <form method="post">
                        <button type="submit" name="registerNow" class="btn btn-primary">Register Now</button>
                    </form>
                <?php
                    //autoRegistration($email, $event_id);
                } else if ($fee > 0) {
                ?>
                    <div id="error"></div>
                    <form id="receiptOfLogUser" method="POST" enctype="multipart/form-data">
                        <input type="text" name="email" value="<?php echo $email; ?>" hidden>
                        <input type="text" name="typeOfUser" value="0101" hidden>
                        <input type="text" name="eventId" value="<?php echo  $event_id; ?>" hidden>
                        <input type="text" name="feeOfEvent" value="<?php echo  $fee; ?>" hidden>
                        <label class="control-label">PAYMENT RECEIPT:</label>
                        <input type="file" name="bill_photo" required />
                        <button type="submit" id="submit" name="submit" value="input" class="btn btn-danger">REGISTER NOW</button>
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
                <?php echo $rowevent['e_description']; ?>
            </p>
        </div>
        <div class="spacer" style="height:90px;"></div>
        <hr class="supp1">
        <div class="row">
            <div class="col-sm-6">
                <div class="spacer" style="height:50px;"></div>
                <div class="know-more">
                    <h3><b style="color: #941616;">Registration Fees</b> <i class="fas fa-dollar-sign"></i></h3>
                    <div class="spacer" style="height:20px;"></div>
                    <p>
                        CSI Members – Rs.<?php echo $rowevent['fee_m']; ?>
                        <br>
                        Non-CSI Members – Rs.<?php echo $rowevent['fee']; ?>
                    </p>
                    <div class="spacer" style="height:50px;"></div>
                    <?php
                    if ($number_of_speakers > 0) {
                    ?>
                        <div class="spacer" style="height:10px;"></div>
                        <h3><b style="color: #729416;">For Any Queries </b><i class="fas fa-question-circle"></i></h3>
                        <br>
                        <div class="spacer" style="height:0px;"></div>
                        <p>
                            <b>Contact:</b>
                            <br>
                            <br>
                            <?php
                            // Event coordinators details
                            $query_contact = execute("SELECT `c_name`,`c_phonenumber` FROM `csi_contact` WHERE `event_id`='$event_id'");
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
                <div class="speakers">
                    <?php
                    if ($number_of_speakers > 0) {
                    ?>
                        <h1>Speakers</h1>
                        <hr class="supp">
                        <br>
                        <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php
                                for ($i = 0; $i < $number_of_speakers; $i++) {
                                ?>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" <?php if ($i == 0) echo 'class="active"'; ?>></li>
                                <?php
                                }
                                ?>
                            </ol>
                            <div class="carousel-inner">
                                <?php
                                for ($i = 0; $i < $number_of_speakers; $i++) {
                                    $rowspeaker = mysqli_fetch_assoc($queryspeaker);
                                ?>
                                    <div class="carousel-item<?php if ($i == 0) echo ' active'; ?>">
                                        <!-- Card Regular -->
                                        <div class="card card-cascade">
                                            <!-- Card image -->
                                            <div class="view view-cascade overlay">
                                                <img class="card-img-top" src="Speaker_Image/<?php echo trim($rowspeaker['photo']); ?>" alt="<?php echo trim($rowspeaker['photo']); ?>">
                                                <a>
                                                    <div class="mask rgba-white-slight"></div>
                                                </a>
                                            </div>
                                            <!-- Card content -->
                                            <div class="card-body card-body-cascade text-center">
                                                <!-- Title -->
                                                <h4 class="card-title"><strong><?php echo $rowspeaker['name']; ?></strong></h4>
                                                <!-- Subtitle -->
                                                <h6 class="font-weight-bold indigo-text py-2"><?php echo $rowspeaker['profession']; ?></h6>
                                                <!-- Text -->
                                                <p class="card-text">
                                                    <?php echo $rowspeaker['description']; ?>
                                                </p>
                                                <div class="footer-social">
                                                    <a href=" <?php if ($rowspeaker['linkedIn'] != "") {
                                                                    echo $rowspeaker['linkedIn'];
                                                                } ?> "><i class="fab fa-linkedin"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="spacer" style="height:50px;"></div>
                        <h3><b style="color: #729416;">For Any Queries </b><i class="fas fa-question-circle"></i></h3>
                        <br>
                        <div class="spacer" style="height:0px;"></div>
                        <p><b>Contact:</b>
                            <br>
                            <br>
                            <?php
                            // Event coordinators details
                            $query_contact = execute("SELECT `c_name`,`c_phonenumber` FROM `csi_contact` WHERE `event_id`='$event_id'");
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
    </div>
    <!-- Content -->

    <!-- Spacer -->
    <div class="spacer" style="height:90px;"></div>
    <!-- Spacer -->

    <!-- Footer -->
    <?php require_once 'footer.php'; ?>
    <!-- Footer -->
    <!-- DO NOT DELETE THIS  -->

    <script src="plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="plugins/jquery.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
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
        });
    </script>

</body>

</html>