<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/csi-logo.png">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/attendance.css?v=<?php echo time(); ?>">
    <?php
    require_once "../config.php";
    session_start();
    // Fetching Access Details
    $access = null;
    if (isset($_SESSION["role_id"])) {
        $role_id = $_SESSION["role_id"];
        $access = getSpecificValue("SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id", 'edit_attendance');
    }
    if ($access == 0) {
        header("location:../index.php");
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
        if ($access['edit_attendance'] == 1) {
            $index = 1;
            $event_id = $_POST['event_id'];
            while (isset($_POST[("username_" . $index)])) {
                $username = $_POST[("username_" . $index)];
                $attend = $_POST[("attend_" . $index)];
                $query = execute("UPDATE `csi_collection` SET `attend`='$attend' WHERE `user_id`='$username' AND `event_id`='$event_id'");
                $index++;
            }
            header("location: attendance.php");
        }
    }
    ?>
    <title>Edit Attendance</title>
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
                    <a class="nav-link" href="managementevent.php?event_id=<?php echo $event_id; ?>"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"><i class="fas fa-home"></i> Home</a>
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
                    if ($access == 1) {
                        $query = execute("SELECT  `csi_userdata`.`name`,`csi_userdata`.`emailID`,`attend`,`csi_userdata`.`id` FROM `csi_collection`,`csi_userdata` 
                                            WHERE `csi_collection`.`event_id`='$event_id' AND `csi_userdata`.`id`=`user_id` AND (LOWER(`name`) LIKE '%$to_search%' OR LOWER(`emailID`) LIKE '%$to_search%')");
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
                                                <input type="radio" name='<?php echo "attend_$index"; ?>' value="1" <?php if ($row['attend'] == "1") {echo 'checked';} ?>> Present
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
    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->
</body>

</html>