    <!-- Footer -->
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
                        <h6 class="footer_title ">Contact Us</h6>
                        <p class="text-white">You can trust us. We only send promo offers, not a single spam.</p>
                        <div class="container">
                            <div class="row justify-content-center">
                                <textarea type="text" class="text-dark" name="message" placeholder="Message" onfocus="this.placeholder=''" onblur="this.placeholder='Message'" autocomplete="off" required></textarea>
                            </div>
                            <?php
                            if (!isset($_SESSION['role_id'])) {
                            ?>
                                <div id="googleButton" style="text-align: -webkit-center;" class="my-2">
                                    <div id="g_id_onload" data-client_id="<?php echo $google_client_id; ?>" data-context="use" data-ux_mode="popup" data-callback="getMailContactUs" data-auto_prompt="false"></div>
                                    <div class="g_id_signin" data-type="standard" data-shape="pill" data-theme="outline" data-text="continue_with" data-size="large" data-logo_alignment="left"></div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="row justify-content-center">
                                    <button class="btn sub-btn" name="contactUsButton">Send</button>
                                </div>
                            <?php
                            }
                            ?>
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
                            <li><a href="http://localhost/csi-sakec/newsletter.php">Newsletter</a></li>
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
    
    <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
        <div id="myToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000">
            <div class="toast-header">
                <img src="images\csi-logo.png" style="width: 50px;" class="rounded mr-2 img-thumbnail rounded-circle" alt="...">
                <strong class="mr-auto h4">Message</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body alert alert-primary h5">
            </div>
        </div>
    </div>
    <script>
        <?php if (isset($_SESSION['role_id'])) {
        ?>
            $(document).on("click", "button[name='contactUsButton']", function() {
                var email = "<?php echo $_SESSION['email']; ?>";
                sendEmail(email, "Login");
            });
        <?php
        } else {
        ?>
            function getMailContactUs(response) {
                var decodedToken = jwt_decode(response.credential);
                var email = decodedToken.email;
                sendEmail(email, "Google");
            }
        <?php
        }
        ?>
    </script>
    <!-- Footer  -->