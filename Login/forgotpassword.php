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
        <div id="step">
            <div class="down-1 d-flex justify-content-center my-4 ">
                <label for="Email"><i class="far fa-user-circle fa-2x"></i></label>
                <input id="Email" type="text" class="form-control w-25 mx-3 " name="email" required="required" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
            </div>
            <div class="down-2">
                <button name="submitEmail" class="btn main_btn">Submit <i class="fa fa-arrow-circle-right"></i></button>
            </div>
            <div class="down- d-flex justify-content-center my-4 ">
                <label for="Password"></label>
                <div><i class="fas fa-lock-open fa-2x"></i>Time left = <span id="timer"></span></div>
            </div>
            <div class="down- d-flex justify-content-center my-4 ">
                <form method="get" class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off">
                    <input type="number" class="onenumber" id="digit-1" name="digit-1" data-next="digit-2" />
                    <input type="number" class="onenumber" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" />
                    <input type="number" class="onenumber" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" />
                    <span class="splitter">&ndash;</span>
                    <input type="number" class="onenumber" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" />
                    <input type="number" class="onenumber" id="digit-5" name="digit-5" data-next="digit-6" data-previous="digit-4" />
                    <input type="number" class="onenumber" id="digit-6" name="digit-6" data-previous="digit-5" />
                </form>
                <button type="resend_otp" class="btn main_btn"><i class="fas fa-sync"></i> Submit </button>
            </div>
            <div class="down- d-flex justify-content-center my-4 ">
                <button type="submit" class="btn main_btn">Submit <i class="fa fa-arrow-circle-right"></i></button>
            </div>
        </div>
    </div>
    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <script src="../plugins/anime.min.js"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <script src="forgetpasswordInput.js"></script>
    <script>
        anime({
            targets: '.down-1',
            translateY: 65,
            duration: 1750
        });
        anime({
            targets: '.down-2',
            translateY: 125,
            duration: 1750
        });
        anime({
            targets: '.down-3',
            translateY: 215,
            duration: 1750
        });
    </script>
    <!-- DO NOT DELETE THIS  -->
</body>

</html>