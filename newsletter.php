<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/csi-logo.png">
    <link rel="stylesheet" href="plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/changeuserdata.css">
    <?php
    require_once "config.php";
    session_start();
    $access = NULL;
    if (isset($_SESSION["role_id"])) {
        $role_id = $_SESSION["role_id"];
        $access = getValue("SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id");
    }
    ?>
    <title>Newsletter</title>
</head>

<body>
    <!-- Navbar -->
    <?php require "usernavbar.php"; ?>
    <div class="spacer" style="height:85px;"></div>
    <!-- Navbar -->
    <div class="container">
        <h1 class="text-center my-4">Newsletter</h1>
        <h3 class="text-center my-4">Choose a account for Subscription</h3>
        <div id="googleButtonNewsletter" style="text-align: -webkit-center;" class="my-2">
            <div id="g_id_onload" data-client_id="<?php echo $google_client_id; ?>" data-context="use" data-ux_mode="popup" data-callback="getMailNewsletter" data-auto_prompt="false"></div>
            <div class="g_id_signin" data-type="standard" data-shape="pill" data-theme="outline" data-text="signin_with" data-size="large" data-logo_alignment="left"></div>
        </div>
    </div>
    <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
        <div id="myToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">
            <div class="toast-header">
                <img src="images\csi-logo.png" style="width: 50px;" class="rounded mr-2 img-thumbnail rounded-circle" alt="...">
                <strong class="mr-auto h4">Message</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body alert alert-primary h5">
            </div>
        </div>
    </div>
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
    <script src="plugins/jquery.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="plugins/google.gsi.client.js" async defer></script>
    <script src="plugins/jwt-decode.min.js"></script>
    <script src="js/email.js"></script>
    <script>
        async function getMailNewsletter(response) {
            var decodedToken = jwt_decode(response.credential);
            var email = decodedToken.email;
            $.ajax({
                url: '<?php echo $protocol.$domainName; ?>/api/registrationNewsletter.php',
                type: 'post',
                data:{"email": email},
                dataType: 'JSON',
                success: function (response) {
                    var registration = response.registration;
                    var registered = response.registered;
                    $('#newsletter').modal('toggle');
                    if (!registered) {
                        if(registration){
                            successMessage("You have been registered for the newsletter.");
                        }else{
                            error("Error in Registering.");
                        }
                    } else {
                        error("You have already registered. for newsletter through this account("+email+").");
                    }
                }
            });
        }
    </script>
</body>

</html>