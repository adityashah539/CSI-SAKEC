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
            window.location.replace('budget.php')
            alert('$message');
            </SCRIPT>";
        }
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == "POST"&&isset($_POST['spent1on'])){
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
                $budget_id=$_POST['bi_e1'];
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
                $row= mysqli_fetch_assoc($result);
                $expense= $row['expense']+$sum;
                $balance= $row['balance']-$expense;
                $sql = "INSERT INTO `budget`( `expense`, `balance`) VALUES ('$expense','$balance')";
                mysqli_query($conn,$sql);
                
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
            <div class="contaniner">
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
                    <button type="button" class="btn btn-success btn-sm btn-add-phone">
                        <span class="glyphicon glyphicon-plus"></span>
                        Add Bill
                    </button>
                    <div class="spacer" style="height:10px;"></div>
                </div>
            </div>
            </div>
            <div class="spacer" style="height:10px;"></div>
            <input type="hidden" name="bi_e1" value="<?php echo $_GETs['bi_e'];?>">
            <div id= "BudgetId">
                
            </div>
            <button type="submit" class="btn btn-primary">Sumbit</button>
            <div class="spacer" style="height:40px;"></div>
            
        </form>

        <script>
            $(function () {

                $(document.body).on('click', '.changeType', function () {
                    $(this).closest('.phone-input').find('.type-text').text($(this).text());
                    $(this).closest('.phone-input').find('.type-input').val($(this).data('type-value'));
                });

                $(document.body).on('click', '.btn-remove-phone', function () {
                    $(this).closest('.deletephone').remove();
                });


                $('.btn-add-phone').click(function () {

                    var index = $('.phone-input').length + 1;

                    $('.form-group').append('' +
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