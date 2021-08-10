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
    <title>Collection</title>
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
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if(isset($_POST['delete_bill'])){
                $collection_id=$_POST['collection_id'];
                $row = getValue("SELECT `bill_photo` FROM `csi_collection` WHERE `id`='$collection_id'");
                $folder_location="Event_Bill/";
                if(file_exists($folder_location.$row['bill_photo'])){
                    gc_collect_cycles();
                    unlink($folder_location.$row['bill_photo']);
                    $query = execute("DELETE FROM `csi_collection` WHERE `id`='$collection_id'");
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
                    $query = execute("SELECT `csi_collection`.`id`,`csi_userdata`.`emailID`, `bill_photo`, `amount`, `confirmed_by` FROM `csi_collection`,`csi_userdata` WHERE `confirmed`='1' AND `csi_userdata`.`id`=`user_id` AND `event_id` = $event_id");
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
                        <td><?php echo $sum;?></td>
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
    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->

</body>

</html>