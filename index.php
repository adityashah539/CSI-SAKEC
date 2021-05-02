<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
	<title>CSI-SAKEC</title>
	<?php

		session_start();
		require_once "config.php";
		if(isset($_COOKIE["email"])&&!isset($_SESSION['email'])){
			$email = $_COOKIE['email'];
			$password = $_COOKIE['password'];
			$sql = "SELECT emailID, password  FROM userdata WHERE emailID = ?";
			$stmt = mysqli_prepare($conn, $sql);
			mysqli_stmt_bind_param($stmt, 's', $param_email);
			$param_email = $email;
			if (mysqli_stmt_execute($stmt)) {
				mysqli_stmt_store_result($stmt);
				if (mysqli_stmt_num_rows($stmt) == 1) {
					mysqli_stmt_bind_result($stmt, $email, $hashed_Password);
					if (mysqli_stmt_fetch($stmt)) {
						if ($password === $hashed_Password) {
							$sql = "SELECT `role`.`role_name`  FROM `userdata` INNER JOIN `role` ON `userdata`.`role`=`role`.`id`WHERE `userdata`.`emailID` = '$email'";
							$result = mysqli_query($conn, $sql);
							$row = mysqli_fetch_assoc($result);
                            $_SESSION['email']=$email;
			                $_SESSION['role']=$row["role_name"];
						}
					}
				}
			}		
		}
		function function_alert($message){
			echo
				"<SCRIPT>
				window.location.replace('index.php')
				alert('$message');
			</SCRIPT>";
		}
		function send_mail($to_email, $subject, $body, $headers){
			if (mail($to_email, $subject, $body, $headers)) {
				function_alert("Email successfully sent to".$to_email."...");  
			} else {
				function_alert("Email sending failed..."); 
			}
		}
		//full form of abrevations are as follows
		// "Name_of_contact_person"  =  nocp
		// "Email_of_contact_person" =  eocp
		// "Msg_of_contact_person"  =  mocp 
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			if($_POST['email']!=null){
				$to_email =trim($_POST['email']) ;
			}
			else{
				$to_email = trim($_POST['eocp']);
			}
			$subject = "Acknowledgement from CSI to ".substr($to_email,0, strpos($to_email, "."))." ".substr($to_email,strpos($to_email, ".")+1, strpos($to_email, "_")-strpos($to_email, ".")+1);
			$body ="Hey Thankyou for contacting us this is to acknowledge you that we received your request and our coordinators will soon get in touch with you at the earliest possible , have a great day ";
			$headers = "From: guptavan96@gmail.com";
			$query= trim($_POST['mocp']);
			if(isset($to_email)){
				send_mail($to_email, $subject, $body, $headers);
				if(strpos($to_email, "@sakec.ac.in")||strpos($to_email, "@gmail.com")){
					$sql = "INSERT INTO query (c_email,c_query) VALUES ('$to_email','$query')";
					$stmt = mysqli_query($conn, $sql);
					function_alert("Msg has been deliverd."); 
				}else {
					function_alert("Pls enter the sakec's or your own emailid.");
				}
			}else {
				function_alert("Pls fill details properly.");
			}
		}
	?>
</head>
<body>
	<!-- Loader -->
	<div class="preloader">
		<div class="loader"></div>
	</div>
	<!--Navbar -->
	<nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color sticky-top">
		<a class="navbar-brand" href="#">
		<img class="invert"  src="images/sakec-logo.png"  alt="" >
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent-333">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href="#">Home
						<span class="sr-only">(current)</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#about">About Us</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#events">Events</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#ourteam">Our Team</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#gallery">Gallery</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#contact">Contact Us</a>
				</li>
				<?php
				if(isset($_SESSION['email'])){
					if ($_SESSION['role']==='admin') {
						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="database.php">Userdata</a>';
						echo '</li>';
						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="eventmanagement.php">Event Management</a>';
						echo '</li>';
						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="query.php">Query</a>';
						echo '</li>';
						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="log.php">Reply Log</a>';
						echo '</li>';
                        echo '<li class="nav-item">';
						echo '<a class="nav-link" href="budget.php">Budget</a>';
						echo '</li>';
						$_SESSION['var'] = 0;
						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="audit.php">Audit</a>';
						echo '</li>';
						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="confirmeventregistration.php">Confirm Event Registration</a>';
						echo '</li>';
						
					}
					else if($_SESSION['role']==='head coordinator')
					{
						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="database.php">Userdata</a>';
						echo '</li>';
						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="eventmanagement.php">Event Management</a>';
						echo '</li>';
						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="query.php">Query</a>';
						echo '</li>';
                        echo '<li class="nav-item">';
						echo '<a class="nav-link" href="budget.php">Budget</a>';
						echo '</li>';
					}
					else if($_SESSION['role']==='coordinator')
					{
						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="eventmanagement.php">Event Management</a>';
						echo '</li>';
						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="query.php">Query</a>';
						echo '</li>';
                        echo '<li class="nav-item">';
						echo '<a class="nav-link" href="budget.php">Budget</a>';
						echo '</li>';
					}
					else if($_SESSION['role']==='member')
					{
						
					} 
					else if($_SESSION['role']==='student')
					{
						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="membership.php">Membership</a>';
						echo '</li>';
					}
				}
				?>
			</ul>
			<ul class="navbar-nav ml-auto nav-flex-icons">
				<?php
				if (isset($_SESSION['email'])) {
					echo '<li class="nav-item">';
					echo '<a class="nav-link" href="">Email Id :'.$_SESSION['email'].' </a>';
					echo '</li>';
					echo '<li class="nav-item">';
					echo '<a class="nav-link" href="logout.php">Logout</a>';
					echo '</li>';
				} else {
					echo '<li class="nav-item">';
					echo '<a class="nav-link" href="login.php">Login</a>';
					echo '</li>';
					echo '<li class="nav-item">';
					echo '<a class="nav-link" href="signup.php">Sign up</a>';
					echo '</li>';
				}
				?>
			</ul>
		</div>
	</nav>
	<!-- Heading Section -->
	<header>
		<div id="home">
			<img class="rolling" src="images/logo.png" alt="">
			<!-- <img class="roll-support1" src="images/settings.png" alt="">
			<a href="#events"> <img class="rolling" src="images/settings.png" alt="events"></a>
			<img class="roll-support2" src="settings.png" alt=""> -->
			<h3>Building Techinical  Skills Professionally</h3>
		</div>
	</header>
	<br>
	<br>
	<br>
	<!-- log in   -->
	<!-- About Us -->
	<div id="about">
		<div class="container-fluid text-center">
			<h1 class=" h1-responsive font-weight-bold my-5">About Us</h1>
		<?php 
			if(isset($_SESSION['role'])&&($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'head coordinator'||$_SESSION['role'] === 'coordinator')){
				echo'<a href="about.php" class="btn btn-primary">Edit</a>';
			}
		?>
			
			<div class="spacer" style="height:60px;"></div>
			<div class="row">
				<div class="col-sm-6">
					<img class="aboutus" src="images/about.png" alt="">
				</div>
				<div class="col-sm-6">
					<div class="spacer" style="height:20px;"></div>
					<p>
						CSÌ SAKEC was formed in the year 2007. From then it
						has successively grown to one of the strongest student
						chapters of SAKEC. CS1 SAKEC has always lived upon
						its motto of:
						“BUILDING TECHNICAL SKILLS PROFESSIONALLY1’
						in the past, CS1 SAKEC has been conducting various
						workshops, seminars and visits with the help of
						technically sound students for the benefit of SAKEC as
						well as Non SAKEC students. Student Council of CS1
						SAKEC includes different teams such as Design,
						Treasury, Registration, Technical, Events,
						Documentation and Publicity. These teams collectively
						work for all the events conducted by CS1 SAKEC under
						the guidance of Staff Coordinators for the benefit of all
						the members.
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="spacer" style="height:170px;"></div>
	<!-- events -->
	<div class="container">
	<div id="events">

			<div class="row">
				<h1>
					Events
				</h1>
			</div>
			<hr class="line1">
			<div class="spacer" style="height:30px;"></div>
			<?php
                $sql = 'SELECT * FROM event';
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
						if($row['live']==1){
                		?>
							<div class="row">
								<div class="col-sm-4 date">
									<br>
									<p>
										<?php 
                                            if($row['e_from_date']==$row['e_to_date'])
                                                echo date("d-m-Y",strtotime($row['e_from_date'])); 
                                            else 
                                                echo date("d-m-Y",strtotime($row['e_from_date']))." to ".date("d-m-Y",strtotime($row['e_to_date']));
                                        ?>
									</p>
								</div>
								<div class="col-sm-8 event-details">
									<form action="event.php" method="GET">
										<input type="hidden" name="event_id" value="<?php echo $row['id']; ?>">
										<h2>
										<button type="submit"><?php echo $row['title']; ?></button>
										</h2>
									</form>
									<br>
									<p>
										<?php echo $row['e_description']; ?>
									</p>
								</div>
							</div>
			<?php
						}
					}
				}
			?>
		</div>
	</div>
	<div class="spacer" style="height:90px;"></div>
	<div id="ourteam">
		<section class="team-section text-center my-5">
			<h1 class="h1-responsive font-weight-bold my-5">Our amazing team </h1>
		<?php 
			if(isset($_SESSION['role'])&&($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'head coordinator'||$_SESSION['role'] === 'coordinator')){
				echo'<a href="addmember.php" class="btn btn-primary">Edit</a>';
			}
		?>	
			<p class="grey-text w-responsive mx-auto mb-5" style="font-size:20px">
				Student Council of CSI SAKEC includes different teams such as Design, Treasury, Registration, Technical, Events, Documentation and Publicity. These teams collectively work for all the events conducted by CS1 SAKEC under he guidance of Staff Coordinators for the benefit of all the members.
			</p>
			<div class="spacer" style="height:45px;"></div>
				<?php
					$sql = "SELECT * FROM `coordinator`";
					$query = mysqli_query($conn, $sql);
					$number_of_coordinator = mysqli_num_rows($query);
					while ($number_of_coordinator >= 3) { //executes while it can accomadate 3 colums in a row i.e. 3 students in a single row
				?>
				<div class="row text-center">
					<?php
						$count = 3;
						while ($row = mysqli_fetch_assoc($query)) { // executes each column
					?>
						<div class="col-md-4 mb-md-0 mb-5">
							<div class="avatar mx-auto"><img src="<?php echo "images/" . trim($row['image']); ?>" class="rounded z-depth-1-half" alt="Sample avatar"></div>
							<h4 class="font-weight-bold dark-grey-text my-4"><?php echo $row['name'];?></h4>
							<h6 class="text-uppercase grey-text mb-3"><strong><?php  echo $row['duty'];?></strong></h6>
							<div class="spacer" style="height:20px;"></div>
						</div>
					<?php
						//echo $rows.'<br>';
						$count--;
						if($count==0){ break;}
						}
						$number_of_coordinator -= 3;
					?>
				</div>
				<?php
					}
					if ($number_of_coordinator == 2) { //executes if 2 students in a single row i.e. last 2 students
				?>
				<div class="row">
					<div class="col-sm-2"></div>
					<?php
						while ($row = mysqli_fetch_assoc($query)) {
					?>
						<div class="col-md-4">
							<div class="avatar mx-auto"><img src="<?php echo "images/" . trim($row['image']); ?>" class="rounded z-depth-1-half" alt="Sample avatar"></div>
							<!--  name of the student members -->
							<h4 class="font-weight-bold dark-grey-text my-4"><?php echo $row['name'];?></h4>
							<!-- position of the student members -->
							<h6 class="text-uppercase grey-text mb-3"><strong><?php echo $row['duty'];?></strong></h6>
						</div>
				<?php
						}
				?>
				</div>
				<?php
					} 
					else if ($number_of_coordinator == 1) { //executes if 1 students in a single row i.e. last student
						$row = mysqli_fetch_assoc($query);
				?>
						<div class="row">
							<div class="col-sm-4"></div>
								<div class="col-md-4">
									<div class="avatar mx-auto"><img src="<?php echo "images/" . trim($row['image']); ?>" class="rounded z-depth-1-half" alt="Sample avatar"></div>
									<!-- // name of the student members -->
									<h4 class="font-weight-bold dark-grey-text my-4"><?php echo $row['name'];?></h4>
									<!-- // position of the student members -->
									<h6 class="text-uppercase grey-text mb-3"><strong><?php echo $row['duty'];?></strong></h6>
								</div>
								<div class="col-sm-4"></div>
							</div>
						</div>
						
				<?php
					}
				?>
	<div class="spacer" style="height:45px;"></div>
	<!-- Gallery -->
	<div class="container">
	<div id="gallery"> 
		<h1 class="h1-responsive">Gallery</h1>     
		<?php 
			if(isset($_SESSION['role'])&&($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'head coordinator'||$_SESSION['role'] === 'coordinator')){
				echo'<a href="gallery.php" class="btn btn-primary">Edit</a>';
			}
		?>
		<hr class="line1">
		<div class="spacer" style="height:30px;"></div>
		<div class="container-fluid text-center">
			<div class="row" >
				<div class="col-sm-12">
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<?php
								$gallerysql = "SELECT `image` FROM `gallery` WHERE `status`='1'";
								$gallerysqlstmt = mysqli_query($conn, $gallerysql);
								$number_of_images_gallery = mysqli_num_rows($gallerysqlstmt);
								for($i = 1;$i <= $number_of_images_gallery; $i++) {
							?>
									<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo ($i-1);?>" <?php if(($i-1)==0)echo 'class="active"';?>></li>
							<?php
								}
							?>
						</ol>
						<div class="carousel-inner">
							<?php
								for($i = 1;$i <= $number_of_images_gallery; $i++) {
									$row = mysqli_fetch_assoc($gallerysqlstmt)
							?>
									<div class="carousel-item <?php if(($i-1)==0) echo ' active';?>"><img class="d-block w-100" src="Gallery/<?php echo $row['image'];?>" alt="No Image"></div>
							<?php
								}
							?>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="spacer" style="height:15px;"></div>
	</div>
	</div>
	<div class="spacer" style="height:50px;"></div>
	<!-- Footer -->
	<div id="contact">
		<div class="footer">
			<div class="row">
				<div class="col-sm-6">
					<div class="spacer" style="height:110px;"></div>
					<div class="grid-container">
						<div class="grid-item item1">
							<h4>
								Important Links
							</h4>
							<ul class="list-group list-group-flush">
								<a class="list-group-item list-group-item-action" href="#">SAKEC</a>
								<a class="list-group-item list-group-item-action" href="#gallery">Gallery</a>
								<a class="list-group-item list-group-item-action" href="#events">Events</a>
								<a class="list-group-item list-group-item-action" href="#ourteam">Our Team</a>
							</ul>
						</div>
						<div class="grid-item item2">
							<div class="vl"></div>
						</div>
						<div class="grid-item item3">
							<div class="spacer" style="height:35px;"></div>
							<!-- <h4>
									Contacts
								</h4> -->
							<ul class="list-group list-group-flush">
								<li class="list-group-item list-group-item-action">Privacy Policy</li>
								<li class="list-group-item list-group-item-action">Terms</li>
								<li class="list-group-item list-group-item-action">Membership</li>
								<li type="button" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#basicExampleModal">Newsletter</li>
								<!-- Modal -->
								<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Subscribe now!</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<input type="email" class="form-control" placeholder="E-Mail" id="emailid">
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-primary">Subscribe</button>
											</div>
										</div>
									</div>
								</div>
							</ul>
						</div>
						<div class="grid-item item4">
							<h5>Stay tuned and follow us on social media for more updates!</h5>
							<hr class="hr1">
							<div class="social-sites">
								<a href="https://www.instagram.com/csisakec/"><img class="social" src="images/instagram.png" alt="instagram"></a>
								<a href="https://www.facebook.com/csisakec/photos"><img class="social" src="images/facebook.png" alt="facebook"></a>
								<a href="https://twitter.com/sakectweets?lang=en"><img class="social" src="images/twitter.png" alt="twitter"></a>
								<a href="https://www.linkedin.com/school/sakec"><img class="social" src="images/linkedin.png" alt="linkedin"></a>
								<a href="https://www.youtube.com/c/SAKECYouTubeChannel"><img class="social" src="images/youtube.png" alt="youtube"></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="jumbotron" >
						<!--"Email_of_contact_person" =  eocp "Msg_of_contact_person"  =  mocp -->
						<h2>Contact Us</h2>
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
							<?php
							if (isset($_SESSION['email'])&&isset($_SESSION['role'])) {
								echo '<input type="hidden" name="email" value="' . $_SESSION['email'] . '">';
							} else {
								echo '<label for="email"  >E-Mail</label> :';
								echo '<input name="eocp" required="required" type="email" class="form-control" placeholder="E-Mail" id="emailid"><br>';
							}
							echo '<label for="message">Message</label> :';
							echo '<textarea name="mocp" data-toggle="tooltip" required="required" data-placement="bottom" title="Any Queries? Write us " type="text-area" placeholder="Message" class="form-control" rows="5"></textarea>';
							?>
							<button type="submit" class="btn btn-primary  btn-block">Submit</button>
						</form>
					</div>
				</div>
			</div>
			<div class="spacer" style="height:30px;"></div>
			<div class="copyright" >
				<div class="spacer" style="height:8px;"></div>
				<a href="#"><i class="fas fa-home"></i></a>
				<div class="spacer" style="height:10px;"></div>
				<h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
				<div class="spacer" style="height:5px;"></div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script>
		setTimeout(function() {
			$('.preloader').fadeToggle();
		}, 1000);
		$(document).ready(function() {
			//image height
			var winHeight = $(window).height();
			var winHeightImg = $(window).height();
			$('header').css('height', winHeightImg);
		})
	</script>
	
</body>
</html>