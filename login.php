<?php
//This script will handle login
session_start();
// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: index.html");
    exit;
}
require_once "config.php";
$username = $password = "";
$err = "";
// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $trimun=trim($_POST['user']);
    $trimpass=trim($_POST['password']);
    if(empty($trimun) || empty($trimpass))
    {
        $err = "Please enter username + password";
    }
    else
    {
        $username = trim($_POST['user']);
        $password = trim($_POST['password']);
    }
    if(empty($err))
    {
        $sql = "SELECT EmailId, Password  FROM data WHERE EmailId = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;        
        // Try to execute this statement
        if(mysqli_stmt_execute($stmt))
        {
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1)
            {
                mysqli_stmt_bind_result($stmt, $username, $hashed_Password);
                if(mysqli_stmt_fetch($stmt))
                {
                    echo $hashed_Password." ".$password;
                    if($password===$hashed_Password)
                    {
                        // this means the password is corrct. Allow user to login
                        session_start();
                        $_SESSION["username"] = $username;
                        $_SESSION["id"] = $id;
                        $_SESSION["loggedin"] = true; 
                        //Redirect user to welcome page
                        echo "Login done";
                        header("location: index.html");        
                    }
                    else 
                    {
                        echo "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
                    }
                }

            }
        }
    }  
}
?>