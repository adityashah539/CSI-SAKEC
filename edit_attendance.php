<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Edit Attendance</title>
    <?php
    require_once "config.php";
    function function_alert($message)
    {
        echo "<SCRIPT>
                    window.location.replace('eventmanagement.php')
                    alert('$message');
                </SCRIPT>";
    }
    $to_search= $event_title=$event_id="";
    if (isset($_POST['search'])) {
        $to_search = trim(strtolower($_POST['search']));
    }
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $event_title=$_GET['event_title'];
        $event_id=$_GET['event_id'];
    }

    ?>
</head>

<body>
    <header>
        <h2 style="text-align: center;">Attendance for <?php echo $event_title?></h2>
    </header>
    <table class="table" id="myTable">
        <thead class="table-head">
            <tr>
                <th>Student Name</th>
                <th>Email</th>
                <th>Attendance</th>    
            </tr>
        </thead>
        <tbody>
            <div class="table-content" style="font-size: large;">
        <?php
                require_once "config.php";
                session_start();
                if (isset($_SESSION['email'])) {
                    if ($_SESSION['role'] === 'admin') {
                        $sql = "SELECT CONCAT(`userdata`.`firstName`,' ', `userdata`.`lastName`) as `name`,`userdata`.`emailID`
                        FROM `collection`,`budget`,`userdata`
                        WHERE `budget`.`event_id`='$event_id' AND `collection`.`budget_id`=`budget`.`id` AND `userdata`.`id`=`user_id` AND 
                        (LOWER(`name`) LIKE '%$to_search%' OR LOWER(`emailID`) LIKE '%$to_search%')";
                        $query = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
        ?>
                                <form action="" method="post">
                                    <tr>
                                        <td><?php echo $row['name']?></td>
                                        <td><?php echo $row['emailID']?></td>
                                        <td>
                                            <label class="btn btn btn-outline-success active">
                                                <input type="radio" name="options" id="option1" checked> Active
                                            </label>
                                            <label class="btn btn-outline-danger">
                                                <input type="radio" name="options" id="option2"> Radio
                                            </label>
                                        </td>
                                    </tr>
                                </form>
                                
        <?php
                            }
                        } else {
                            echo "<td>No Record Found</td><td/><td/>";
                        }
                    } else {
                        echo "<td>You need excess to see.</td><td/>";
                    }
                } else {
                    echo "<td>You have not logged in.</td><td/>";
                }

        ?>
            </div>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
