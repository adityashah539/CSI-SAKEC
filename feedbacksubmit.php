<?php
    require_once "config.php";
    session_start();
    //checking wheather user is registered
    
    $part1 = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">';
    $part2 = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></div>';
    $event_id=$_GET['e_id'];
    $email=$_POST['email'];
    $collection_id=$row['id'] = getSpecificValue("SELECT `id` FROM csi_collection WHERE event_id='$event_id' and user_id=(SELECT `id` FROM csi_userdata WHERE emailID='".$email."')", "id");
    $stmt = execute("INSERT INTO `csi_feedback`( `collection_id`,`Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `Q6`, `Q7`, `any_queries`) 
                    VALUES ('$collection_id','".$_POST['one']."','".$_POST['two']."','".$_POST['three']."','".$_POST['four']."','".$_POST['five']."','".$_POST['six']."','".$_POST['seven']."','".$_POST['query']."')");
    
    $selfie_img = mysqli_insert_id($conn);
    $flag = true;
    if (isset($_FILES['selfie'])) {
        $image = fileTransfer('selfie', 'Selfies');
        if($image['error'] == NULL){
            $file_new_selfie = $image['file_new_name'];
            execute("UPDATE `csi_feedback` SET `selfie`='$file_new_selfie' WHERE id='$selfie_img'");
        } else {
            function_alert($image['error']);
            $flag = false;
        }
    }
    if($flag)echo "$part1 Thank You for Filling the Feedback $part2";
?>