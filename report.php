<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/permission.css?v=<?php echo time(); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.min.js"></script>
    <script>
        if (typeof jQuery !== "undefined" && typeof saveAs !== "undefined") {
            (function($) {
                $.fn.wordExport = function(fileName) {
                    fileName = typeof fileName !== 'undefined' ? fileName : "jQuery-Word-Export";
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
                $("#MainHTML").wordExport();
            });
        });
    </script>
    <?php
        require_once 'config.php';
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['event_id'])) {
            $event_id = $_GET['event_id'];
            $sqlevent = "SELECT * FROM `event` WHERE `id`=$event_id";
            $queryevent = mysqli_query($conn, $sqlevent);
            $rowevent = mysqli_fetch_assoc($queryevent);

            // Event collaboration details
            $sqlcollaboration = "SELECT * FROM collaboration WHERE event_id='$event_id'";
            $querycollaboration = mysqli_query($conn, $sqlcollaboration);
            //$rowcollaboration = mysqli_fetch_assoc($querycollaboration);

            // Event Speaker details
            $sqlspeaker = "SELECT * FROM speaker WHERE event_id='$event_id'";
            $queryspeaker = mysqli_query($conn, $sqlspeaker);

            // Event coordinators details
            $sqlcoordinator = "SELECT `c_name`,`c_phonenumber`, `c_type` FROM `contact` WHERE `event_id`='$event_id'";
            $querycoordinator = mysqli_query($conn, $sqlcoordinator);

            // Event venue details
            $sqlvenue = "SELECT `location` FROM `venue` WHERE event_id = '$event_id'";
            $queryvenue = mysqli_query($conn, $sqlvenue);
            }
        }
    ?>
    <title>Document</title>

</head>

<body>
    <div class="container">
        <div class="spacer" style="height: 50px;"></div>
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
        <div id="MainHTML">
            <div id="output" contenteditable="true">
                <div>
                    <div id = "date" style = "text-align:right;">
                        <?php
                            echo date("jS  F Y",strtotime($rowevent['e_to_date']));
                        ?>
                    </div>
                    <h2 id="eventreportheader"style = "text-align:center;"> <u> EVENT REPORT </u></h2>
                    <div id="eventname">
                        <b>Event Name:</b> 
                        <?php echo $rowevent['title']; ?>
                    </div>
                    <div id="organizedby">
                        <b>Organized By:</b> CSI-SAKEC
                        <?php
                            $collaboration = "";
                            for($i = mysqli_num_rows($querycollaboration); $i > 0; $i--){
                                $rowcollaboration = mysqli_fetch_assoc($querycollaboration);
                                $collaboration = $collaboration.$rowcollaboration['collab_body'];
                                if($i != 1)$collaboration = $collaboration.", ";
                            }
                            if(mysqli_num_rows($querycollaboration)){
                                echo " in collaboration with ".$collaboration."</h2>";
                            }
                        ?>
                    </div>
                    <div id="dateandtime"><b>Date & time:</b>
                     <!-- 30th-31st August & 11th September, 2019, 10:00 AM to 5:00 PM  -->
                    <?php
                        if($rowevent['e_from_date'] == $rowevent['e_to_date'])
                            echo date("jS  F Y",strtotime($rowevent['e_from_date'])).",".date(" h:i A",strtotime($rowevent['e_from_time']))." to ".date("h:i A",strtotime($rowevent['e_to_time']));
                        else
                            echo date("jS F Y",strtotime($rowevent['e_from_date']))."-".date("jS F Y",strtotime($rowevent['e_to_date'])).",".date(" h:i A",strtotime($rowevent['e_from_time']))." to ".date("h:i A",strtotime($rowevent['e_to_time']))
                    ?>
                    </div>
                    <div id="venue">
                        <?php
                            $venue = "";
                            for($i = mysqli_num_rows($queryvenue); $i > 0; $i--){
                                $rowvenue = mysqli_fetch_assoc($queryvenue);
                                $venue = $venue.$rowvenue['location'];
                                if($i != 1)$venue = $venue.", ";
                            }
                            if(mysqli_num_rows($querycollaboration)){
                                echo "<b>Venue:</b> ".$venue;
                            }
                        ?>
                    </div>
                    <?php
                        $studentcoordinators = "";
                        $staffcoordinators = "";
                        while ($rowcoordinator = mysqli_fetch_assoc($querycoordinator)) {
                            if($rowcoordinator['c_type'] == 0) $studentcoordinators = $studentcoordinators . $rowcoordinator['c_name'] . " (No." . $rowcoordinator['c_phonenumber'] . ")<br>";
                            else  $staffcoordinators = $staffcoordinators . $rowcoordinator['c_name'] . " (No." . $rowcoordinator['c_phonenumber'] . ")<br>";
                        }
                    ?>
                    <div id="staffcoordinator">
                        <?php 
                            if($staffcoordinators != "")
                                echo "<b>Staff Coordinator:</b> ".$staffcoordinators;
                        ?>
                    </div>
                    <div id="studentcoordinator">
                        <?php 
                            if($studentcoordinators != "")
                                echo "<b>Student Coordinator:</b> ".$studentcoordinators;
                        ?>
                    </div>
                    <div class="description">
                        <b>Description:</b>  
                        <?php echo $rowevent['e_description']; ?>
                        <br>
                    </div>
                    <div id="sincerely" style = "text-align:right;">
                        Sincerely,<br>
                        <b>CSI-SAKEC 
                        <?php
                            echo date("Y-",strtotime("-1 years")).date("y",strtotime("now")); 
                        ?>
                        <b>
                    </div>
                    <div id="banner">
                        <b>Banner:</b> 
                        <?php
                            //echo "<img src = 'Banner/".$rowevent['banner']."' alt = 'No Image'>";
                            $img = file_get_contents("Banner/".$rowevent['banner']);
                            $data = base64_encode($img);
                        ?>
                            <img src = "data:image/jpg;base64,<?php echo $data;?>" alt = "No Image" style = "width:600px;">
                    </div>
                    <div class="contentrepository">
                        <?php
                            $sqlcontentrepository = "SELECT `image` FROM `contentrepository` WHERE eventid = $event_id";
                            $querycontentrepository = mysqli_query($conn, $sqlcontentrepository);
                            while($rowcontentrepository = mysqli_fetch_assoc($querycontentrepository)){
                                $img = file_get_contents("EventImages/".$rowevent['title'].$rowevent['id']."/".$rowcontentrepository['image']);
                                $data = base64_encode($img);
                        ?>
                                <img src = "data:image/jpg;base64,<?php echo $data;?>" alt = "No Image" style = "width:600px;">
                                <br>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
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

</body>

</html>