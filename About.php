<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" href="images/csi-logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/membership.css?v=<?php echo time(); ?>">
    <title> About Us</title>
</head>
<?php
require_once "config.php";
session_start();
// Fetching Access Details
$access = NULL;
if (isset($_SESSION["role_id"])) {
    $role_id = $_SESSION["role_id"];
    $access = getValue("SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id");
}
if (isset($access) && $access['main_page_edit'] == 0) {
    header("location:../index.php");
}
$row = getValue("SELECT * FROM `csi_aboutus`");
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    if (isset($access) && $access['main_page_edit'] == 1) {
        $description = $_POST['description'];
        $image = fileTransfer('img', "AboutUs");
        if ($image['error'] == NULL) {
            $file_new_name = $image['file_new_name'];
            execute("UPDATE `csi_aboutus` SET `photo`='$file_new_name'");
        }
        execute("UPDATE `csi_aboutus` SET `description`='$description' WHERE 1");
    }
    header("location:index.php");
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