<?php
require_once "config.php";
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
                    if ($phonenumber>999999999){ 
                        $password = trim($_POST["password"]);
                        $confrimpassword = trim($_POST["confrimpassword"]);
                        if ($password === $confrimpassword) {
                            $member_period = trim($_POST["member_period"]);
                            $registration_number = trim($_POST["registration_number"]);
                            $firstname = trim($_POST["firstname"]);
                            $lastname = trim($_POST["lastname"]);
                            $branch = trim($_POST["branch"]);
                            $class = trim($_POST["year"]);
                            $sql = "INSERT INTO userdata ( `name` , emailID, phonenumber  , branch  , class  ,      r_number         ,  password  ,   m_period     ,role) 
                                                  VALUES ('$name','$lastname','$email','$phonenumber','$branch','$class',' $registration_number','$password ','$member_period','m')";
                            $stmt = mysqli_query($conn, $sql);
                            header("location: login.php");
                            mysqli_close($conn);
                        }else{
                            function_alert("Plese enter the corrrect password.");
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
