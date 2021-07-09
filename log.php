<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <link rel="stylesheet" href="css/membership.css?v=<?php echo time(); ?>">
    <title>Replied queries</title>
</head>
<body>  
    <header>
    <h2 style="text-align: center;">Log of replied queries</h2>
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark default-color sticky-top">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent-333">
			<ul class="navbar-nav mr-auto">
                <li class="nav-item">
					<a class="nav-link" href="query.php"><i class="fas fa-long-arrow-alt-left"></i>  Back</a>
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
    <table class="table">
        <thead class="table-head">
            <tr>
                <th scope="col">Email ID</th>
                <th>Query</th>
                <th>Replied Mesaage</th>
                <th>Replied by</th>
                <th>DELETE</th>
            </tr>
        </thead>
        <tbody>
            <div class="table-content" style="font-size: large;">
                 <?php
                    require_once "config.php";
                    session_start();
                    if(isset($_SESSION["email"])){
                        if($_SESSION["role"]==='admin'){
                            $sql = 'SELECT * FROM csi_reply';
                            $query = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query) > 0) {
                                while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                    <td scope="row"><?php echo $row['c_email']; ?></td>
                    <td>
                        <div id="summary">
                            <p class="collapse" id="collapseSummary"><?php echo $row['c_query']; ?></p>
                            <a class="collapsed" data-toggle="collapse" href="#collapseSummary" aria-expanded="false"aria-controls="collapseSummary"></a>
                        </div>
                    </td>
                    <td>
                        <div id="summary">
                            <p class="collapse" id="replied"><?php echo $row['reply']; ?> </p>
                            <a class="collapsed" data-toggle="collapse" href="#replied" aria-expanded="false" aria-controls="collapseSummary"></a>
                        </div>
                    </td>
                    <td><?php echo $row['replied_by']; ?></td>
                    <td><button type="button" class="btn btn-danger">Delete</button></td>
                </tr>
                <?php
                    }
                } else {
                echo "No Record Found.";
                }
            }else {
                echo "You are not allowed.";
            }
        }else {
            echo "You need to Login.";
        }
                ?>
            </div>
        </tbody>
    </table>
    <div class="spacer" style="height:10px;"></div>
    <div class="footer">
        <div class="spacer" style="height:2px;"></div>
        <a href="index.php">
            <i class="fas fa-home"></i>
        </a> 
        <div class="spacer" style="height:0px;"></div>
        <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
        <div class="spacer" style="height:1px;"></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>