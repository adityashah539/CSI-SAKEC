<!DOCTYPE html>
<html lang="en">

<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/csi-logo.png">
    <link rel="stylesheet" href="plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/changeuserdata.css?v=<?php echo time(); ?>">
    <title> Membership</title>
    <?php
    require_once "config.php";
    session_start();
    function function_alert($message){
        echo"<SCRIPT>
            window.location.replace('index.php')
            alert('$message');
        </SCRIPT>";
    }
    if(isset($_SESSION["email"])){
        $email = $_SESSION["email"];
        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
            $id = trim($_POST["id"]);
            $name = trim($_POST["name"]);
            $rollno = trim($_POST["rollno"]);
            $year = trim($_POST["year"]);
            $division = trim($_POST["division"]);
            $phone = trim($_POST["phone"]);
            $branch = trim($_POST["branch"]);
            $sqlupdate = "UPDATE `csi_userdata` SET `name`='$name',`year`='$year',`division`='$division',`rollNo`='$rollno',`phonenumber`='$phone',`branch`='$branch' WHERE id = $id";
            $result = mysqli_query($conn, $sqlupdate);
        }
        $sqlshowdata = "SELECT `id`, `name`, `year`, `division`, `rollNo`, `emailID`, `phonenumber`, `branch` FROM `csi_userdata` WHERE `emailID` = '$email'";
        $resulshowdata = mysqli_query($conn, $sqlshowdata);
        $rowshowdata = mysqli_fetch_assoc($resulshowdata);
    }else{
        function_alert("Login First");
    }
    ?>
</head>

<body>
    <header>
        <h2 style="text-align: center;">Edit Profile</h2>
    </header>
    <div class="spacer" style="height:46px;"></div>
    <div class="changedata">
        <div class="container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="id" value = "<?php echo $rowshowdata['id']; ?>">
                <div class="row justify-content-center">
                    <div class="col-sm-2">
                        <div class="labels">
                            <label for="fname">First Name :</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="texts">
                            <input type="text" id="fname" name="name" value = "<?php echo $rowshowdata['name']; ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-2">
                        <div class="labels">
                            <label for="year">Select Year :</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="texts">
                            <select id="year" name="year" required="required" class="custom-select mb-3">
                                <option value="FE"<?php if($rowshowdata['year'] == 'FE')echo "selected"; ?>>FE</option>
                                <option value="SE"<?php if($rowshowdata['year'] == 'SE')echo "selected"; ?>>SE</option>
                                <option value="TE"<?php if($rowshowdata['year'] == 'TE')echo "selected"; ?>>TE</option>
                                <option value="BE"<?php if($rowshowdata['year'] == 'BE')echo "selected"; ?>>BE</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-2">
                        <div class="labels">
                            <label for="division">Select Division :</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="texts">
                            <select id="division" name="division" required="required" class="custom-select mb-3" value="SE">
                                <option value="1" <?php if($rowshowdata['division'] == "1") echo "selected";  ?>>1</option>
                                <option value="2" <?php if($rowshowdata['division'] == "2") echo "selected";  ?>>2</option>
                                <option value="3" <?php if($rowshowdata['division'] == "3") echo "selected";  ?>>3</option>
                                <option value="4" <?php if($rowshowdata['division'] == "4") echo "selected";  ?>>4</option>
                                <option value="5" <?php if($rowshowdata['division'] == "5") echo "selected";  ?>>5</option>
                                <option value="6" <?php if($rowshowdata['division'] == "6") echo "selected";  ?>>6</option>
                                <option value="7" <?php if($rowshowdata['division'] == "7") echo "selected";  ?>>7</option>
                                <option value="8" <?php if($rowshowdata['division'] == "8") echo "selected";  ?>>8</option>
                                <option value="9" <?php if($rowshowdata['division'] == "9") echo "selected";  ?>>9</option>
                                <option value="10"<?php if($rowshowdata['division'] == "10") echo "selected"; ?>>10</option>
                                <option value="11"<?php if($rowshowdata['division'] == "11") echo "selected"; ?>>11</option>
                                <option value="12"<?php if($rowshowdata['division'] == "12") echo "selected"; ?>>12</option>
                                <option value="13"<?php if($rowshowdata['division'] == "13") echo "selected"; ?>>13</option>
                                <option value="14"<?php if($rowshowdata['division'] == "14") echo "selected"; ?>>14</option>
                                <option value="15"<?php if($rowshowdata['division'] == "15") echo "selected"; ?>>15</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-2">
                        <div class="labels">
                            <label for="rollno">Roll No :</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="texts">
                            <input type="number" id="rollno" name="rollno" value = "<?php echo $rowshowdata['rollNo']; ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-2">
                        <div class="labels">
                            <label for="phone">Phone number :</label>
                        </div>
                    </div>
                    <div class="col-sm-2 justify-content-center">
                        <div class="texts">
                            <input type="tel" id="phone" name="phone" value = "<?php echo $rowshowdata['phonenumber']; ?>" pattern="[1-9]{1}[0-9]{9}" required/>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-2">
                        <div class="labels">
                            <label for="branch">Select Branch :</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="texts">
                            <select id="branch" name="branch" required="required" class="custom-select mb-3">
                                <option value="CS"<?php if($rowshowdata['branch'] == "CS") echo "selected";  ?> >CS</option>
                                <option value="IT"<?php if($rowshowdata['branch'] == "IT") echo "selected";  ?> >IT</option>
                                <option value="Electronics"<?php if($rowshowdata['branch'] == "Electronics") echo "selected";?> > Electronics</option>
                                <option value="EXTC"<?php if($rowshowdata['branch'] == "EXTC") echo "selected";?>>EXTC</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" name = "submit" class="btn main_btn">Change</button>
            </form>
        </div>
    </div>
    <div class="spacer" style="height:100px;"></div>
        <!-- Footer -->
        <section id="contact">
        <footer class="footer-area  p_60">
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
                        <a href="https://www.facebook.com/csisakec/photos">
                            <i class="fab fa-facebook-f"></i>
                        </a><a href="https://www.instagram.com/csi.sakec/?utm_medium=copy_link"><i class="fab fa-instagram"></i></a>
                        <a href="https://twitter.com/sakectweets?lang=en"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.youtube.com/c/SAKECYouTubeChannel"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    </section>
    <!-- Footer Ends -->
    <!-- Javascript -->
    <script src="plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="plugins/jquery.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
</body>
</html>