<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/csi-logo.png">
    <link rel="stylesheet" href="plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/membership.css?v=<?php echo time(); ?>">
    <title>Team members list</title>
</head>
<?php
    require_once "config.php";
    session_start();
    function function_alert($message){
        echo "  <SCRIPT>
                    alert('$message');
                </SCRIPT>";
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete_id_btn'])) {
        $user_id = $_POST['delete_user_id'];
        $sql = "DELETE FROM `csi_coordinator` WHERE user_id=".$user_id;
        $query = mysqli_query($conn, $sql);
        $filename = $_POST['delete_file'];
        if (file_exists($filename)) {
            unlink($filename);
            function_alert('File has been deleted');
        } else {
            function_alert('Could not delete, file does not exist');
        }
    }

    // Update the image
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update_btn'])){
        $user_id=$_POST['user_id'];
        if($_SESSION['role']==='admin'||$_SESSION['role']==='c'){
            $phpFileUploadErrors = array(
                0 => 'There is no error, the file uploaded with success',
                1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
                2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
                3 => 'The uploaded file was only partially uploaded',
                4 => 'No file was uploaded',
                6 => 'Missing a temorary folder',
                7 => 'Failed to write file to disk,', 
                8 => 'A PHP extension stopped the file upload.',
            ); 
            $extensions= array('jpg','jpeg','png');
            $image = $_FILES["image"]["name"];
            if($image!=null){
                $file_ext_img=explode(".", $_FILES['image']["name"]);
                $file_ext_img=end($file_ext_img);
                if (in_array($file_ext_img,$extensions)){
                    $check = $_POST['check'];
                    $folder_name_coordinatorImage="Coordinator_Images/";
                    $file_new_coordinatorimage = uniqid('',true).".".$file_ext_img;
                    if($check){
                        // updates image of existing user
                        $sql = "UPDATE `csi_coordinator` SET `image`= '$file_new_coordinatorimage' WHERE user_id=".$user_id;
                    } else {
                        // inserts image of new user
                        $sql = "INSERT INTO `csi_coordinator`(`user_id`, `image`) VALUES ('$user_id','$image')";
                    }
                    $stmt = mysqli_query($conn, $sql);
                    move_uploaded_file($_FILES["image"]["tmp_name"],$folder_name_coordinatorImage.$file_new_coordinatorimage);
                    if($_FILES["image"]["error"]!=0){
                        $err =  $phpFileUploadErrors[$_FILES["image"]["error"]];
                    }
                    header("Location: coordinator.php");
                }else{
                    function_alert("Extention of file should be jpg,jpeg,png.");
                }
            }
        }else{
            function_alert("You have to be admin or cooridinator");
        }
    }
    
?>
<body>
    <header>
        <h2 style="text-align: center;">Team Members List</h2>
</header>
    <!-- Members List -->
    <div class="members">
        <table class="table">
            <thead class="black white-text">
                <tr>
                    <th scope="col">NAME</th>
                    <th>DESIGNITION</th>
                    <th>IMAGE</th>
                    <th>EDIT IMAGE</th>
                    <th>DELETE IMAGE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT u.id as user_id, CONCAT(u.firstname,' ',u.lastname) as name, r.role_name as duty
                            FROM `csi_userdata` as u,`csi_role` as r
                            WHERE u.role = r.id and (r.role_name like '%Coordinator%' || r.role_name = 'General Secretary' || r.role_name like '%Team%')";
                    $result= mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)) {
                        $sqlimage = "SELECT image FROM `csi_coordinator` WHERE user_id = ".$row['user_id'];
                        $resultimage= mysqli_query($conn,$sqlimage);
                        $image_count = mysqli_num_rows($resultimage);
                ?>
                        <div class="table-content" style="font-size: large;">
                            <tr>
                                <th scope="row"><?php echo $row['name']; ?></th>
                                <td><?php echo $row['duty']; ?></td>
                                    <td>
                                        <?php
                                            if($image_count == 1){
                                                $rowimage = mysqli_fetch_array($resultimage);
                                        ?>
                                                <a target="_blank" href="Coordinator_Images/<?php echo $rowimage['image']; ?>">
                                                <img src="Coordinator_Images/<?php echo $rowimage['image']; ?>" alt="Forest" style="width:80px">
                                        <?php
                                            }
                                        ?>
                                        </a>
                                    </td>
                                    <td>
                                        <div id="<?php echo 'reply'.$row['user_id']; ?>">
                                            <button type="button" onClick="<?php echo 'addTextArea('.$row['user_id'].');'; ?>" class="btn btn-primary">Change Image</button>
                                        </div>
                                        <div id="<?php echo 'textArea'.$row['user_id'];?>">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                                                <input type="file" name="image" required>
                                                <br>
                                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                                <input type="hidden" name="check" value="<?php echo ($image_count == 1 ? true : false);?>">
                                                <button type="submit" class="btn btn-primary" name = "update_btn">Update</button>
                                                <button type="button" onClick="<?php echo 'addTextArea('.$row['user_id'].');'; ?>" class="btn btn-primary">Cancel</button>
                                            </form> 
                                        </div>
                                        <script type=text/javascript>
                                            var t = document.getElementById("<?php echo 'textArea'.$row['user_id']; ?>");
                                            t.style.display = "none";
                                        </script>
                                    </td>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                    <td> 
                                        <input type='hidden' name='delete_user_id' value='<?php echo $row['user_id']; ?>'>
                                        <input type="hidden" name="delete_file" value="<?php echo ($image_count == 1 ? "Coordinator_Images/".$rowimage['image'] : "");?>">
                                        <button type='submit' name="delete_id_btn" class='btn btn-danger'>DELETE IMAGE</button> 
                                    </td>
                                </form>
                            </tr>
                        </div>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <div class="spacer" style="height:30px;"></div>
    </div>
    <!-- Footer -->
    <div class="footer">
        <div class="spacer" style="height:2px;"></div>
        <a href="index.php"><i class="fas fa-home"></i></a>
        <div class="spacer" style="height:0px;"></div>
        <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
        <div class="spacer" style="height:1px;"></div>
    </div>
    <!-- Footer -->
    <script type="text/javascript">
        function addTextArea(id){
            var reply="reply";
            var tA="textArea";
            var combi=id;
            var x = document.getElementById(reply.concat(combi));
            var y = document.getElementById(tA.concat(combi));
            if (x.style.display === "none") {
                x.style.display = "block";
                y.style.display = "none";
            } else {
                x.style.display = "none";
                y.style.display = "block";
            }
        }
        
    </script>
    <!-- DO NOT DELETE THIS  -->
    <script src="plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="plugins/jquery.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->
</body>

</html>