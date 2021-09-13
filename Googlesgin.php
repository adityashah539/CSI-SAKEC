<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="images/csi-logo.png">
    <title>Google Sign In</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
    <h1>Google Sign In</h1>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/jwt-decode@2.2.0/build/jwt-decode.min.js"></script>
    <div id="g_id_onload" data-client_id="159353966442-gr7au60l9noshlk968icbhd5592ga3fc.apps.googleusercontent.com" data-context="use" data-ux_mode="popup" data-callback="handleCredentialResponse" data-auto_prompt="false">
    </div>

    <div class="g_id_signin" data-type="standard" data-shape="pill" data-theme="outline" data-text="continue_with" data-size="large" data-logo_alignment="left">
    </div>
    <button type="button" class="btn btn-primary show-toast" id="liveToastBtn">Show live toast</button>

    <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
        <div id="myToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
            <div class="toast-header">
                <img src="..." class="rounded mr-2" alt="...">
                <strong class="mr-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-success" id="show"></button>
    <button type="button" class="btn btn-danger" id="close"></button>
    <script>
        function handleCredentialResponse(response) {
            var decodedToken = jwt_decode(response.credential);
            console.log(decodedToken.name);
            console.log(decodedToken.email); // This is null if the 'email' scope is not present.
            $("#Step2").load("godatainput.php", {
                authProvider: "<?php echo md5("Google"); ?>",
                email: email
            });
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $(".show-toast").click(function() {
                $("#myToast").toast('show');
            });
        });
    </script>
</body>

</html>