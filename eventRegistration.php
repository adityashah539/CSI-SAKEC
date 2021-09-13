<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/csi-logo.png">
    <link rel="stylesheet" href="plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/changeuserdata.css?v=<?php echo time(); ?>">

    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/jwt-decode@2.2.0/build/jwt-decode.min.js"></script>
    <title>Event Registration</title>
    <?php
    require_once "config.php";
    session_start();
    //include "usernavbar.php";
    $event_id = $_GET['event_id'];
    $rowevent = getValue("SELECT * FROM csi_event WHERE id='$event_id'");
    ?>
</head>

<body>

    <!-- Navbar -->
    <?php require "usernavbar.php"; ?>
    <div style='height: 85px;'></div>
    <!-- Navbar -->
    <?php
    //checking if feedback is enabled
    $eventquery = execute("SELECT * FROM csi_event WHERE id='$event_id'");
    // collaboration of event
    $querycollaboration = execute("SELECT * FROM csi_collaboration WHERE event_id='$event_id'");
    $collaboration = "";
    $rowevent = mysqli_fetch_assoc($eventquery);
    for ($i = mysqli_num_rows($querycollaboration); $i > 0; $i--) {
        $rowcollaboration = mysqli_fetch_assoc($querycollaboration);
        $collaboration = $collaboration . $rowcollaboration['collab_body'];
        if ($i != 1) $collaboration = $collaboration . ", ";
    }
    ?>
    <header class="container text-center">
        <h2 class="my-3">
            Event Registration for <?php echo $rowevent['title']; ?> 
            <?php
            if (mysqli_num_rows($querycollaboration)) {
                echo "In collaboration with " . $collaboration . " ";
            }
            ?>
        </h2>
    </header>
    <?php

    if (!isset($_SESSION['email'])) {
    ?>
        <div class="user-login">
            <div id="error" class="my-4"></div>
            <div class="text-center h4">Step 1 : Choose a account </div>
            <!--Google Button -->
            <div id="googleButton" style="text-align: -webkit-center;" class="my-4">
                <div id="g_id_onload" data-client_id="159353966442-gr7au60l9noshlk968icbhd5592ga3fc.apps.googleusercontent.com" data-context="use" data-ux_mode="popup" data-callback="fillRequired" data-auto_prompt="false"></div>
                <div class="g_id_signin" data-type="standard" data-shape="pill" data-theme="outline" data-text="continue_with" data-size="large" data-logo_alignment="left"></div>
            </div>
            <div id="spacer"></div>
            <div id="Step2" class="container ">
            </div>
        </div>
        <?php
    } else if (isset($_SESSION['roll_id'])) {
        $fee = $_POST['feeOfEvent'];
        $email = $_SESSION['email'];
        if ($fee > 0) {
        ?>
            <form action="eventRegDataProcessing.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="email" value="<?php echo $email; ?>" hidden>
                <input type="text" name="typeOfUser" value="0101" hidden>
                <input type="text" name="eventId" value="<?php echo  $event_id; ?>" hidden>
                <input type="text" name="feeOfEvent" value="<?php echo  $fee; ?>" hidden>
                <label class="control-label">PAYMENT RECEIPT:</label>
                <input type="file" name="bill_photo" required />
                <button type="submit" id="submit" name="submit" value="input" class="btn btn-danger">REGISTER NOW</button>
            </form>
    <?php
        } else {
            goToFile("event.php?event_id=" . $event_id);
        }
    } else {
        goToFile("event.php?event_id=" . $event_id);
    }
    ?>
    <!-- DO NOT DELETE THIS  -->
    <script src="plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="plugins/jquery.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <script src="plugins/smtp.min.js"></script>
    <script src="plugins/google.gsi.client.js" async defer></script>
    <script src="plugins/jwt-decode.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/email.js"></script>
    <!-- DO NOT DELETE THIS  -->
    <script>
        $(document).ready(function(){
            $("#spacer").css("height", "204px");
        });
        function fillRequired(response) {
            var decodedToken = jwt_decode(response.credential);
            var email = decodedToken.email;
            $("#Step2").load("eventRegistrationData.php", {
                authProvider: "<?php echo md5("Google"); ?>",
                email: email,
                eventId: "<?php echo $event_id; ?>",
                success: function() {
                    $("#error").html("");
                }
            });
            $("#spacer").css("height", "0px");
            
        }
    </script>
    <!-- Footer -->
    <?php require_once 'footer.php'; ?>
    <!-- Footer -->
</body>

</html>