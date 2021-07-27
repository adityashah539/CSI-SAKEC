<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    $sql = "SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id";
    $query =  mysqli_query($conn, $sql);
    $access = mysqli_fetch_assoc($query);
}

$email = $_SESSION['email'];

$sql_user_id = "SELECT id FROM csi_userdata where emailID = '$email'";
$query_user_id = mysqli_query($conn, $sql_user_id);
$row_user_id = mysqli_fetch_assoc($query_user_id);
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['like'])) {
    $event_id = $_POST['event_id'];
    $sql_add_like = "INSERT INTO `csi_event_likes`(`event_id`, `user_id`) VALUES ('$event_id',".$row_user_id['id'].")";
    $query_add_like = mysqli_query($conn, $sql_add_like);
} else if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['unlike'])){
    $event_id = $_POST['event_id'];
    $sql_remove_like = "DELETE FROM `csi_event_likes` WHERE user_id = ".$row_user_id['id']." and event_id = '$event_id'";
    $query_remove_like = mysqli_query($conn, $sql_remove_like);
}
?>

<body>

    <!-- navbar -->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
                <img class="invert" src="images/csi-logo.png" alt="SAKEC-icon">
                <a class="navbar-brand" href="#" style="color: aliceblue;"> CSI SAKEC</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll " style="height: auto;">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#team">Our Team</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#events">Events</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="#gallery">Gallery</a>
                        </li>
                        <?php
                        if (isset($_SESSION['email']) && isset($access)) {
                            if ($access['user_data'] == '1' || $access['role'] == '1') {
                        ?>
                                <li class="nav-item active">
                                    <a class="nav-link" href="Userdata/database.php">Userdata</a>
                                </li>
                            <?php
                            }
                            if (
                                $access['add_event'] == '1' || $access['budget'] == '1' || $access['edit_attendance'] == '1' || $access['permission_letter'] == '1' ||
                                $access['report'] == '1' ||$access['manage_event'] == '1' || $access['confirm_event_registration'] == '1' || $access['content_repository'] == '1' || $access['feedback_response'] == '1'
                            ) {
                            ?>
                                <li class="nav-item active">
                                    <a class="nav-link" href="Eventmanagement/eventmanagement.php">Event Management</a>
                                </li>
                            <?php
                            }
                            if ($access['query'] == '1' || $access['reply_log'] == '1') {
                            ?>
                                <li class="nav-item active">
                                    <a class="nav-link" href="Query/query.php">Query</a>
                                </li>
                            <?php
                            }
                            if ($access['audit']) {
                            ?>
                                <li class="nav-item active">
                                    <a class="nav-link" href="Audit/audit.php">Audit</a>
                                </li>
                            <?php
                            }
                            if ($access['confirm_membership']) {
                            ?>
                                <li class="nav-item active">
                                    <a class="nav-link" href="Membership/membership.php"> Membership</a>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                    <?php
                    if (isset($_SESSION['email'])) {
                    ?>
                        <a href="Login/logout.php" class="btn main_btn ">Logout</a>
                        <a href="edit_profile.php" class="btn main_btn ">Edit Profile</a>
                    <?php
                    } else {
                    ?>
                        <a href="Login/login.php" class="btn main_btn">Login</a>
                        <a href="Login/signup.php" class="btn main_btn">Sigup</a>
                    <?php
                    }
                    ?>
                </div>
            </nav>
        </div>
    </header>
    <!-- Navbar ends -->

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
                        $sqlevent = "SELECT * FROM `csi_event` WHERE `e_from_date`<'$currentdate'";
                        $queryevent = mysqli_query($conn, $sqlevent);
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
                                                            $sql_count_likes = "SELECT COUNT(user_id) as count FROM `csi_event_likes` where `event_id` = ".$rowevent['id'];
                                                            $query_count_likes = mysqli_query($conn, $sql_count_likes);
                                                            $row_count_likes = mysqli_fetch_assoc($query_count_likes);
                                                            $count = $row_count_likes['count'];
                                                            $sqlliked = "SELECT COUNT(`csi_event_likes`.`id`) as count FROM `csi_event_likes`, `csi_userdata` WHERE `emailID` = '$email' AND `user_id`= `csi_userdata`.`id` AND`event_id` = '$event_id'";
                                                            $queryliked = mysqli_query($conn, $sqlliked);
                                                            $liked = mysqli_fetch_assoc($queryliked);
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


    <!-- Footer -->
    <section id="contact">
        <footer class="footer-area p_120 p_60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single_footer_section tp_widgets">
                            <h6 class="footer_title">Page Links</h6>
                            <ul class="list">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Events</a></li>
                                <li><a href="#">Our Team</a></li>
                                <li><a href="#">Gallery</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-6">
                        <div class="single_footer_section tp_widgets">
                            <h6 class="footer_title">Contact Us</h6>
                            <p>You can trust us. we only send promo offers, not a single spam.</p>
                            <div class="guery">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="input-group d-flex flex-row">
                                        <?php
                                        if (isset($_SESSION['email']) && isset($_SESSION['role'])) {
                                            echo '<input type="hidden" name="email" value="' . $_SESSION['email'] . '">';
                                        } else {
                                            echo '<input type="email" name="emailentered" placeholder="Your Email" onfocus="this.placeholder=\'\'" onblur="this.placeholder=\'Email\'" autocomplete="off" required>';
                                        }
                                        echo '<textarea type="email" name="message" placeholder="Message" onfocus="this.placeholder=' . '" onblur="this.placeholder=\'Message\'" autocomplete="off" required></textarea>';
                                        ?>
                                        <!-- <input type="text" name="name" placeholder="Your Name" onfocus="this.placeholder=''" onblur="this.placeholder='Name'" autocomplete="off" required> -->
                                        <!-- <input type="email" name="email" placeholder="Your Email" onfocus="this.placeholder=''" onblur="this.placeholder='Email'" autocomplete="off" required> -->
                                        <!-- <textarea type="email" name="message" placeholder="Message" onfocus="this.placeholder=''" onblur="this.placeholder='Message'" autocomplete="off" required></textarea> -->
                                        <button class="btn sub-btn" name="contactusbutton">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 offset-lg-1">
                        <div class="single_footer_section tp_widgets">
                            <h6 class="footer_title">contact</h6>
                            <ul class="list">
                                <li><a href="#">Privacy policy</a></li>
                                <li><a href="#">Terms</a></li>
                                <li><a href="#">Membership</a></li>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#exampleModal">Newsletter</a>
                                </li>
                                <!-- Newsletter Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="email" name="name" placeholder="Your Email" onfocus="this.placeholder=''" onblur="this.placeholder='Email'" autocomplete="off" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn news-btn">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row footer-bottom d-flex justify-content-between align-items-center">
                    <p class="col-lg-8 col-md-8 footer-text m-0">
                        Copyright © <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template is made with ❤ by Israil
                    </p>
                    <div class="col-lg-4 col-md-4 footer-social">
                        <a href="">
                            <i class="fab fa-facebook-f"></i>
                        </a><a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    </section>

    <script src="plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="plugins/jquery.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
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
</body>

</html>