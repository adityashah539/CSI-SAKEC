<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'csi');
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($conn == false) {
        die('Error: Cannot connect');
    } 
    function function_alert($message){
        echo "<SCRIPT>alert('$message');</SCRIPT>";
    }
    function fileTransfer($fileInputName,$location){
        $file_photo_error = $_FILES[$fileInputName]['error'];
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
        if ($file_photo_error == 0) {
            $extensions = array('jpg', 'jpeg', 'png');
            $file_bill_photo = explode(".", $_FILES[$fileInputName]["name"]);
            $file_ext_bill_photo = end($file_bill_photo);
            if (in_array($file_ext_bill_photo, $extensions)) {
                $file_new_name = uniqid('', true) . "." . $file_ext_bill_photo;
                $location_file = $location."/" . $file_new_name;
                move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $location_file);
                return $file_new_name;
            } else {
                function_alert("The photo of the bill should be of jpg, jpeg, png.");
            }
        } else {
            function_alert($phpFileUploadErrors[$file_photo_error]);
        }
    }
    function execute($sql){
        global $conn;
        return mysqli_query($conn, $sql);
    }
    function getValue($sql){
        return mysqli_fetch_assoc(execute($sql));
    }
    function getSpecificValue($sql,$columnName){
        $variable= mysqli_fetch_assoc(execute($sql));
        return $variable[$columnName];
    }
?>