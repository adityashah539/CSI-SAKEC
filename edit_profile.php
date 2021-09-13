<!DOCTYPE html>
<html lang="en">

<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/csi-logo.png">
    <link rel="stylesheet" href="plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/changeuserdata.css?v=<?php echo time(); ?>">
    <title> Edit Profile</title>
</head>

<body>
    <!-- Navbar -->
    <?php 
        require "config.php";
        session_start();
        require "usernavbar.php"; 
    ?>
    <div style='height: 85px;'></div>
    <!-- Navbar -->
    <header>
        <h2 class="text-center my-4">Edit profile</h2>
    </header>
    <div id = 'editdata'></div>
    
    <!-- Javascript -->
    <script src="plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="plugins/jquery.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <script src="plugins/smtp.min.js"></script>
    <script src="plugins/google.gsi.client.js" async defer></script>
    <script src="plugins/jwt-decode.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/email.js"></script>
    <script>
            $(document).ready(function (e) {
                $('#editdata').load('editprofilestatus.php');
            });
    </script>
    <!-- Footer -->
    <?php require_once 'footer.php';?>
    <!-- Footer -->
</body>
</html>