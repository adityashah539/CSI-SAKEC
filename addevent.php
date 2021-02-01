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
    if($_SESSION["role"]=='admin'||$_SESSION["role"]=='c'){
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
            $s_photo = $_FILES["s_photo"]["name"];
            $file_ext_banner=explode(".", $_FILES["e_banner"]["name"]);
            $file_ext_s_photo=explode(".", $_FILES["s_photo"]["name"]);
            $file_ext_banner=end($file_ext_banner);
            $file_ext_s_photo_banner=end($file_ext_s_photo);
            if (in_array($file_ext_banner,$extensions)&&in_array($file_ext_s_photo_banner,$extensions)){
                $title=$_POST['title']; 
                $tempe_banner = $_FILES["e_banner"]["tmp_name"];     
                $folder = "image/";
                $date = date("Y-m-d",strtotime($_POST['date']));
                $time = date("h:i:sa",strtotime($_POST['time']));
                $e_descripition=$_POST['e_descripition'];
                $fee_m=$_POST['fee_m'];
                $fee=$_POST['fee'];
                $s_name=$_POST['s_name'];
                $temps_photo = $_FILES["s_photo"]["tmp_name"];     
                $s_descripition=$_POST['s_descripition'];
                $sql = "INSERT INTO `event`(`title`, `banner`, `e_date`, `e_time`, `e_description`, `fee_m`, `fee`, `s_photo`, `s_name`, `s_descripition`, `live`)
                                    VALUES ('$title',' $e_banner','$date','$time','$e_descripition','$fee_m','$fee','$s_photo','$s_name','$s_descripition','false')";
                mysqli_query($conn, $sql);
                move_uploaded_file($tempe_banner,$folder);
                move_uploaded_file($temps_photo,$folder);
                if(!$ext_error&&$_FILES["e_banner"]["error"]==0&&$_FILES["e_banner"]["error"]==0)
                {
                    function_alert("Your enter is made.");
                }else{
                    echo $phpFileUploadErrors[$_FILES["e_banner"]["error"]];
                }                
                // echo $title.',' .$e_banner.','.$date.','.$time.','.$e_descripition.','.$fee_m.','.$fee.','.$s_photo.','.$s_name.','.$s_descripition;
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