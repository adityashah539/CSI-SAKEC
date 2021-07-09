<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="css/attendance.css?v=<?php echo time(); ?>">
    <title>Edit Attendance</title>
    <?php
    require_once "config.php";
    session_start();
    function function_alert($message){
        echo "<SCRIPT>window.location.replace('eventmanagement.php') alert('$message');</SCRIPT>";
    }
    $to_search = $event_title = $event_id = "";
    if (isset($_POST['search'])) {
        $to_search = trim(strtolower($_POST['search']));
    }
    if ($_SERVER['REQUEST_METHOD'] === "GET") {
        $event_title = $_GET['e_title'];
        $event_id = $_GET['e_id'];
    }
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (isset($_SESSION['email'])) {
            if ($_SESSION['role'] == "admin" ) {
                $index = 1;
                $event_id = $_POST['event_id'];
                while (isset($_POST[("username_".$index)])) {
                    $username = $_POST[("username_".$index)];
                    $attend = $_POST[("attend_".$index)];
                    $sql = "UPDATE `csi_collection` SET `attend`='$attend' WHERE `user_id`='$username' AND `event_id`='$event_id'";
                    $query = mysqli_query($conn, $sql);
                    $index++;
                }
                header("location: attendance.php");
            }
        }
    }
    ?>
</head>

<body>
    <header>
        <h2 style="text-align: center;">Attendance for <?php echo $event_title ?></h2>
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark default-color sticky-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="attendance.php"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="input-group">
                        <input type="search" id="form1" name="search" placeholder="Search" class="form-control" autocomplete="off" />
                        <button id="search-button" type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </ul>
        </div>
    </nav>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>" />
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
                    if (isset($_SESSION['email'])) {
                        if ($_SESSION['role'] === 'admin') {
                            $sql = "SELECT CONCAT(`csi_userdata`.`firstName`,' ', `csi_userdata`.`lastName`) as `name`,`csi_userdata`.`emailID`,`attend`,`csi_userdata`.`id` FROM `csi_collection`,`csi_userdata` 
                            WHERE `csi_collection`.`event_id`='$event_id' AND `csi_userdata`.`id`=`user_id` AND (LOWER(CONCAT(`csi_userdata`.`firstName`,' ', `csi_userdata`.`lastName`)) LIKE '%$to_search%' OR LOWER(`emailID`) LIKE '%$to_search%')";
                            //echo $sql;
                            $query = mysqli_query($conn, $sql);
                            $number_of_rows = mysqli_num_rows($query);
                            if ($number_of_rows > 0) {
                                $index = 1;
                                while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                                    <tr>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['emailID'] ?></td>
                                        <td>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <input type="hidden" name="username_<?php echo $index; ?>" value="<?php echo $row['id']; ?>">
                                                <label class="btn btn btn-outline-success  ">
                                                    <input type="radio" name='<?php echo "attend_$index"; ?>' value="1" <?php if ($row['attend'] == "1") {echo 'checked';} ?> > Present
                                                </label>
                                                <label class="btn btn-outline-danger ">
                                                    <input type="radio" name='<?php echo "attend_$index"; ?>' value="0" <?php if ($row['attend'] == "0") {echo 'checked';} ?>> Absent
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                    <?php
                                    $index++;
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
        <button type="submit" class="btn btn-primary"><i class="fas fa-arrow-circle-right"></i> Sumbit</button>
    </form>
    <div class="spacer" style="height:70px;"></div>
    <div class="footer">
        <div class="spacer" style="height:2px;"></div>
        <a href="index.php"><i class="fas fa-home"></i></a>
        <div class="spacer" style="height:0px;"></div>
        <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
        <div class="spacer" style="height:1px;"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>