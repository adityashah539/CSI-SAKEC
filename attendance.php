<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/attendance.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <title>Attentance</title>
    <?php
    require_once "config.php";
    function function_alert($message)
    {
        echo "<SCRIPT>
                    window.location.replace('eventmanagement.php')
                    alert('$message');
                </SCRIPT>";
    }
    $to_search = "";
    if (isset($_POST['search'])) {
        $to_search = trim(strtolower($_POST['search']));
    }
    ?>
</head>

<body>
    <header>
        <h2 style="text-align: center;">Attendance</h2>
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark default-color sticky-top">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent-333">
			<ul class="navbar-nav mr-auto">
                <li class="nav-item">
					<a class="nav-link" href="eventmanagement.php"><i class="fas fa-long-arrow-alt-left"></i>  Back</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php"><i class="fas fa-home"></i>  Home</a>
				
			</ul>
			<ul class="navbar-nav ml-auto nav-flex-icons">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="input-group">
                        <input type="search" id="form1" name="search" placeholder="Search" class="form-control" autocomplete="off"/>
                        <button id="search-button" type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
			</ul>
		</div>
	</nav>
    <table class="table" id="myTable">
        <thead class="table-head">
            <tr>
                <th scope="col">Event Name</th>
            </tr>
        </thead>
        <tbody>
            <div class="table-content" style="font-size: large;">
                <?php
                require_once "config.php";
                session_start();
                if (isset($_SESSION['email'])) {
                    if ($_SESSION['role'] === 'admin') {
                        $sql = "SELECT * FROM `event` WHERE LOWER(`title`) LIKE '%$to_search%' ";
                        $query = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                ?>
                                <tr>
                                    <td>
                                        <form action="edit_attendance.php" method="GET">
                                            <input type="hidden" name="event_id" value="<?php echo $row['id']; ?>">
                                            <input type="hidden" name="event_title" value="<?php echo $row['title']; ?>">
                                            <button type="submit" class="textbutton"><?php echo $row['title']; ?></button>
                                        </form>
                                    </td>
                                </tr>
                <?php
                            }
                        } else {
                            echo "<td>No Record Found</td>";
                        }
                    } else {
                        echo "<td>You need excess to see.</td>";
                    }
                } else {
                    echo "<td>You have not logged in.</td>";
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
    <script>
        function myFunction() {
            var filter, table, tr, td, i, eventname;
            filter = document.getElementById('myInput').value.toUpperCase();
            table = document.getElementById('myTable');
            tr = table.getElementsByTagName('tr');
            debugger;
            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                if (td) {
                    eventname = td[0].textContent || td[0].innerText;
                    if (eventname.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    
</body>

</html>