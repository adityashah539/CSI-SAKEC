<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/membership.css?v=<?php echo time(); ?>">
    <title>Expense</title>
    <?php
        require_once "config.php";
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if(isset($_POST['delete_bill'])){
                $expense_id=$_POST['expense_id'];
                $sql = "DELETE FROM `csi_expense` WHERE `id`='$expense_id'";
                $query = mysqli_query($conn, $sql);
                mysqli_query($conn, $sql);
            }
        }
    ?>
</head>

<body>
    <header>
        <h2 style="text-align: center;">Expense</h2>
    </header>
    <table class="table">
        <thead class="black white-text">
            <tr>
                <th scope="col">Expense for</th>
                <th>By</th>
                <th>Amount</th>
                <th>Bill</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <div class="table-content" style="font-size: large;">

                <?php
                    $event_id= $_GET['e_id'];
                    $sum=0;
                    $sql = "SELECT `id`,`spent_on`, `by` , `bill_photo`, `bill_amount` FROM `csi_expense` WHERE `event_id` = $event_id";
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                ?>
                        <tr>
                            <th scope="row"><?php echo $row['spent_on']; ?></th>
                            <td><?php echo $row['by']; ?></td>
                            <td>
                                <a target="_blank" href="<?php echo "Bill/".$row['bill_photo']; ?>">
                                    <img src="<?php echo "Bill/".trim($row['bill_photo']); ?>" alt="Forest" style="width:80px">
                                </a>
                            </td>
                            <td><?php $sum+=$row['bill_amount'];echo $row['bill_amount']; ?></td>
                            <td>
                            <?php 
                                if ($row['by']===$_SESSION['email']){
                            ?>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                    <input type="hidden" name="expense_id" value="<?php echo $row["id"]; ?>"/>
                                    <button type="submit" name="delete_bill" value="delete" class="btn btn-danger"> Delete</button>
                                </form>
                            <?php
                                }
                            ?>
                            </td>
                        </tr>
                    <?php
                        }
                        ?>
                    <th scope="row"> </th>
                    <td></td>
                    <td>Total : </td>
                    <td><?php echo $sum ?></td>
                <?php
                    } else {
                        echo "No Record Found";
                    }
                ?>
                    
            </div>
        </tbody>
    </table>
    <div class="spacer" style="height:30px;"></div>
    <div class="container text-center">
    <form action="addbill.php" method="get">
        <input type="hidden" name="e_id" value="<?php echo $event_id; ?>">
        <button type="submit" class="btn btn-primary" >Add Bill</button>
    </form> 
    </div>
    <div class="spacer" style="height:100px;"></div>

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