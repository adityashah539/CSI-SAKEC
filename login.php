<?php
function function_alert($message)
{
    echo "<SCRIPT>
    window.location.replace('membership.html')
    alert('$message');
    
</SCRIPT>";
}
if (isset($_SESSION['username'])) {
    header("location: index.php");
    exit;
}
require_once "config.php";
$username = $password = "";
$err = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_POST['email'])) || empty(trim($_POST['password']))) {
        $err = "Please enter username + password";
    } else {
        $username = trim($_POST['email']);
        $password = trim($_POST['password']);
    }
    if (empty($err)) {
        $sql = "SELECT emailID, password  FROM userdata WHERE emailID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $param_username);
        $param_username = $username;
        // Try to execute this statement
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $username, $hashed_Password);
                if (mysqli_stmt_fetch($stmt)) {
                    //echo $hashed_Password . " " . $password;
                    if ($password === $hashed_Password) {
                        // this means the password is corrct. Allow user to login
                        session_start();
                        $_SESSION["username"] = $username;
                        $_SESSION["loggedin"] = true;
                       // echo $_SESSION["username"];
                        header("location: index.php");
                    } else {
                        function_alert("Plese enter the corrrect password");
                        header("location: login.php");
                    }
                }
            }
        }
    }
    else{
        function_alert($err);
        header("location: login.html");
    } 
    
}
