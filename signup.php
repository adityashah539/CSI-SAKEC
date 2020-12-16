<?php
require_once "config.php";
function function_alert($message)
{
    echo
        "<SCRIPT>
        window.location.replace('signup.html')
        alert('$message');
    </SCRIPT>";
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $sql = "SELECT * FROM userdata WHERE emailId = ? or phonenumber= ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        $param_email = trim($_POST["email"]);
        $param_phonenumber = trim($_POST["phonenumber"]);
        mysqli_stmt_bind_param($stmt, "si", $param_email, $param_phonenumber);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                function_alert("The user already exits");
            } else {
                $email = trim($_POST["email"]);
                if (strpos($email, "@sakec.ac.in")) {
                    $phonenumber = trim($_POST["phonenumber"]);
                    if ($phonenumber > 999999999||$phonenumber < 10000000000) {
                        $password = trim($_POST["password"]);
                        $confrimpassword = trim($_POST["confrimpassword"]);
                        if ($password === $confrimpassword) {
                            session_start();
                            $branch = trim($_POST["branch"]);
                            $class = trim($_POST["year"]);
                            $firstname = trim($_POST["firstname"]);
                            $lastname = trim($_POST["lastname"]);
                            $sql = "INSERT INTO userdata ( firstName  , lastName  , emailID, phonenumber  , branch  , class  , password  ,role) 
                                                  VALUES ('$firstname','$lastname','$email','$phonenumber','$branch','$class','$password','s')";
                            $stmt = mysqli_query($conn, $sql);
                            header("location: index.php");
                            mysqli_close($conn);
                        } else {
                            function_alert("Plese enter the corrrect password");
                        }
                    }else{
                        function_alert("Phone numeber does not contains 10-digit.");
                    }
                } else {
                    function_alert("Pls enter the college email Id");
                }
            }
        }
    }
}
?>