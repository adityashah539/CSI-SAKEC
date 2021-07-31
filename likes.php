<?php
session_start();
if (isset($_SESSION['email'])) {
    require_once "config.php";
    $event_id = $_POST['e_id'];
    $increment = $_POST['increment'];
    $email = $_SESSION['email'];
    $sql = "SELECT `id` FROM `csi_userdata` WHERE `emailID`='$email'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    $user_id = $row['id'];
    if($increment == 1){
        $sql = "SELECT COUNT(`id`) as `count` FROM `csi_event_likes` WHERE `event_id`='$event_id' AND `user_id`='$user_id'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
        if ($row['count']=="0"){
            $sql = "INSERT INTO `csi_event_likes`( `event_id`, `user_id`) VALUES ('$event_id','$user_id')";
            mysqli_query($conn, $sql);
        }
    }else{
        $sql = "DELETE FROM `csi_event_likes` WHERE `event_id`='$event_id' AND `user_id`='$user_id'";
        mysqli_query($conn, $sql);
    }
    $sql_count_likes = "SELECT COUNT(user_id) as count FROM `csi_event_likes` where `event_id` = '$event_id'";
    $query_count_likes = mysqli_query($conn, $sql_count_likes);
    $row_count_likes = mysqli_fetch_assoc($query_count_likes);
    $count = $row_count_likes['count'];
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
