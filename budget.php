<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="plugins/css/mdb.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="css/admin.css">
    <title>Budget</title>
</head>

<body>
    <div class="spacer" style="height:10px;"></div>
    <header><h2 style="text-align: center;">Budget</h2></header>
    <div class="spacer" style="height:10px;"></div>
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
                $sql = "SELECT `budget`.`id`, `budget`.`collection`, `budget`.`expense`, `budget`.`balance` , `event`.`title`FROM `budget` INNER JOIN `event` ON `budget`.`event_id`=`event`.`id`";
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                    <td scope="row"><?php echo $row['title']; ?></td>
                    <td>
                        <form action="collection.php" method="get">
                            <input type="hidden" name="bi_c" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-outline-dark"><?php echo $row['collection']; ?></button>
                        </form>
                    </td>
                    <td>
                        <form action="expense.php" method="get">
                            <input type="hidden" name="bi_e" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-outline-dark"><?php echo $row['expense']; ?></button>
                        </form>
                    </td>
                    <td>
                        <?php
                            if($row['balance']<0){
                        ?>
                                <button type="Button" class="btn btn-outline-success"><?php echo $row['balance']; ?></button>
                        <?php
                            }
                            else{
                        ?>
                                <button type="Button" class="btn btn-outline-danger"><?php echo $row['balance']; ?></button>
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