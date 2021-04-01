<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="plugins/css/mdb.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
	<title>CSI-SAKEC</title>
	<?php
		session_start();
		require_once "config.php";
		$loggedin=false;
		$email=null;	
		$role=null;
		$id=null;
		if(isset($_COOKIE["email"])&&!isset($_SESSION['id']))
		{
			$email = $_COOKIE['email'];
			$password = $_COOKIE['password'];
			$sql = "SELECT emailID, password  FROM userdata WHERE emailID = ?";
			$stmt = mysqli_prepare($conn, $sql);
			mysqli_stmt_bind_param($stmt, 's', $param_email);
			$param_email = $email;
			// Try to execute this statement
			if (mysqli_stmt_execute($stmt)) {
				mysqli_stmt_store_result($stmt);
				if (mysqli_stmt_num_rows($stmt) == 1) {
					mysqli_stmt_bind_result($stmt, $email, $hashed_Password);
					if (mysqli_stmt_fetch($stmt)) {
						//echo $hashed_Password . " " . $password;
						if ($password === $hashed_Password) {
							// this means the password is corrct. Allow user to login
							$sql = "SELECT role,id  FROM userdata WHERE emailID = '$email'";
							$result = mysqli_query($conn, $sql);
							$row = mysqli_fetch_assoc($result);
							$role = $row["role"];
							$id = $row["id"];
							$loggedin=true;
                            $_SESSION['email']=$email;
			                $_SESSION['role']=$role;
			                $_SESSION['id']=$id;
						}else{
							$email=null;	
						}
					}
				}
			}		
		}
		else if(isset($_SESSION['id'])){	
			$loggedin=true;
			$email=$_SESSION['email'];
			$role=$_SESSION['role'];
			$id = $_SESSION['id'];
		}
		unset($_SESSION['id']);
		function send_mail($to_email, $subject, $body, $headers)
		{
			if (mail($to_email, $subject, $body, $headers)) {
				echo "Email successfully sent to $to_email...";
			} else {
				echo "Email sending failed...";
			}
		}
		function function_alert($message)
		{
			echo
				"<SCRIPT>
				window.location.replace('index.php')
				alert('$message');
			</SCRIPT>";
		}
		//full form of abrevations are as follows
		// "Name_of_contact_person"  =  nocp
		// "Email_of_contact_person" =  eocp
		// "Msg_of_contact_person"  =  mocp 
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			//$body = $_POST['mocp'];
			$body ="Hey Thankyou for contacting us this is to acknowledge you that we received your request and our coordinators will soon get in touch with you at the earliest possible , have a great day ";
			$headers = "From: guptavan96@gmail.com";
			if($_POST['contact_us_email']!=null){
				$to_email =trim($_POST['contact_us_email']) ;
			}
			else{
				$to_email = trim($_POST['eocp']);
			} 
			$msg= trim($_POST['mocp']);
			$n=strpos($to_email, ".")+1;
			$subject = "Acknowledgement from CSI to ".substr($to_email,0, strpos($to_email, "."))." ".substr($to_email,$n, strpos($to_email, "_")-$n);
			if(isset($_POST['contact_us_email'])&&isset($_POST['contact_us_email'])){
			//send_mail($to_email, $subject, $body, $headers);
				if(strpos($to_email, "@sakec.ac.in")||strpos($to_email, "@gmail.com")){
					$sql = "INSERT INTO query (c_email,c_query) VALUES ('$to_email','$msg')";
					$stmt = mysqli_query($conn, $sql);
					function_alert("Msg has been deliverd."); 
					mysqli_close($conn);
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
				if($loggedin){
					
					if ($role==='admin') {
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
					}
					else if(($role==='c'))
					{
						// echo '<li class="nav-item">';
						// echo '<a class="nav-link" href="loggedinmembership.html">Membership</a>';
						// echo '</li>';
						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="query.php">Query</a>';
						echo '</li>';
					}
					else if(($role==='m'))
					{
						// echo '<li class="nav-item">';
						// echo '<a class="nav-link" href="loggedinmembership.html">Membership</a>';
						// echo '</li>';
					} 
					else if(($role==='s'))
					{
						echo '<li class="nav-item">';
						echo '<a class="nav-link" href="membership.php">Membership</a>';
						echo '</li>';
					}
					else 
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
				if ($loggedin) {
					echo '<li class="nav-item">';
					echo '<a class="nav-link" href="">Email Id :' . $email . ' </a>';
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
	<div id="events">
		<div class="container">
			<div class="spacer" style="height:50px;"></div>
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
									<form action="event.php" method="post">
										<input type="hidden" name="id_event" value="<?php echo $row['id']; ?>">
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
		<!-- Section: Team v.2 -->
		<section class="team-section text-center my-5">
			<!-- Section heading -->
			<h1 class="h1-responsive font-weight-bold my-5">Our amazing team</h1>
			<!-- Section description -->
			<p class="grey-text w-responsive mx-auto mb-5" style="font-size:20px">Student Council of CS1
				SAKEC includes different teams such as Design,
				Treasury, Registration, Technical, Events,
				Documentation and Publicity. These teams collectively
				work for all the events conducted by CS1 SAKEC under
				the guidance of Staff Coordinators for the benefit of all
				the members.</p>
			<div class="spacer" style="height:45px;"></div>
			<!-- Grid row -->
			<div class="row text-center">

				<!-- Grid column -->
				<div class="col-md-4 mb-md-0 mb-5">
					<div class="avatar mx-auto">
						<img src="images/Dhruvi-jain.jpg" class="rounded z-depth-1-half" alt="Sample avatar">
					</div>
					<h4 class="font-weight-bold dark-grey-text my-4">Dhruvi Jain</h4>
					<h6 class="text-uppercase grey-text mb-3"><strong>GENERAL SECRETARY</strong></h6>
					<!-- Facebook-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-fb">
						<img class="social" src="images/instagram.png" alt="instagram">

					</a>
					<!--Dribbble -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-dribbble">
						<img class="social" src="images/facebook.png" alt="facebook">
					</a>
					<!-- Twitter -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-tw">
						<img class="social" src="images/twitter.png" alt="twitter">
					</a>
				</div>
				<!-- Grid column -->

				<!-- Grid column -->
				<div class="col-md-4 mb-md-0 mb-5">
					<div class="avatar mx-auto">
						<img src="images/Yukta Lapsiya.jpg" class="rounded z-depth-1-half" alt="Sample avatar">
					</div>
					<h4 class="font-weight-bold dark-grey-text my-4">Yukta Lapsiya</h4>
					<h6 class="text-uppercase grey-text mb-3"><strong>GENERAL COORDINATOR</strong></h6>
					<!--Email-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-email">
						<img class="social" src="images/instagram.png" alt="instagram">
					</a>
					<!-- Facebook-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-fb">
						<img class="social" src="images/facebook.png" alt="facebook">
					</a>
					<!-- GitHub-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-git">
						<img class="social" src="images/twitter.png" alt="twitter">
					</a>
				</div>
				<!-- Grid column -->

				<!-- Grid column -->
				<div class="col-md-4">
					<div class="avatar mx-auto">
						<img src="images/Pratik-upadhyaya.jpg" class="rounded z-depth-1-half" alt="Sample avatar">
					</div>
					<h4 class="font-weight-bold dark-grey-text my-4">Pratik upadhyay</h4>
					<h6 class="text-uppercase grey-text mb-3"><strong>STUDENT COORDINATOR</strong></h6>
					<!--Linkedin -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-li">
						<img class="social" src="images/instagram.png" alt="instagram">
					</a>
					<!-- Twitter -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-tw">
						<img class="social" src="images/facebook.png" alt="facebook">
					</a>
					<!--Pinterest -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-pin">
						<img class="social" src="images/twitter.png" alt="twitter">
					</a>
				</div>
				<!-- Grid column -->

			</div>
			<!-- Grid row -->
			<div class="spacer" style="height:120px;"></div>
			<div class="row text-center">

				<!-- Grid column -->
				<div class="col-md-4 mb-md-0 mb-5">
					<div class="avatar mx-auto">
						<img src="images/Aagam-sheth.jpeg" class="rounded z-depth-1-half" alt="Sample avatar">
					</div>
					<h4 class="font-weight-bold dark-grey-text my-4">Aagam Sheth</h4>
					<h6 class="text-uppercase grey-text mb-3"><strong>Events Team Head</strong></h6>

					<!-- Facebook-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-fb">
						<img class="social" src="images/instagram.png" alt="instagram">

					</a>
					<!--Dribbble -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-dribbble">
						<img class="social" src="images/facebook.png" alt="facebook">
					</a>
					<!-- Twitter -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-tw">
						<img class="social" src="images/twitter.png" alt="twitter">
					</a>
				</div>
				<!-- Grid column -->

				<!-- Grid column -->
				<div class="col-md-4 mb-md-0 mb-5">
					<div class="avatar mx-auto">
						<img src="images/Krutik-patel.jpg" class="rounded z-depth-1-half" alt="Sample avatar">
					</div>
					<h4 class="font-weight-bold dark-grey-text my-4">Krutik Patel</h4>
					<h6 class="text-uppercase grey-text mb-3"><strong>EVENTS TEAM CO-HEAD</strong></h6>
					<!--Email-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-email">
						<img class="social" src="images/instagram.png" alt="instagram">
					</a>
					<!-- Facebook-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-fb">
						<img class="social" src="images/facebook.png" alt="facebook">
					</a>
					<!-- GitHub-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-git">
						<img class="social" src="images/twitter.png" alt="twitter">
					</a>
				</div>
				<!-- Grid column -->

				<!-- Grid column -->
				<div class="col-md-4">
					<div class="avatar mx-auto">
						<img src="images/Preet-karia.jpg" class="rounded z-depth-1-half" alt="Sample avatar">
					</div>
					<h4 class="font-weight-bold dark-grey-text my-4">Preet Karia</h4>
					<h6 class="text-uppercase grey-text mb-3"><strong>TECHNICAL TEAM HEAD</strong></h6>
					<!--Linkedin -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-li">
						<img class="social" src="images/instagram.png" alt="instagram">
					</a>
					<!-- Twitter -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-tw">
						<img class="social" src="images/facebook.png" alt="facebook">
					</a>
					<!--Pinterest -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-pin">
						<img class="social" src="images/twitter.png" alt="twitter">
					</a>
				</div>
				<!-- Grid column -->
			</div>
			<div class="spacer" style="height:120px;"></div>
			<!-- Grid row -->
			<div class="row text-center">


				<!-- Grid column -->
				<div class="col-md-4 mb-md-0 mb-5">
					<div class="avatar mx-auto">
						<img src="images/Rutvik-dashpande.jpg" class="rounded z-depth-1-half" alt="Sample avatar">
					</div>
					<h4 class="font-weight-bold dark-grey-text my-4">Rutvik Deshpande</h4>
					<h6 class="text-uppercase grey-text mb-3"><strong>technical team CO-HEAD</strong></h6>
					<!-- Facebook-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-fb">
						<img class="social" src="images/instagram.png" alt="instagram">

					</a>
					<!--Dribbble -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-dribbble">
						<img class="social" src="images/facebook.png" alt="facebook">
					</a>
					<!-- Twitter -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-tw">
						<img class="social" src="images/twitter.png" alt="twitter">
					</a>
				</div>
				<!-- Grid column -->

				<!-- Grid column -->
				<div class="col-md-4 mb-md-0 mb-5">
					<div class="avatar mx-auto">
						<img src="images/Ritik Mahajan.jpg" class="rounded z-depth-1-half" alt="Sample avatar">
					</div>
					<h4 class="font-weight-bold dark-grey-text my-4">Ritik Mahajan</h4>
					<h6 class="text-uppercase grey-text mb-3"><strong>publicity team head</strong></h6>
					<!--Email-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-email">
						<img class="social" src="images/instagram.png" alt="instagram">
					</a>
					<!-- Facebook-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-fb">
						<img class="social" src="images/facebook.png" alt="facebook">
					</a>
					<!-- GitHub-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-git">
						<img class="social" src="images/twitter.png" alt="twitter">
					</a>
				</div>
				<!-- Grid column -->

				<!-- Grid column -->
				<div class="col-md-4">
					<div class="avatar mx-auto">
						<img src="images/Ridhhi-dagha.jpeg" class="rounded z-depth-1-half" alt="Sample avatar">
					</div>
					<h4 class="font-weight-bold dark-grey-text my-4">Ridhi Dagha</h4>
					<h6 class="text-uppercase grey-text mb-3"><strong>REGISTRATION AND TREASURE TEAM treasurer</strong></h6>
					<!--Linkedin -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-li">
						<img class="social" src="images/instagram.png" alt="instagram">
					</a>
					<!-- Twitter -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-tw">
						<img class="social" src="images/facebook.png" alt="facebook">
					</a>
					<!--Pinterest -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-pin">
						<img class="social" src="images/twitter.png" alt="twitter">
					</a>
				</div>
				<!-- Grid column -->

			</div>
			<!-- Grid row -->
			<div class="spacer" style="height:120px;"></div>
			<!-- Grid row -->
			<div class="row text-center">

				<!-- Grid column -->
				<div class="col-md-4 mb-md-0 mb-5">
					<div class="avatar mx-auto">
						<img src="images/Shalini-gund.jpg" class="rounded z-depth-1-half" alt="Sample avatar">
					</div>
					<h4 class="font-weight-bold dark-grey-text my-4">Shalin Gund</h4>
					<h6 class="text-uppercase grey-text mb-3"><strong>REGISTRATION AND TREASURE TEAM head1</strong></h6>
					<!-- Facebook-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-fb">
						<img class="social" src="images/instagram.png" alt="instagram">
					</a>
					<!--Dribbble -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-dribbble">
						<img class="social" src="images/facebook.png" alt="facebook">
					</a>
					<!-- Twitter -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-tw">
						<img class="social" src="images/twitter.png" alt="twitter">
					</a>
				</div>
				<!-- Grid column -->

				<!-- Grid column -->
				<div class="col-md-4 mb-md-0 mb-5">
					<div class="avatar mx-auto">
						<img src="images/Simran-jindal.jpg" class="rounded z-depth-1-half" alt="Sample avatar">
					</div>
					<h4 class="font-weight-bold dark-grey-text my-4">Simran Jindal</h4>
					<h6 class="text-uppercase grey-text mb-3"><strong>REGISTRATION AND TREASURE TEAM head1</strong></h6>
					<!--Email-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-email">
						<img class="social" src="images/instagram.png" alt="instagram">
					</a>
					<!-- Facebook-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-fb">
						<img class="social" src="images/facebook.png" alt="facebook">
					</a>
					<!-- GitHub-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-git">
						<img class="social" src="images/twitter.png" alt="twitter">
					</a>
				</div>
				<!-- Grid column -->

				<!-- Grid column -->
				<div class="col-md-4">
					<div class="avatar mx-auto">
						<img src="images/Zarana-desai.jpg" class="rounded z-depth-1-half" alt="Sample avatar">
					</div>
					<h4 class="font-weight-bold dark-grey-text my-4">Zarana Desai</h4>
					<h6 class="text-uppercase grey-text mb-3"><strong>Documentation team head</strong></h6>
					<!--Linkedin -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-li">
						<img class="social" src="images/instagram.png" alt="instagram">
					</a>
					<!-- Twitter -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-tw">
						<img class="social" src="images/facebook.png" alt="facebook">
					</a>
					<!--Pinterest -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-pin">
						<img class="social" src="images/twitter.png" alt="twitter">
					</a>
				</div>
				<!-- Grid column -->
			</div>
			<!-- Grid row -->
			<div class="spacer" style="height:120px;"></div>
			<!-- Grid row -->
			<div class="row text-center">

				<!-- Grid column -->
				<div class="col-md-4 mb-md-0 mb-5">
					<div class="avatar mx-auto">
						<img src="images/Parth-panchal.jpg" class="rounded z-depth-1-half" alt="Sample avatar">
					</div>
					<h4 class="font-weight-bold dark-grey-text my-4">Parth Panchal</h4>
					<h6 class="text-uppercase grey-text mb-3"><strong>design team head1</strong></h6>
					<!-- Facebook-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-fb">
						<img class="social" src="images/instagram.png" alt="instagram">

					</a>
					<!--Dribbble -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-dribbble">
						<img class="social" src="images/facebook.png" alt="facebook">
					</a>
					<!-- Twitter -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-tw">
						<img class="social" src="images/twitter.png" alt="twitter">
					</a>
				</div>
				<!-- Grid column -->

				<!-- Grid column -->
				<div class="col-md-4 mb-md-0 mb-5">
					<div class="avatar mx-auto">
						<img src="images/Atharva Juikar.jpg" class="rounded z-depth-1-half" alt="Sample avatar">
					</div>
					<h4 class="font-weight-bold dark-grey-text my-4">Atharva Juikar</h4>
					<h6 class="text-uppercase grey-text mb-3"><strong>design team head2</strong></h6>
					<!--Email-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-email">
						<img class="social" src="images/instagram.png" alt="instagram">
					</a>
					<!-- Facebook-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-fb">
						<img class="social" src="images/facebook.png" alt="facebook">
					</a>
					<!-- GitHub-->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-git">
						<img class="social" src="images/twitter.png" alt="twitter">
					</a>
				</div>
				<!-- Grid column -->

				<!-- Grid column -->
				<div class="col-md-4">
					<div class="avatar mx-auto">
						<img src="images/Bhavika-salshingikar.jpg" class="rounded z-depth-1-half" alt="Sample avatar">
					</div>
					<h4 class="font-weight-bold dark-grey-text my-4">Bhavika Salshingikar</h4>
					<h6 class="text-uppercase grey-text mb-3"><strong>Design team co-head1</strong></h6>
					<!--Linkedin -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-li">
						<img class="social" src="images/instagram.png" alt="instagram">
					</a>
					<!-- Twitter -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-tw">
						<img class="social" src="images/facebook.png" alt="facebook">
					</a>
					<!--Pinterest -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-pin">
						<img class="social" src="images/twitter.png" alt="twitter">
					</a>
				</div>
				<!-- Grid column -->
			</div>
			<!-- Grid row -->
			<div class="spacer" style="height:120px;"></div>
			<div class="row">
				<div class="col-sm-4"></div>
				<!-- Grid column -->
				<div class="col-md-4">
					<div class="avatar mx-auto">
						<img src="images/Ritika-boricha.jpg" class="rounded z-depth-1-half" alt="Sample avatar">
					</div>
					<h4 class="font-weight-bold dark-grey-text my-4">Ritika Boricha</h4>
					<h6 class="text-uppercase grey-text mb-3"><strong>Design team co-head2</strong></h6>
					<!--Linkedin -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-li">
						<img class="social" src="images/instagram.png" alt="instagram">
					</a>
					<!-- Twitter -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-tw">
						<img class="social" src="images/facebook.png" alt="facebook">
					</a>
					<!--Pinterest -->
					<a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-pin">
						<img class="social" src="images/twitter.png" alt="twitter">
					</a>
				</div>
				<!-- Grid column -->
				<div class="col-sm-4"></div>
			</div>
			<div class="spacer" style="height:90px;"></div>
		</section>
		<!-- Section: Team v.2 -->
	</div>
	<!-- Gallery -->
	<div id="gallery"  style="background-color:black">
	<div class="spacer" style="height:50px;"></div>
	
		<h1 class="h1-responsive">Gallery</h1>
		<hr class="line1">
		<div class="spacer" style="height:30px;"></div>
		<div class="container-fluid text-center">
			<div class="row" >
			
				<div class="col-sm-12">
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img class="d-block w-100" src="images/gal-4.jpg" alt="First slide">
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" src="images/gal-2.jpg" alt="Second slide">
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" src="images/gal-3.jpg" alt="Third slide">
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" src="images/gal-1.jpg" alt="ourth slide">
							</div>
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
	<!-- Footer -->
	<div id="contact">
		<div class="footer" style="background-color: #edf9ff">
			<div class="row" >
				<div class="col-sm-6">
					<div class="spacer" style="height:110px;"></div>
					<div class="grid-container" >
						<div class="grid-item item1">
							<h4>
								Important Links
							</h4>
							<ul class="list-group list-group-flush" >
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
				<!-- <div class="container" id="ff-compose"></div> -->
				<div class="col-sm-5">
					<div class="jumbotron" style="background-color: #c4d6e0">
					<!--"Name_of_contact_person"  =  nocp
					    "Email_of_contact_person" =  eocp
						"Msg_of_contact_person"  =  mocp -->
						<h2>Contact Us</h2>
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
							<?php
								echo '<input type="hidden" name="contact_us_email" value="'.$email.'">';
								if($loggedin){
									echo '<label for="message"> Message </label> :';
									echo '<textarea name="mocp" data-toggle="tooltip" required="required" data-placement="bottom" title="Any Queries? Write us " type="text-area" placeholder="Message" class="form-control" rows="5"></textarea>';
								}
								else{
									// echo '<label for="name" >Name</label> :';
									// echo '<input name="nocp" required="required" type="name" placeholder="Name" class="form-control"><br>';
									echo '<label for="email"  >E-Mail</label> :';
									echo '<input name="eocp" required="required" type="email" class="form-control" placeholder="E-Mail" id="emailid"><br>';
									echo '<label for="message">Message</label> :';
									echo '<textarea name="mocp" data-toggle="tooltip" required="required" data-placement="bottom" title="Any Queries? Write us " type="text-area" placeholder="Message" class="form-control" rows="5"></textarea>';
								}
							?>
							<button type="submit" class="btn btn-primary  btn-block">Submit</button>
						</form>
					</div>
				</div>
			</div>
			<div class="spacer" style="height:30px;"></div>
			<div class="copyright" style="background-color: #c4d6e0">
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