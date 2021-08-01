<?php
require_once "../config.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $gallery_id = $_POST['gallery_id'];
    $query = execute("DELETE FROM `csi_gallery` WHERE `id`='$gallery_id'");
    if ($query) {
?>
        <ol class="carousel-indicators">
            <?php
            $gallerysqlstmt = execute("SELECT * FROM `csi_gallery`");
            $number_of_images_gallery = mysqli_num_rows($gallerysqlstmt);
            for ($j = 0; $j < $number_of_images_gallery; $j++) {
            ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $j; ?>" <?php if ($j == 0) {echo 'class="active"';} ?>></li>
            <?php
            }
            ?>
        </ol>
        <div class="carousel-inner">
            <?php
            for ($i = 0; $i < $number_of_images_gallery; $i++) {
                $row = mysqli_fetch_assoc($gallerysqlstmt);
            ?>
                <div class="carousel-item <?php if ($i == 0) {echo "active";} ?>">
                    <img class="d-block w-100" src="<?php echo $row['image']; ?>" alt="no image">
                    <div class="carousel-caption d-none d-md-block">
                        <div id="photoStatus_<?php echo $row['id']; ?>" class="d-inline">
                            <?php
                            if ($row['status'] == 1) {
                            ?>
                                <button name='disablePhoto' value='<?php echo $row['id']; ?>' class='btn btn-warning'>Disable</button>
                            <?php
                            } else {
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
<?php
    }
}
?>