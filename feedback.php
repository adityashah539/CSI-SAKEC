<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/csi-logo.png">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="css/changeuserdata.css?v=<?php echo time(); ?>">
    <title> Feedback</title>
</head>

<body>
    <!-- Navbar -->
    <?php require "usernavbar.php"; ?>
    <div style='height: 85px;'></div>
    <!-- Navbar -->
    <input type="hidden" id="e_id" value="<?php echo $_GET['e_id']; ?>">
    <div id='feedbackform'></div>
    <!-- DO NOT DELETE THIS  -->
    <script src="plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="plugins/jquery.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->
    <script>
        $(document).ready(function() {
            $("#feedbackform").load("feedbackstatus.php?e_id=" + $("#e_id").val());
        });
    </script>
    <!-- Footer -->
    <?php require_once 'footer.php'; ?>
    <!-- Footer -->
</body>