<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/membership.css?v=<?php echo time(); ?>">
    <title>Database</title>
    <?php
    // Database Connection
    require_once "config.php";
    // To give warning or notification 
    function function_alert($message){
        echo "<SCRIPT>
                window.location.replace('database.php')
                alert('$message');
            </SCRIPT>";
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
   
    <header><h2 style="text-align: center;">Userdata</h2></header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark default-color sticky-top">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent-333">
            <form action="" method="get"></form>
			<ul class="navbar-nav mr-auto">
                <li class="nav-item">
					<a class="nav-link" href="index.php"><i class="fas fa-long-arrow-alt-left"></i>  Back</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="index.php"><i class="fas fa-home"></i>  Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="role.php"><i class="fas fa-user"></i> Role</a>
				</li>
			</ul>
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="input-group">
                    <input type="search"  onkeyup="myFunction()" id="myInput"placeholder="Search" class="form-control" />
                        <button id="search-button" type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
			</ul>
		</div>
	</nav>
    <!-- Navbar -->
    <table class="table" id="myTable">
        <thead class="table-head">
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
            <div  class="table-content" style="font-size: large;">
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
                                ";
                        //echo $sql;
                        $query = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($query) > 0) {
                            $index=0;
                            while ($row = mysqli_fetch_assoc($query)) {
                                $index++;
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
                                            <select name="role" id="<?php echo "role".$index; ?>" class="custom-select mb-3">
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
    <script>
        function myFunction(){
            var  filter, table, tr, td, i,txtValue,first_name,last_name,emailid,phone_number,branch,year,role;
            filter = document.getElementById('myInput').value.toUpperCase();
            table = document.getElementById('myTable');
            tr = table.getElementsByTagName('tr');
            debugger;
            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                if (td) {
                    first_name  =td[0].textContent || td[0].innerText;
                    last_name   =td[1].textContent || td[1].innerText;
                    emailid     =td[2].textContent || td[2].innerText;
                    phone_number=td[3].textContent || td[3].innerText;
                    branch      =td[4].textContent || td[4].innerText;
                    year        =td[5].textContent || td[5].innerText;
                    role        =document.getElementById('role'+i).value;
                    if (first_name.toUpperCase().indexOf(filter)>-1||last_name.toUpperCase().indexOf(filter)>-1||(first_name+" "+last_name).toUpperCase().indexOf(filter)>-1||
                    (last_name+" "+first_name).toUpperCase().indexOf(filter)>-1||emailid.toUpperCase().indexOf(filter)>-1||phone_number.toUpperCase().indexOf(filter)>-1||
                    branch.toUpperCase().indexOf(filter)>-1||year.toUpperCase().indexOf(filter)>-1||branch.toUpperCase().indexOf(filter)>-1||
                    (branch+" "+year).toUpperCase().indexOf(filter)>-1||(year+" "+branch).toUpperCase().indexOf(filter)>-1||role.toUpperCase().indexOf(filter)>-1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <div class="spacer" style="height:59px;"></div>
    <!-- Footer -->
    <div class="footer">
        <div class="spacer" style="height:2px;"></div>
        <a href="index.php"><i class="fas fa-home"></i></a>
        <div class="spacer" style="height:0px;"></div>
        <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
        <div class="spacer" style="height:1px;"></div>
    </div>
    <!-- Footer -->
    <!-- DO NOT DELETE THIS  -->
    <script src="plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="plugins/jquery-3.4.1.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
</body>

</html>