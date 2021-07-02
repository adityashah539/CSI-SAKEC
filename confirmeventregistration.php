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
    <title>Event Confirmation</title>
    <?php
        require_once "config.php";
        session_start();
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(isset($_POST['confirm_payment'])){
                $id = $_POST['budget_id'];
                $confirmedby = $_SESSION["email"];
                $sql = "UPDATE `collection` SET `confirmed`='1',`confirmed_by`='$confirmedby' WHERE id = '$id'";
                $query = mysqli_query($conn, $sql);
            }
            if(isset($_POST['delete_payment'])){
                $id = $_POST['budget_id'];
                $sql = "DELETE FROM `collection` WHERE id = '$id'";
                $query = mysqli_query($conn, $sql);
            }
        }
    ?>
</head>

<body>
    <div class="spacer" style="height:10px;"></div>
    <header>
        <h2 style="text-align: center;">Event Confirmation</h2>
    </header>
    <div class="spacer" style="height:10px;"></div>
    <table class="table">
        <thead class="black white-text">
            <tr>
                <th scope="col">Name</th>
                <th>Email ID</th>
                <th>Amount Paid</th>
                <th>Confirm</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <div class="table-content" style="font-size: large;">
            <?php
                if (isset($_SESSION['email'])) {
                    if ($_SESSION['role'] === 'admin') {
                        $sql = 
                        "SELECT `collection`.`id`,CONCAT(`firstName`,' ', `lastName`) as `name`,`userdata`.`emailID`,`collection`.`bill_photo`
                        FROM `event`,`userdata`,`collection` 
                        WHERE `collection`.`event_id`=`event`.`id` AND`collection`.`user_id`=`userdata`.`id` AND `confirmed`='0' ";
                        $query = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                    <th scope="row"><?php echo $row['name'];?></th>
                    <td><?php echo $row['emailID'];?></td>
                    <td>
                        <a target="_blank" href="Event_Bill/<?php echo $row['bill_photo'];?>">
                            <img src="Event_Bill/<?php echo $row['bill_photo'];?>" alt="No Image" style="width:80px"/>
                        </a>
                    </td>
                    <td>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <input type="hidden" name="budget_id" value="<?php echo $row['id']; ?>"/>
                            <button type="submit" value="confirm_payment" name ="confirm_payment" class="btn btn-success">Confirm</button>
                        </form> 
                    </td>
                    <td>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <input type="hidden" name="budget_id" value="<?php echo $row['id']; ?>"/>
                            <button type="submit" name="delete_payment"class="btn btn-danger" >Delete</button>
                        </form> 
                    </td>
                    
                </tr>
                <?php 
                            }
                        }
                    }
                }
                ?>
            </div>
        </tbody>
    </table>
    <div class="spacer" style="height:30px;"></div>
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