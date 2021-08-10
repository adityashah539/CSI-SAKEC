<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/csi-logo.png">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="../css/login.css?v=<?php echo time(); ?>">
    <title>CSI-SAKEC</title>
    <?php
    require_once "../config.php";
    session_start();
    ?>
</head>


<body>
    <div id="user-login">
        <h1 class="font-weight-bold my-5">WELCOME!</h1>
        <div id="error"></div>
        <div class="container text-center">
            <h4>Step 1: Choose your account </h4>
            <div id="googleButton" style="text-align: -webkit-center;" class="my-5">
                <div id="g_id_onload" data-client_id="159353966442-gr7au60l9noshlk968icbhd5592ga3fc.apps.googleusercontent.com" data-context="use" data-ux_mode="popup" data-callback="handleCredentialResponse" data-auto_prompt="false"></div>
                <div class="g_id_signin" data-type="standard" data-shape="pill" data-theme="outline" data-text="signin_with" data-size="large" data-logo_alignment="left"></div>
            </div>
            <div id="Step2">

            </div>
            
        </div>
    </div>

    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/jwt-decode@2.2.0/build/jwt-decode.min.js"></script>
    <!-- DO NOT DELETE THIS  -->

    <script>
        $(document).ready(function() {
            //image height
            $('#user-login').css({'height': (($(window).height())+250)+'px'});

            function handleCredentialResponse(response) {
                var decodedToken = jwt_decode(response.credential);
                var email = decodedToken.email;
                $("#Step2").load("datainput.php", {
                    authProvider: "<?php echo md5("Google"); ?>",
                    email: email
                });
            }
            $("button[name='sign_up_non-sakec']").click(function() {
                var password = $("input[name='password']").val();
                var confirmpassword = $("input[name='confirmpassword']").val();
                var email = $("input[name='email']").val();
                var phonenumber = $("input[name='phonenumber']").val();
                var name = $("input[name='name']").val();
                var branch = $("#branch").val();
                var gender = $("#gender").val();
                var year = $("#year").val();
                var organization = $("input[name='organization']").val();
                // alert( branch+' '+year+' '+organization+' '+password);
                $("#error").load("registration.php", {
                    email: email,
                    branch: branch,
                    phonenumber: phonenumber,
                    name: name,
                    gender: gender,
                    year: year,
                    organization: organization,
                    password: password,
                    confirmpassword: confirmpassword
                });
            });
        })
    </script>
</body>

</html>