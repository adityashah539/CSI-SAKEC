<?php
require_once "../config.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    $repliedBy = $_POST['repliedBy'];
    $email = getSpecificValue("SELECT `c_email` FROM `csi_query` WHERE `id`='$id'","c_email");
    $query = getSpecificValue("SELECT `c_query` FROM `csi_query` WHERE `id`='$id'","c_query");
    execute("DELETE FROM `csi_query` WHERE `id`='$id'");
    $query ="INSERT INTO `csi_reply`( `c_email`, `c_query`, `reply_subject`, `reply_body`, `replied_by`) VALUES ('$email','$query','$subject','$body','$repliedBy')";
    if (execute($query)){
        $dataEntry = true;
    }else{
        $dataEntry = false;
    }
    $data = array("dataEntry" => $dataEntry);
    echo json_encode($data);
}
?>