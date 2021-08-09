<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="images/csi-logo.png">
    <title>Google Sign In</title>
</head>

<body>
    <h1>Google Sign In</h1>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/jwt-decode@2.2.0/build/jwt-decode.min.js"></script>
    <!-- <div id="g_id_onload"
     data-client_id="159353966442-gr7au60l9noshlk968icbhd5592ga3fc.apps.googleusercontent.com"
     data-context="use"
     data-ux_mode="popup"
     data-callback="handleCredentialResponse">
</div> -->

    <!-- <div id="g_id_onload"
        data-client_id="159353966442-gr7au60l9noshlk968icbhd5592ga3fc.apps.googleusercontent.com"
        data-context="signin"
        data-callback="handleCredentialResponse">
    </div> -->
    <script>
        function handleCredentialResponse(response) {
            var decodedToken = jwt_decode(response.credential);
            console.log(decodedToken.name);
            console.log(decodedToken.email); // This is null if the 'email' scope is not present.
        }
    </script>
</body>

</html>