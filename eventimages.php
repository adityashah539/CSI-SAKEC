<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
    <!-- linking for append images -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Upload Event Images</title>

    <?php
    require_once "config.php";
    session_start();
    function function_alert($message){
        echo "<SCRIPT>
        alert('$message');
        </SCRIPT>";
    }
    if(isset($_POST['event'])){   
        $id = $_POST['event_id'];
        $title = $_POST['event_title'];
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
        // if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'coordinator'||$_SESSION['role'] == 'head coordinator'){
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
                $event_photo = $_FILES["image" . $index]["name"];
                $file_ext_event = explode(".", $_FILES['image' . $index]["name"]);
                $file_ext_event = end($file_ext_event);
                if (in_array($file_ext_event, $extensions)) {
                    $title = $_POST['eventtitle'];
                    $id = $_POST['eventid'];
                    $dir = str_replace(" ", "", $title.$id);
                    $folder_name_event = "EventImages/".$dir;
                    if(!file_exists($folder_name_event)){
                        mkdir($folder_name_event);
                        echo "<script>alert('You create directory successfully')</script>";
                    }
                    $file_new_event = uniqid('',true).".".$file_ext_event;
                    $sql = "INSERT INTO `contentrepository`(`eventid`, `image`) VALUES ('$id','$file_new_event')";
                    $stmt = mysqli_query($conn, $sql);
                    echo "<script>alert(".$folder_name_event.")</script>";
                    move_uploaded_file($_FILES["image" . $index]["tmp_name"], $folder_name_event .'/'. $file_new_event);
                    if ($_FILES["image" . $index]["error"] != 0) {
                        $err =  $phpFileUploadErrors[$_FILES["image" . $index]["error"]];
                    }
                } else {
                    function_alert("Extention of file should be jpg,jpeg,png.");
                }
                $index++;
            }
            if (isset($_POST['delete_id_btn'])) {
                $title = $_POST['eventtitle'];
                $id = $_POST['eventid'];
                $imgid = $_POST['delete_id'];
                $sql = "DELETE FROM `contentrepository` WHERE id=" . $imgid;
                $query = mysqli_query($conn, $sql);
            }
        // }else{
        //     function_alert("You have to be admin or cooridinator");
        // }
    }
    ?>
</head>

<body style="background-image: linear-gradient(#ff9a9aa8, #ffffd66b);">
    <div class="row text-center" style="background-color:#b1d7ff; padding:10px;">
        <h2>Upload Event Images</h2>
    </div>
    <div id="carouselMultiItemExample" class="carousel slide carousel-dark text-center" data-mdb-ride="carousel">
        <div class="d-flex justify-content-center mb-4">
            <button class="carousel-control-prev position-relative" type="button" data-mdb-target="#carouselMultiItemExample" data-mdb-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next position-relative" type="button" data-mdb-target="#carouselMultiItemExample" data-mdb-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- Inner -->
        <div class="carousel-inner py-4">
            <!-- Single item -->

            <?php
            $sql = "SELECT * FROM `contentrepository` where eventid = '$id'";
            $sqlstmt = mysqli_query($conn, $sql);
            $number_of_images = mysqli_num_rows($sqlstmt);
            $j = 0;
            while ($number_of_images - $j > 3) {

            ?>
                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <?php
                            for ($i = 0; $i < 3; $i++, $j++) {
                                $row = mysqli_fetch_assoc($sqlstmt);
                            ?>
                                <div class="col-lg-4">
                                    <div class="card">
                                        <img src="<?php echo "EventImages/".str_replace(" ", "", $title.$id).'/'.$row['image']; ?>" class="card-img-top" alt="..." />
                                        <div class="card-body">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                <input type="hidden" name="eventtitle" value = "<?php echo $title;?>">
                                                <input type="hidden" name="eventid" value = "<?php echo $id;?>">
                                                <input type='hidden' name='delete_id' value='<?php echo $row['id']; ?>'>
                                                <button type='submit' name="delete_id_btn" class='btn btn-danger'>DELETE</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

            <?php
            }
            if ($number_of_images % 3 == 0 && $number_of_images >= 3) {
            ?>
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row">
                            <?php
                            for ($i = 0; $i < 3; $i++, $j++) {
                                $row = mysqli_fetch_assoc($sqlstmt);
                            ?>
                                <div class="col-lg-4">
                                    <div class="card">
                                        <img src="<?php echo "EventImages/".str_replace(" ", "", $title.$id).'/'.$row['image']; ?>" class="card-img-top" alt="..." />
                                        <div class="card-body">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                <input type='hidden' name='delete_id' value='<?php echo $row['id']; ?>'>
                                                <input type="hidden" name="eventtitle" value = "<?php echo $title;?>">
                                                <input type="hidden" name="eventid" value = "<?php echo $id;?>">
                                                <button type='submit' name="delete_id_btn" class='btn btn-danger'>DELETE</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            } else if ($number_of_images % 3 == 2) {
            ?>
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <?php
                            for ($i = 0; $i < 2; $i++, $j++) {
                                $row = mysqli_fetch_assoc($sqlstmt)
                            ?>
                                <div class="col-lg-4">
                                    <div class="card">
                                        <img src="<?php echo "EventImages/".str_replace(" ", "", $title.$id).'/'.$row['image']; ?>" class="card-img-top" alt="..." />
                                        <div class="card-body">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                <input type='hidden' name='delete_id' value='<?php echo $row['id']; ?>'>
                                                <input type="hidden" name="eventtitle" value = "<?php echo $title;?>">
                                                <input type="hidden" name="eventid" value = "<?php echo $id;?>">
                                                <button type='submit' name="delete_id_btn" class='btn btn-danger'>DELETE</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            } else if ($number_of_images % 3 == 1) {
                $row = mysqli_fetch_assoc($sqlstmt)
            ?>
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <img src="<?php echo "EventImages/".str_replace(" ", "", $title.$id).'/'.$row['image']; ?>" class="card-img-top" alt="..." />
                                    <div class="card-body">
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <input type='hidden' name='delete_id' value='<?php echo $row['id']; ?>'>
                                            <input type="hidden" name="eventtitle" value = "<?php echo $title;?>">
                                            <input type="hidden" name="eventid" value = "<?php echo $id;?>">
                                            <button type='submit' name="delete_id_btn" class='btn btn-danger'>DELETE</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                $j++;
            }
            ?>
        </div>
        <div class="spacer" style="height:20px;"></div>
        <h2 class="text-center">Add images in Repository </h2>
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
                <input type="hidden" name="eventtitle" value = "<?php echo $title;?>">
                <input type="hidden" name="eventid" value = "<?php echo $id;?>">
                <button class="btn btn-primary" name="insert" value="submit">Submit</button>
            </form>
        </div>
        <div class="spacer" style="height:40px;"></div>
        <div class="footer" style="background-color:#b1d7ff;">
            <div class="spacer" style="height:2px;"></div>
            <a href="index.php"><i class="fas fa-home"></i></a>
            <div class="spacer" style="height:0px;"></div>
            <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
            <div class="spacer" style="height:1px;"></div>
        </div>
        <script>
            $(function() {
                $(document.body).on('click', '.changeType', function() {
                    $(this).closest('.phone-input').find('.type-text').text($(this).text());
                    $(this).closest('.phone-input').find('.type-input').val($(this).data('type-value'));
                });
                $(document.body).on('click', '.btn-remove-phone', function() {
                    $(this).closest('.deletephone').remove();
                });
                $('.btn-add-phone').click(function() {
                    var index = $('.phone-input').length + 1;
                    $('.form-group').append('' +
                        '<div class="deletephone">' +
                            '<div class="spacer" style="height:20px;"></div>' +
                                '<div class="row">' +
                                    '<div class="col-sm-10">' +
                                        '<div class="input-group phone-input">' +
                                            '<input type="hidden" name="uploadimg' + index + '" value="' + index + '">' +
                                            '<input name="image' + index + '" type="file" class="form-control" id="customFile" required>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="col-sm-2">' +
                                        '<span  class="input-group-btn">' +
                                            '<button class="btn btn-danger btn-remove-phone" type="button"><i class="fas fa-times"></i></button>' +
                                        '</span>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>'
                    );
                });
            });
        </script>
</body>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</html>