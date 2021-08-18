<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/csi-logo.png">
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="../css/membership.css?v=<?php echo time(); ?>">
    
    <title>Confirm Membership</title>
    <?php 
        require_once "../config.php";
        session_start();
        // Fetching Access Details
        $access = NULL;
        if (isset($_SESSION["role_id"])) {
            $role_id = $_SESSION["role_id"];
            $access = getValue( "SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id");
        }
        if($access['confirm_membership']==0){
            header("location:../index.php");
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
            $id = $_POST['id'];
            $user_id = $_POST['user_id'];
            if (isset($_POST['Confirm'])) {
                $member_period = $_POST['member_period'];
                $membership_id = $_POST['membership_id'];
                $membership_taken = $_POST['membership_taken'];
                $duration = date("Y-m-d", strtotime(date("Y-m-d", strtotime($membership_taken)) . " + $member_period year"));
                execute("UPDATE `csi_membership` SET `duration`='$duration' WHERE id = $membership_id");
                execute("UPDATE `csi_membership_bills` SET `accepted` = '1' WHERE id = $id");
                $member_id= getSpecificValue("SELECT `id` FROM `csi_role` WHERE `role_name`='member'", "id");
                execute("UPDATE `csi_userdata` SET `role` = '$member_id' WHERE id = '$user_id'");
            } else if (isset($_POST['Delete'])) {
                $query = execute("DELETE FROM `csi_membership_bills` WHERE id = " . $id);
            }
        }
    ?>
</head>

<body>
    <header><h2 style="text-align: center;">Confirm Membership</h2></header>
    <table class="table">
        <thead class="black white-text">
            <tr>
                <th>Name</th>
                <th>Registration number</th>
                <th>Email ID</th>
                <th>Phone Number</th>
                <th>Amount Paid</th>
                <th>Bill</th>
                <th>Membership taken in years</th>
                <th>Confirm</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <div class="table-content" style="font-size: large;">
            <?php
            $sqlstmt = execute("select b.id as id, membership_id, u.name,u.id as user_id, r_number, primaryEmail, phonenumber, amount, duration, bill_photo, no_of_year, membership_taken
                                from csi_userdata as u, csi_membership as m, csi_membership_bills as b
                                where accepted = '0' and b.membership_id = m.id and m.userid = u.id;");
            $number_of_data = mysqli_num_rows($sqlstmt);
            if($number_of_data){
                while( $row = mysqli_fetch_assoc($sqlstmt)){
            ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >
                        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                        <input type="hidden" name="user_id" value="<?php echo $row['user_id'];?>">
                        <tr>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['r_number'];?></td>
                            <td><?php echo $row['primaryEmail'];?></td>
                            <td><?php echo $row['phonenumber'];?></td>
                            <td><?php echo $row['amount'];?></td>
                            <td>
                                <a target="_blank" href="Membership_Bill/<?php echo $row['bill_photo']; ?>">
                                    <img src="Membership_Bill/<?php echo $row['bill_photo']; ?>" alt="Membership_Bill/<?php echo $row['bill_photo']; ?>" style="width:80px">
                                </a>
                            </td>
                            <input type="hidden" name = "membership_taken" value="<?php echo $row['membership_taken']; ?>">
                            <input type="hidden" name="membership_id" value = "<?php echo $row['membership_id'];?>">
                            <td>
                                <input type="hidden" name="member_period" value = "<?php echo $row['no_of_year'];?>">
                                <?php echo $row['no_of_year'];?>
                            </td>
                            <td><button class = 'btn btn-success' name = 'Confirm'>Confirm</button></td>
                            <td><button class = 'btn btn-danger' name = 'Delete'>Delete</button></td>
                        </tr>
                    </form>
                <?php 
                    }
                }
                ?>
            </div>
        </tbody>
    </table>
    <div class="spacer" style="height:40px;"></div>
    <div class="footer">
        <div class="spacer" style="height:2px;"></div>
        <a href="index.php"><i class="fas fa-home"></i></a>
        <div class="spacer" style="height:0px;"></div>
        <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
        <div class="spacer" style="height:1px;"></div>
    </div>
    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->

</body>

</html>