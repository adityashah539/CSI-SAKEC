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

    </style>
    <title>Gallery</title>
  </head>

  <body>
    <div class="spacer" style="height:10px;"></div>
    <div class="row text-center">
      <h2>GALLERY</h2>
    </div>

    <div class="spacer" style="height:20px;"></div>
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
              require_once "config.php";
              session_start();
              $gallerysql = "SELECT * FROM `gallery`";
              $gallerysqlstmt = mysqli_query($conn, $gallerysql);
              $number_of_images_gallery = mysqli_num_rows($gallerysqlstmt);
              for($j = 0; $j < $number_of_images_gallery;){
                if (($number_of_images_gallery - $j) % 3 == 2) {
                  $j += 2;
            ?>
                <div class="carousel-item active">
                 <div class="container">
                  <div class="row">
                    <div class="col-sm-2"></div>
            <?php
                  for($i = 0; $i < 2; $i++){
                    $row = mysqli_fetch_assoc($gallerysqlstmt)
            ?>
                      <div class="col-lg-4">
                        <div class="card">
                          <img src="images/<?php echo $row['image']; ?>" class="card-img-top" alt="..." />
                          <div class="card-body">
                            <a href="#!" class="btn btn-primary">Able / Disable</a>
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
                  }else if (($number_of_images_gallery - $j)%3 == 1){
                    $j++;
                    $row = mysqli_fetch_assoc($gallerysqlstmt)
            ?>
                <div class="carousel-item active">
                  <div class="container">
                    <div class="row">
                      <div class="col-sm-4"></div>
                      <div class="col-lg-4">
                        <div class="card">
                          <img src="images/<?php echo $row['image']; ?>" class="card-img-top" alt="..." />
                          <div class="card-body">
                            <a href="#!" class="btn btn-primary">Able / Disable</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <?php
                  }else{
                    $j += 3;
              ?>
                  <div class="carousel-item">
                    <div class="container">
                      <div class="row">
              <?php
                    for($i = 0; $i < 3; $i++){
                      $row = mysqli_fetch_assoc($gallerysqlstmt);
              ?>
                        <div class="col-lg-4">
                          <div class="card">
                            <img src="images/<?php echo $row['image']; ?>" class="card-img-top" alt="..." />
                            <div class="card-body">
                              <a href="#!" class="btn btn-primary">Able / Disable</a>
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
        <input name="getFile" type="file" class="form-control" id="customFile" />
        <div class="spacer" style="height:20px;"></div>
        <button class="btn btn-primary">Add</button>
      </form>
    </div>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>
  </body>

  </html>