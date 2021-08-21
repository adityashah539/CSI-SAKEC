<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/csi-logo.png">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="../css/changeuserdata.css?v=<?php echo time(); ?>">
    <title> Membership</title>
</head>

<body>
    <header>
        <h2 class="text-center">Membership</h2>
    </header>
    <div id="fillRequired"></div>
    <!-- Footer -->
    <?php require_once '../footer.php'; ?>
    <!-- Footer -->
    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->
    <script>
        //jquery for loading the fields for renewal and the Filling the details 
        $(document).ready(function() {
            $("#fillRequired").load("membershipInput.php");
        });
    </script>
</body>

</html>