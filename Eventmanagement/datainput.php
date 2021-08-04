<?php 
    session_start();
    if(isset($_POST['input']))
        $_SESSION['input']= $_POST['input'];
    if(isset($_POST['event_id']))
        $_SESSION['event_id']= $_POST['event_id'];
    if(isset($_POST['membership']))
        $_SESSION['membership']= $_POST['membership'];
?>