<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/csi-logo.png">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="../css/login.css?v=<?php echo time(); ?>" type="text/css">
    <title>CSI-SAKEC</title>
</head>

<body>
<?php
    require_once "../config.php";
        //session_start();
        // if(isset($_SESSION['email'])){
        //     redirect_after_msg("You Are Already Logged In \n If you Wnted to Login with different account please Logout first","../index.php");
        // }
    ?>
    <div class="container text-center">
        <h1 class="font-weight-bold my-5">USER LOGIN</h1>
        <div class="my-5">
            <i class="fas fa-user-circle fa-5x"></i>
        </div>
        <div id="error"></div>
        <div class="d-flex justify-content-center my-4">
            <label for="Email"><i class="far fa-user-circle fa-2x"></i></label>
            <input id="Email" type="text" class="form-control w-25 mx-3" name="email" required="required" placeholder=" Username" aria-label="Username" aria-describedby="basic-addon1">
        </div>
        <div class="d-flex justify-content-center my-4">
            <label for="Password"><i class="fas fa-lock fa-2x"></i></label>
            <input type="password" class="form-control w-25 p-3 mx-3" name="password" required="required" placeholder=" Input Password">
        </div>
        <button name="login" class="btn main_btn_gradient">Login<i class="fas fa-sign-in-alt"></i></button>
        <div id="googleButton" style="text-align: -webkit-center;" class="my-5">
            <div id="g_id_onload" data-client_id="<?php echo $google_client_id; ?>" data-context="use" data-ux_mode="popup" data-callback="handleCredentialResponse" data-auto_prompt="false"></div>
            <div class="g_id_signin" data-type="standard" data-shape="pill" data-theme="outline" data-text="signin_with" data-size="large" data-logo_alignment="left"></div>
        </div>
        <p class="my-4 text-light"><a href="forgotpassword.php" class="btn main_btn">Forgot password</a></p>
        <p class="my-4 text-light"><a href="signup.php" class="btn main_btn">Sign Up</a></p>
    </div>

    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <script src="../plugins/google.gsi.client.js" async defer></script>
    <script src="../plugins/jwt-decode.min.js"></script>
    <!-- DO NOT DELETE THIS  -->

    <script>
        function handleCredentialResponse(response) {
            var decodedToken = jwt_decode(response.credential);
            var email = decodedToken.email;
            $("#error").load("../GoogleLogin/GoogleLogin.php", {
                authProvider: "<?php echo md5("Google"); ?>",
                email: email
            });
        }
        $(document).on('click', "button[name='login']", function() {
            var email = $("input[name='email']").val();
            var password = $("input[name='password']").val();
            $("#error").load("loginCheck.php", {
                email: email,
                password: password
            });
        });
    </script>
</body>

</html>