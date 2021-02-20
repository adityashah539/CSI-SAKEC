<?php
require_once "config.php";
function function_alert($message){
    echo"<SCRIPT>
            window.location.replace('query.php')
            alert('$message');
        </SCRIPT>";
}
if(isset($_POST['reply_id'])){
    $id = $_POST['reply_id'];
    $sql = "SELECT * FROM query WHERE id='$id'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    $email=  $row['c_email'];
    $query=   $row['c_query'];
    $reply =$_POST['Msg']; 
    $sql = "INSERT INTO reply ( c_email  , c_query  , reply , replied_by ) VALUES ('$email','$query','$reply','abc')";
    $query = mysqli_query($conn, $sql);
    $sql = "DELETE FROM query WHERE id='$id' ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        function_alert("Update Successful ");
    }else{
        function_alert("Update Unsuccessful, Something went wrong.");
    }
}
?>