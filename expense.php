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
    <title>Expense</title>
</head>

<body>
    <div class="spacer" style="height:10px;"></div>
    <header>
        <h2 style="text-align: center;">Expense</h2>
    </header>
    <div class="spacer" style="height:10px;"></div>
    <table class="table">
        <thead class="black white-text">
            <tr>
                <th scope="col">Expense for</th>
                <th>By</th>
                <th>Amount</th>
                <th>Bill</th>
                <!-- <th>Edit</th> -->
            </tr>
        </thead>
        <tbody>
            <div class="table-content" style="font-size: large;">

                <?php
                    require_once "config.php";
                    session_start();
                    $bi= $_GET['bi_e'];
                    $sum=0;
                    $sql = "SELECT `spent_on`, `by` , `bill_photo`, `bill_amount` FROM `expense` WHERE `buget_id` = $bi";
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
        <input type="hidden" name="bi_e" value="<?php echo $bi; ?>">
        <button type="submit" class="btn btn-primary" >Add Bill</button>
    </form> 
    </div>
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