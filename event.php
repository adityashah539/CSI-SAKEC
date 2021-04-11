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
    <link rel="stylesheet" href="css/event.css?v=<?php echo time(); ?>">
    <title>Event</title>
</head>

<body>
    <?php
    require_once "config.php";
    session_start();
    $id = $_GET['event_id'];
    $sql = "SELECT * FROM event WHERE id='$id'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="spacer" style="height:20px;"></div>
    <div class="container ">
        <h1>
            <?php echo $row['title']; ?>
            <?php 
                if($row['collaboration'] != "")echo "<h2>In collaboration with ".$row['collaboration']."</h2>"; ?>
        </h1>
        <div class="spacer" style="height:20px;"></div>
        <img class="main-img" src="<?php echo "Banner/" . trim($row['banner']); ?>" alt="no image">
        <div class="spacer" style="height:35px;"></div>
        <div class="event-header">
            <div class="spacer" style="height:20px;"></div>
            <h1> <?php echo $row['subtitle']; ?></h1>
            <h2>
                <span id="demo" style="color: rgb(145, 0, 0);">
                    8
                </span>
                <span style="color: rgb(120 134 5)s;">
                    Days
                    <span style="color: rgb(0, 99, 16);">
                        Go
                    </span>
            </h2>
            <h1><?php $row['subtitle']; ?></h1>
            <h4>
                <span style="color: #a10f95;">
                    21 September
                </span>
                2020,
                <span style="color: rgb(173, 173, 0);">
                    3 p.m
                </span>
                Onwads
            </h4>
            <div class="spacer" style="height:20px;"></div>
            <?php
            if (isset($_SESSION["email"])) {
                $email = $_SESSION["email"];
                $checkersql =
                    "SELECT `confirmed`  
                    FROM `collection`,`budget`,`userdata` 
                    WHERE `collection`.`budget_id`= `budget`.`id` 
                    AND   `collection`.`user_id`  = `userdata`.`id`
                    AND   `userdata`.`emailID`    = '$email'
                    AND   `budget`.`event_id`     = '$id'";
                $checker = mysqli_query($conn, $checkersql);
                $row1 = mysqli_fetch_assoc($checker);
                if (isset($row1["confirmed"])) {
                    if ($row1["confirmed"] == '1') {
            ?>
                        <button type="button" class="btn btn-success">Registered</button>
                    <?php
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
                        </form>
                    <?php
                    } else {
                    ?>
                        <form action="<?php echo "eventregistration.php"; ?>" method="POST">
                            <button type="submit" value="registraation" name="register_now" class="btn btn-primary">Register Now</button>
                            <input type="hidden" name="event_id" value="<?php echo $id; ?>" />
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
                <?php echo $row['e_description']; ?>
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
                        CSI Members – Rs.<?php echo $row['fee_m']; ?>
                        <br>
                        Non-CSI Members – Rs.<?php echo $row['fee']; ?>
                    </p>
                    <div class="spacer" style="height:50px;"></div>
                    <hr class="supp1">
                    <div class="spacer" style="height:50px;"></div>
                    <h3><b style="color: #729416;">For Any Queries </b><i class="fas fa-question-circle"></i></h3>
                    <br>
                    <div class="spacer" style="height:0px;"></div>
                    <p><b>Contact:</b>
                        <br>
                        <br>
                        <?php
                        $contact = "SELECT `c_name`,`c_phonenumber` FROM `contact` WHERE `event_id`='$id'";
                        $query_contact = mysqli_query($conn, $contact);
                        while ($row2 = mysqli_fetch_assoc($query_contact)) {
                            echo $row2['c_name'] . " - " . $row2['c_phonenumber'] . "<br>";
                        }
                        ?>
                    </p>
                </div>
            </div>
            <div class="col-sm-6">
                <?php
                if (isset($row['s_photo'])) {
                ?>
                    <div class="speakers">s
                        <h1>Speakers</h1>
                        <hr class="supp">
                        <br>
                        <!-- Card Regular -->
                        <div class="card card-cascade">
                            <!-- Card image -->
                            <div class="view view-cascade overlay">
                                <img class="card-img-top" src="Speaker_Image/<?php echo trim($row['s_photo']); ?>" alt="Card image cap">
                                <a>
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                            <!-- Card content -->
                            <div class="card-body card-body-cascade text-center">
                                <!-- Title -->
                                <h4 class="card-title"><strong><?php echo $row['s_name']; ?></strong></h4>
                                <!-- Subtitle -->
                                <h6 class="font-weight-bold indigo-text py-2"><?php echo $row['s_profession']; ?></h6>
                                <!-- Text -->
                                <p class="card-text">
                                    <?php echo $row['s_descripition']; ?>
                                </p>
                                <div class="social-sites">
                                    <a href=""><img class="social" src="images/instagram (1).png" alt="instagram"></a>
                                    <a href=""><img class="social" src="images/linkedin1.png" alt="linkedin"></a>
                                    <a href=""> <img class="social" src="images/facebook.png" alt="facebook"></a>
                                </div>
                            </div>sss
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php

    ?>
    <div class="spacer" style="height:90px;"></div>
    <div class="copyright">
        <div class="spacer" style="height:8px;"></div>
        <a href="#"><i class="fas fa-home"></i></a>
        <div class="spacer" style="height:10px;"></div>
        <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
        <div class="spacer" style="height:5px;"></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
    </script>
    
</body>

</html>