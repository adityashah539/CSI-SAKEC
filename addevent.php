<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
    <link href="https://fonts.googleapis.com/css?family=Oswald|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css'
        integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <link rel="stylesheet" href="css/membership.css">
    <title> Add Event</title>
    <?php 
    require_once "config.php";
    function function_alert($message)
    {
        echo "<SCRIPT>
        window.location.replace('addevent.php')
        alert('$message');
        </SCRIPT>";
    }
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == "POST"&&isset($_POST['title'])){
        if($_SESSION['role']==='admin'||$_SESSION['role']==='c'){
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
                $ext_error=true;
                $extensions= array('jpg','jpeg','png');
                $e_banner = $_FILES["e_banner"]["name"];
                if(isset($_FILES["s_photo"]["name"])){
                    $file_ext_s_photo=explode(".", $_FILES["s_photo"]["name"]);
                    $file_ext_s_photo_banner=end($file_ext_s_photo);
                    if(in_array($file_ext_s_photo_banner,$extensions)){
                        $ext_error=false;
                    }
                    $s_photo = $_FILES["s_photo"]["name"];
                    $s_name=$_POST['s_name'];
                    $s_profession=$_POST['s_profession'];
                    $s_descripition=$_POST['s_descripition'];
                }else{
                    $s_photo=null;
                    $s_name=null;
                    $s_profession=null;
                    $s_descripition=null;
                }
                if(isset($_POST["collaboration"])){
                    $collaboration = $_POST['collaboration'];
                }else{
                    $collaboration = null;
                }
                $file_ext_banner=explode(".", $_FILES["e_banner"]["name"]);
                $file_ext_banner=end($file_ext_banner);
                if(in_array($file_ext_banner,$extensions)){
                    $ext_error = false;
                }
                if ($ext_error){
                    $title=$_POST['title']; 
                    $subtitle=$_POST['subtitle'];
                    $folder_name_banner = 'Banner/';
                    $folder_name_speaker = 'Speaker_Image/';
                    $from_date = date("Y-m-d",strtotime($_POST['fromdate']));
                    $to_date = date("Y-m-d",strtotime($_POST['todate']));
                    $from_time = date("h:i:sa",strtotime($_POST['fromtime']));
                    $to_time = date("h:i:sa",strtotime($_POST['totime']));
                    $e_descripition=$_POST['e_descripition'];
                    $fee_m=$_POST['fee_m'];
                    $fee=$_POST['fee'];
                    $sql = "INSERT INTO `event`(`title`,  `subtitle`,    `banner`, `e_from_date`,`e_to_date`, `e_from_time`,`e_to_time`, `e_description`, `fee_m`, `fee`, `s_photo`, `s_name`, `s_profession`  ,`s_descripition`, `live`,`collaboration`)
                                        VALUES ('$title','$subtitle',' $e_banner',' $from_date','  $to_date','$from_time',   '$to_time','$e_descripition','$fee_m','$fee','$s_photo','$s_name','$s_profession','$s_descripition','false','$collaboration')";
                    mysqli_query($conn, $sql);
                    move_uploaded_file($_FILES["e_banner"]["tmp_name"],$folder_name_banner.$e_banner);
                    $last_entry= mysqli_insert_id($conn);
                    $index=1;
                    while(isset($_POST['phone'.$index.'number'])&&isset($_POST['phone'.$index.'name'])){
                        $phonenmber= $_POST['phone'.$index.'number'];
                        $name=$_POST['phone'.$index.'name'];
                        $sql="INSERT INTO `contact`( `c_name`, `c_phonenumber`, `event_id`) VALUES ('$name','$phonenmber','$last_entry')";
                        mysqli_query($conn, $sql);
                        //This for testing:-)
                        //echo $name.'<br>'.$phonenmber.'<br>';
                        $index++;
                    }
                    if($s_photo!==null){
                        move_uploaded_file($_FILES["s_photo"]["tmp_name"],$folder_name_speaker.$s_photo);
                    }
                    if(!$ext_error&&$_FILES["e_banner"]["error"]==0&&$_FILES["e_banner"]["error"]==0)
                    {
                        function_alert("Your enter is made.");
                    }else{
                        echo $phpFileUploadErrors[$_FILES["e_banner"]["error"]];
                    }
                    //The following code for testing              
                    //echo $title.'<br>'.$subtitle.'<br>'.$e_banner.'<br>'.$from_date.'<br>'.$to_date.'<br>'.$from_time.'<br>'.$to_time.'<br>'.$e_descripition.'<br>'.$fee_m.'<br>'.$fee.'<br>'.$s_photo.'<br>'.$s_name.'<br>'.$s_profession.'<br>'.$s_descripition.'<br>'.$folder_name_speaker.$s_photo.'<br>'.$folder_name_banner.$e_banner;
                }else{
                    function_alert("Extention of file should be jpg,jpeg,png.");
                }
        }else{
            function_alert("You have to be admin or cooridinator");
        }
    } 
    ?> 
</head>
<body style="background:#ffffff">
    <body>
        <h2 class="add-event-header">Add a new event</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
            <div class="container text-left">
                <div class="spacer" style="height:20px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="rnumber">Event Title :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="texts">
                            <input type="text" id="title" name="title" placeholder="Title" required>
                        </div>
                    </div>
                </div>
                <div class="spacer" style="height:20px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="rnumber">Event Subtitle :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="texts">
                            <input type="text" id="subtitle" name="subtitle" placeholder="Subtitle" required>
                        </div>
                    </div>
                </div>
                <div class="spacer" style="height:20px;"></div>
                <div class="row" id="collaboration_id_section">
                </div>
                <div class="spacer" style="height:20px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="banner-img">Banner Image :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <input type="file" id="img" name="e_banner" required>
                    </div>
                </div>
                <div class="spacer" style="height:20px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label> Date :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="texts">
                            <label for="fromdate">From: </label>
                            <br>
                            <input type="date" id="fromdate" name="fromdate" required>
                            <div class="spacer" style="height:10px;"></div>
                            <label for="todate">To:</label>
                            <br>
                            <input type="date" id="todate" name="todate" required>
                        </div>
                    </div>
                </div>
                <div class="spacer" style="height:20px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label> Time :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="texts">
                            <label for="fromtime">From: </label>
                            <br>
                            <input type="time" id="fromtime" name="fromtime" required>
                            <div class="spacer" style="height:10px;"></div>
                            <label for="totime">To: </label>
                            <br>
                            <input type="time" id="totime" name="totime" required>
                        </div>
                    </div>
                </div>
                <div class="spacer" style="height:20px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="rnumber"> Event Description :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="texts">
                            <textarea data-toggle="tooltip" data-placement="bottom" title="Enter the Event Descripition" type="text-area" placeholder="Event Description" class="form-control" rows="4" columns="3"  name="e_descripition" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="spacer" style="height:20px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="rnumber">Fees for Members :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="texts">
                            <label for="appt">&#8377;</label>
                            <input type="text" name="fee_m" placeholder="Fees for Member" required>
                        </div>
                    </div>
                </div>
                <div class="spacer" style="height:20px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="rnumber">Fees for Non-members :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="texts">
                            <label for="appt">&#8377;</label>
                            <input type="text" name="fee"  placeholder="Fees for Non-members"  required>
                        </div>
                    </div>
                </div>
                <div class="spacer" style="height:20px;"></div>
                
                <div class="form-group">
                    <div class="col-sm-5">
                    <label class="control-label">Contact Name :</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="text" name="phone1name" class="form-control">
                    </div>
         
                    <div class="col-sm-5">
                    <label class="control-label">Phone number :</label>
                    </div>
                    <div class="col-sm-7">
                        <div class="phone-list">
                            <div class="input-group phone-input">
                                <input type="number" name="phone1number" id="phone1number" class="form-control" placeholder="+91 999 999 9999" />
                            </div>
                        </div>
                        <button type="button" class="btn btn-success btn-sm btn-add-phone"><span class="glyphicon glyphicon-plus"></span> Add Phone</button>
                        <div class="spacer" style="height:20px;"></div>
                    </div>
                </div>
                    <div class="spacer" style="height:20px;"></div>
                <div id="speaker">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="labels">
                                <label for="banner-img"> Speaker Name : </label>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="texts">
                                <input type="text" name="s_name" placeholder="Speaker Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="spacer" style="height:20px;"></div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="labels">
                                <label for="s_profession"> Speaker Profession: </label>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="texts">
                                <input type="text" name="s_profession" placeholder="Speaker Profession" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="spacer" style="height:20px;"></div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="labels">
                                <label for="banner-img"> Speaker Image :</label>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <input type="file" id="img" name="s_photo"  required>
                        </div>
                    </div>
                    <div class="spacer" style="height:20px;"></div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="labels">
                                <label > Speakers Description :</label>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="texts">
                                <textarea data-toggle="tooltip" data-placement="bottom" title="Enter the Event Descripition" type="text-area" placeholder="Speakers Description" class="form-control" rows="4"  columns="3" name= "s_descripition" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="spacer" style="height:20px;"></div>
            <button type="button" onclick="collaboration_appearance()" class="btn btn-primary" id="collaboration_id_button">Collaboration</button>
            <button type="button" onclick="Disappear()" class="btn btn-primary" id="speaker_nospeaker">No Speaker</button>
            <button type="submit" class="btn btn-primary">Sumbit</button>
            <div class="spacer" style="height:40px;"></div>
        </form>
        <script>
            var collaboration_id_section = document.getElementById("collaboration_id_section");
            collaboration_id_section.innerHTML = '';
            function collaboration_appearance(){
                var collaboration_id_button = document.getElementById("collaboration_id_button");
                if(collaboration_id_section.innerHTML == '') {
                    collaboration_id_section.innerHTML = '<div class="col-sm-5"><div class="labels"><label for="rnumber">Collaboration :</label></div></div>';
                    collaboration_id_section.innerHTML += '<div class="col-sm-7"><div class="texts"><input type="text" id="collaboration" name="collaboration" placeholder="Collaboration" required></div></div>';
                    collaboration_id_button.innerHTML = "No Collaboration";
                } else {
                    collaboration_id_section.innerHTML = '';
                    collaboration_id_button.innerHTML = "Collaboration";
                }
            }
            function Disappear() {
                var element = document.getElementById("speaker_nospeaker");
                var speaker = document.getElementById("speaker");
                if (speaker.innerHTML != '') {
                    speaker.innerHTML = '';
                    element.innerHTML = "Speaker";
                } else {
                    speaker.innerHTML =  '<div class="row"><div class="col-sm-5"><div class="labels"><label for="banner-img"> Speaker Name : </label></div></div><div class="col-sm-7"><div class="texts"><input type="text" name="s_name" placeholder="Speaker Name" required></div></div></div>';
                    speaker.innerHTML += '<div class="spacer" style="height:20px;"></div>';
                    speaker.innerHTML += '<div class="row"><div class="col-sm-5"><div class="labels"><label for="s_profession"> Speaker Profession: </label></div></div><div class="col-sm-7"><div class="texts"><input type="text" name="s_profession" placeholder="Speaker Profession" required></div></div></div>';
                    speaker.innerHTML += '<div class="spacer" style="height:20px;"></div>';
                    speaker.innerHTML += '<div class="row"><div class="col-sm-5"><div class="labels"><label for="banner-img"> Speaker Image :</label></div></div><div class="col-sm-7"><input type="file" id="img" name="s_photo"  required></div></div>';
                    speaker.innerHTML += '<div class="spacer" style="height:20px;"></div>';
                    speaker.innerHTML += '<div class="row"><div class="col-sm-5"><div class="labels"><label > Speakers Description :</label></div></div><div class="col-sm-7"><div class="texts"><textarea data-toggle="tooltip" data-placement="bottom" title="Enter the Event Descripition" type="text-area" placeholder="Speakers Description" class="form-control" rows="4"  columns="3" name= "s_descripition" required></textarea></div></div></div>';
                    element.innerHTML = "No Speaker";
                }
            }
        </script>
        <script>
            $(function(){
		
        $(document.body).on('click', '.changeType' ,function(){
            $(this).closest('.phone-input').find('.type-text').text($(this).text());
            $(this).closest('.phone-input').find('.type-input').val($(this).data('type-value'));
        });
        
        $(document.body).on('click', '.btn-remove-phone' ,function(){
            $(this).closest('.deletephone').remove();
        });   
        $('.btn-add-phone').click(function(){

            var index = $('.phone-input').length + 1;

            $('.form-group').append(''+
            '<div class="deletephone">'+
          '  <div class="col-sm-5">'+
           ' <label class=" control-label">Contact Name :</label>'+
           '</div>'+
                   ' <div class="col-sm-7">'+
                      '  <input type="text" name="phone'+index+'name" class="form-control">'+
               '</div>'+
               '  <div class="col-sm-5">'+
               ' <label class=" control-label">Phone Number :</label>'+
               '</div>'+
               ' <div class="col-sm-7">'+
                    '<div class="input-group phone-input">'+
                        '<input type="number" name="phone'+index+'number" class="form-control" placeholder="+91 999 999 9999" />'+
                        '<span class="input-group-btn">'+
                            '<button class="btn btn-danger btn-remove-phone" type="button"><span class="glyphicon glyphicon-remove"></span></button>'+
                        '</span>'+
                        '</div>'+
                    '</div>'+
                    '</div>'
            );
        });  
    });
        </script>
        <div class="footer">
            <div class="spacer" style="height:2px;"></div>
            <a href="index.php"><i class="fas fa-home"></i></a>
            <div class="spacer" style="height:0px;"></div>
            <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
            <div class="spacer" style="height:1px;"></div>
        </div>
    </body>
</html>