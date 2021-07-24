<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="../css/membership.css?v=<?php echo time(); ?>">
    <title> Membership</title>
    <?php
    require_once "../config.php";
    session_start();
    function function_alert($message)
    {
        echo "<SCRIPT>
            alert('$message');
            </SCRIPT>";
    }
    $email = $_SESSION['email'];
    $sqluserid= "SELECT `id` from `csi_userdata` where emailID = '$email'";
    $queryuserid= mysqli_query($conn, $sqluserid);
    $rows=mysqli_fetch_assoc($queryuserid);
    $userid=$rows['id'];
    $sql = "SELECT `id` ,`userid` FROM `csi_membership` WHERE userid = $userid";
    $query = mysqli_query($conn, $sql);
    $noOfRows=mysqli_num_rows($query);  
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
        $amount=$_POST['amount'];
        if($noOfRows==0){              
            $pemail=$_POST['pemail'];
            $regno=$_POST['registration_number'];
            $dob=$_POST['dob'];
            $syear=$_POST['syear'];
            $eyear=$_POST['eyear'];
            $sqlinsert="INSERT INTO `csi_membership`(`userid`, `dob`, `primaryEmail`, `startingYear`, `passingYear`, `r_number`)
                                            VALUES ('$userid','$dob','$pemail','$syear','$eyear','$regno')";
            $queryinsert = mysqli_query($conn, $sqlinsert);
        }
        $sqlmembershipid= "SELECT `id` from `csi_membership` where userid = '$userid'";
        $querymembershipid= mysqli_query($conn, $sqlmembershipid);
        $rows=mysqli_fetch_assoc($querymembershipid);
        $membership_id=$rows['id'];
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
         $extensions = array('jpg', 'jpeg', 'png');
        //INSERT INTO `membership`(`userid`, `membershipbill`, `smartcard`, `status`) VALUES ('[value-2]','[value-3]','[value-4]','[value-5]')
        // Insert Bill in folder
                    $bill_photo = $_FILES["billphoto"]["name"];
                    $file_ext_bill = explode(".", $_FILES['billphoto']["name"]);
                    $file_ext_bill = end($file_ext_bill);
                    if (in_array($file_ext_bill, $extensions)) {
                        $folder_name_bill = "Membership_Bill/";
                        $file_new_bill = uniqid('', true) . "." . $file_ext_bill;
                        move_uploaded_file($_FILES["billphoto"]["tmp_name"], $folder_name_bill . $file_new_bill);
                        if ($_FILES["billphoto"]["error"] != 0) {
                            $err =  $phpFileUploadErrors[$_FILES["billphoto"]["error"]];
                        }
                        else{
                            $sqlbill="INSERT INTO `csi_membership_bills`( `membership_id`, `bill_photo`, `amount`)
                                                                VALUES ('$membership_id','$file_new_bill','$amount')";
                            $querybill= mysqli_query($conn, $sqlbill);
                            function_alert("success");                            
                            header("location:../index.php");
                        }
                    } else {
                        function_alert("Extention of file should be jpg,jpeg,png." . $file_new_bill);
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
        <!-- DOB
STARTING YEAR
ENDING YEAR
P EMIAL
REG. NO
DURATION

MEMBERSHIP ID
BILLS PHOTO
AMOUNT
MEMBERSHIP TAKEN YEAR(DATE TIME)
NO. OF YEARS
-->
            <div class="spacer" style="height:35px;"></div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <!-- <div class="row">
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
                </div> -->
                <?php 
                    if($noOfRows==0){
                ?>
                <div class="spacer" style="height:35px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <label for="">Dob </label>
                    </div>
                    <div class="col-sm-7">
                        <input type="date" name= "dob"  required="required">
                    </div>
                </div>
                <div class="spacer" style="height:20px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <label for="">Primary Email </label>
                    </div>
                    <div class="col-sm-7">
                        <input type="email" name="pemail" required="required">
                    </div>
                </div>
                <div class="spacer" style="height:20px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <label for="">starting year </label>
                    </div>
                    <div class="col-sm-7">
                        <input type="number" name="syear" required="required">
                    </div>
                </div>
                <div class="spacer" style="height:20px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <label for="">Ending year </label>
                    </div>
                    <div class="col-sm-7">
                        <input type="number" name="eyear" required="required">
                    </div>
                </div>
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
                <?php 
                    }
                ?>
                <div class="spacer" style="height:40px;"></div>
                <div class="row">
                    <div class="col-sm-5">
                        <label class="control-label">Amount paid :</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="text" name="amount" required>
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
                <div class="spacer" style="height:40px;"></div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 text-center">
                        <div class="register">
                            <button type="submit" name="submit" class="btn btn-primary">Submit Application</button>
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
    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->

</body>

</html>