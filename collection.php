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
    <title>Collection</title>
    <?php
        require_once "config.php";
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if(isset($_POST['delete_bill'])){
                $collection_id=$_POST['collection_id'];
                $sql = "SELECT `bill_photo` FROM `collection` WHERE `id`='$collection_id'";
                $query = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($query);
                $folder_location="Event_Bill/";
                if(file_exists($folder_location.$row['bill_photo'])){
                    gc_collect_cycles();
                    unlink($folder_location.$row['bill_photo']);
                    $sql = "DELETE FROM `collection` WHERE `id`='$collection_id'";
                    $query = mysqli_query($conn, $sql);
                    mysqli_query($conn, $sql);
                }
                else{
                    echo "Unable to delete the photo.";
                }
            }
        }
    ?>
</head>

<body>
    <header>
        <h2 style="text-align: center;">Collection</h2>
    </header>
    <table class="table">
        <thead class="black white-text">
            <tr>
                <th scope="col">User</th>
                <th>Confirmed By</th>
                <th>Bill Photo</th>
                <th>Amount</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <div class="table-content" style="font-size: large;">
                <?php
                    $event_id= $_GET['e_id'];
                    $sum=0;
                    $sql = "SELECT `collection`.`id`,`userdata`.`emailID`, `bill_photo`, `amount`, `confirmed_by` FROM `collection`,`userdata` WHERE `confirmed`='1' AND `userdata`.`id`=`user_id` AND `event_id` = $event_id";
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                ?>
                        <tr>
                            <td><?php echo $row['emailID']; ?></td>
                            <td><?php echo $row['confirmed_by']; ?></td>
                            <td>
                                <?php
                                if(isset($row['bill_photo'])){
                                ?>
                                <a target="_blank" href="<?php echo "Event_Bill/".$row['bill_photo']; ?>">
                                    <img src="<?php echo "Event_Bill/".trim($row['bill_photo']); ?>" alt="Iamge not found, contact web dev" style="width:80px">
                                </a>
                                <?php
                                }else{
                                ?>
                                No Image
                                <?php
                                }
                                ?>
                            </td>
                            <td><?php $sum+=$row['amount'];echo $row['amount']; ?></td>
                            <td>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                    <input type="hidden" name="collection_id" value="<?php echo $row["id"]; ?>"/>
                                    <button type="submit" name="delete_bill" value="delete" class="btn btn-danger"> Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                        }
                        ?>
                    <tr>
                        <td/><td/>
                        <td>Total : </td>
                        <td><?php echo $sum ?></td>
                        <td/>
                    </tr>
                <?php
                    } else {
                        echo "No Record Found";
                    }
                ?>
                    
            </div>
        </tbody>
    </table>
    <div class="spacer" style="height:100px;"></div>
    <div class="footer">
        <div class="spacer" style="height:2px;"></div>
        <a href="index.php"><i class="fas fa-home"></i></a>
        <div class="spacer" style="height:2px;"></div>
        <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
        <div class="spacer" style="height:2px;"></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>