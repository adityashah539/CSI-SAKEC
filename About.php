<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/membership.css?v=<?php echo time(); ?>">
    <title> About Us</title>
</head>
<?php
require_once "config.php";
session_start();
$sqlselect = "SELECT * FROM `csi_aboutus`";
$query = mysqli_query($conn, $sqlselect);
$row = mysqli_fetch_assoc($query);
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'c') {
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
        $extensions = array('jpg', 'jpeg', 'png');
        $description = $_POST['description'];
        $image = $_FILES["img"]["name"];
        if ($image != null) {
            $file_ext_img = explode(".", $_FILES['img']["name"]);
            $file_ext_img = end($file_ext_img);
            if (in_array($file_ext_img, $extensions)) {
                $file_new_name = uniqid('', true) . "." . $file_ext_img;
                $folder_location = "AboutUs/";
                $sql = "UPDATE `csi_aboutus` SET `photo`='$file_new_name'";
                $stmt = mysqli_query($conn, $sql);
                /*if(file_exists($folder_location.$row['photo'])){
                    gc_collect_cycles();
                    unlink($folder_location.$row['photo']);
                }else{
                    echo "Some Error ".$folder_location.$row['photo'];
                }*/
                move_uploaded_file($_FILES["img"]["tmp_name"], $folder_location . $file_new_name);
                if ($_FILES["img"]["error"] != 0) {
                    $err =  $phpFileUploadErrors[$_FILES["img"]["error"]];
                }
            } else {
                function_alert("Extention of file should be jpg,jpeg,png.");
            }
        }
        $sql = "UPDATE `csi_aboutus` SET `description`='$description' WHERE 1";
        $stmt = mysqli_query($conn, $sql);
    } else {
        function_alert("You have to be admin or cooridinator");
    }
}
?>

<body>
    <header>
        <h2 style="text-align: center;">About US</h2>
    </header>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <div class="contaniner">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-5">
                        <label class="control-label">Banner Image:</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="file" name="img">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <label class="control-label">Description:</label>
                    </div>
                    <div class="col-sm-7">
                        <textarea rows="4" cols="50" name="description" class="form-control"><?php echo $row['description']; ?></textarea>
                    </div>
                </div>
                <div class="spacer" style="height:10px;"></div>
            </div>
        </div>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Sumbit</button>
        <div class="spacer" style="height:40px;"></div>
    </form>

    <div class="footer">
        <div class="spacer" style="height:2px;"></div>
        <a href="index.html"><i class="fas fa-home"></i></a>
        <div class="spacer" style="height:0px;"></div>
        <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
        <div class="spacer" style="height:1px;"></div>
    </div>
</body>

</html>