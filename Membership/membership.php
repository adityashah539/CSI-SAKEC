<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/csi-logo.png">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="../css/changeuserdata.css?v=<?php echo time(); ?>">
    <title> Membership</title>
    <?php
    require_once "../config.php";
    session_start();
    function function_alert($message)
    {
        echo "<SCRIPT>
            alert('$message');
            </SCRIPT>";
    }
    $email = $_SESSION['email'];
    $sqluserid= "SELECT `id` from `csi_userdata` where emailID = '$email'";
    $queryuserid= mysqli_query($conn, $sqluserid);
    $rows=mysqli_fetch_assoc($queryuserid);
    $userid=$rows['id'];
    $sql = "SELECT `id` ,`userid` FROM `csi_membership` WHERE userid = $userid";
    $query = mysqli_query($conn, $sql);
    $noOfRows=mysqli_num_rows($query);  
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
        $amount=$_POST['amount'];
        if($noOfRows==0){              
            $pemail=$_POST['pemail'];
            $regno=$_POST['registration_number'];
            $dob=$_POST['dob'];
            $syear=$_POST['syear'];
            $eyear=$_POST['eyear'];
            $sqlinsert="INSERT INTO `csi_membership`(`userid`, `dob`, `primaryEmail`, `startingYear`, `passingYear`, `r_number`)
                                            VALUES ('$userid','$dob','$pemail','$syear','$eyear','$regno')";
            $queryinsert = mysqli_query($conn, $sqlinsert);
        }
        $sqlmembershipid= "SELECT `id` from `csi_membership` where userid = '$userid'";
        $querymembershipid= mysqli_query($conn, $sqlmembershipid);
        $rows=mysqli_fetch_assoc($querymembershipid);
        $membership_id=$rows['id'];
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
         $extensions = array('jpg', 'jpeg', 'png');
        //INSERT INTO `membership`(`userid`, `membershipbill`, `smartcard`, `status`) VALUES ('[value-2]','[value-3]','[value-4]','[value-5]')
        // Insert Bill in folder
                    $bill_photo = $_FILES["billphoto"]["name"];
                    $file_ext_bill = explode(".", $_FILES['billphoto']["name"]);
                    $file_ext_bill = end($file_ext_bill);
                    if (in_array($file_ext_bill, $extensions)) {
                        $folder_name_bill = "Membership_Bill/";
                        $file_new_bill = uniqid('', true) . "." . $file_ext_bill;
                        move_uploaded_file($_FILES["billphoto"]["tmp_name"], $folder_name_bill . $file_new_bill);
                        if ($_FILES["billphoto"]["error"] != 0) {
                            $err =  $phpFileUploadErrors[$_FILES["billphoto"]["error"]];
                        }
                        else{
                            $sqlbill="INSERT INTO `csi_membership_bills`( `membership_id`, `bill_photo`, `amount`)
                                                                VALUES ('$membership_id','$file_new_bill','$amount')";
                            $querybill= mysqli_query($conn, $sqlbill);
                            function_alert("success");                            
                            header("location:../index.php");
                        }
                    } else {
                        function_alert("Extention of file should be jpg,jpeg,png." . $file_new_bill);
                    }
    }
    ?>
</head>

<body>
    <header>
    <h2 style="text-align: center;">Membership</h2>
    </header>
    <div class="spacer" style="height:50px;"></div>
    <div class="spacer" style="height:15px;"></div>
    <div class="registration">
        <div class="container">

            <h4>Student Membership Registration </h4>
            <p>Fill all the fields carefully</p>
            <hr>
            <div class="spacer" style="height:35px;"></div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <?php 
                    if($noOfRows==0){
                ?>
                <div class="spacer" style="height:35px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <label for="">Dob </label>
                    </div>
                    <div class="col-sm-7">
                        <input type="date" name= "dob"  required="required">
                    </div>
                </div>
                <div class="spacer" style="height:20px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <label for="">Primary Email </label>
                    </div>
                    <div class="col-sm-7">
                        <input type="email" name="pemail" required="required">
                    </div>
                </div>
                <div class="spacer" style="height:20px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <label for="">starting year </label>
                    </div>
                    <div class="col-sm-7">
                        <input type="number" name="syear" required="required">
                    </div>
                </div>
                <div class="spacer" style="height:20px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <label for="">Ending year </label>
                    </div>
                    <div class="col-sm-7">
                        <input type="number" name="eyear" required="required">
                    </div>
                </div>
                <div class="spacer" style="height:20px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="rnumber">College Registration Number :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="texts">
                            <input type="number" id="rnumber" name="registration_number" value="" required="required">
                            <small id="rnumberlHelp" class="form-text text-muted">As printed on your ID card</small>
                        </div>
                    </div>
                </div>
                <?php 
                    }
                ?>
                <div class="spacer" style="height:40px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <label class="control-label">Amount paid :</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="text" name="amount" required>
                    </div>
                </div>
                <div class="spacer" style="height:40px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <label class="control-label">Bill photo :</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="file" name="billphoto" required>
                    </div>
                </div>
                <div class="spacer" style="height:40px;"></div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 text-center">
                        <div class="register">
                            <button type="submit" name="submit" class="btn btn-primary">Submit Application</button>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="spacer" style="height:50px;"></div>
    <div class="spacer" style="height:50px;"></div>
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
    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->

</body>

</html>