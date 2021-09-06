<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/csi-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
    <!-- linking for append images -->
    <link rel="stylesheet" href="../css/membership.css?v=<?php echo time(); ?>">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Upload Event Images</title>

    <?php
    require_once "../config.php";
    session_start();
    // Fetching Access Details
    $access = 0;
    if (isset($_SESSION["role_id"])) {
        $role_id = $_SESSION["role_id"];
        $access = getSpecificValue("SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id", 'content_repository');
    }
    if ($access == 0) {
        header("location:../index.php");
    }
    if (isset($_GET['event_id'])) {
        $id = $_GET['event_id'];
        $title = $_GET['event_title'];
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $index = 1;
        while (isset($_POST['uploadimg' . $index])) {
            $title = $_POST['eventtitle'];
            $id = $_POST['eventid'];
            $dir = str_replace(" ", "", $title . $id);
            $folder_name_event = "EventImages/" . $dir;
            if (!file_exists($folder_name_event)) {
                mkdir($folder_name_event);
                echo function_alert("You create directory successfully");
            }
            $image = fileTransfer("image" . $index, "EventImages/" . $dir);
            if ($image['error'] == NULL) {
                $file_new_event = $image['file_new_name'];
                execute("INSERT INTO `csi_contentrepository`(`eventid`, `image`) VALUES ('$id','$file_new_event')");
            } else {
                function_alert($image['error']);
            }
            $stmt =
                $index++;
        }
        if (isset($_POST['delete_id_btn'])) {
            $title = $_POST['eventtitle'];
            $id = $_POST['eventid'];
            $imgid = $_POST['delete_id'];
            $query = execute("DELETE FROM `csi_contentrepository` WHERE id=" . $imgid);
        }
    }
    ?>
</head>

<body>
    <header>
        <h2 style="text-align: center;">
            <h2>Upload images for <?php echo $title; ?></h2>
        </h2>
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark default-color sticky-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"><i class="fas fa-home"></i> Home</a>
                </li>

            </ul>

        </div>
    </nav>

    <div id=" carouselMultiItemExample" class="carousel slide carousel-dark text-center" data-mdb-ride="carousel">
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
        <div class="carousel-inner py-4" id='reload'>
            <!-- Single item -->

            <?php
            $sqlstmt = execute("SELECT * FROM `csi_contentrepository` where eventid = '$id'");
            $number_of_images = mysqli_num_rows($sqlstmt);
            for ($j = 0; $j < $number_of_images;) {

            ?>
                <div class="carousel-item <?php if ($j < 3) echo "active"; ?>">
                    <div class="container text-center">
                        <div class="row">
                            <?php
                            // to give extre space if two image are left
                            if ($number_of_images - $j == 2) echo "<div class='col-sm-2'></div>";
                            // to give extre space if one image if left
                            else if ($number_of_images - $j == 1) echo "<div class='col-sm-4'></div>";
                            for ($i = 0; $i < 3 && $j < $number_of_images; $i++, $j++) {
                                $row = mysqli_fetch_assoc($sqlstmt);
                            ?>
                                <div class="col-lg-4">
                                    <div class="card">
                                        <img src="<?php echo "EventImages/" . str_replace(" ", "", $title . $id) . '/' . $row['image']; ?>" class="card-img-top content-rep-img" alt="..." />
                                        <div class="card-body">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                <input type="hidden" name="eventtitle" value="<?php echo $title; ?>">
                                                <input type="hidden" name="eventid" value="<?php echo $id; ?>">
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
                <input type="hidden" name="eventtitle" value="<?php echo $title; ?>">
                <input type="hidden" name="eventid" value="<?php echo $id; ?>">
                <button class="btn btn-primary" name="insert" value="submit">Submit</button>
            </form>
        </div>
        <div class="spacer" style="height:60px;"></div>
        <div class="row footer-bottom d-flex justify-content-between align-items-center" style="background-color: black; padding:20px; color:white; bottom:0;">
            <p class="col-lg-8 col-md-8 footer-text m-0">
                Copyright © <script>
                    document.write(new Date().getFullYear());
                </script> All rights reserved by CSI-SAKEC
            </p>
            <div class="col-lg-4 col-md-4 footer-social">
                <a href="https://www.facebook.com/csisakec/photos"><i style="color:white; margin-left:5px" class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/csi.sakec/?utm_medium=copy_link"><i style="color:white; margin-left:5px;" class="fab fa-instagram"></i></a>
                <a href="https://twitter.com/sakectweets?lang=en"><i style="color:white; margin-left:5px;" class="fab fa-twitter"></i></a>
                <a href="https://www.youtube.com/c/SAKECYouTubeChannel"><i style="color:white; margin-left:5px;" class="fab fa-youtube"></i></a>
            </div>
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