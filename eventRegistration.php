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
    $arrayEventCollaboration = getAllValues("SELECT `collab_body` FROM `csi_collaboration` WHERE event_id='$event_id'");
    $eventCollaboration = implode(', ', array_column($arrayEventCollaboration, 'collab_body'));
    ?>
    <header class="container text-center">
        <h1 class="my-3">
            Event Registration for <?php echo $rowevent['title']; ?>
        </h1>
        <?php
        if (isset($eventCollaboration)) {
            echo "<h2>In collaboration with " . $eventCollaboration . "</h2>";
        }
        ?>
    </header>
    <?php
    if (!isset($_SESSION["role_id"])) {
    ?>
        <div class="user-login">
            <div id="error" class="my-4"></div>
            <div class="text-center h4">Step 1 : Choose a account </div>
            <!--Google Button -->
            <div id="googleButton" style="text-align: -webkit-center;" class="my-4">
                <div id="g_id_onload" data-client_id="<?php echo $google_client_id; ?>" data-context="use" data-ux_mode="popup" data-callback="fillRequired" data-auto_prompt="false"></div>
                <div class="g_id_signin" data-type="standard" data-shape="pill" data-theme="outline" data-text="continue_with" data-size="large" data-logo_alignment="left"></div>
            </div>
            <div id="spacer"></div>
            <div id="Step2" class="container">
            </div>
        </div>
        <?php
    } else {
        if($_SESSION['role_id']=='5'||($_SESSION['role_id']>='8'&&$_SESSION['role_id']<='24')){
            $fee = $rowevent['fee_m'];
        }else {
            $fee = $rowevent['fee'];
        }
        $email = $_SESSION['email'];
        if ($fee > 0) {
        ?>
            <form id ="form" enctype="multipart/form-data">
                <input type="text" name="email" value="<?php echo $email; ?>" hidden>
                <input type="text" name="typeOfUser" value="0101" hidden>
                <input type="text" name="eventId" value="<?php echo  $event_id; ?>" hidden>
                <input type="text" name="feeOfEvent" value="<?php echo  $fee; ?>" hidden>
                <div class="form-group row justify-content-center my-5">
                    <label for="" class="col-sm-1 text-center">Bills Photo : </label>
                    <div class="col-sm-2"><input type="file" name="bill_photo" required /></div>
                </div>
                <div class="d-flex justify-content-center my-4 grid-container">
                    <button type="submit" id="submit" name="submit" value="input" class="btn main_btn_gradient">Submit</button>
                </div>
            </form>
    <?php
        }
    }
    ?>
    <footer class="footer-area pb-4">
        <div class="container">
            <div class="row footer-bottom d-flex justify-content-between align-items-center">
                <p class="col-lg-8 col-md-8 footer-text m-0 ">
                    Copyright © <script>document.write(new Date().getFullYear());</script> All rights reserved by CSI-SAKEC
                </p>
                <div class="col-lg-4 col-md-4 footer-social">
                    <a href="https://www.facebook.com/csisakec/photos"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/csi.sakec/?utm_medium=copy_link"><i class="fab fa-instagram"></i></a>
                    <a href="https://twitter.com/sakectweets?lang=en"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.youtube.com/c/SAKECYouTubeChannel"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>
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
            $(document).ready(function() {
                $("#form").on("submit", function(e){
                    e.preventDefault();
                    var formData = new FormData(this);
                    var email=$("input[name='email']").val();
                    var typeOfUser = $("input[name='typeOfUser']").val();
                    var eventId = $("input[name='eventId']").val();
                    var feeOfEvent = $("input[name='feeOfEvent']").val();
                    $.ajax({
                        url : "eventRegDataProcessing.php",
                        type : "POST",
                        data : 
                        {
                            "bill_photo": formData,
                            "email": email,
                            "typeOfUser": typeOfUser,
                            "eventId": eventId,
                            "feeOfEvent": feeOfEvent
                        },
                        contextType : false,
                        processData : false,
                        success: function(data){
                            if(data == "true"){
                                window.location = 'http://localhost/csi-sakec/event.php?event_id='+eventId;
                            }
                        }
                    });
                });
            });
        }
    </script>
</body>

</html>