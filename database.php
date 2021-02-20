<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="plugins/css/mdb.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="css/admin.css">
    <title>Database</title>
</head>
<body>
    <div class="spacer" style="height:10px;"></div>
    <header>
        <h2 style="text-align: center;">Userdata</h2>
    </header>
    <div class="spacer" style="height:5px;"></div>
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
                $sql = 'SELECT * FROM userdata';
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
                            <form action="update.php" method="post">
                                <td>
                                    <select name="role" class="custom-select mb-3">
                                        <?php
                                        if ($row['role'] == 'admin') {
                                            echo ' <option value="admin"selected>Admin</option>';
                                            echo ' <option value="c">Co-ordinator</option>';
                                            echo ' <option value="m">Member</option>';
                                            echo ' <option value="s">Student</option>';
                                        } else if ($row['role'] == 'c') {
                                            echo ' <option value="admin">Admin</option>';
                                            echo ' <option value="c" selected >Co-ordinator</option>';
                                            echo ' <option value="m">Member</option>';
                                            echo ' <option value="s">Student</option>';
                                        } else if ($row['role'] == 'm') {
                                            echo ' <option value="admin">Admin</option>';
                                            echo ' <option value="c">Co-ordinator</option>';
                                            echo ' <option value="m" selected >Member</option>';
                                            echo ' <option value="s">Student</option>';
                                        } else {
                                            echo ' <option value="admin">Admin</option>';
                                            echo ' <option value="c">Co-ordinator</option>';
                                            echo ' <option value="m">Member</option>';
                                            echo ' <option value="s" selected >Student</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="edit_btn" class="btn btn-success"> Update </button>
                                </td>
                            </form>
                            <td>
                                <form action="delete.php" method="post">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="delete_btn" class="btn btn-danger"> Delete</button>
                                </form>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "No Record Found";
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