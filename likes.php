<?php
session_start();
if (isset($_SESSION['email'])) {
    require_once "config.php";
    $event_id = $_POST['e_id'];
    $increment = $_POST['increment'];
    $email = $_SESSION['email'];
    $user_id = getSpecificValue("SELECT `id` FROM `csi_userdata` WHERE `emailID`='$email'", 'id');
    if($increment == 1){
        $row = getValue("SELECT COUNT(`id`) as `count` FROM `csi_event_likes` WHERE `event_id`='$event_id' AND `user_id`='$user_id'");
        if ($row['count']=="0"){
            $stmt = execute("INSERT INTO `csi_event_likes`( `event_id`, `user_id`) VALUES ('$event_id','$user_id')");
        }
    }else{
        $stmt = execute("DELETE FROM `csi_event_likes` WHERE `event_id`='$event_id' AND `user_id`='$user_id'");
    }
    $count = getSpecificValue("SELECT COUNT(user_id) as count FROM `csi_event_likes` where `event_id` = '$event_id'", 'count');
    if($increment == 0){
?>
        <button class="btn icon_btn" name = 'like' value="<?php echo $event_id;?>" ><i class="far fa-thumbs-up fa-2x"></i></button>
<?php
    }else {
?>
        <button class="btn icon_btn" name = 'unlike' value="<?php echo $event_id;?>" ><i class="fas fa-thumbs-up fa-2x"></i></button>  
<?php
    }
    echo $count;
}
?>
