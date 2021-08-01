<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            if (isset($_POST['Confirm'])) {
                $start_year = $_POST['start_year'];
                $member_period = $_POST['member_period'];
                $query = execute("UPDATE `csi_membership_bills` SET `membership_taken`='$start_year',`no_of_year`='$member_period' WHERE  id = " . $id);
                
                $datetime = new DateTime($start_year);
                $datetime->add(new DateInterval('P'.$member_period.'Y'));
                $new_membership_end = $datetime->format('Y-m-d h:m:s');
                $query = execute("UPDATE `csi_membership`,`csi_membership_bills` SET `duration`='$new_membership_end' WHERE `csi_membership`.`id` = `csi_membership_bills`.`membership_id` and `csi_membership_bills`.`id` = $id");
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
                <th>Current Membership Ends</th>
                <th>Membership Start</th>
                <th>Number Of Years</th>
                <th>Confirm</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <div class="table-content" style="font-size: large;">
            <?php
            $sqlstmt = execute("select b.id as id, u.name , r_number, primaryEmail, phonenumber, amount, duration, bill_photo
                                from csi_userdata as u, csi_membership as m, csi_membership_bills as b
                                where no_of_year = '' and b.membership_id = m.id and m.userid = u.id");
            $number_of_data = mysqli_num_rows($sqlstmt);
            if($number_of_data){
                while( $row = mysqli_fetch_assoc($sqlstmt)){
            ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >
                        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
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
                            <td><?php 
                                    if($row['duration'] != NULL)echo $row['duration'];
                                    else echo "No Previous Membership";
                                ?></td>
                            <td><input type="date" name="start_year" required></td>
                            <td>
                                <div class="col-sm-7">
                                    <div class="texts">
                                        <select name="member_period" class="custom-select mb-3" required="required">
                                            <option selected disabled>Select Year</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td><button class = 'btn btn-primary' name = 'Confirm'>Confirm</button></td>
                            <td><button class = 'btn btn-primary' name = 'Delete'>Delete</button></td>
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