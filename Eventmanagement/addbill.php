<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/csi-logo.png">
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/membership.css?v=<?php echo time(); ?>">
    <title> Add Event</title>
    <?php
    require_once "../config.php";
    session_start();
    
    $access = 0;
    if (isset($_SESSION["role_id"])) {
        $role_id = $_SESSION["role_id"];
        $access = getSpecificValue("SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id", 'budget');
    }
    if ($access == 0) {
        header("location:../index.php");
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['spent1on'])) {
        if ($access == 1) {
            $err ="";
            $index = 1;
            $event_id = $_POST['e_id'];
            $email = $_SESSION['email'];
            $sum = 0; 
            while (isset($_POST['spent' . $index . 'on']) && isset($_POST['bill' . $index . 'amount'])) {
                $image = fileTransfer('bill' . $index . 'photo', "Bill");
                if($image['error'] == NULL){
                    $file_new_name = $image['file_new_name'];
                    $spent_on = $_POST['spent' . $index . 'on'];
                    $amount = $_POST['bill' . $index . 'amount'];
                    $stmt = execute("INSERT INTO `csi_expense` ( `event_id`, `spent_on`, `by`, `bill_photo`, `bill_amount`) VALUES ('$event_id','$spent_on','$email','$file_new_name','$amount')");
                } else {
                    function_alert($image['error']);
                }
                $index++;
            }
            if ($err !== "") {
                function_alert($err);
            } else {
                header("location:expense.php?e_id=$event_id");
            }
        } else {
            function_alert("You don't have permission");
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
    
    <script src="plugins/jquery.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <script src="plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
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