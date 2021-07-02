<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/event.css?v=<?php echo time(); ?>">

    <title>Event</title>
</head>

<body>
    <?php
    require_once "config.php";
    session_start();
    $event_id = $_GET['event_id'];

    $sqlevent = "SELECT * FROM event WHERE id='$event_id'";
    $queryevent = mysqli_query($conn, $sqlevent);
    $rowevent = mysqli_fetch_assoc($queryevent);


    $sqlspeaker = "SELECT * FROM speaker WHERE event_id='$event_id'";
    $queryspeaker = mysqli_query($conn, $sqlspeaker);
    $number_of_speakers = mysqli_num_rows($queryspeaker);
    ?>


    <!-- navbar -->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light ">

                <img class="invert" src="images/PngItem_2981494.png" alt="SAKEC-icon">
                <a class="navbar-brand" href="#" style="color: aliceblue;"> CSI SAKEC</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php#events">Events</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php#team">Our Team</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php#gallery">Gallery</a>
                        </li>
                        <!-- <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                                    data-toggle="dropdown" aria-expanded="false">
                                    Membership
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link active" href="#contact">CONTACT</a>
                            </li>
                            -->
                        <?php
                        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                            $_SESSION['var'] = 0;
                        ?>
                            <li class="nav-item active">
                                <a class="nav-link" href="database.php">Userdata</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="eventmanagement.php">Event Management</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="query.php">Query</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="log.php">Reply Log</a>
                            </li>

                            <li class="nav-item active">

                                <a class="nav-link" href="audit.php">Audit</a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                    <?php
                    if (isset($_SESSION['email'])) {
                    ?>
                        <a href="logout.php" class="btn main_btn">Logout</a>
                    <?php
                    } else {
                    ?>
                        <a href="login.php" class="btn main_btn">Login</a>
                        <a href="signup.php" class="btn main_btn">Sigup</a>
                    <?php
                    }
                    ?>
                </div>

            </nav>
        </div>
    </header>



    <div class="spacer" style="height:150px;"></div>
    <div class="container ">
        <h1>
            <?php
            // Title of event
            echo $rowevent['title'];
            ?>
            <?php
            // collaboration of event
            $sqlcollaboration = "SELECT * FROM collaboration WHERE event_id='$event_id'";
            $querycollaboration = mysqli_query($conn, $sqlcollaboration);
            $collaboration = "";
            for ($i = mysqli_num_rows($querycollaboration); $i > 0; $i--) {
                $rowcollaboration = mysqli_fetch_assoc($querycollaboration);
                $collaboration = $collaboration . $rowcollaboration['collab_body'];
                if ($i != 1) $collaboration = $collaboration . ", ";
            }
            if (mysqli_num_rows($querycollaboration)) {
                echo "<h2>In collaboration with " . $collaboration . "</h2>";
            }
            ?>
        </h1>
        <div class="spacer" style="height:20px;"></div>
        <img class="main-img" src="<?php echo "Banner/" . trim($rowevent['banner']); ?>" alt="no image">
        <div class="spacer" style="height:35px;"></div>
        <div class="event-header">
            <div class="spacer" style="height:20px;"></div>
            <h1> <?php echo $rowevent['subtitle']; ?></h1>
            <h1><?php $rowevent['subtitle']; ?></h1>
            <h4>
                <?php
                if ($rowevent['e_from_date'] == $rowevent['e_to_date'])
                    echo "DATE :" . date("d-m-Y", strtotime($rowevent['e_from_date']));
                else
                    echo "FROM DATE :" . date("d-m-Y", strtotime($rowevent['e_from_date'])) . "<br> TO DATE :" . date("d-m-Y", strtotime($rowevent['e_to_date']));
                echo "<br>From Time :" . date("h:i:s A", strtotime($rowevent['e_from_time'])) . "<br> TO Time :" . date("h:i:s A", strtotime($rowevent['e_from_time']));
                ?>

            </h4>
            <div class="spacer" style="height:20px;"></div>
            <?php
            if (isset($_SESSION["email"])) {
                $email = $_SESSION["email"];
                $checkersql =
                    "SELECT `confirmed` 
                    FROM `collection`,`userdata` 
                    WHERE `collection`.`event_id`= '$event_id' AND `collection`.`user_id` = `userdata`.`id` AND `userdata`.`emailID` = '$email' ";
                $checker = mysqli_query($conn, $checkersql);
                $row1 = mysqli_fetch_assoc($checker);
                if (isset($row1["confirmed"])) {
                    if ($row1["confirmed"] == '1') {
            ?>
                        <button type="button" class="btn btn-success">Registered</button>
                        <?php 
                            if($rowevent['feedback']==1){                            
                        ?>
                        <form action="feedback.php" method="GET">
                            <br>
                            <input type="hidden" name="e_id"  value="<?php echo $rowevent['id']; ?>">
                            <button type="submit" class="btn btn-success">Feedback</button>
                        </form>
                    <?php
                            }
                    } else {
                    ?>
                        <button type="button" class="btn btn-info">Waiting for Confrimation</button>
                    <?php
                    }
                } else {
                    if ($_SESSION['role'] == "member" || $_SESSION['role'] == "coordinator" || $_SESSION['role'] == "head coordinator" || $_SESSION['role'] == "admin") {
                    ?>
                        <form action="<?php echo "eventregistration.php"; ?>" method="POST">
                            <button type="submit" name="register_now" class="btn btn-primary">Register Now</button>
                            <input type="hidden" name="event_id" value="<?php echo $id; ?>" />
                            <input type="hidden" name="fee" value="<?php echo $row['fee_m']; ?>" />
                        </form>
                    <?php
                    } else {
                    ?>
                        <form action="<?php echo "eventregistration.php"; ?>" method="POST">
                            <button type="submit" value="registration" name="register_now" class="btn btn-primary">Register Now</button>
                            <input type="hidden" name="event_id" value="<?php echo $id; ?>" />
                            <input type="hidden" name="fee" value="<?php echo $row['fee']; ?>" />
                        </form>
                <?php
                    }
                }
            } else {
                ?>
                <a href="login.php?notlogin=true"> <button type="button" class="btn btn-primary">Register Now</button></a>
            <?php
            }
            ?>
            <div class="spacer" style="height:20px;"></div>
        </div>
        <div class="spacer" style="height:40px;"></div>
        <div class="row">
            <div class="spacer" style="height:40px;"></div>
            <p class="description">
                <?php echo $rowevent['e_description']; ?>
            </p>
        </div>
        <div class="spacer" style="height:90px;"></div>
        <div class="row">
            <div class="col-sm-6">
                <div class="spacer" style="height:150px;"></div>
                <div class="know-more">
                    <h3><b style="color: #941616;">Registration Fees</b> <i class="fas fa-dollar-sign"></i></h3>
                    <div class="spacer" style="height:20px;"></div>
                    <p>
                        CSI Members – Rs.<?php echo $rowevent['fee_m']; ?>
                        <br>
                        Non-CSI Members – Rs.<?php echo $rowevent['fee']; ?>
                    </p>
                    <div class="spacer" style="height:50px;"></div>
                    <?php
                    if ($number_of_speakers > 0) {
                    ?>
                        <hr class="supp1">
                        <div class="spacer" style="height:50px;"></div>
                        <h3><b style="color: #729416;">For Any Queries </b><i class="fas fa-question-circle"></i></h3>
                        <br>
                        <div class="spacer" style="height:0px;"></div>
                        <p><b>Contact:</b>
                            <br>
                            <br>
                            <?php
                            // Event coordinators details
                            $contact = "SELECT `c_name`,`c_phonenumber` FROM `contact` WHERE `event_id`='$event_id'";
                            $query_contact = mysqli_query($conn, $contact);
                            while ($row2 = mysqli_fetch_assoc($query_contact)) {
                                echo $row2['c_name'] . " - " . $row2['c_phonenumber'] . "<br>";
                            }
                            ?>
                        </p>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="speakers">
                    <?php
                    if ($number_of_speakers > 0) {
                    ?>
                        <h1>Speakers</h1>
                        <hr class="supp">
                        <br>
                        <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php
                                for ($i = 0; $i < $number_of_speakers; $i++) {
                                ?>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" <?php if ($i == 0) echo 'class="active"'; ?>></li>
                                <?php
                                }
                                ?>
                            </ol>
                            <div class="carousel-inner">
                                <?php
                                for ($i = 0; $i < $number_of_speakers; $i++) {
                                    $rowspeaker = mysqli_fetch_assoc($queryspeaker);
                                ?>
                                    <div class="carousel-item<?php if ($i == 0) echo ' active'; ?>">

                                        <!-- Card Regular -->
                                        <div class="card card-cascade">
                                            <!-- Card image -->
                                            <div class="view view-cascade overlay">
                                                <img class="card-img-top" src="Speaker_Image/<?php echo trim($rowspeaker['photo']); ?>" alt="<?php echo trim($rowspeaker['photo']); ?>">
                                                <a>
                                                    <div class="mask rgba-white-slight"></div>
                                                </a>
                                            </div>
                                            <!-- Card content -->
                                            <div class="card-body card-body-cascade text-center">
                                                <!-- Title -->
                                                <h4 class="card-title"><strong><?php echo $rowspeaker['name']; ?></strong></h4>
                                                <!-- Subtitle -->
                                                <h6 class="font-weight-bold indigo-text py-2"><?php echo $rowspeaker['profession']; ?></h6>
                                                <!-- Text -->
                                                <p class="card-text">
                                                    <?php echo $rowspeaker['description']; ?>
                                                </p>
                                                <div class="social-sites">
                                                    <?php
                                                    if ($rowspeaker['linkedIn'] != "") {
                                                        echo "<a href=" . $rowspeaker['linkedIn'] . "><img class='social' src='images/linkedin1.png' alt='linkedin'></a>";
                                                    }
                                                    if ($rowspeaker['facebook'] != "") {
                                                        echo "<a href=" . $rowspeaker['facebook'] . "><img class='social' src='images/facebook.png' alt='facebook'></a>";
                                                    }
                                                    if ($rowspeaker['instagram'] != "") {
                                                        echo "<a href=" . $rowspeaker['instagram'] . "><img class='social' src='images/instagram (1).png' alt='instagram'></a>";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

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
                    <?php
                    } else {
                    ?>
                        <div class="spacer" style="height:150px;"></div>
                        <h3><b style="color: #729416;">For Any Queries </b><i class="fas fa-question-circle"></i></h3>
                        <br>
                        <div class="spacer" style="height:0px;"></div>
                        <p><b>Contact:</b>
                            <br>
                            <br>
                            <?php
                            // Event coordinators details
                            $contact = "SELECT `c_name`,`c_phonenumber` FROM `contact` WHERE `event_id`='$event_id'";
                            $query_contact = mysqli_query($conn, $contact);
                            while ($row2 = mysqli_fetch_assoc($query_contact)) {
                                echo $row2['c_name'] . " - " . $row2['c_phonenumber'] . "<br>";
                            }
                            ?>
                        </p>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php

    ?>
    <div class="spacer" style="height:90px;"></div>
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
    <script src="plugins/jquery-3.4.1.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>