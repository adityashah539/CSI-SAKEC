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
    <!-- Navbar -->
    <?php require "../usernavbar.php"; ?>
    <!-- Navbar -->

    <header class="membership_header">
        <h2 class="text-center">Membership</h2>
    </header>
    <div id="membershipStatus"></div>
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
            $("#membershipStatus").load("membershipStatus.php");
            console.log("Status Loaded");
            $("#fillRequired").load("membershipInput.php");
            console.log("Input Loaded");
            $("#syear").on('change', function() {
                var val = parseInt($("#syear").children("option:selected").val());
                $("#eyear").val(val + 4);
            });
            $("form").on('submit', (function() {
                $.ajax({
                    url: "membershipsubmit.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#message").html('');
                    },
                    success: function(data) {
                        $("#message").html(data);
                        $("#registration").html('');
                    }
                });
            }));
        });
    </script>
    <script src="../js/script.js"></script>
</body>

</html>