<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/csi-logo.png">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="css/changeuserdata.css?v=<?php echo time(); ?>">
    <title> Feedback</title>
</head>

<body>
    <!-- Navbar -->
    <?php 
        require_once "config.php";
        session_start(); 
        require "usernavbar.php";
    ?>
    <div style='height: 85px;'></div>
    <!-- Navbar -->
    <input type="hidden" id="e_id" value="<?php echo $_GET['e_id']; ?>">
    <?php
    if(!isset($_GET['e_id'])){
        header("Location: index.php");
    }
    ?>
    
    <div id='feedbackform'></div>
    <?php
    if(!isset($_SESSION['email'])){
        echo '<div id="googleButton" style="text-align: -webkit-center;" class="my-4">
            <div id="g_id_onload" data-client_id="<?php echo $google_client_id; ?>" data-context="use" data-ux_mode="popup" data-callback="fillRequired" data-auto_prompt="false"></div>
            <div class="g_id_signin" data-type="standard" data-shape="pill" data-theme="outline" data-text="continue_with" data-size="large" data-logo_alignment="left"></div>
        </div>';
    }
    ?>
    <!-- DO NOT DELETE THIS  -->
    <script src="plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="plugins/jquery.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->
    <script>
        $(document).ready(function() {
            console.log("hello");
            $("#feedbackform").load("feedbackstatus.php?e_id=" + $("#e_id").val());
        });
        function fillRequired(response) {
            var decodedToken = jwt_decode(response.credential);
            var email = decodedToken.email;
            console.log(email);
            $("#feedbackform").load("feedbackstatus.php?e_id=" + $("#e_id").val(), {
                email: email,
                success: function() {
                    document.getElementById("googleButton").style.display = "none";
                }
            });
        }
    </script>
    <!-- Footer -->
    <?php require_once 'footer.php'; ?>
    <!-- Footer -->
</body>