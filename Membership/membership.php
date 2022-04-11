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
    <?php
    session_start();
    require_once "../config.php";
    // Fetching Access Details
    $access = NULL;
    if (isset($_SESSION["role_id"])) {
        $role_id = $_SESSION["role_id"];
        $access = getValue("SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id");
    }
    else{
        header("location:".$protocol.$domainName."/".$folderName."/index.php");
    }
    ?>
</head>

<body>
    <!-- Navbar -->
    <?php require "../usernavbar.php"; ?>
    <div style='height: 85px;'></div>
    <!-- Navbar -->
    <main>
        <div id="membershipStatus"></div>
        <div id="fillRequired"></div>
    </main>
    
    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <script src="../plugins/smtp.min.js"></script>
    <script src="../plugins/google.gsi.client.js" async defer></script>
    <script src="../plugins/jwt-decode.min.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/email.js"></script>
    <!-- DO NOT DELETE THIS  -->
    <script>
        //jquery for loading the fields for renewal and the Filling the details 
        $("#membershipStatus").load("membershipStatus.php");
        $("#fillRequired").load("membershipInput.php");
        
        $(document).ready(function() {
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
    <!-- Footer -->
    <?php require_once '../footer.php'; ?>
    <!-- Footer -->
</body>

</html>