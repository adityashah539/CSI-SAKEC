<?php
require_once "config.php";
function function_alert($message)
{
    echo "<SCRIPT>alert('$message');</SCRIPT>";
}
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['value'])) {
        $value = $_GET['value'];
        $event_id = $_GET['event_id'];
        $sql = "UPDATE event SET live='$value' WHERE id='$event_id'";
        $query = mysqli_query($conn, $sql);
        mysqli_query($conn, $sql);
    }
    } else if (isset($_GET['delete_event'])) {
        $id = $_GET['delete_id_event'];
        $sql = "DELETE FROM event WHERE id='$id' ";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            function_alert("Update Successful ");
        } else {
            function_alert("Update Unsuccessful, Something went wrong.");
        }
    }
}
?>