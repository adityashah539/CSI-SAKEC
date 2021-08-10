<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/csi-logo.png">
    <title>newsletter</title>
</head>
<body>
    <?php
        require_once "config.php"; 
        $vkey=$_GET['vKey'];
        if(getNumRows("SELECT * FROM `csi_newsletter` WHERE vKey='$vkey' and status=0")==1){
            $query = execute("UPDATE `csi_newsletter` SET status =1 WHERE vKey='$vkey'");
        }else{
            function_alert("success");
        }
    ?>

</body>
</html>