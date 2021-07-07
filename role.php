<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Basic -->
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
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
    <header><h2 style="text-align: center;">Role Management</h2></header>
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
					<a class="nav-link" href="addevent.php"><i class="fas fa-user-plus"></i> Add Role</a>
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
    <!-- Main -->
    <table class="table" id="myTable">
        <thead class="table-head">
            <tr>
                <th>Name</th>
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
                        $sql = "SELECT * FROM `role`";
                        $query = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($query) > 0) {
                            $index=0;
                            while ($row = mysqli_fetch_assoc($query)) {
                ?>
                                <tr>
                                    <td><?php echo ucfirst($row['role_name']); ?></td>
                                    <td>
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="delete_btn" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                <?php
                            }
                        } else {
                            echo "<td>No Record Found.</td><td/>";
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
    
    <!-- Main -->
    <!-- Spacer -->
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
    <!-- DO NOT DELETE THIS  -->
</body>

</html>