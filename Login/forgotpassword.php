<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/csi-logo.png">
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css?v=<?php echo time(); ?>">
    <title>CSI-SAKEC</title>
</head>

<body>
    <div class="container text-center">
        <h1 class="font-weight-bold mb-5">Forgot Password</h1>
        <div class="my-4"><i class="fas fa-user-lock fa-5x"></i></div>
        <div id="error"></div>
        <div id="step" onload="animation();">
            <div class="down-1 d-flex justify-content-center my-4 ">
                <label for="Email"><i class="far fa-user-circle fa-2x"></i></label>
                <input id="Email" type="text" class="form-control w-25 mx-3 " name="email" required="required" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="down-2">
                <button name="submit" value="2" class="btn main_btn">Submit <i class="fa fa-arrow-circle-right "></i></button>
            </div>
        </div>
    </div>
    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <script src="../plugins/anime.min.js"></script>
    <script src="../plugins/smtp.min.js"></script>
    <script src="forgetpasswordInput.js"></script>
    <!-- DO NOT DELETE THIS  -->
</body>

</html>