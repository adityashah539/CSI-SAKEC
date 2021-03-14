<?php
require_once "config.php";
session_start();
ob_start();
function function_alert($message)
{
    echo "<SCRIPT>
    window.location.replace('login.html')
    alert('$message');
    </SCRIPT>";
}
if ($_SESSION['email']!='') {
    header("location: index.php");
    exit;
}
$username = $password = "";
$err = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_POST['email'])) || empty(trim($_POST['password']))) {
        $err = "Please enter username + password";
    } else {
        if(strpos(trim($_POST['email']),"@sakec.ac.in")){
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
        }
        else{
            function_alert("Pls enter the college email Id");
        }
    }
    if (empty($err)) {
        $sql = "SELECT emailID, password  FROM userdata WHERE emailID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $param_email);
        $param_email = $email;
        // Try to execute this statement
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $email, $hashed_Password);
                if (mysqli_stmt_fetch($stmt)) {
                    if ($password === $hashed_Password) { // this means the password is corrct. Allow user to login
                        session_start();
                        $sql = "SELECT role,id  FROM userdata WHERE emailID = '$email'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $_SESSION["role"] = $row["role"];
                        $_SESSION["id"] = $row["id"];
                        $_SESSION["email"] = $email;
                        if(isset($_POST['rememeber_me'])){
                            setcookie('email',$email,time()+86400);
                            setcookie('password',$password,time()+86400);
                        }
                        header("location: index.php");
                    } else {
                        function_alert("Plese enter the corrrect password");
                    }
                }
            }
        }
    }
    else{
        function_alert($err);
    }
}