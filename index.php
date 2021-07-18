<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <title>CSI</title>
    <?php
    session_start();
    require_once "config.php";
    function function_alert($message)
    {
        echo
        "<SCRIPT>
            window.location.replace('index.php')
            alert('$message');
        </SCRIPT>";
    }
    function send_mail($to_email, $subject, $body, $headers)
    {
        if (mail($to_email, $subject, $body, $headers)) {
            function_alert("Email successfully sent to $to_email...");
        } else {
            function_alert("$to_email, $subject, $body, $headers");
        }
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['contactusbutton'])) {
        if ($_POST['email'] != null) {
            $to_email = trim($_POST['email']);
        } else {
            $to_email = trim($_POST['emailentered']);
        }
        $subject = "Acknowledgement from CSI to " . substr($to_email, 0, strpos($to_email, ".")) . " " . substr($to_email, strpos($to_email, ".") + 1, strpos($to_email, "_") - strpos($to_email, ".") + 1);
        $body = "Hey Thankyou for contacting us this is to acknowledge you that we received your request and our coordinators will soon get in touch with you at the earliest possible , have a great day ";
        $headers = "From: guptavan96@gmail.com";
        $query = trim($_POST['message']);
        if (isset($to_email)) {
            send_mail($to_email, $subject, $body, $headers);
            if (strpos($to_email, "@sakec.ac.in") || strpos($to_email, "@gmail.com")) {
                $sql = "INSERT INTO csi_query (c_email,c_query) VALUES ('$to_email','$query')";
                $stmt = mysqli_query($conn, $sql);
                function_alert("Msg has been deliverd.");
            } else {
                function_alert("Pls enter the sakec's or your own emailid.");
            }
        } else {
            function_alert("Pls fill details properly.");
        }
    }
    ?>
</head>

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
                    <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll " style="height: auto;" >
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
                        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                            $_SESSION['var'] = 0;
                            ?>
                            <li class="nav-item active">
                                <a class="nav-link" href="Userdata/database.php">Userdata</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="Eventmanagement/eventmanagement.php">Event Management</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="Query/query.php">Query</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="Audit/audit.php">Audit</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="Membership/membership.php"> Membership</a>
                            </li>
                            <?php
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


    <!-- Landing -->
    <section class="home">
        <div class="container text-center">
            <div class="home-heading">
                <img src="images/logo.png" alt="" class="homelogo ">
                <h3>"Building Technical skills professionally"</h3>
                <!-- <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt beatae hic harum placeat
                    perferendis totam consectetur dolore alias</p> -->
            </div>
        </div>
    </section>
    <!-- Landing ends -->

    <?php
    $data;
    $sqlNextEvent = "SELECT `id`, `title`, `e_from_date`,  `e_from_time` FROM `csi_event` WHERE `live`='1'";
    $queryNextEvent = mysqli_query($conn, $sqlNextEvent);
    while ($rowNextEvent = mysqli_fetch_assoc($queryNextEvent)) {
        if ((date("Y-m-d", strtotime($rowNextEvent['e_from_date'])) > date("Y-m-d", strtotime("now"))) && (isset($data) ? (date("Y-m-d", strtotime($rowNextEvent['e_from_date'])) <= date("Y-m-d", strtotime($data['e_from_date']))) : true)) {
            $data = $rowNextEvent;
        } else if (date("Y-m-d", strtotime($rowNextEvent["e_from_date"])) == date("Y-m-d", strtotime("now"))) {
            if ((date("H:i:s", strtotime($rowNextEvent['e_from_time'])) > date("H:i:s", strtotime("now"))) && (isset($data) ? (date(" H:i:s", strtotime($rowNextEvent['e_from_time'])) < date(" H:i:s", strtotime($data['e_from_time']))) : true)) {
                $data = $rowNextEvent;
            }
        }
    }
    if (isset($data)) {
    ?>
        <!-- Event Timer -->
        <section class="event_time_area">
            <div class="container">
                <div class="event_time_inner">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="event_text">
                                <h3>Next Event will Start in</h3>
                                <p><?php echo $data['title']; ?></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="timer_inner">
                                <div id="timer" class="timer">
                                    <input type="hidden" id="next_event" value="<?php echo (date("M d, Y", strtotime($data['e_from_date']))) . (date(" H:i:s", strtotime($data['e_from_time']))); ?>">
                                    <div class="timer__section days">
                                        <div class="timer__number" id="days"></div>
                                        <div class="timer__label">days</div>
                                    </div>
                                    <div class="timer__section hours">
                                        <div class="timer__number" id="hours"></div>
                                        <div class="timer__label">hours</div>
                                    </div>
                                    <div class="timer__section minutes">
                                        <div class="timer__number" id="minutes"></div>
                                        <div class="timer__label">Minutes</div>
                                    </div>
                                    <div class="timer__section seconds">
                                        <div class="timer__number" id="seconds"></div>
                                        <div class="timer__label">seconds</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--event timer ends -->
    <?php
    }
    ?>


    <!-- about us  -->
    <section id="about" class="p_120">
        <div class="container">
            <div class="welcome row">
                <?php
                // query for image and description in about us section 
                $sqlaboutus = "SELECT * FROM `csi_aboutus`";
                $queryaboutus = mysqli_query($conn, $sqlaboutus);
                $rowaboutus = mysqli_fetch_assoc($queryaboutus);
                ?>
                <div class="col-lg-5">
                    <div class="about_img">
                        <img src="AboutUs/<?php echo $rowaboutus['photo']; ?>" alt="About US - Image" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="welcome_text">
                        <h3>Welcome to CSI SAKEC</h3>
                        <p><?php echo $rowaboutus['description']; ?></p>
                        <?php
                        if (isset($_SESSION['email'])) {
                        ?>
                            <a class="btn main_btn_welcome" href="About.php">Edit About US</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about ends -->

    <!-- Our Team  -->
    <section id="team" class="team_area p_120">
        <div class="container">
            <div class="main_title">
                <h2>OUR CSI SAKEC TEAM</h2>
                <?php
                if (isset($_SESSION['email'])) {
                ?>
                    <a class="btn main_btn_welcome" href="coordinator.php">Edit Team</a>
                <?php
                }
                ?>
            </div>
            <div class="spacer" style="height:45px;"></div>
            <?php
            $sqlcoordinator =  "SELECT CONCAT(u.firstname,' ',u.lastname) as name, r.role_name as duty, c.image as image
                                FROM `csi_coordinator` as c, `csi_userdata` as u,`csi_role` as r
                                WHERE c.user_id = u.id and u.role = r.id and (r.role_name like '%Coordinator%' || r.role_name = 'General Secretary' || r.role_name like '%Team%')";
            $querycoordinator = mysqli_query($conn, $sqlcoordinator);
            $number_of_coordinator = mysqli_num_rows($querycoordinator);
            // Will execute for no of coordinators
            while ($number_of_coordinator > 0) {
            ?>
                <div class="row team_inner">
                    <?php
                    // Will show 4 coordinators in same line for large
                    // TODO: change col-lg-3 and col-sm-6 if you need to change from 4 members in one row
                    for ($count = 0; $count < 4; $count++, $number_of_coordinator--) {
                        if ($number_of_coordinator == 0) {
                            break;
                        }
                        $rowcoordinator = mysqli_fetch_assoc($querycoordinator);
                    ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="team_item">
                                <div class="team_img"><img src="<?php echo "Coordinator_Images/" . trim($rowcoordinator['image']); ?>" alt=""></div>
                                <div class="team_name">
                                    <h4><?php echo $rowcoordinator['name']; ?></h4>
                                </div>
                                <p class="text-uppercase grey-text mb-3"><?php echo $rowcoordinator['duty']; ?></p>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="spacer" style="height:45px;"></div>
            <?php
            }
            ?>
        </div>
    </section>
    <!-- team ends -->

    <!-- Events -->
    <section id="events" class="p_120">
        <div class="container">
            <div class="main_title">
                <!-- <p>If you are looking at blank cassettes on the web, you may be very confused at the difference in
                    price. You may see some for as low as $.17 each.</p> -->
            </div>
            <div class="event_schedule_inner">
                <div class="tab" style="text-align: center;">
                    <button class="tablinks active" onclick="openCity(event, 'London')">Upcoming AND RECENT
                        events</button>

                </div>
                <div id="London" class="tabcontent" style="display:block;">
                    <div class="row ">
                        <?php
                        // This is for Upcoming AND Recent Events
                        // TODO: change $sqlevent according to your needs
                        date_default_timezone_set('Asia/Kolkata');
                        $currentdate = date("Y-m-d");
                        $sqlevent = "SELECT * FROM `csi_event` WHERE `e_from_date` >= '$currentdate' and live = 1";
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
                                                        <!-- <span class="event_date"> 24 </span>
                                                            <span class="event_date">April 2021</span> -->
                                                        <span class="event_date"><?php echo $eventdate; ?></span>
                                                    </p>
                                                </div>
                                                <p>
                                                    <?php echo $rowevent['e_description']; ?>
                                                </p>
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
            <div class="tab" style="text-align: center;">
                <a href="allevents.php" class="btn main_btn_welcome tablinks">All Events</a>
            </div>
        </div>
    </section>
    <!-- event ends -->

    <!-- gallery starts -->
    <section id="gallery" class="p_120">
        <div class="container">
            <div class="main_title">
                <h2>Gallery</h2>
                <!-- <p>If you are looking at blank cassettes on the web, you may be very confused at the difference in
                    price. You may see some for as low as $.17 each.</p> -->
                <?php
                if (isset($_SESSION['email'])) {
                ?>
                    <a class="btn main_btn_welcome" href="gallery.php">Edit Gallery</a>
                <?php
                }
                ?>
            </div>
            <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php
                    $sqlgallery = "SELECT `image` FROM `csi_gallery` WHERE `status`=1";
                    $querygallery = mysqli_query($conn, $sqlgallery);
                    $number_of_images_gallery = mysqli_num_rows($querygallery);
                    for ($i = 0; $i < $number_of_images_gallery; $i++) {
                    ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" <?php if ($i == 0) echo 'class="active"'; ?>></li>
                    <?php
                    }
                    ?>
                </ol>
                <div class="carousel-inner">
                    <?php
                    for ($i = 0; $i < $number_of_images_gallery; $i++) {
                        $rowgallery = mysqli_fetch_assoc($querygallery);
                    ?>
                        <div class="carousel-item<?php if ($i == 0) echo ' active'; ?>" <?php if ($i == 0) echo 'data-interval="10000"'; ?>>
                            <img src="Gallery_Images/<?php echo $rowgallery['image']; ?>" class="d-block w-100" alt="...">
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>
    <!-- gallery ends -->

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
                                <?php 

                                ?>
                            <?php
                            //    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['newsletter_email'])) {
                            //         if ($_POST['newsletter_email'] != null) {
                            //             $nEmail = trim($_POST['newsletter_email']);
                            //             $subject = "Acknowledgement from CSI to " . substr($to_email, 0, strpos($to_email, ".")) . " " . substr($to_email, strpos($to_email, ".") + 1, strpos($to_email, "_") - strpos($to_email, ".") + 1);
                            //             $body = "Hey Thankyou for contacting us this is to acknowledge you that we received your request and our coordinators will soon get in touch with you at the earliest possible , have a great day ";
                            //             $headers = "From: guptavan96@gmail.com";
                            //             send_mail($to_email, $subject, $body, $headers);

                            //         } else {
                            //         $to_email = trim($_POST['emailentered']);
                            //         }
                            //         $nEmail=$_POST['newsletter_email'];
                            //         $sql="INSERT INTO `newsletter`('email') VALUES('$nEmail')";
                            //         $stmt = mysqli_query($conn, $sql);
                            //         if($stmt){
                                       
                            //         }
                            //     }
                            ?>
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
                                            <?php
                                                if($_SERVER['REQUEST_METHOD'] == "POST"&&isset($_POST['newsletter_email'])){
                                                        $nEmail = $_POST['newsletter_email'];
                                                        //function_alert($nEmail);
                                                        //vkey=verification key
                                                        $vkey= md5(time().$nEmail);
                                                        $sql = "SELECT * FROM `csi_newsletter` WHERE emailid='$nEmail'";
                                                        $query = mysqli_query($conn, $sql);
                                                        $row=mysqli_fetch_assoc($query);
                                                        $no_of_rows=mysqli_num_rows($query);
                                                        if($no_of_rows==1&&$row['status']==0){
                                                            $sqle="DELETE FROM `csi_newsletter` WHERE emailid='$nEmail'";
                                                            $querye = mysqli_query($conn, $sqle);
                                                            $no_of_rows--;
                                                            function_alert($no_of_rows);
                                                        }
                                                        if($no_of_rows==0){
                                                            $subject = "Acknowledgement from CSI to " ;
                                                            $body = "<a href='http://localhost/CSI-SAKEC/newsletter.php?vKey=$vkey'>Register here</a>";
                                                            $headers = "From: guptavan96@gmail.com";
                                                            $headers.="MIME-VERSION: newsletter"."\r\n";
                                                            $headers.="Content-type:text/html;charset=UTF-8"."\r\n";
                                                            //send_mail($nEmail, $subject, $body, $headers);
                                                            if(mail($nEmail, $subject, $body, $headers)){                                                               
                                                                $sql = "INSERT INTO `csi_newsletter`(`emailid`, `vKey`, `status`) VALUES ('$nEmail','$vkey','0')";
                                                                $stmt = mysqli_query($conn, $sql);
                                                                function_alert("mail success");
                                                            }
                                                            else{
                                                                function_alert("mail sending failed");
                                                            }
                                                        }
                                                        else {
                                                            function_alert("email exists");
                                                        }                                                        
                                                    }
                                            ?>
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                <div class="modal-body">
                                                    <input type="email" name="newsletter_email" placeholder="Your Email" onfocus="this.placeholder=''" onblur="this.placeholder='Email'" autocomplete="off" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button name='sendotp' class="btn news-btn">Subscribe</button>
                                                </div>
                                            </form>
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
                        <a href="https://www.facebook.com/csisakec/photos"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/csi.sakec/?utm_medium=copy_link"><i class="fab fa-instagram"></i></a>
                        <a href="https://twitter.com/sakectweets?lang=en"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.youtube.com/c/SAKECYouTubeChannel"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

            </div>
        </footer>
    </section>
    <!-- footer ends -->

    <!-- ❤ ❤ ❤ ❤ ❤ ❤ ❤ 
Israil - +91 7977435942 for any kind of technical support
-->
    <script src="plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="plugins/jquery-3.4.1.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>