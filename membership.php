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
    <title> Membership</title>
    <?php
    require_once "config.php";
    session_start();
    function function_alert($message)
    {
        echo "<SCRIPT>
            window.location.replace('loggedinmembership.php')
            alert('$message');
            </SCRIPT>";
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
        if (isset($_SESSION['email'])) {
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
            $extensions = array('jpg','jpeg','png');
            //INSERT INTO `membership`(`userid`, `membershipbill`, `smartcard`, `status`) VALUES ('[value-2]','[value-3]','[value-4]','[value-5]')

            // Insert Bill in folder
            $bill_photo = $_FILES["billphoto"]["name"];
            $file_ext_bill = explode(".", $_FILES['billphoto']["name"]);
            $file_ext_bill = end($file_ext_bill);
            if (in_array($file_ext_bill, $extensions)) {
                $folder_name_bill = "Membership_Bill/";
                $file_new_bill = uniqid('',true).".".$file_ext_bill;
                move_uploaded_file($_FILES["billphoto"]["tmp_name"], $folder_name_bill.$file_new_bill);
                if ($_FILES["billphoto"]["error"] != 0) {
                    $err =  $phpFileUploadErrors[$_FILES["billphoto"]["error"]];
                }
            } else {
                function_alert("Extention of file should be jpg,jpeg,png.".$file_new_bill);
            }


            // Insert Smart Card in folder
            $card_photo = $_FILES["smartcard"]["name"];
            $file_ext_card = explode(".", $_FILES['smartcard']["name"]);
            $file_ext_card = end($file_ext_card);
            if (in_array($file_ext_card, $extensions)) {
                $folder_name_card = "Smart_Card/";
                $file_new_card = uniqid('',true).".".$file_ext_card;
                move_uploaded_file($_FILES["smartcard"]["tmp_name"], $folder_name_card.$file_new_card);
                if ($_FILES["smartcard"]["error"] != 0) {
                    $err =  $phpFileUploadErrors[$_FILES["smartcard"]["error"]];
                }
            } else {
                function_alert("Extention of file should be jpg,jpeg,png.Smart");
            }

            $email = $_SESSION['email'];
            $sqluser = "SELECT id FROM `userdata` WHERE emailID = '$email'";
            $stmt = mysqli_query($conn, $sqluser);
            if(mysqli_num_rows($stmt) == 1){
                $row = mysqli_fetch_assoc($stmt);
                $id = $row['id'];
                $sql = "INSERT INTO `membership`(`userid`, `membershipbill`, `smartcard`, `status`) VALUES ('$id','$file_new_bill','$file_new_card',0)";
                $stmt = mysqli_query($conn, $sql);
            }


            $member_period = trim($_POST["member_period"]);
            $registration_number = trim($_POST["registration_number"]);
            if ($_SESSION["role"] === 'student') {
                $sql = "UPDATE userdata SET r_number='$registration_number',m_period='$member_period' WHERE emailID='$email'";
                mysqli_query($conn, $sql);
                header("location: index.php");
                mysqli_close($conn);
            } else {
                function_alert("You are member .You don't need membership");
            }
        }else{
            function_alert("You need to login");
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
       
            <h4>Student Membership Registration </h4>
            <p>Fill all the fields carefully</p>
            <hr>
            <div class="spacer" style="height:35px;"></div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="">Membership period :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="texts">
                            <select name="member_period" class="custom-select mb-3" required="required">
                                <option selected disabled>Select Year</option>
                                <option value="1">One Year</option>
                                <option value="2">Two Year</option>
                                <option value="3">Three Year</option>
                                <option value="4">Four Year</option>
                                <option value="5">Life</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- <div class="spacer" style="height:20px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="birthday">Date of Birth :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="texts">
                            <input type="date" id="birthday" name="birthday">
                        </div>
                    </div>
                </div>
                <div class="spacer" style="height:35px;"></div>
                <div class="row">

                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="type">Gender :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="texts">
                            <input type="radio" id="male" name="gender" value="male">
                            <label for="male">Male</label>
                            <input style="margin-left:25px ;" type="radio" id="female" name="gender" value="female">
                            <label for="Female">Female</label>
                        </div>
                    </div>
                </div> -->
                <div class="spacer" style="height:20px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="rnumber">College Registration Number :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="texts">
                            <input type="number" id="rnumber" name="registration_number" value="" required="required">
                            <small id="rnumberlHelp" class="form-text text-muted">As printed on your ID card</small>
                        </div>
                    </div>
                </div>
                <div class="spacer" style="height:40px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <label class="control-label">Smart card :</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="file" name="smartcard" required>
                    </div>
                </div>
                <div class="spacer" style="height:40px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <label class="control-label">Bill photo :</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="file" name="billphoto" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 text-center">
                        <div class="register">
                            <button type="submit" name = "submit"class="btn btn-primary">Register</button>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                </div>
            </form>
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