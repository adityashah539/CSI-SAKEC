<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <link rel="stylesheet" href="css/login.css">
    <title>CSI-SAKEC</title>
</head>
<script>
    function validateEmail() {
        var email = document.getElementById("email").value;
        alert(email);
        // window.location.replace('fpotp.php')
        document.getElementById("user-login").style.display = "none";
        document.getElementById("errorMsg").style.display = "block";

        //  document.getElementById("user-login").style.display ="block";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert(this.responseText);
                // document.getElementById("user-login").style.display ="block";
            }
        };
        xhttp.open("POST", "new.php", true);
        xhttp.send("value");
        alert(xhttp.responseText);

    }
</script>

<body>

    <div class="container text-center">
        <div class="spacer" style="height:50px;"></div>
        <div>
            <p class="login"><b> ENTER OTP </b></br></br><i class="fas fa-user-circle" style="font-size:80px;"></i></p>
            </br>
            </br>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                <span id="otp">

                    <i class="far fa-user-circle" style="font-size:30px;"></i>
                    <input data-toggle="tooltip" data-placement="bottom" title="one time password (OTP)" id="OTP" type="number" class="g" name="userOTP" required="required" placeholder=" enter otp send on your mail "></br>
                    <button type="submit" value="submit" class="btn btn-primary">
                        submit otp
                    </button>
                </span>
                </br>
                </br>
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($_SESSION['OTP'] == $_POST['userOTP']) {
                    echo "otp match";
                    header("Location:newPassword.php");
                } else if (empty($name)) {
                    echo "Name is empty";
                } else {
                    echo "please enter correct otp";
                }
            }

            ?>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            //image height
            var winHeight = $(window).height();
            var winHeightImg = $(window).height() - 50;
            $('#user-login').css('height', winHeightImg);
        })
    </script>
</body>

</html>