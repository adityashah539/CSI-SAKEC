<?php
require_once "../config.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $gallery_id = $_POST['gallery_id'];
    $status = $_POST['status'];
    $sql = "UPDATE `csi_gallery` SET `status`='$status' WHERE `id`='$gallery_id'";
    $query = mysqli_query($conn, $sql);
    if($status==0){
?>
    <button name='enablePhoto' value='<?php echo $gallery_id; ?>' class='btn btn-primary'>Enable</button>
    <?php
    }else{
?>
    <button name='disablePhoto' value='<?php echo $gallery_id; ?>' class='btn btn-warning'>Disable</button>
<?php
    }
} 
?>