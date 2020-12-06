<?php
require_once "config.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $sql = "SELECT * FROM userdata WHERE emailId = ? or phonenumber= ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        $param_email = trim($_POST["email"]);
        $param_phonenumber = trim($_POST["phonenumber"]);
        mysqli_stmt_bind_param($stmt, "si", $param_email,$param_phonenumber);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                echo'email or phone  has been taken';
            } else {
                $email = trim($_POST["email"]);
                $password = trim($_POST["password"]);
                $phonenumber = trim($_POST["phonenumber"]);
                $confrimpassword = trim($_POST["confrimpassword"]);
                if ($password === $confrimpassword) {
                    $branch = trim($_POST["branch"]);
                    $class = trim($_POST["year"]);
                    $firstname = trim($_POST["firstname"]);
                    $lastname = trim($_POST["lastname"]);
                    $sql = "INSERT INTO userdata ( firstName, lastName, emailID, phonenumber, branch, class, password) VALUES ('$firstname','$lastname','$email','$phonenumber','$branch','$class','$password')";
                    $stmt = mysqli_query($conn, $sql);
                    header("location: login.html");
                    mysqli_close($conn);
                }
            }
        }
    }
} 
?>