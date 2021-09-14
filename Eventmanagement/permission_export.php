<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/csi-logo.png">
    <?php
		require_once "../config.php";
        session_start();
        // Fetching Access Details
        $access = NULL;
        if (isset($_SESSION["role_id"])) {
            $role_id = $_SESSION["role_id"];
            $access = getValue("SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id");
        }
        if(!isset($access) || $access['permission_letter']==0){
            header("location:../index.php");
        }
        if($_SERVER['REQUEST_METHOD'] === "GET"){
            if(isset($_GET['event_id'])){
                $event_id=$_GET['event_id'];
                $row = getValue("SELECT * FROM `csi_event` WHERE `id`=$event_id");
                $collaboration_row = getValue("SELECT `collab_body` FROM `csi_collaboration` WHERE `event_id`='$event_id'");

                // start year and end year for acedemic year
                $startyear = date("Y",strtotime($row['e_from_date'])); 
                $endyear = date("Y", strtotime("+1 year",strtotime($row['e_from_date'])));
                $acyear = $startyear.'-'.$endyear;
                if(date("Y-m-d") < date('Y-m-d', strtotime($startyear.'-07-01'))){
                    $endyear = $startyear;
                    $startyear = date("Y", strtotime("-1 year",strtotime($startyear)));
                    $acyear = $startyear.'-'.$endyear;
                }
                $startdate = date('Y-m-d', strtotime($startyear.'-07-01'));
                $enddate = $row['e_from_date'];
                $row_current_event_no = getValue("SELECT COUNT(id) as count
                                                    FROM `csi_event` 
                                                    WHERE '$startdate' <= e_from_date and e_from_date < '$enddate'");
                $current_event_no = $row_current_event_no['count'] + 1;
            } 
        }
        ?>
        <!-- Boostrap-4.6.0-->
        <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/permission.css?v=<?php echo time(); ?>">
        <script src="../plugins/jquery.min.js"></script>
        <script src="../plugins/FileSaver/FileSaver.min.js"></script>
        <script>
            if (typeof jQuery !== "undefined" && typeof saveAs !== "undefined") {
                (function($) {
                    $.fn.wordExport = function(fileName) {
                        fileName = typeof fileName !== 'undefined' ? fileName : "Permission Letter for <?php echo $row['title']?>";
                        var static = {
                            mhtml: {
                                top: "Mime-Version: 1.0\nContent-Base: " + location.href + "\nContent-Type: Multipart/related; boundary=\"NEXT.ITEM-BOUNDARY\";type=\"text/html\"\n\n--NEXT.ITEM-BOUNDARY\nContent-Type: text/html; charset=\"utf-8\"\nContent-Location: " + location.href + "\n\n<!DOCTYPE html>\n<html>\n_html_</html>",
                                head: "<head>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n<style>\n_styles_\n</style>\n</head>\n",
                                body: "<body>_body_</body>"
                            }
                        };
                        var options = {
                            maxWidth: 624
                        };
                        var markup = $(this).clone();
                        markup.each(function() {
                            var self = $(this);
                            if (self.is(':hidden'))
                                self.remove();
                        });
                        var images = Array();
                        var img = markup.find('img');
                        for (var i = 0; i < img.length; i++) {
                            // Calculate dimensions of output image
                            var w = Math.min(img[i].width, options.maxWidth);
                            var h = img[i].height * (w / img[i].width);
                            // Create canvas for converting image to data URL
                            var canvas = document.createElement("CANVAS");
                            canvas.width = w;
                            canvas.height = h;
                            // Draw image to canvas
                            var context = canvas.getContext('2d');
                            context.drawImage(img[i], 0, 0, w, h);
                            // Get data URL encoding of image
                            var uri = canvas.toDataURL("image/png");
                            $(img[i]).attr("src", img[i].src);
                            img[i].width = w;
                            img[i].height = h;
                            // Save encoded image to array
                            images[i] = {
                                type: uri.substring(uri.indexOf(":") + 1, uri.indexOf(";")),
                                encoding: uri.substring(uri.indexOf(";") + 1, uri.indexOf(",")),
                                location: $(img[i]).attr("src"),
                                data: uri.substring(uri.indexOf(",") + 1)
                            };
                        }
                        // Prepare bottom of mhtml file with image data
                        var mhtmlBottom = "\n";
                        for (var i = 0; i < images.length; i++) {
                            mhtmlBottom += "--NEXT.ITEM-BOUNDARY\n";
                            mhtmlBottom += "Content-Location: " + images[i].location + "\n";
                            mhtmlBottom += "Content-Type: " + images[i].type + "\n";
                            mhtmlBottom += "Content-Transfer-Encoding: " + images[i].encoding + "\n\n";
                            mhtmlBottom += images[i].data + "\n\n";
                        }
                        mhtmlBottom += "--NEXT.ITEM-BOUNDARY--";
                        //TODO: load css from included stylesheet
                        var styles = "";
                        // Aggregate parts of the file together
                        var fileContent = static.mhtml.top.replace("_html_", static.mhtml.head.replace("_styles_", styles) + static.mhtml.body.replace("_body_", markup.html())) + mhtmlBottom;
                        // Create a Blob with the file contents
                        var blob = new Blob([fileContent], {
                            type: "application/msword;charset=utf-8"
                        });
                        saveAs(blob, fileName + ".doc");
                    };
                })(jQuery);
            } else {
                if (typeof jQuery === "undefined") {
                    console.error("jQuery Word Export: missing dependency (jQuery)");
                }
                if (typeof saveAs === "undefined") {
                    console.error("jQuery Word Export: missing dependency (FileSaver.js)");
                }
            }
            jQuery(document).ready(function($) {
                $("a.word-export").click(function(event) {
                    $("#output").wordExport();
                });
            });
        </script>
    <title>Permission Letter</title>
</head>

<body>
    <header>
        <h2 style="text-align: center;">Permission Letter <?php echo $row['title']?></h2>
    </header>
    <div class="container">
        <div class="toolbar">
            <ul class="tool-list">
                <li class="tool">
                    <button type="button" data-command='justifyLeft' class="tool--btn">
                        <i class=' fas fa-align-left'></i>
                    </button>
                </li>
                <li class="tool">
                    <button type="button" data-command='justifyCenter' class="tool--btn">
                        <i class=' fas fa-align-center'></i>
                    </button>
                </li>
                <li class="tool">
                    <button type="button" data-command='justifyRight' class="tool--btn">
                        <i class=' fas fa-align-right'></i>
                    </button>
                </li>
                <li class="tool">
                    <button type="button" data-command="bold" class="tool--btn">
                        <i class=' fas fa-bold'></i>
                    </button>
                </li>
                <li class="tool">
                    <button type="button" data-command="italic" class="tool--btn">
                        <i class=' fas fa-italic'></i>
                    </button>
                </li>
                <li class="tool">
                    <button type="button" data-command="underline" class="tool--btn">
                        <i class=' fas fa-underline'></i>
                    </button>
                </li>
                <li class="tool">
                    <button type="button" data-command="insertOrderedList" class="tool--btn">
                        <i class=' fas fa-list-ol'></i>
                    </button>
                </li>
                <li class="tool">
                    <button type="button" data-command="insertUnorderedList" class="tool--btn">
                        <i class=' fas fa-list-ul'></i>
                    </button>
                </li>
                <li class="tool">
                    <button type="button" data-command="createlink" class="tool--btn">
                        <i class=' fas fa-link'></i>
                    </button>
                </li>
                <li class="tool">
                    <a class="word-export tool--btn btn btn-success"  href="javascript:void(0)" onclick="ExportToDoc()">
                    <i class="fas fa-file-export"></i>Export to Doc
                    </a>
                </li>
            </ul>
        </div>
        <div id="output" contenteditable="true">
            <div><img src = "data:image/jpg;base64,<?php echo base64_encode(file_get_contents("../images/CSI-header.jpg"));?>" alt = "No Image" style = "width:600px;"></div>
            <div>REF:-<?php echo substr($acyear,2,3).substr($acyear,7,2)."/$current_event_no".str_repeat("&nbsp; ",26);?> Date:- <?php echo date("d/m/Y",strtotime("now"))?></div>
            <div>To,<br></div>
            <div>The Principal,</div>
            <div>&nbsp;Shah &amp; Anchor Kutchhi Engineering College</div>
            <div>Chembur, Mumbai 400088<br></div>
            <div><br></div>
            <div>Subject: <u>Permission to conduct an event on <?php echo $row['subtitle'];?></u>.<br></div>
            <div><br></div>
            <div>Respected Sir,<br></div>
            <div><br></div>
            <div>CSI-SAKEC is organizing an event '<?php echo $row['subtitle'];?>’ 
                <?php
                    if(isset($row[$collaboration_row["collab_body"]])){
                        echo ",in collaboration with".$collaboration_row['collab_body'];
                        while(isset($collaboration_row )){
                            $collaboration_row = mysqli_fetch_assoc($collaboration_query);
                            echo ", ".$collaboration_row['collab_body'];
                        }
                    }
                ?> 
                on <?php if($row['e_from_date']==$row['e_to_date']) echo date("j F Y",strtotime($row['e_from_date'])); else echo date("j F Y",strtotime($row['e_from_date']))." to ".date("j F Y",strtotime($row['e_to_date']));?>. For the same, permission
                is required to access to <b>[requirements]</b> as well as social media publicity.
                Thus, kindly give us permission to access the above mentioned venue from <?php date("h:i A",strtotime($row['e_from_time']))." to ".date("h:i A",strtotime($row['e_from_time']))?> on <?php if($row['e_from_date']==$row['e_to_date']) echo date("j F Y",strtotime($row['e_from_date'])); else echo date("j F Y",strtotime($row['e_from_date']))." to ".date("j F Y",strtotime($row['e_to_date']));?>.
                Thanking You.<br></div>
            <div><br></div>
            <div>Yours sincerely,<br></div>
            <div>[Enter the Sign of General Secretary]<br></div>
            <div>[Enter the Name of General Secretary]<br></div>
            <div>General Secretary&nbsp;</div>
            <div>(CSI-SAKEC <?php echo substr($acyear,0,5).substr($acyear,7,2);?>)<br></div>
        </div>
    </div>
    
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
                            <p class="white">You can trust us. we only send promo offers, not a single spam.</p>
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
                        Copyright © <script>document.write(new Date().getFullYear());</script> All rights reserved || By CSI-SAKEC 
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

    <script>
        let output = document.getElementById('output');
        let buttons = document.getElementsByClassName('tool--btn');
        for (let btn of buttons) {
            btn.addEventListener('click', () => {
                let cmd = btn.dataset['command'];
                if (cmd === 'createlink') {
                    let url = prompt("Enter the link here: ", "http:\/\/");
                    document.execCommand(cmd, false, url);
                } else {
                    document.execCommand(cmd, false, null);
                }
            })
        }
    </script>
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
</body>

</html>