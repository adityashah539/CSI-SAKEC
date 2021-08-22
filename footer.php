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
                                    <div class="input-group d-flex flex-row justify-content-center">
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
                                                        $query = execute("SELECT * FROM `csi_newsletter` WHERE emailid='$nEmail'");
                                                        $row=mysqli_fetch_assoc($query);
                                                        $no_of_rows=mysqli_num_rows($query);
                                                        if($no_of_rows==1&&$row['status']==0){
                                                            $querye = execute("DELETE FROM `csi_newsletter` WHERE emailid='$nEmail'");
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
                                                                $stmt = execute("INSERT INTO `csi_newsletter`(`emailid`, `vKey`, `status`) VALUES ('$nEmail','$vkey','0')");
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
                        Copyright © <script>document.write(new Date().getFullYear());</script> All rights reserved by CSI-SAKEC
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
    <!-- Footer  -->