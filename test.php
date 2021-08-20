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
        //Google will call this function 
        function fillRequired(response) {
            var decodedToken = jwt_decode(response.credential);
            var email = decodedToken.email;
            console.log(email);
            $("#Step2").load("test2.php", {
                authProvider: "<?php echo md5("Google"); ?>",
                email: email,
                eventId: "<?php echo $eventId; ?>"
            });
        }
        $(document).ready(function(e) {
                console.log("test unsuccess");
                $("#part1").on("submit",(function(e) {
                    e.preventDefault();
                    console.log(this);
                    $.ajax({
                        url: "test3.php",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            $("#error").html(data);
                        },
                    });
                }));
            });

       

        // $(document).ready(function() {
        //     $('#user-login').css({
        //         'height': (($(window).height()) - 49) + 'px'
        //     });
        //     $(document).on("click", "button['name='submit']", function() {
        //         var type = $("input[name='typeOfUser']").val();
        //         var fee = $("input[name='eventPaymentStatus']").val();

        //         if (type == "1101") {
        //             var billImage = $("input[name='bill_photo']").val();
        //             var userId = $("input[name='userId']").val();
        //             $("#error").load("test3.php", {
        //                 authProvider: "<?php echo md5("Google"); ?>",
        //                 type: type,
        //                 fee: fee,
        //                 eventId: "<?php echo $eventId; ?>",
        //                 userId: userId
        //             });
        //         } else if (type == "100") {
        //             var billImage = $("input[name='bill_photo']").val();
        //             var name = $("input[name='Name']").val();
        //             var year = $("input[name='year']").val();
        //             var emailId = $("input[name='email']").val();
        //             var branch = $("input[name='branch']").val();
        //             var organisation = "collegeName";

        //             $("#error").load("test3.php", {
        //                 authProvider: "<?php echo md5("Google"); ?>",
        //                 type: type,
        //                 fee: fee,
        //                 name: name,
        //                 year: year,
        //                 emailId: emailId,
        //                 branch: branch,
        //                 organisation: organisation,
        //                 eventId: "<?php echo $eventId; ?>",

        //             });
        //         }
        //     });
        // });
    </script>
</body>

</html>