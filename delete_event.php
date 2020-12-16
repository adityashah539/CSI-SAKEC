<?php
require_once "config.php";
function function_alert($message){
    echo"<SCRIPT>
            window.location.replace('eventmanagement.php')
            alert('$message');
        </SCRIPT>";
}
//if(isset($_POST['delete_event_btn']))
{
    $id = $_POST['delete_id_event'];
    $sql = "DELETE FROM event WHERE id='$id' ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        function_alert("Update Successful ");
    }else{
        function_alert("Update Unsuccessful, Something went wrong.");
    }
}
?>
