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
		require_once "config.php";
        if($_SERVER['REQUEST_METHOD'] === "GET"){
            if(isset($_GET['event_id'])){
                $event_id=$_GET['event_id'];
                $sql="SELECT * FROM `event` WHERE `id`=$event_id";
                $query = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($query);
                $collaboration_sql = "SELECT `collab_body` FROM `collaboration` WHERE `event_id`='$event_id'";
                $collaboration_query = mysqli_query($conn, $collaboration_sql);
                $collaboration_row = mysqli_fetch_assoc($collaboration_query);
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
                <div><img src = "data:image/jpg;base64,<?php echo base64_encode(file_get_contents("images/CSI-header.jpg"));?>" alt = "No Image" style = "width:600px;"></div>
                <div>REF:-<?php echo date("y-",strtotime("-1 years")).date("y",strtotime("now"))."[Enter the event Number]".str_repeat("&nbsp; ",26);?> Date:- <?php echo date("d/m/Y",strtotime("now"))?></div>
                <div>To,<br></div>
                <div>The Principal,</div>
                <div>&nbsp;Shah &amp; Anchor Kutchhi Engineering College</div>
                <div>Chembur, Mumbai 400088<br></div>
                <div><br></div>
                <div>Subject: <u>Permission to conduct an event on <?php echo $row['subtitle']?></u>.<br></div>
                <div><br></div>
                <div>Respected Sir,<br></div>
                <div><br></div>
                <div>CSI-SAKEC is organizing an event '<?php echo $row['subtitle'];?>’ ,in
                    collaboration with 
                    <?php echo $collaboration_row['collab_body'];while($collaboration_row = mysqli_fetch_assoc($collaboration_query)) echo ", ".$collaboration_row['collab_body']; ?> 
                    on <?php if($row['e_from_date']==$row['e_to_date']) echo date("j F Y",strtotime($row['e_from_date'])); else echo date("j F Y",strtotime($row['e_from_date']))." to ".date("j F Y",strtotime($row['e_to_date']));?>. For the same, permission
                    is required to access to <b>[requirements]</b> as well as social media publicity.
                    Thus, kindly give us permission to access the above mentioned venue from <?php date("h:i A",strtotime($row['e_from_time']))." to ".date("h:i A",strtotime($row['e_from_time']))?> on <?php if($row['e_from_date']==$row['e_to_date']) echo date("j F Y",strtotime($row['e_from_date'])); else echo date("j F Y",strtotime($row['e_from_date']))." to ".date("j F Y",strtotime($row['e_to_date']));?>.
                    Thanking You.<br></div>
                <div><br></div>
                <div>Yours sincerely,<br></div>
                <div>[Enter the Sign of General Secretary]<br></div>
                <div>[Enter the Name of General Secretary]<br></div>
                <div>General Secretary&nbsp;</div>
                <div>(CSI-SAKEC <?php echo date("Y-",strtotime("-1 years")).date("y",strtotime("now"))?>)<br></div>
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