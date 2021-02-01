<?php
    require_once "config.php";
    $id=$_POST['disable_id'];
    $sql = "UPDATE event SET live='0' WHERE id='$id'";
    $query = mysqli_query($conn, $sql);
    mysqli_query($conn, $sql);
    header("location: eventmanagement.php");
?>