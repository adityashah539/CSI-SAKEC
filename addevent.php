<?php 
require_once "config.php";
function function_alert($message)
{
    echo "<SCRIPT>
    window.location.replace('addevent.html')
    alert('$message');
    </SCRIPT>";
}
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST"){
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
            $ext_error=false;
            $extensions= array('jpg','jpeg','png');
            $e_banner = $_FILES["e_banner"]["name"];
            if(isset($_FILES["s_photo"]["name"])){
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
            $file_ext_banner=explode(".", $_FILES["e_banner"]["name"]);
            $file_ext_s_photo=explode(".", $_FILES["s_photo"]["name"]);
            $file_ext_banner=end($file_ext_banner);
            $file_ext_s_photo_banner=end($file_ext_s_photo);
            if (in_array($file_ext_banner,$extensions)&&in_array($file_ext_s_photo_banner,$extensions)){
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
                 $sql = "INSERT INTO `event`(`title`,  `subtitle`,    `banner`, `e_from_date`,`e_to_date`, `e_from_time`,`e_to_time`, `e_description`, `fee_m`, `fee`, `s_photo`, `s_name`, `s_profession`  ,`s_descripition`, `live`)
                                     VALUES ('$title','$subtitle',' $e_banner',' $from_date','  $to_date','$from_time',   '$to_time','$e_descripition','$fee_m','$fee','$s_photo','$s_name','$s_profession','$s_descripition','false')";
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
} else{
    function_alert("Someting went worng.");
}
?> 