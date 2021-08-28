<?php
    require_once "config.php";
    session_start();
    $id = trim($_POST["id"]);
    if(isset($_POST["name"])){
        $name = trim($_POST["name"]);
        $result = execute("UPDATE `csi_userdata` SET `name`='$name' WHERE id = $id");
    }
    
    if(isset($_POST["rollno"])){
        $rollno = trim($_POST["rollno"]);
        $result = execute("UPDATE `csi_userdata` SET `rollNo`='$rollno' WHERE id = $id");
    }
    
    if(isset($_POST["year"])){
        $year = trim($_POST["year"]);
        $result = execute("UPDATE `csi_userdata` SET `year`='$year' WHERE id = $id");
    }
    
    if(isset($_POST["division"])){
        $division = trim($_POST["division"]);
        $result = execute("UPDATE `csi_userdata` SET `division`='$division' WHERE id = $id");
    }
    
    if(isset($_POST["phone"])){
        $phone = trim($_POST["phone"]);
        $result = execute("UPDATE `csi_userdata` SET `phonenumber`='$phone' WHERE id = $id");
    }
    
    if(isset($_POST["branch"])){
        $branch = trim($_POST["branch"]);
        $result = execute("UPDATE `csi_userdata` SET `branch`='$branch' WHERE id = $id");
    }
    
    $part1 = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">';
    $part2 = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></div>';
    echo "$part1 Successfully Updated $part2";
?>