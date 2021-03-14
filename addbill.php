<?php 
require_once "config.php";
function function_alert($message)
{
    echo "<SCRIPT>
    window.location.replace('expense.php')
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
            $index=1;
            $budget_id=$_SESSION['budget_id'];
            $email=$_SESSION['Email'];
            $sum = 0 ; 
            while(isset($_POST['spent'.$index.'on'])&&isset($_POST['bill'.$index.'amount'])){
                $bill_photo = $_FILES["bill".$index."photo"]["name"];
                $file_ext_bill=explode(".", $_FILES['bill'.$index.'photo']["name"]);
                $file_ext_bill=end($file_ext_bill);
                if (in_array($file_ext_bill,$extensions)){
                    $spent_on = $_POST['spent'.$index.'on'];
                    $amount =$_POST['bill'.$index.'amount'];
                    $folder_name_bill="Bill/";
                    $sum+=(int)$spent_on;
                    $sql = "INSERT INTO `expense`(`buget_id`, `spent_on`, `by`, `bill_photo`, `bill_amount`) VALUES ('$budget_id','$spent_on','$email','$bill_photo','$amount')";
                    mysqli_query($conn, $sql);
                    move_uploaded_file($_FILES["bill".$index."photo"]["tmp_name"],$folder_name_bill.$bill_photo);
                    if(!$ext_error&&$_FILES["bill".$index."photo"]["error"]==0)
                    {
                        function_alert("Your enter is made.");
                    }else{
                        echo $phpFileUploadErrors[$_FILES["bill".$index."photo"]["error"]];
                    }
                    //The following code for testing              
                    //echo $title.'<br>'.$subtitle.'<br>'.$e_banner.'<br>'.$from_date.'<br>'.$to_date.'<br>'.$from_time.'<br>'.$to_time.'<br>'.$e_descripition.'<br>'.$fee_m.'<br>'.$fee.'<br>'.$s_photo.'<br>'.$s_name.'<br>'.$s_profession.'<br>'.$s_descripition.'<br>'.$folder_name_speaker.$s_photo.'<br>'.$folder_name_banner.$e_banner; 
                }else{
                    function_alert("Extention of file should be jpg,jpeg,png.");
                }
                $index++;
            }
            $sql = "SELECT `expense`,`balance` FROM `budget` WHERE `id` = $budget_id";
            $result= mysqli_query($conn,$sql);
            $row= mysql_fetch_assoc($result);
            $expense= $row['expense']+$sum;
            $balance= $row['balance']-$expense;
            $sql = "INSERT INTO `budget`( `expense`, `balance`) VALUES ('$expense','$balance')";
            mysqli_query($conn,$sql);
            
        }else{
            function_alert("You have to be admin or cooridinator");
        }
    } else{
        function_alert("Someting went worng.");
    }
?> 