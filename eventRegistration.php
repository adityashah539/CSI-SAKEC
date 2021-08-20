<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/csi-logo.png">
    <link rel="stylesheet" href="plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/jwt-decode@2.2.0/build/jwt-decode.min.js"></script>
    <title>Event Registration</title>
</head>
<body>
<?php
    require_once "config.php";
    session_start();
    //include "usernavbar.php";
    $eventId = $_GET['event_id'];
    if (!isset($_SESSION['email'])) {
    ?>
        <div class="user-login">
            <div id="error" class="my-4"></div>
            <!--Google Button -->
            <div id="googleButton" style="text-align: -webkit-center;" class="my-4">
                <div id="g_id_onload" data-client_id="159353966442-gr7au60l9noshlk968icbhd5592ga3fc.apps.googleusercontent.com" data-context="use" data-ux_mode="popup" data-callback="fillRequired" data-auto_prompt="false"></div>
                <div class="g_id_signin" data-type="standard" data-shape="pill" data-theme="outline" data-text="continue_with" data-size="large" data-logo_alignment="left"></div>
            </div>
            <div id="Step2">

            </div>
        </div>
    <?php
    }
    ?>
    <!-- DO NOT DELETE THIS  -->
    <script src="plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="plugins/jquery.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/jwt-decode@2.2.0/build/jwt-decode.min.js"></script>
    <!-- DO NOT DELETE THIS  -->
    <script>
        function fillRequired(response) {
            var decodedToken = jwt_decode(response.credential);
            var email = decodedToken.email;
            console.log(email);
            $("#Step2").load("eventRegistrationData.php", {
                authProvider: "<?php echo md5("Google"); ?>",
                email: email,
                eventId: "<?php echo $eventId; ?>",
            });
        }
    </script>
</body>
</html>