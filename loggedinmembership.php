<?php
require_once "config.php";
session_start();
function function_alert($message) { 
    echo "<SCRIPT>
    window.location.replace('loggedinmembership.html')
    alert('$message');
    </SCRIPT>";
} 
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_SESSION["loggedin"]== true) {       
        $member_period=trim($_POST["member_period"]);
        $registration_number = trim($_POST["registration_number"]);
        if ($_SESSION["role"] === 's') {
            $id= $_SESSION["id"];
            $sql = "UPDATE userdata SET r_number='$registration_number',m_period='$member_period',role= 'm' WHERE id='$id'";
            mysqli_query($conn, $sql);
            $_SESSION['role'] ='m';
            header("location: index.php");
            mysqli_close($conn); 
        }else{
            function_alert("You are member .You don't need membership");
        }
    }else{
        function_alert("You need to login");
    }
}else{
    function_alert("Some thing went worng ");
}
?>