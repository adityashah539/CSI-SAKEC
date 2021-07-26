<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/csi-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <link rel="stylesheet" href="../css/membership.css?v=<?php echo time(); ?>">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title> Add Event</title>
    <?php
    require_once "../config.php";
    function function_alert($message){
        echo "<script> alert('$message'); </script>";
    }
    session_start();
    
    if (isset($_SESSION["role_id"])) {
        $role_id = $_SESSION["role_id"];
        $sql = "SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id";
        $query =  mysqli_query($conn, $sql);
        $access = mysqli_fetch_assoc($query);
    }
    if ($access['budget'] == 0) {
        header("location:../index.php");
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['spent1on'])) {
        if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'c') {
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
            $err = "";
            $extensions = array('jpg', 'jpeg', 'png');
            $index = 1;
            $event_id = $_POST['e_id'];
            $email = $_SESSION['email'];
            $sum = 0;
            while (isset($_POST['spent' . $index . 'on']) && isset($_POST['bill' . $index . 'amount'])) {
                $bill_photo = $_FILES["bill" . $index . "photo"]["name"];
                $file_ext_bill = explode(".", $_FILES['bill' . $index . 'photo']["name"]);
                $file_ext_bill = end($file_ext_bill);
                $file_new_name = uniqid('', true) . "." . $file_ext_bill;
                if (in_array($file_ext_bill, $extensions)) {
                    $spent_on = $_POST['spent' . $index . 'on'];
                    $amount = $_POST['bill' . $index . 'amount'];
                    $folder_name_bill = "Bill/";
                    $sql = "INSERT INTO `csi_expense` ( `event_id`, `spent_on`, `by`, `bill_photo`, `bill_amount`) VALUES ('$event_id','$spent_on','$email','$file_new_name','$amount')";
                    $stmt = mysqli_query($conn, $sql);
                    move_uploaded_file($_FILES["bill" . $index . "photo"]["tmp_name"], $folder_name_bill . $file_new_name);
                    if ($_FILES["bill" . $index . "photo"]["error"] != 0) {
                        $err =  $phpFileUploadErrors[$_FILES["bill" . $index . "photo"]["error"]];
                        break;
                    }
                    //The following code for testing              
                    //echo $budget_id.'<br>'.$spent_on.'<br>'.$email.'<br>'.$bill_photo.'<br>'.$amount.'<br>'.$sql.'<br>'.$sum.'<br>'; 
                } else {
                    $err = "Extention of file should be jpg,jpeg,png.";
                }
                $index++;
            }
            if ($err !== "") {
                function_alert($err);
            } else {
                header("location:expense.php?e_id=$event_id");
            }
        } else {
            function_alert("You have to be admin or cooridinator");
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
            <h4>ADD BILL FOR BUDGET</h4>
            <p>Fill all the fields carefully</p>
            <hr>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="e_id" value="<?php if (isset($_GET['e_id'])) {echo $_GET['e_id'];} ?>">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-5">
                            <label class="control-label">Spent on:</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" name="spent1on" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label class="control-label">Bill photo :</label>
                        </div>
                        <div class="col-sm-7">
                            <input type="file" name="bill1photo" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label class="control-label">Bill amount :</label>
                        </div>
                        <div class="col-sm-7">
                            <div class="phone-list">
                                <div class="input-group phone-input">
                                    <input type="number" name="bill1amount" id="bill1amount" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="extra">
                    </div>
                    <div class="submission text-center">
                        <button type="button" class="btn btn-success btn-sm btn-add-phone">
                            <span class="glyphicon glyphicon-plus"></span>
                            Add Bill
                        </button>
                        <div class="spacer" style="height:35px;"></div>
                        <button id="submit_bill" type="submit" class="btn btn-primary">Sumbit</button>
                        <div class="spacer" style="height:20px;"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(function() {
            $(document.body).on('click', '.changeType', function() {
                $(this).closest('.phone-input').find('.type-text').text($(this).text());
                $(this).closest('.phone-input').find('.type-input').val($(this).data('type-value'));
            });
            $(document.body).on('click', '.btn-remove-phone', function() {
                $(this).closest('.deletephone').remove();
            });
            $('.btn-add-phone').click(function() {
                var index = $('.phone-input').length + 1;
                $('.extra').append('' +
                    '<div class="deletephone">' +
                    '<div class="row">' +
                    '<div class="col-sm-5">' +
                    '<label class="control-label">Spent on:</label>' +
                    '</div>' +
                    '<div class="col-sm-7">' +
                    '<input type="text" name="spent' + index + 'on" class="form-control">' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-sm-5">' +
                    '<label class="control-label">Bill photo :</label>' +
                    '</div>' +
                    '<div class="col-sm-7">' +
                    '<input type="file" name="bill' + index + 'photo"  required>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-sm-5">' +
                    '<label class="control-label">Bill amount :</label>' +
                    '</div>' +
                    '<div class="col-sm-7">' +
                    '<div class="bill-list">' +
                    '<div class="input-group phone-input">' +
                    '<input type="number" name="bill' + index + 'amount" id="bill' + index + 'amount" class="form-control" >' +
                    '<span class="input-group-btn">' +
                    '<button class="btn btn-danger btn-remove-phone" type="button"><span class="glyphicon glyphicon-remove"></span></button>' +
                    '</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
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