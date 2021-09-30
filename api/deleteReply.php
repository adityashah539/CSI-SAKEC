<?php
require_once "../config.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $query = "DELETE FROM `csi_reply` WHERE `id`='$id'";
    if (execute($query)){
        $error=false;
    }else{
        $error=true;
    }
    
}else{
    $error = true;
}
$data = array("error" => $error);
echo json_encode($data);