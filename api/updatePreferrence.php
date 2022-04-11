<?php
require_once "../config.php";
$updated = NULL;
$error = NULL;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
$registered = NULL;
    $preferrenceId = $_POST['preferrenceId'];
    $preferrenceValue = $_POST['preferrenceValue'];
    if (isset($preferrenceId) && isset($preferrenceValue)) {
            $sql = "UPDATE `csi_coordinator` SET `preference`='$preferrenceValue' WHERE `user_id`='$preferrenceId'";
            if (execute($sql)) {
                $updated = true;
            } else {
                $updated = false;
            }
    }else{
        $error = 'Insufficient Data.';
    }

}else {
    $error = 'Access Denied';
}
$data = array(
    "updated"=>$updated,
    "error"=>$error
);
echo json_encode($data);
