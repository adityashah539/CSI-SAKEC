<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/csi-logo.png">
    <link rel="stylesheet" href="../css/membership.css?v=<?php echo time(); ?>">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <title>Manage Event</title>
    <?php
    require_once "../config.php";
    session_start();
    function function_alert($message){
        echo "<SCRIPT>
                    alert('$message');
                </SCRIPT>";
    }
    $access = NULL;
    if (isset($_SESSION["role_id"])) {
        $role_id = $_SESSION["role_id"];
        $sql = "SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id";
        $query =  mysqli_query($conn, $sql);
        $access = mysqli_fetch_assoc($query);
    }
    if ($access['add_event'] == 0 && $access['manage_event']==0 && $access['budget'] == 0 && $access['edit_attendance'] == 0 && $access['permission_letter'] == 0 && $access['report'] == 0 && $access['confirm_event_registration'] == 0 && $access['content_repository'] == 0 && $access['feedback_response'] == 0) {
        header("location:../index.php");
    }
    $to_search = "";
    if (isset($_POST['search'])) {
        $to_search = trim(strtolower($_POST['search']));
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['enable_id'])) {
            $id = $_POST['enable_id'];
            $sql = "UPDATE csi_event SET live='1' WHERE id='$id'";
            $query = mysqli_query($conn, $sql);
            mysqli_query($conn, $sql);
        } else if (isset($_POST['disable_id'])) {
            $id = $_POST['disable_id'];
            $sql = "UPDATE csi_event SET live='0' WHERE id='$id'";
            $query = mysqli_query($conn, $sql);
            mysqli_query($conn, $sql);
        } else if (isset($_POST['delete_event_btn'])) {
            $id = $_POST['delete_id_event'];
            $sql = "DELETE FROM csi_event WHERE id='$id' ";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                function_alert("Update Successful ");
            } else {
                function_alert("Update Unsuccessful, Something went wrong.");
            }
        } else if (isset($_POST['enable_feedback'])) {
            $id = $_POST['enable_feedback'];
            $sql = "UPDATE csi_event SET feedback='1' WHERE id='$id'";
            $query = mysqli_query($conn, $sql);
            mysqli_query($conn, $sql);
        } else if (isset($_POST['disable_feedback'])) {
            $id = $_POST['disable_feedback'];
            $sql = "UPDATE csi_event SET feedback='0' WHERE id='$id'";
            $query = mysqli_query($conn, $sql);
            mysqli_query($conn, $sql);
        }
    }
    ?>
</head>

<body>
    <header>
        <h2 style="text-align: center;">Manage Events</h2>
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark default-color sticky-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"><i class="fas fa-home"></i> Home</a>
                </li>
                <?php
                if (isset($access) && $access['add_event'] == 1) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="addevent.php"><i class="fas fa-calendar-plus"></i> Add Event</a>
                    </li>
                <?php
                }
                if (isset($access) && $access['budget'] == 1) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="budget.php"><i class="fas fa-balance-scale"></i> Budget</a>
                    </li>
                <?php
                }
                ?>
            </ul>
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="input-group">
                        <input type="search" onkeyup="SearchFunction()" id="form1" name="search" placeholder="Search" class="form-control" />
                        <button id="search-button" type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </ul>
        </div>
    </nav>
    <table class="table" id="eventsTable">
        <thead class="table-head">
            <tr>
                <th scope="col">Title</th>
                <?php
                if (isset($access) &&$access['manage_event'] == 1) {
                ?>
                    <th>Live</th>
                    <th>FEEDBACK</th>
                    <th>Delete</th>
                <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <div class="table-content" style="font-size: large;">
                <?php
                $sql = "SELECT * FROM `csi_event` WHERE LOWER(`title`) LIKE '%$to_search%' ";
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                ?>
                        <tr>
                            <th scope="row">
                                <form action="managementevent.php" method="GET">
                                    <input type="hidden" name="event_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="textbutton"><?php echo $row['title']; ?></button>
                                </form>
                            </th>
                            <?php
                            if (isset($access) && $access['manage_event'] == 1) {
                                if ($row['live'] == 1) {
                            ?>
                                    <td>
                                        <div id="live">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                <input type="hidden" name="disable_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="btn btn-success">Live</button>
                                            </form>
                                        </div>
                                    </td>
                                <?php
                                } else {
                                ?>
                                    <td>
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <input type="hidden" name="enable_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="btn btn-danger"> Disabled</button>
                                        </form>
                                    </td>
                                <?php
                                }
                                if ($row['feedback'] == 1) {
                                ?>
                                    <td>
                                        <div id="live">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                <input type="hidden" name="disable_feedback" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="btn btn-success">Live</button>
                                            </form>
                                        </div>
                                    </td>
                                <?php
                                } else {
                                ?>
                                    <td>
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <input type="hidden" name="enable_feedback" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="btn btn-danger"> Disabled</button>
                                        </form>
                                    </td>
                                <?php
                                }
                                ?>
                                <td>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <input type="hidden" name="delete_id_event" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_event_btn" class="btn btn-danger"> Delete</button>
                                    </form>
                                </td>
                            <?php
                            }
                            ?>
                    <?php
                    }
                } else {
                    echo "<td>No Record Found</td><td/><td/><td/><td/><td/><td/><td/>";
                }
                    ?>
            </div>
        </tbody>
    </table>
    <div class="spacer" style="height:30px;"></div>
    <!-- <div class="container text-center">
        <a href="addevent.php">
            <button type="button" class="btn btn-primary" >Add Event</button>    
        </a>
    </div> -->
    <div class="spacer" style="height:10px;"></div>
    <div class="footer">
        <div class="spacer" style="height:2px;"></div>
        <a href="index.php"><i class="fas fa-home"></i></a>
        <div class="spacer" style="height:0px;"></div>
        <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
        <div class="spacer" style="height:1px;"></div>
    </div>
    <script>
        function SearchFunction(){
            var  filter, table, tr, td, i,lengthOfTable,eventTitle,txtValue;
            filter = document.getElementById('form1').value.toUpperCase();
            table = document.getElementById('eventsTable');
            tr = table.getElementsByTagName('tr');
            lengthOfTable=tr.length;
            debugger;
            for (i = 1; i < lengthOfTable; i++) {
                td = tr[i].getElementsByTagName("th");
                if (td) {
                    eventTitle  = td[0].innerText;
                    if (eventTitle.toUpperCase().indexOf(filter)>-1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <script>
        function status_change() {
            var x = document.getElementById("button_live");
            if (JSON.stringify(x) != "null") {
                document.getElementById("status").innerHTML = '<button type="submit" name="delete_event_btn" onclick="status_change()" class="btn btn-danger"> Delete</button>';
            } else {
                document.getElementById("status").innerHTML = '<button type="submit" id ="button_live" onclick="status_change()" class="btn btn-success">Live</button>';
            }
        }
    </script>
    <script>
        function eventfuvtion(str) {
            if (str.length == 0) {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "eventfuction.php?q=" + str, true);
                xmlhttp.send();
            }
        }
    </script>
    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->
</body>

</html>