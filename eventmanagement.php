<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/membership.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <title>Manage Event</title>
    <?php
        require_once "config.php";
        function function_alert($message){
            echo"<SCRIPT>
                    window.location.replace('eventmanagement.php')
                    alert('$message');
                </SCRIPT>";
        }
        $to_search="";
        if(isset($_POST['search'])){
            $to_search = trim(strtolower($_POST['search']));
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if(isset($_POST['enable_id'])){
                $id=$_POST['enable_id'];
                $sql = "UPDATE event SET live='1' WHERE id='$id'";
                $query = mysqli_query($conn, $sql);
                mysqli_query($conn, $sql);
            }
            else if(isset($_POST['disable_id'])){
                $id=$_POST['disable_id'];
                $sql = "UPDATE event SET live='0' WHERE id='$id'";
                $query = mysqli_query($conn, $sql);
                mysqli_query($conn, $sql);
            }
            else if(isset($_POST['delete_event_btn']))
            {
                $id = $_POST['delete_id_event'];
                $sql = "DELETE FROM event WHERE id='$id' ";
                $query = mysqli_query($conn, $sql);
                if ($query) {
                    function_alert("Update Successful ");
                }else{
                    function_alert("Update Unsuccessful, Something went wrong.");
                }
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
					<a class="nav-link" href="index.php"><i class="fas fa-long-arrow-alt-left"></i>  Back</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="index.php"><i class="fas fa-home"></i>  Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="addevent.php"><i class="fas fa-calendar-plus"></i> Add Event</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="attendance.php"><i class="fas fa-users"></i> Attendance</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="permission.php"><i class="fas fa-envelope-open-text"></i> Permission Letter</a>
				</li>
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
    <table class="table">
        <thead class="table-head">
            <tr>
                <th scope="col">Title</th>
                <th>Event date</th>
                <th>Event time</th>
                <th>Event Description</th>
                <th>Fee for Members</th>
                <th>Fee for non-members</th>
                <th>Speaker</th>
                <th>Speaker Description</th>
                <th>Live</th>
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
                        $sql = "SELECT * FROM `event` WHERE LOWER(`title`) LIKE '%$to_search%' ";
                        $query = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $row['title']; ?></th>
                            <td>
                                <?php 
                                    if($row['e_from_date']!=$row['e_to_date']){
                                        echo date("d-m-Y",strtotime($row['e_from_date']))." to ".date("d-m-Y",strtotime($row['e_to_date']));
                                    }
                                    else{
                                        echo date("d-m-Y",strtotime($row['e_from_date']));
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                if($row['e_from_time']!=$row['e_to_time']){
                                    echo date("h:i",strtotime($row['e_from_time']))." to ".date("h:i",strtotime($row['e_to_time']));
                                }
                                else{
                                    echo date("h:i",strtotime($row['e_from_time']));
                                } 
                                ?>
                            </td>
                            <td>
                                <div id="summary">
                                    <p class="collapse" id="<?php echo 'collapseSummary'.$row['id'];?>"><?php echo $row['e_description']; ?></p>
                                    <a class="collapsed" data-toggle="collapse" href="<?php echo '#collapseSummary'.$row['id']; ?>" aria-expanded="false" aria-controls="collapseSummary"></a>
                                </div>
                            </td>
                            <td>&#8377;  <?php echo $row['fee_m']; ?></td>
                            <td>&#8377;  <?php echo $row['fee']; ?></td>
                            <td> <?php echo $row['s_name']; ?></td>
                            <td>
                                <div id="s-description">
                                    <p class="collapse" id="<?php echo 'collapseSummary'.$row['id'];?>"><?php echo $row['s_descripition']; ?></p>
                                    <a class="collapsed" data-toggle="collapse" href="<?php echo '#collapseSummary'.$row['id']; ?>"aria-expanded="false" aria-controls="collapseSummary"></a>
                                </div>
                            </td>
                        <?php
                        if($row['live']==1){
                            ?>
                                <td>
                                    <div id = "live" >
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                            <input type="hidden" name="disable_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="btn btn-success">Live</button>
                                        </form>
                                    </div>                             
                                </td>
                        <?php
                            }
                        else{
                            ?>
                                <td>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                        <input type="hidden" name="enable_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="btn btn-danger"> Disabled</button>
                                    </form>
                                </td>
                        <?php
                            }
                        ?>
                            <td>             
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                    <input type="hidden" name="delete_id_event" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="delete_event_btn" class="btn btn-danger"> Delete</button>
                                </form>
                            </td>
                <?php
                            }
                        } else {
                            echo "<td>No Record Found</td><td/><td/><td/><td/><td/><td/><td/><td/><td/>";
                        }
                    }else {
                        echo "<td>You need excess to see.</td><td/><td/><td/><td/><td/><td/><td/><td/><td/>";
                    }
                }else {
                    echo "<td>You have not logged in.</td><td/><td/><td/><td/><td/><td/><td/><td/><td/>";
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
        function status_change(){
            var x = document.getElementById("button_live");
            if(JSON.stringify(x)!="null"){
                document.getElementById("status").innerHTML='<button type="submit" name="delete_event_btn" onclick="status_change()" class="btn btn-danger"> Delete</button>';
            }
            else{
                document.getElementById("status").innerHTML='<button type="submit" id ="button_live" onclick="status_change()" class="btn btn-success">Live</button>';
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>