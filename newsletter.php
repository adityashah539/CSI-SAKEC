<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>newsletter</title>
</head>
<body>
    <?php
        require_once "config.php"; 
        function function_alert($message)
        {
            echo
            "<SCRIPT>
                window.location.replace('index.php')
                alert('$message');
            </SCRIPT>";
        }
        $vkey=$_GET['vKey'];
        $sql = "SELECT * FROM `csi_newsletter` WHERE vKey='$vkey' and status=0";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query)==1){
            $sql = "UPDATE `csi_newsletter` SET status =1 WHERE vKey='$vkey'";
            $query = mysqli_query($conn, $sql);
        }
        else{
            function_alert("success");
        }
    ?>

</body>
</html>