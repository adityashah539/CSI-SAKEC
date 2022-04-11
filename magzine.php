<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/csi-logo.png">
    <link rel="stylesheet" href="plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <title>CSI</title>
    <?php
    session_start();
    require_once "config.php";
    // Fetching Access Details
    $access = NULL;
    if (isset($_SESSION["role_id"])) {
        $role_id = $_SESSION["role_id"];
        $access = getValue("SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id");
    }
    ?>
</head>

<body>
    <!-- Navbar -->
    <?php require "usernavbar.php"; ?>
    <!-- Navbar -->

    <embed src="CACHE_V10.0.pdf" width="800px" height="2100px" />

    <!-- Javascript -->
    <script src="plugins/jquery.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="plugins/waypoints.min.js"></script>
    <script src="plugins/counterup.min.js"></script>
    <script src="plugins/smtp.min.js"></script>
    <script src="plugins/google.gsi.client.js" async defer></script>
    <script src="plugins/jwt-decode.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/email.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', "button[name='like']", function() {
                var event_id = $(this).val();
                var email =
                    <?php
                    if (isset($_SESSION['email'])) {
                        echo '"' . $_SESSION['email'] . '"';
                    } else {
                        echo "null";
                    }
                    ?>;
                if (email !== null) {
                    $("#likes_" + event_id).load("likes.php", {
                        e_id: event_id,
                        increment: 1
                    });
                }
            });
            $(document).on('click', "button[name='unlike']", function() {
                var event_id = $(this).val();
                var email =
                    <?php
                    if (isset($_SESSION['email'])) {
                        echo '"' . $_SESSION['email'] . '"';
                    } else {
                        echo "null";
                    }
                    ?>;
                if (email !== null) {
                    $("#likes_" + event_id).load("likes.php", {
                        e_id: event_id,
                        increment: 0
                    });
                }
            });
            $('.counter').counterUp({
                delay: 100,
                time: 1000
            });
        });


        ​
    </script>
    <!-- Javascript -->
    <!-- Footer -->
    <?php require_once 'footer.php'; ?>
    <!-- Footer -->
</body>

</html>