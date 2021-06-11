<!DOCTYPE html>
    <html lang="en">

    <?php
        require_once "config.php";
        session_start();

        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['name1'])){
            // if($_SESSION['role']==='admin'||$_SESSION['role']==='c'){
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
                $extensions= array('jpg','jpeg','png');
                $index=1;
                //echo $_POST['name'.$index];
                //inserts new coordinatorsb in the database
                while(isset($_POST['name'.$index])){
                    $image = $_FILES["image".$index]["name"];
                    $file_ext_img=explode(".", $_FILES['image'.$index]["name"]);
                    $file_ext_img=end($file_ext_img);
                    if (in_array($file_ext_img,$extensions)){
                        $name = $_POST['name'.$index];
                        $duty = $_POST['duty'.$index];
                        $folder_name_coordinatorImage="images/";
                        $sql = "INSERT INTO `coordinator`(`name`, `duty`, `image`) VALUES ('$name','$duty','$image')";
                        $stmt = mysqli_query($conn, $sql);
                        // if($stmt)echo "success";
                        // else echo "fail";
                        move_uploaded_file($_FILES["image".$index]["tmp_name"],$folder_name_coordinatorImage.$image);
                        if($_FILES["image".$index]["error"]!=0){
                            $err =  $phpFileUploadErrors[$_FILES["image".$index]["error"]];
                            break;
                        }
                    }else{
                        function_alert("Extention of file should be jpg,jpeg,png.");
                    }
                    $index++;
                }
            // }else{
            //     function_alert("You have to be admin or cooridinator");
            // }
        }
    ?>

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
        <title> Add Members</title>
    </head>

    <body style="background:#ffffff">
        <body>    
            </div>
            <h2 class="add-event-header">Add a member</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="contaniner">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-5">
                                <label class="control-label">MEMBER IMAGE :</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="file" name="image1" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <label class="control-label">NAME:</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" name="name1" class="form-control">
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-sm-5">
                                <label class="control-label">DESIGNITION :</label>
                            </div>
                            <div class="col-sm-7">
                                <div class="phone-list">
                                    <div class="input-group phone-input">
                                        <input type="text" name="duty1" id="bill1amount" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success btn-sm btn-add-phone">
                            <span class="glyphicon glyphicon-plus"></span>
                            Add Member
                        </button>
                        <div class="spacer" style="height:20px;"></div>
                    </div>
                </div>
                </div>
                <div class="spacer" style="height:20px;"></div>
                <button onclick="location.href='coordinator.php'" type="button" class="btn btn-primary" >Members List</button> 
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
                            '<label class="control-label">MEMBER IMAGE :</label>' +
                            '</div>' +
                            '<div class="col-sm-7">' +
                            '<input type="file" name="image' + index + '"  required>' +
                            '</div>' +
                            '</div>' +
                            '<div class="row">' +
                            '<div class="col-sm-5">' +
                            '<label class="control-label">NAME:</label>' +
                            '</div>' +

                            '<div class="col-sm-7">' +
                            '<input type="text" name="name' + index + '" class="form-control">' +
                            '</div>' +
                            '</div>' +
                            '<div class="row">' +
                            '<div class="col-sm-5">' +
                            '<label class="control-label">DESIGNITION :</label>' +
                            '</div>' +
                            '<div class="col-sm-7">' +
                            '<div class="bill-list">' +
                            '<div class="input-group phone-input">' +
                            '<input type="text" name="duty' + index + '" id="bill' + index + 'amount" class="form-control" >' +
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
                <a href="index.html"><i class="fas fa-home"></i></a>
                <div class="spacer" style="height:0px;"></div>
                <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
                <div class="spacer" style="height:1px;"></div>
            </div>
        </body>

    </html>