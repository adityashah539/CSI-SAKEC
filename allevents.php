<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" href="images/csi-logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/event.css?v=<?php echo time(); ?>">
    <title>All events</title>
</head>
<?php
session_start();
require_once "config.php";
// Fetching Access Details
$access = NULL;
if (isset($_SESSION["role_id"])) {
    $role_id = $_SESSION["role_id"];
    $access = getValue("SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id");
}

$email = $_SESSION['email'];

$row_user_id = getValue("SELECT id FROM csi_userdata where emailID = '$email'");
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['like'])) {
    $event_id = $_POST['event_id'];
    $query_add_like = execute("INSERT INTO `csi_event_likes`(`event_id`, `user_id`) VALUES ('$event_id',".$row_user_id['id'].")");
} else if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['unlike'])){
    $event_id = $_POST['event_id'];
    $query_remove_like = execute("DELETE FROM `csi_event_likes` WHERE user_id = ".$row_user_id['id']." and event_id = '$event_id'");
}
?>

<body>



    <!-- Navbar -->
    <?php require "usernavbar.php";?>
    <!-- Navbar -->

    

    <section id="events" class="p_120">
        <div class="container">
            <div class="event_schedule_inner">
                <div class="tab" style="text-align: center;">
                    <button class="tablinks">All Events</button>
                </div>
                <div id="London" class="tabcontent">
                    <div class="row">
                        <?php
                        // TODO: change $sqlevent according to requirement
                        $currentdate = date("Y-m-d");
                        $queryevent = execute("SELECT * FROM `csi_event` WHERE `e_from_date`<'$currentdate'");
                        if (mysqli_num_rows($queryevent) > 0) {
                            while ($rowevent = mysqli_fetch_assoc($queryevent)) {
                                if ($rowevent['live'] == 1) {
                                    $eventdate = date("d F Y", strtotime($rowevent['e_from_date']));
                        ?>
                                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                                        <div class="posts">
                                            <img src="<?php echo "Banner/" . trim($rowevent['banner']); ?>" alt="" class="img-fluid">
                                            <div class="blog-inner">
                                                <h2><a href="#"><?php echo $rowevent['title']; ?></a></h2>
                                                <div class="mh-blog-post-info">
                                                    <p>
                                                        <strong>Event on </strong>
                                                        <span class="event_date"><?php echo $eventdate; ?></span>
                                                    </p>
                                                </div>
                                                <p class="line-clamp">
                                                    <?php echo $rowevent['e_description']; ?>
                                                </pc>
                                                        <?php
                                                            $event_id = $rowevent['id'];
                                                            $count = getSpecificValue("SELECT COUNT(user_id) as count FROM `csi_event_likes` where `event_id` = ".$rowevent['id'], 'count');
                                                            $liked = getValue("SELECT COUNT(`csi_event_likes`.`id`) as count FROM `csi_event_likes`, `csi_userdata` WHERE `emailID` = '$email' AND `user_id`= `csi_userdata`.`id` AND`event_id` = '$event_id'");
                                                        ?>
                                                        <div class="likes" id="likes_<?php echo $event_id; ?>">
                                                        <?php
                                                            if($liked['count'] == 0){
                                                        ?>
                                                                <button class="btn icon_btn" name = "like" value="<?php echo $event_id;?>"><i class="far fa-thumbs-up fa-2x"></i></button>
                                                        <?php
                                                            }else {
                                                        ?>
                                                                <button class="btn icon_btn" name = "unlike" value="<?php echo $event_id;?>" ><i class="fas fa-thumbs-up fa-2x"></i></button>  
                                                        <?php
                                                            }
                                                        ?>
                                                        <?php echo $count;?> 
                                                    </div>
                                                <form action="event.php" method="GET">
                                                    <input type="hidden" name="event_id" value="<?php echo $rowevent['id']; ?>">
                                                    <button class="btn main_btn_read_more" type="submit">Read More</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="plugins/jquery.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <script src="plugins/smtp.min.js"></script>
    <script src="plugins/google.gsi.client.js" async defer></script>
    <script src="plugins/jwt-decode.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/email.js"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click', "button[name='like']", function() {
                var event_id = $(this).val();
                var email = 
                <?php 
                if (isset($_SESSION['email'])) {
                    echo '"' . $_SESSION['email'] . '"';
                } else {
                    echo "null";
                } 
                ?>;
                if (email !== null) {
                    $("#likes_" + event_id).load("likes.php", {
                        e_id: event_id,
                        increment: 1
                    });
                }
            });
            $(document).on('click', "button[name='unlike']", function() {
                var event_id = $(this).val();
                var email = 
                <?php 
                if (isset($_SESSION['email'])) {
                    echo '"' . $_SESSION['email'] . '"';
                } else {
                    echo "null";
                } 
                ?>;
                if (email !== null) {
                    $("#likes_" + event_id).load("likes.php", {
                        e_id: event_id,
                        increment: 0
                    });
                }
            });
        });
    </script>
    <!-- Footer -->
    <?php require_once 'footer.php';?>
    <!-- Footer -->
</body>

</html>