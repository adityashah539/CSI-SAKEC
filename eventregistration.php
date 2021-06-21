<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <link rel="stylesheet" href="css/membership.css?v=<?php echo time(); ?>">
    <title>Event Registration</title>
    <?php
        require_once "config.php";
        session_start();
        function function_alert($message)
        {
            echo "<SCRIPT>alert('$message');</SCRIPT>";
        }
        if ($_SERVER['REQUEST_METHOD']=="POST") {
            
            if (isset($_POST['register_now']) && isset($_POST['event_id'])&&isset($_POST['fee'])&&($_POST['fee']==0)&&isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $event_id = $_POST['event_id'];
                $sql = "SELECT `userdata`.`id` as `user_id` FROM `userdata` WHERE `emailID`='$email'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $user_id = $row["user_id"];
                $sql = "INSERT INTO `collection`(`event_id`,`user_id`,`confirmed`,`confirmed_by`) VALUES ('$event_id','$user_id','1','auto')";
                $result = mysqli_query($conn, $sql);
                header("location:event.php?event_id=$event_id");
                // for testing 
                echo $email."<br>".$event_id."<br>".$sql."<br>".$budget_id."<br>".$user_id."<br>";
            }
            else if(isset($_POST['paid_registration']) && $_POST['paid_registration']=="paid_registration"){
                echo $_POST['paid_registration'];
                $file_bill_photo_error=$_FILES["bill_photo"]['error'];
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
                if($file_bill_photo_error==0){
                    $extensions= array('jpg','jpeg','png');
                    $file_bill_photo=explode(".", $_FILES["bill_photo"]["name"]);
                    $file_ext_bill_photo=end($file_bill_photo);
                    if(in_array($file_ext_bill_photo,$extensions)){
                        $file_new_name = uniqid('',true).".".$file_ext_bill_photo;
                        $location_file = 'Event_Bill/'.$file_new_name;
                        move_uploaded_file($_FILES["bill_photo"]["tmp_name"],$location_file);
                        $email = $_SESSION['email'];
                        $event_id = $_POST['event_id'];
                        $sql = "SELECT `userdata`.`id` as `user_id` FROM `userdata` WHERE `emailID`='$email'";
                        $result = mysqli_query($conn, $sql);
                        //echo "<br>".$sql;
                        $row = mysqli_fetch_assoc($result);
                        $user_id = $row["user_id"];
                        $sql = "INSERT INTO `collection`(`event_id`,`user_id`,`bill_photo`,`confirmed`) VALUES ('$event_id','$user_id','$file_new_name','0')";
                        $result = mysqli_query($conn, $sql);
                        header("location:event.php?event_id=$event_id");
                        // for testing 
                        echo $email."<br>".$event_id."<br>".$sql."<br>".$budget_id."<br>".$user_id."<br>".$_POST['fee'];
                    }else{
                        function_alert("The photo of the bill should be of jpg, jpeg, png.");
                    }
                }else{
                    function_alert($phpFileUploadErrors[$file_bill_photo_error]);
                }
            }
        }
    ?>
</head>

<body>
    <header>
        <h6>
            MAHAVIR EDUCATION TRUST'S<br>
            SHAH AND ANCHOR KUTCHHI ENGINEERING COLLEGE<br>
            COMPUTER SOCIETY OF INDIA
        </h6>
        <h4>CSI-SAKEC</h4>
    </header>
    <div class="spacer" style="height:15px;"></div>
    <div class="registration">
    <div class="container">
       
            <h4>Register For The Event</h4>
            <p>Fill all the fields carefully</p>
            <hr>
            
                <div class="row">
                    <div class="col-sm-12">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                            <label class="control-label">Bills Photo :</label>
                            <input type="file" name="bill_photo" required/>
                            <div class="spacer" style="height:20px;"></div>
                            <button type="submit" value="paid_registration" name="paid_registration" class="btn btn-primary">Sumbit</button>
                            <?php 
                                if(isset($_POST['event_id'])&&isset($_POST['fee'])){
                            ?>
                                    <input type="hidden" name="event_id" value="<?php echo $_POST['event_id'];?>"/>
                                    <input type="hidden" name="fee" value="<?php echo $_POST['fee'];?>"/>
                            <?php
                                }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="spacer" style="height:50px;"></div>
    <div class="footer">
            <div class="spacer" style="height:2px;"></div>
            <a href="index.php"><i class="fas fa-home"></i></a>
            <div class="spacer" style="height:0px;"></div>
            <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
            <div class="spacer" style="height:1px;"></div>
        </div>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>