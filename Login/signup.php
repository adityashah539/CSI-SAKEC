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
    <div class="container text-center">
        <h1 class="font-weight-bold my-5 ">WELCOME!</h1>
        <div id="error"></div>
        <div class="">
            <h4>Step 1: Choose your account </h4>
            <!--Google Button -->
            <div id="googleButton" style="text-align: -webkit-center;" class="my-4">
                <div id="g_id_onload" data-client_id="<?php echo $google_client_id; ?>" data-context="use" data-ux_mode="popup" data-callback="fillRequired" data-auto_prompt="false"></div>
                <div class="g_id_signin" data-type="standard" data-shape="pill" data-theme="outline" data-text="continue_with" data-size="large" data-logo_alignment="left"></div>
            </div>
            <!-- <div class="d-flex justify-content-center my-4">
                <label><i class="fas fa-file-signature fa-2x"></i></label>
                <input type="text" class="form-control w-25 p-3 mx-3" name="Email" required="required" placeholder="Enter Email">
            </div>
            <button class="btn btn-primary" name="submit">Submit </button></br></br> -->
            <!-- jquery will put the fill required -->
            <div id="Step2"></div>
        </div>
    </div>
    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <script src="../plugins/google.gsi.client.js" async defer></script>
    <script src="../plugins/jwt-decode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jwt-decode@2.2.0/build/jwt-decode.min.js"></script>
    <script>
        //Google will call this function 
        function fillRequired(response) {
            var decodedToken = jwt_decode(response.credential);
            var email = decodedToken.email;
            $("#Step2").load("datainput.php", {
                authProvider: "<?php echo md5("Google"); ?>",
                signupEmail: email
            });
        }
        $(document).ready(function() {
            //To resize the background image based upon window size 
            $('#user-login').css({
                'height': (($(window).height()) - 49) + 'px'
            });
            //For testing purpose 
            $(document).on('click', "button[name='submit']", function() {
                var email = $("input[name='Email']").val();
                $("#Step2").load("datainput.php", {
                    authProvider: "<?php echo md5("Google"); ?>",
                    signupEmail: email
                });
            });
            // After the sign up button data will pushed to database 
            $(document).on('click', "button[name='sign_up']", function() {
                var registrationProcess = $("input[name='registrationProcess']").val();
                if (registrationProcess == "337db7c71a09b11bf114cf9a48ed0af6") {
                    var password = $("input[name='password']").val();
                    var confirmpassword = $("input[name='confirmPassword']").val();
                    $("#error").load("registration.php", {
                        registrationProcess: registrationProcess,
                        password: password,
                        confirmpassword: confirmpassword
                    });
                } else if (registrationProcess == "f0e84041297fae34080e61b840d26ebe") {
                    var gender = $("#gender").val();
                    var password = $("input[name='password']").val();
                    var confirmpassword = $("input[name='confirmPassword']").val();
                    $("#error").load("registration.php", {
                        registrationProcess: registrationProcess,
                        gender: gender,
                        password: password,
                        confirmpassword: confirmpassword
                    });
                } else if (registrationProcess == "b44f7646f2918e4ddc983ca59d34ed97") {
                    var password = $("input[name='password']").val();
                    var confirmpassword = $("input[name='confirmPassword']").val();
                    var phonenumber = $("input[name='phonenumber']").val();
                    var name = $("input[name='Name']").val();
                    var branch = $("#branch").val();
                    var gender = $("#gender").val();
                    var year = $("#year").val();
                    var collegeName = $("input[name='collegeName']").val();
                    $("#error").load("registration.php", {
                        registrationProcess: registrationProcess,
                        name: name,
                        collegeName: collegeName,
                        phonenumber: phonenumber,
                        branch: branch,
                        year: year,
                        gender: gender,
                        password: password,
                        confirmpassword: confirmpassword
                    });
                }
            });
        })
    </script>
    <!-- DO NOT DELETE THIS  -->
</body>

</html>