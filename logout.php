<?php
    session_start();
    $SESSION=array();
    session_destroy();
    setcookie('Email','',time()-86400);
    setcookie('Password','',time()-86400);
    header("location: index.php");
?>
