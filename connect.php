<?php

session_start();
 $con = mysqli_connect('localhost', 'root', "");
 mysqli_select_db($con, 'login');
 $name = $_POST['user'];
 $pass = $_POST['password'];

 $s = "select + from users where name= '$name'";
 $result = mysqli_query($con, $s);
 $num = mysqli_num_rows($result);
 if($num== 1){ 
     echo "Username already taken";

 }else
 {
     $reg="Insert into users(name, password) values ('$name', '$pass')";
     mysqli_query($con, $reg);
     echo" Login successfull";
 }

/*
$username=filter_input(INPUT_POST, 'username');
$password=filter_input(INPUT_POST, 'password');
if(!empty($username)){
    if(!empty($password)){
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "login";

//creating a connection
$conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
if(mysqli_connect_error()){
    die('connect Error('.mysqli_connect_error()') '
    .mysqli_connect_error());
}
else
{
    $sql = "INSERT INTO users (username,password)
    values ('$username', $password)";
    if($conn->query($sql)){
        echo "New record is inserted successfully";

    }
    else
    {
        echo "Error: ".$sql."<br>".$conn->error;
    }
    $conn->close();
}


 }
  else{
        echo "Username should not be empty";
        die();

}
else{
    echo "Username should not be empty";
    die();
}

*/
?>