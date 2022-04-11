<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/csi-logo.png">
    <link rel="stylesheet" href="plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/membership.css?v=<?php echo time(); ?>">
    <title>Team members list</title>
</head>
<?php
require_once "config.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete_id_btn'])) {
    $user_id = $_POST['delete_user_id'];
    $query = execute("DELETE FROM `csi_coordinator` WHERE user_id=" . $user_id);
    $filename = $_POST['delete_file'];
    if (file_exists($filename)) {
        unlink($filename);
        function_alert('File has been deleted');
    } else {
        function_alert('Could not delete, file does not exist');
    }
}
// Update the image
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update_btn'])) {
    $user_id = $_POST['user_id'];
    $check = $_POST['check'];
    $image = fileTransfer('image', "Coordinator_Photo");
    if ($image['error'] == NULL) {
        $file_new_coordinatorimage = $image['file_new_name'];
        if ($check) {
            // updates image of existing user
            $stmt = execute("UPDATE `csi_coordinator` SET `image`= '$file_new_coordinatorimage' WHERE user_id=" . $user_id);
        } else {
            // inserts image of new user
            $stmt = execute("INSERT INTO `csi_coordinator`(`user_id`, `image`) VALUES ('$user_id','$file_new_coordinatorimage')");
        }
    } else {
        function_alert($image['error']);
    }
    header("Location: coordinator.php");
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update_btn'])) {
}
?>

<body>
    <?php
    //$sqlPreference = "SELECT COUNT(*) as count FROM `csi_coordinator`";
    //$queryPreference = mysqli_query($conn, $sqlPreference);
    $queryPreference =  execute("SELECT `id`,COUNT(*) as count FROM `csi_coordinator`");
    $rowPreference = mysqli_fetch_assoc($queryPreference);
    $count = $rowPreference['count'];
    $copy = $count;
    ?>
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
                    <th>PREFERENCE</th>
                    <th>EDIT IMAGE</th>
                    <th>DELETE IMAGE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $results = getAllValues("SELECT `cu`.`id`, `cu`.`name`, `cr`.`role_name`,`cc`.`image`,`cc`.`preference` FROM `csi_userdata` as `cu` LEFT JOIN `csi_coordinator`as `cc` ON `cu`.id = `cc`.`user_id` LEFT JOIN `csi_role` as `cr` ON `cu`.`role` = `cr`.`id` WHERE `cr`.`role_name` LIKE '%Coordinator%' || `cr`.`role_name` = 'General Secretary' || `cr`.`role_name` LIKE '%Team%' ORDER BY `cc`.`preference`;");
                $options_html = '';
                for ($i = 1; $i <= count($results); $i++){
                    $options_html .= '<option value="'.$i.'">'.$i.'</option>';
                }
                foreach($results as $result){
                ?>
                    <div class="table-content" style="font-size: large;">
                        <tr>
                            <th scope="row"><?php echo $result['name']; ?></th>
                            <td><?php echo $result['role_name']; ?></td>
                            <td>
                                <?php 
                                if(isset($result['image'])){
                                ?>
                                    <a target="_blank" href="Coordinator_Photo/<?php echo $result['image']; ?>">
                                        <img src="Coordinator_Photo/<?php echo $result['image']; ?>" alt="Forest" style="width:80px">
                                    </a>
                                <?php
                                }else {
                                    echo "No Image Uploaded.";
                                }
                                ?>
                            </td>
                            <td>
                                <h4>Current Preference:</h4>
                                <h5 id="showPreferrence<?php echo $result['id']; ?>"><?php echo $result['preference']; ?></h5>
                                <form action="">
                                    <label for="preferrence<?php echo $result['id']; ?>">Choose Preference:</label>
                                    <select id="preferrence<?php echo $result['id']; ?>"><?php echo $options_html;?> </select>
                                    <br><br>
                                    <button type="button" class="btn btn-primary" name="updatePreference" value="<?php echo $result['id']; ?>">Update</button>
                                </form>
                            </td>
                            <td>
                                <div id="<?php echo 'reply' . $result['id']; ?>">
                                    <button type="button" onClick="<?php echo 'addTextArea(' . $result['id'] . ');'; ?>" class="btn btn-primary">Change Image</button>
                                </div>
                                <div id="<?php echo 'textArea' . $result['id']; ?>">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                                        <input type="file" name="image" required>
                                        <br>
                                        <input type="hidden" name="user_id" value="<?php echo $result['id']; ?>">
                                        <input type="hidden" name="check" value="<?php echo (isset($result['image']) ? true : false); ?>">
                                        <button type="submit" class="btn btn-primary" name="update_btn">Update</button>
                                        <button type="button" onClick="<?php echo 'addTextArea(' . $result['id'] . ');'; ?>" class="btn btn-primary">Cancel</button>
                                    </form>
                                </div>
                                <script type=text/javascript>
                                    var t = document.getElementById("<?php echo 'textArea' . $result['id']; ?>");
                                    t.style.display = "none";
                                </script>
                            </td>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                <td>
                                    <input type='hidden' name='delete_user_id' value='<?php echo $result['id']; ?>'>
                                    <input type="hidden" name="delete_file" value="<?php echo (isset($result['image']) ? "Coordinator_Photo/" . $result['image'] : ""); ?>">
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
    <!-- DO NOT DELETE THIS  -->
    <script src="plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="plugins/jquery.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->
    <script type="text/javascript">
        function addTextArea(id) {
            var reply = "reply";
            var tA = "textArea";
            var combi = id;
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
    <script>
        $("button[name='updatePreference']").on("click", function() {
            console.log($(this).val());
            var id = $(this).val();
            var preferrenceValue = $("#preferrence" + id).val();
            $.ajax({
                url: "<?php echo $protocol.$domainName; ?>/api/updatePreferrence.php",
                type: "POST",
                data: {
                    "preferrenceId": id,
                    "preferrenceValue": preferrenceValue
                },
                dataType: 'JSON',
                success: function(response) {
                    var updated = response.updated;
                    var error = response.error;
                    if (error == null) {
                        if (updated) {
                            $('#showPreferrence' + id).html(preferrenceValue);
                        } else {
                            alert("Error in updating");
                        }
                    } else {
                        alert(error);
                    }
                }
            });
        });
    </script>
</body>

</html>