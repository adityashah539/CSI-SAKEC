<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Basic -->
    <link rel="icon" href="../images/csi-logo.png">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="../css/membership.css?v=<?php echo time(); ?>">
    <title>Database</title>
    <?php
    // Database Connection
    require_once "../config.php";
    session_start();

    $role = NULL;
    if (isset($_SESSION["role_id"])) {
        $role_id = $_SESSION["role_id"];
        $sql = "SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id";
        $query =  mysqli_query($conn, $sql);
        $role = mysqli_fetch_assoc($query);
    }
    ?>
</head>

<body>
    <header>
        <h2 style="text-align: center;">Role Management</h2>
    </header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark default-color sticky-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
            <form action="" method="get"></form>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addrole.php"><i class="fas fa-user-plus"></i> Add Role</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="input-group">
                        <input type="search" onkeyup="SearchFunction()" id="userInput" placeholder="Search" class="form-control" />
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
    <div id="allEvent" class="table-content" style="font-size: large;">
        <table class="table" id="roleTable">
            <thead class="table-head">
                <tr>
                    <th>Name</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    if (isset($_SESSION['email'])) {
                        if (isset($role) && $role["role"] === "1") {
                            $sql = "SELECT * FROM `csi_role`";
                            $query = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query) > 0) {
                                $index = 0;
                                while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                                    <tr>
                                        <td>
                                            <form action="edit_role.php" method="get">
                                                <input type="hidden" name="role_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" class="textbutton">
                                                    <?php echo ucfirst($row['role_name']); ?>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <button type="submit" name="delete_btn" value="<?php echo $row['id'] ?>" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                    <?php
                                }
                            } else {
                                echo "<td>No Record Found.</td><td/>";
                            }
                        } else {
                            header("location:../index.php");
                        }
                    } else {
                        header("../Login/login.php?notlogin=true");
                    }
                    ?>
            </tbody>
        </table>
    </div>
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
    <script>
        function SearchFunction(){
            var  inputValue, tablebody,noOfRows, tr, th, i,lengthOfTable,role,txtValue;
            inputValue = document.getElementById('userInput').value.toUpperCase();
            tablebody = document.getElementById('roleTable');
            noOfRows = tablebody.getElementsByTagName('tr');
            lengthOfTable=noOfRows.length;
            console.log(lengthOfTable);
            //debugger;
            for (i = 1; i < lengthOfTable; i++) {
                th = noOfRows[i].getElementsByTagName("td");
                console.log(th[0].innerHTML);
                if (th) {
                    role  = th[0].innerText ;
                    if (role.toUpperCase().indexOf(inputValue)>-1) {
                        noOfRows[i].style.display = "";
                    } else {
                        noOfRows[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->
    <script>
        $(document).ready(function() {
            $(document).on('click',"button[name='delete_btn']",function() {
                $("#allEvent").load("deleteRole.php", {
                    role_id: $(this).val()
                });
            });
        });
    </script>
</body>

</html>