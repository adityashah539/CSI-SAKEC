<?php 
require_once "../config.php";
$email = $_POST['email'];
$msg = null;
if (doesEmailIdExists($email)){
    $msg = "YES";
}else{
    $msg = "NO";
}
$data = array("msg" => $msg);
echo json_encode($data);
?>