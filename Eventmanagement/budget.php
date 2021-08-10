<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/csi-logo.png">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="../css/membership.css?v=<?php echo time(); ?>">
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
					<a class="nav-link" href="../index.php"><i class="fas fa-home"></i>  Home</a>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto nav-flex-icons">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="input-group">
                        <input type="search"  onkeyup="SearchFunction()" id="form1" name="search" placeholder="Search" class="form-control" />
                        <button id="search-button"  type="submit" class="btn btn-primary">
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
        <tbody id="eventsTableBody">
            <!-- <div class="table-content" style="font-size: large;">    -->
        <?php
                require_once "../config.php";
                session_start();
                
                $access = 0;
                if (isset($_SESSION["role_id"])) {
                    $role_id = $_SESSION["role_id"];
                    $access = getSpecificValue("SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id", 'budget');
                }
                if ($access == 0) {
                    header("location:../index.php");
                }
                $query = execute("SELECT `id`, `title`  FROM `csi_event` ");
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        $id= $row['id'];
                        $title= $row['title'];
                        $expense_row=getValue("SELECT SUM( `bill_amount`) as `amount` FROM `csi_expense` WHERE `event_id`='$id' GROUP BY `event_id`");
                        $collection_row=getValue("SELECT SUM( `amount`)as `amount` FROM `csi_collection` WHERE `event_id`='$id' GROUP BY `event_id`");
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
                    <th scope="row" value = "<?php echo $title; ?>">
                        <?php echo $title; ?>
                    </th>
                    
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
                
            <!-- </div> -->
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
    <script>
        function SearchFunction(){
            var  inputValue, tablebody,noOfRows, tr, th, i,lengthOfTable,eventTitle,txtValue;
            inputValue = document.getElementById('form1').value.toUpperCase();
            tablebody = document.getElementById('eventsTableBody');
            noOfRows = tablebody.getElementsByTagName('tr');
            lengthOfTable=noOfRows.length;
            console.log(lengthOfTable);
            // debugger;
            for (i = 0; i < lengthOfTable; i++) {
                th = noOfRows[i].getElementsByTagName("th");
                console.log(th[0].innerHTML);
                if (th) {
                    eventTitle  = th[0].innerText ;
                    if (eventTitle.toUpperCase().indexOf(inputValue)>-1) {
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

</body>

</html>