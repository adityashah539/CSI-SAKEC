  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
      integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
    <!-- linking for append images -->
     <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <title>Gallery</title>

    <?php 
        require_once "config.php";
        session_start();
        echo "before if";
        if (($_SERVER['REQUEST_METHOD']) == "POST" && ($_SESSION['var']==1)) {
          $_SESSION['var']=0;
          //if(isset($_POST['insert'])){
            // if($_SESSION['role']==='admin'||$_SESSION['role']==='c'){
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
                $index=1;
                while(isset($_POST['image'.$index]))
                {
                    $bill_photo = $_FILES["image".$index]["name"];
                    if(!$bill_photo){break;}
                    echo $bill_photo;
                    $file_ext_bill=explode(".", $_FILES['image'.$index]["name"]);
                    $file_ext_bill=end($file_ext_bill);
                    if (in_array($file_ext_bill,$extensions)){
                        $folder_name_bill="images/";
                        //$sql = "INSERT INTO `gallery`(`image`) VALUES ('$bill_photo')";
                        $sql="INSERT INTO `gallery`(`image`, `status`) VALUES ('$bill_photo','active')";
                        $stmt = mysqli_query($conn, $sql);
                        move_uploaded_file($_FILES["image".$index]["tmp_name"],$folder_name_bill.$bill_photo);
                        if($_FILES["image".$index]["error"]!=0){
                            $err =  $phpFileUploadErrors[$_FILES["bill".$index."photo"]["error"]];
                            break;
                        }
                    }else{
                        // function_alert("Extention of file should be jpg,jpeg,png.");
                    }
                    $index++;
                }
            // }else{
            //     function_alert("You have to be admin or cooridinator");
            // }
        //}
      }
      else {
        echo "not in if condition";
        echo isset($_POST['insert']);
      }
    ?> 
    <?php
      if ($_SERVER['REQUEST_METHOD'] == "POST"&&$_SESSION['var']=2){
        $_SESSION['var']=0;
        //if(isset($_POST['disable'])){
          $image=$_FILES["image".$index]["name"];
            $sql="UPDATE `gallery` SET `status`='inactive' WHERE `image`='$image'";
            $stmt = mysqli_query($conn, $sql);
        //}
      }
    ?>
  </head>

  <body style="background-image: linear-gradient(#ff9a9aa8, #ffffd66b);">
    <div class="spacer" style="height:30px;"></div>
    <div class="row text-center" style="background-color:#b1d7ff; padding:10px;">
      <h2>GALLERY</h2>
    </div>

    <div class="spacer" style="height:30px;"></div>
    <!-- Carousel wrapper -->
    <div id="carouselMultiItemExample" class="carousel slide carousel-dark text-center" data-mdb-ride="carousel">
      <!-- Controls -->
      <div class="d-flex justify-content-center mb-4">
        <button class="carousel-control-prev position-relative" type="button" data-mdb-target="#carouselMultiItemExample"
          data-mdb-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next position-relative" type="button" data-mdb-target="#carouselMultiItemExample"
          data-mdb-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <!-- Inner -->
      <div class="carousel-inner py-4">
        <!-- Single item -->
        
        <?php
                    $gallerysql = "SELECT * FROM `gallery` WHERE status = 'active'";
                    $gallerysqlstmt = mysqli_query($conn, $gallerysql);
                    $number_of_images_gallery = mysqli_num_rows($gallerysqlstmt);
                    $j = 0;
                    while($number_of_images_gallery - $j > 3){
                        
                  ?>
                      <div class="carousel-item">
                        <div class="container">
                          <div class="row">
                  <?php
                        for($i = 0; $i < 3; $i++, $j++){
                          $row = mysqli_fetch_assoc($gallerysqlstmt);
                  ?>
                            <div class="col-lg-4">
                              <div class="card">
                              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                                <img src="images/<?php echo $row['image']; ?>" class="card-img-top" alt="..." />
                                <div class="card-body">
                                  <button name = "disable<?php echo $j; ?>" class="btn btn-primary">Disable</a>
                                </div>
                              </form>
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
                    if ($number_of_images_gallery % 3 == 0) {
                  ?>
                    <div class="carousel-item active">
                      <div class="container">
                        <div class="row">
                  <?php
                        for($i = 0; $i < 3; $i++, $j++){
                          $row = mysqli_fetch_assoc($gallerysqlstmt);
                  ?>
                            <div class="col-lg-4">
                              <div class="card">
                              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                                <img name = "<?php echo $row['id'];?>" src="images/<?php echo $row['image']; ?>" class="card-img-top" alt="..." />
                                <div class="card-body">
                                  <button name = "disable<?php echo $j; ?>" class="btn btn-primary">Disable</a>
                                </div>
                              </form>
                              </div>
                            </div>
                  <?php
                        }
                  ?>
                          </div>
                        </div>
                      </div>
                  <?php
                    }else if ($number_of_images_gallery % 3 == 2) {
                  ?>
                      <div class="carousel-item active">
                        <div class="container">
                          <div class="row">
                            <div class="col-sm-2"></div>
                  <?php
                        for($i = 0; $i < 2; $i++, $j++){
                          $row = mysqli_fetch_assoc($gallerysqlstmt)
                  ?>
                             <div class="col-lg-4">
                              <div class="card">
                              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                                <img name = "<?php echo $row['id'];?>" src="images/<?php echo $row['image']; ?>" class="card-img-top" alt="..." />
                                <div class="card-body">
                                  <button name = "disable<?php echo $j; ?>" class="btn btn-primary">Disable</a>
                                </div>
                              </form>
                              </div>
                            </div>
                  <?php
                        }
                  ?>
                        </div>
                      </div>
                      </div>
                  <?php
                        }else if ($number_of_images_gallery % 3 == 1){
                          $row = mysqli_fetch_assoc($gallerysqlstmt)
                  ?>
                      <div class="carousel-item active">
                        <div class="container">
                          <div class="row">
                          <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                              <div class="card">
                              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                                <img name = "<?php echo $row['id'];?>" src="images/<?php echo $row['image']; ?>" class="card-img-top" alt="..." />
                                <div class="card-body">
                                  <button name = "disable<?php echo $j; ?>" class="btn btn-primary">Disable</a>
                                </div>
                              </form>
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
    <!-- Carousel wrapper -->
    <div class="spacer" style="height:20px;"></div>
    <h2 class="text-center">Add images in Gallery </h2>
    <div class="spacer" style="height:20px;"></div>
    <div class="container text-center">
      <form action="">
        <label class="form-label" for="customFile">Choose an image</label>
        <div class="form-group">
        <div class="input-group phone-input">
        <input name="getFile" type="file" class="form-control" id="customFile" />
              </div>
              </div>
        <div class="spacer" style="height:20px;"></div>
        <button class="btn btn-primary btn-sm btn-add-phone">Add</button> <br> <br>
        <button class="btn btn-primary">Submit</button>
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
            $(function () {
                $(document.body).on('click', '.changeType', function () {
                    $(this).closest('.phone-input').find('.type-text').text($(this).text());
                    $(this).closest('.phone-input').find('.type-input').val($(this).data('type-value'));
                });
                $(document.body).on('click', '.btn-remove-phone', function () {
                    $(this).closest('.deletephone').remove();
                });
                $('.btn-add-phone').click(function () {
                    var index = $('.phone-input').length + 1;
                    $('.form-group').append('' +
                    '<div class="deletephone">' +
                   ' <div class="spacer" style="height:20px;"></div>'+
                            '<div class="row">' +
                                
                                '<div class="col-sm-10">' +
                                    '<input name="getFile" type="file" class="form-control" id="customFile" required>' +
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