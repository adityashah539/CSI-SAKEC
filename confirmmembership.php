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
    <?php 
        require_once "config.php";
        session_start();
        function function_alert($message)
        {
        echo "<SCRIPT>
            window.location.replace('index.php')
            alert('$message');
            </SCRIPT>";
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
            if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'coordinator'||$_SESSION['role'] == 'head coordinator'){
                $id = $_POST['id'];
                echo $id;
                if (isset($_POST['Confirm'])) {
                    $sql = "UPDATE membership SET status=1 WHERE userid = " . $id;
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
            $sql = "SELECT * FROM `membership`,`userdata` WHERE membership.userid=userdata.id";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>