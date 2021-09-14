<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/csi-logo.png">
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="xyz.css?v=<?php echo time(); ?>">
    <title>Gallery</title>

    <?php
    require_once "../config.php";
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'coordinator' || $_SESSION['role'] == 'head coordinator') {
            // if(isset($_))
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
            $index = 1;
            while (isset($_POST['uploadimg' . $index])) {
                $gallery_photo = $_FILES["image" . $index]["name"];
                $file_ext_gallery = explode(".", $_FILES['image' . $index]["name"]);
                $file_ext_gallery = end($file_ext_gallery);
                if (in_array($file_ext_gallery, $extensions)) {
                    $folder_name_gallery = "Gallery_Images/";
                    $file_new_gallery = uniqid('', true) . "." . $file_ext_gallery;
                    $sql = "INSERT INTO `csi_gallery`(`image`, `status`) VALUES ('$file_new_gallery',1)";
                    $stmt = mysqli_query($conn, $sql);
                    move_uploaded_file($_FILES["image" . $index]["tmp_name"], $folder_name_gallery . $file_new_gallery);
                    if ($_FILES["image" . $index]["error"] != 0) {
                        $err =  $phpFileUploadErrors[$_FILES["image" . $index]["error"]];
                    }
                } else {
                    function_alert("Extention of file should be jpg,jpeg,png.");
                }
                $index++;
            }
            if (isset($_POST['enable_id_btn'])) {
                $id = $_POST['enable_id'];
                $sql = "UPDATE csi_gallery SET status=1 WHERE id=" . $id;
                $query = mysqli_query($conn, $sql);
            } else if (isset($_POST['disable_id_btn'])) {
                $id = $_POST['disable_id'];
                $sql = "UPDATE csi_gallery SET status=0 WHERE id=" . $id;
                $query = mysqli_query($conn, $sql);
            } else if (isset($_POST['delete_id_btn'])) {
                $id = $_POST['delete_id'];
                $sql = "DELETE FROM `csi_gallery` WHERE id=" . $id;
                $query = mysqli_query($conn, $sql);
                // Delete file from folder
                $filename = $_POST['delete_file'];
                if (file_exists($filename)) {
                    unlink($filename);
                    function_alert('File has been deleted');
                } else {
                    function_alert('Could not delete, file does not exist');
                }
            }
        } else {
            function_alert("You have to be admin or cooridinator");
        }
    }
    ?>
</head>

<body>
    <header>
        <h2 class="text-center">Edit Gallery </h2>
    </header>
    <div class="w-75 mx-auto">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
            <ol class="carousel-indicators">
            <?php
                $gallerysqlstmt = mysqli_query($conn,"SELECT * FROM `csi_gallery`");
                $number_of_images_gallery = mysqli_num_rows($gallerysqlstmt);
                for ($j = 0; $j < $number_of_images_gallery;$j++) {
            ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $j; ?>" <?php if($j==0){echo 'class="active"';} ?>></li>
            <?php
                }
            ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $number_of_images_gallery; ?>" <?php if($number_of_images_gallery==0){echo 'class="active"';} ?>></li>
            </ol>
            <div class="carousel-inner">  
            <?php
                for ($i = 0; $i < $number_of_images_gallery; $i++) {
                    $row = mysqli_fetch_assoc($gallerysqlstmt);
            ?>
                <div class="carousel-item <?php if($i==0){echo "active";} ?>">
                    <img class="d-block w-100" src="<?php echo $row['image']; ?>" alt="no image">
                    <div class="carousel-caption d-none d-md-block">
                        <div id="photoStatus_<?php echo $row['id']; ?>" class="d-inline">
                        <?php 
                        if($row['status']==1){
                        ?>
                            <button name='disablePhoto' value='<?php echo $row['id']; ?>' class='btn btn-warning'>Disable</button>
                        <?php
                        }else{
                        ?>
                            <button name='enablePhoto' value='<?php echo $row['id']; ?>' class='btn btn-primary'>Enable</button>
                        <?php
                        }
                        ?>
                        </div>
                        <button type='submit' name="deletePhoto" value='<?php echo $row['id']; ?>' class='btn btn-danger'>Delete</button>
                        
                    </div>
                </div>
            <?php
                }
            ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="spacer" style="height:20px;"></div>
    <h2 class="text-center">Add images in Gallery </h2>
    <div class="spacer" style="height:20px;"></div>
    <div class="container text-center">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <label class="form-label" for="customFile">Choose an image</label>
            <div class="form-group">
                <div class="input-group phone-input">
                    <input type="hidden" name="uploadimg1">
                    <input name="image1" type="file" class="form-control" id="customFile" required />
                </div>
            </div>
            <div class="spacer" style="height:20px;"></div>
            <button class="btn btn-primary btn-sm btn-add-phone">Add</button> <br> <br>
            <button class="btn btn-primary" name="insert" value="submit">Submit</button>
        </form>
    </div>
    <div class="spacer" style="height:40px;"></div>
    <!-- Footer -->
    <section id="contact">
        <footer class="footer-area p_60">
            <div class="container">
                <div class="text-center  footer-social"><a href="../index.php" class="text-white"><i class="fas fa-home"></i></a></div>
                <div class="row footer-bottom d-flex justify-content-between align-items-center">
                    <p class="col-lg-8 col-md-8 footer-text m-0">
                        Copyright © <script>document.write(new Date().getFullYear());</script> All rights reserved by CSI-SAKEC
                    </p>
                    <div class="col-lg-4 col-md-4 footer-social">
                        <a href="https://www.facebook.com/csisakec/photos"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/csi.sakec/?utm_medium=copy_link"><i class="fab fa-instagram"></i></a>
                        <a href="https://twitter.com/sakectweets?lang=en"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.youtube.com/c/SAKECYouTubeChannel"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    </section>
    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->
    <script src="../js/gallery.js"></script>
</body>

</html>