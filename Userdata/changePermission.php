<?php
    require_once "../config.php";
    $role_id=$_POST["role_id"];
    $value=$_POST["value"];
    $update=$_POST["update"];
    $sql = "UPDATE `csi_role` SET `$update`='$value' WHERE `id`='$role_id'";
    $query = mysqli_query($conn, $sql);
?>