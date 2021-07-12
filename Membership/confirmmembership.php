<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <!-- <link rel="stylesheet" href="../css/membership.css?v=<?php echo time(); ?>">
     -->
    <title>Expense</title>
    <?php 
        require_once "../config.php";
        session_start();
        function function_alert($message)
        {
        echo "<SCRIPT>
            alert('$message');
            </SCRIPT>";
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
            if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'coordinator'||$_SESSION['role'] == 'head coordinator'){
                $id = $_POST['id'];
                if (isset($_POST['Confirm'])) {
                    $sql = "UPDATE membership SET status=1 WHERE userid = " . $id;
                    $query = mysqli_query($conn, $sql);
                    $sql = "UPDATE userdata SET role=5 WHERE id = " . $id;
                    $query = mysqli_query($conn, $sql);
                } else if (isset($_POST['Delete'])) {
                    $sql = "DELETE FROM `membership` WHERE userid=" . $id;
                    $query = mysqli_query($conn, $sql);
                } 
            }
            else{
                function_alert("You have to be admin or cooridinator");
            }
        }
        
    ?>
</head>

<body>
    
    <div class="spacer" style="height:10px;"></div>
    <header>
        <h2 style="text-align: center;">Confirm Membership</h2>
    </header>
    <div class="spacer" style="height:10px;"></div>
    <table class="table">
        <thead class="black white-text">
            <tr>
                <th scope="col">Name</th>
                <th>Email ID</th>
                <th>Amount Paid</th>
                <th>Bill</th>
                <th>Registration number</th>
                <th>Smartcard</th>
                <th>Confirm</th>
                <th>Delete</th>
                <!-- <th>Edit</th> -->
            </tr>
        </thead>
        <tbody>
            <div class="table-content" style="font-size: large;">
            <?php
            //hold
            $sql = "SELECT * FROM `membership`,`userdata` WHERE membership.userid=userdata.id and membership.status = '0'";
            $sqlstmt = mysqli_query($conn, $sql);
            $number_of_data = mysqli_num_rows($sqlstmt);
            if($number_of_data){
                while( $row = mysqli_fetch_assoc($sqlstmt)){
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >
                <tr>
                    <th scope="row"><?php  echo $row['firstName']." ".$row['lastName']; ?> </th>
                    <td><?php echo $row['emailID']; ?> </td>
                    <td><?php echo $row['ammount']; ?> </td>
                    <td>
                        <a target="_blank" href="Membership_Bill/<?php echo $row['membershipbill']; ?>">
                            <img src="Membership_Bill/<?php echo $row['membershipbill']; ?>" alt="Membership_Bill" style="width:80px">
                        </a>
                    </td>
                    <td><?php echo $row['r_number']; ?> </td>
                    <td>
                        <a target="_blank" href="Smart_Card/<?php echo $row['smartcard']; ?>">
                            <img src="Smart_Card/<?php echo $row['smartcard'];  ?>" alt="Smart_Card" style="width:80px">
                        </a>
                    </td>
                    <input type='hidden' name='id' value='<?php echo $row['userid']; ?>'>
                    <td><button name="Confirm" type="submit" class="btn btn-success" >Confirm</button> </td>
                    <td><button  name="Delete" type="submit" class="btn btn-danger" >Delete</button> </td>
                </tr>
            </form>
                <?php 
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
        <!-- DO NOT DELETE THIS  -->
        <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery-3.4.1.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->

</body>

</html>