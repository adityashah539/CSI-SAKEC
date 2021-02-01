<?php
 require_once "config.php";
$id=$_POST['enable_id'];
$sql = "UPDATE event SET live='1' WHERE id='$id'";
 $query = mysqli_query($conn, $sql);
 mysqli_query($conn, $sql);
 header("location: eventmanagement.php");
?>