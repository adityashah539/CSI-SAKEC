<?php
    session_start();
    $SESSION=array();
    session_destroy();
    setcookie('email','',time()-86400);
    setcookie('password','',time()-86400);
    header("location: ../index.php");
?>
