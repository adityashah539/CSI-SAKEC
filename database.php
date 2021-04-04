<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="plugins/css/mdb.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
    <title>Database</title>
    <?php
    require_once "config.php";
    function function_alert($message)
    {
        echo "<SCRIPT>
                window.location.replace('database.php')
                alert('$message');
            </SCRIPT>";
    }
    $to_search="";
    if(isset($_POST['search'])){
        $to_search = trim(strtolower($_POST['search']));
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['update_id'])) {
            $update_role = $_POST['role'];
            $sql = "SELECT `id` FROM `role` WHERE `role_name`='$update_role'";
            $query = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($query);
            $update_role = $row['id'];
            $id = $_POST['update_id'];
            $sql = "UPDATE userdata SET role='$update_role' WHERE id='$id'";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                function_alert("Update Successful ");
            } else {
                function_alert("Update was Unsuccessful, Something went wrong.");
            }
        }
        if (isset($_POST['delete_id'])) {
            $id = $_POST['delete_id'];
            $sql = "DELETE FROM userdata WHERE id='$id' ";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                function_alert("Update Successful ");
            } else {
                function_alert("Update was Unsuccessful, Something went wrong.");
            }
        }
    }
    ?>
</head>

<body>
    <div class="spacer" style="height:10px;"></div>
    <header>
        <h2 style="text-align: center;">Userdata</h2>

    </header>
    <div class="spacer" style="height:5px;"></div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="input-group">
            <div class="form-outline">
                <input type="search" id="form1" name = "search" class="form-control" autocomplete="off"/>
                <label class="form-label" for="form1">Search</label>
            </div>
            <button id="search-button" type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
    <table class="table">
        <thead class="black white-text">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email ID</th>
                <th>Phone Number</th>
                <th>Branch</th>
                <th>Class</th>
                <th>Role</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <div class="table-content" style="font-size: large;">
                <?php
                require_once "config.php";
                session_start();
                if (isset($_SESSION['email'])) {
                    if ($_SESSION['role'] === 'admin') {
                        $sql = "SELECT `role_name` FROM `role`";
                        $result = mysqli_query($conn, $sql);
                        $roles = array();
                        while ($row = mysqli_fetch_assoc($result)) {
                            $roles[] = $row['role_name'];
                        }
                        $sql = "SELECT `userdata`.`id`,`firstName`,`lastName`,`emailID`,`phonenumber`,`branch`,`class`,`role_name` FROM `userdata`  
                                INNER JOIN `role` 
                                ON `userdata`.`role`=`role`.`id` 
                                WHERE LOWER(`firstName`) LIKE '%$to_search%' OR LOWER(`lastName`) LIKE '%$to_search%' OR LOWER(CONCAT(`firstName`,' ', `lastName`))LIKE '%$to_search%' OR LOWER(CONCAT(`lastName`,' ', `firstName`))LIKE '%$to_search%' OR
                                      LOWER(`emailID`) LIKE '%$to_search%' OR `phonenumber` LIKE '%$to_search%' OR LOWER(`branch`) LIKE '%$to_search%' OR LOWER(`class`) LIKE '%$to_search%' OR
                                      LOWER(CONCAT(`branch`,' ', `class`)) LIKE '%$to_search%' OR LOWER(CONCAT(`class`,' ', `branch`)) LIKE '%$to_search%' OR LOWER(`role_name`) LIKE '%$to_search%'";
                        //echo $sql;
                        $query = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                ?>
                                <tr>
                                    <td><?php echo $row['firstName']; ?></td>
                                    <td><?php echo $row['lastName']; ?></td>
                                    <td><?php echo $row['emailID']; ?></td>
                                    <td><?php echo $row['phonenumber']; ?></td>
                                    <td><?php echo $row['branch']; ?></td>
                                    <td><?php echo $row['class']; ?></td>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <td>
                                            <select name="role" class="custom-select mb-3">
                                                <?php
                                                foreach ($roles as $role) {
                                                    if ($row['role_name'] == $role) {
                                                        echo ' <option value="' . $role . '" selected >' . ucfirst($role) . '</option>';
                                                    } else {
                                                        echo ' <option value="' . $role . '">' . ucfirst($role) . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="edit_btn" class="btn btn-success"> Update </button>
                                        </td>
                                    </form>
                                    <td>
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="delete_btn" class="btn btn-danger"> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                <?php
                            }
                        } else {
                            echo "<td>No Record Found.</td><td/><td/><td/><td/><td/><td/><td/><td/>";
                        }
                    } else {
                        echo "<td>You need excess to see.</td><td/><td/><td/><td/><td/><td/><td/><td/>";
                    }
                } else {
                    echo "<td>You have not logged in.</td><td/><td/><td/><td/><td/><td/><td/><td/>";
                }
                ?>
            </div>
        </tbody>
    </table>
    <div class="footer">
        <div class="spacer" style="height:2px;"></div>
        <a href="index.php"><i class="fas fa-home"></i></a>
        <div class="spacer" style="height:0px;"></div>
        <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
        <div class="spacer" style="height:1px;"></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>