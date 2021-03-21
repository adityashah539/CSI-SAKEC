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

<body>

    <div class="container text-center">
        <div class="spacer" style="height:50px;"></div>
        <div id="user-login">
            <p class="login"><b>FORGET PASSWORD </b></br></br><i class="fas fa-user-circle" style="font-size:80px;"></i></p>
            </br>
            <form action=<?php echo htmlentities($_SERVER['PHP_SELF']); ?> method="post">

                <i class="fas fa-lock" style="font-size:30px;"></i>
                <input data-toggle="tooltip" data-placement="bottom" title=" type yuour new password" id="pass" type="password" class="g" name="password" required="required" placeholder=" Enter New password "></br>
                <i class="fa fa-key" style="font-size:30px;"></i>
                <input data-toggle="tooltip" data-placement="bottom" title="Should be same as above" id="pass" type="password" name="confrimpassword" class="g" placeholder=" Retype New Password" required /></br>
                <button type="submit" value="submit" class="btn btn-primary">
                    RESET
                    <i class="fas fa-sign-in-alt"></i>
                </button>
            </form>
            <?php
            require_once "config.php";
            session_start();
            if ($_SERVER['REQUEST_METHOD'] == "POST") {

                $password = trim($_POST["password"]);
                $confrimpassword = trim($_POST["confrimpassword"]);

                if ($password === $confrimpassword) {
                    //password encryption
                    //$pass = password_hash($password, PASSWORD_BCRYPT);
                    $var = $_SESSION['Pemail'];
                    $sql = "UPDATE `userdata` SET `password`='$password' WHERE emailID = '$var'";
                    $stmt = mysqli_query($conn, $sql);
                }
            }
            ?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
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