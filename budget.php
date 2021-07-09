<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/membership.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
    <title>Budget</title>
</head>

<body>
    <header>
        <h2 style="text-align: center;">Budget</h2>
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
        <thead class="black white-text">
            <tr>
                <th scope="col">Title</th>
                <th>Collect</th>
                <th>Expense</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            <div class="table-content" style="font-size: large;">            
                <?php
                require_once "config.php";
                $sql = "SELECT `id`, `title`  FROM `csi_event` ";
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        $id= $row['id'];
                        $title= $row['title'];
                        $expense_sql="SELECT SUM( `bill_amount`) as `amount` FROM `csi_expense` WHERE `event_id`='$id' GROUP BY `event_id`";
                        $collection_sql="SELECT SUM( `amount`)as `amount` FROM `csi_collection` WHERE `event_id`='$id' GROUP BY `event_id`";
                        $expense_query = mysqli_query($conn, $expense_sql);
                        $collection_query = mysqli_query($conn, $collection_sql);
                        $expense_row=mysqli_fetch_assoc($expense_query);
                        $collection_row=mysqli_fetch_assoc($collection_query);
                        if(isset($expense_row['amount'])){ 
                            $expense=$expense_row['amount'];
                        }
                        else{
                            $expense=0;
                        }
                        if(isset($collection_row['amount'])){
                            $collection=$collection_row['amount'];
                        }
                        else{
                            $collection=0;
                        }
                        $balance = $collection-$expense;
                ?>
                <tr>
                    <td scope="row"><?php echo $title; ?></td>
                    <td>
                        <form action="collection.php" method="get">
                            <input type="hidden" name="e_id" value="<?php echo $id; ?>">
                            <button type="submit" class="btn btn-outline-dark"><?php echo $collection; ?></button>
                        </form>
                    </td>
                    <td>
                        <form action="expense.php" method="get">
                            <input type="hidden" name="e_id" value="<?php echo $id; ?>">
                            <button type="submit" class="btn btn-outline-dark"><?php echo $expense; ?></button>
                        </form>
                    </td>
                    <td>
                        <?php
                            if($balance>=0){
                        ?>
                                <button type="Button" class="btn btn-outline-success"><?php echo $balance; ?></button>
                        <?php
                            }
                            else{
                        ?>
                                <button type="Button" class="btn btn-outline-danger"><?php echo $balance; ?></button>
                        <?php 
                            }
                        ?>
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
    <div class="spacer" style="height:10px;"></div>
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