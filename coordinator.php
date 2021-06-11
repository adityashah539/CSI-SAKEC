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
    <title>Database</title>
    <title>Team members list</title>
</head>
<?php
    require_once "config.php";
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
        //if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'coordinator'||$_SESSION['role'] == 'head coordinator'){
            if (isset($_POST['delete_id_btn'])) {
                $id = $_POST['delete_id'];
                $sql = "DELETE FROM `coordinator` WHERE id=" . $id;
                $query = mysqli_query($conn, $sql);
            }
       // }
        else{
            function_alert("You have to be admin or cooridinator");
          }
    }
    
?>
<body>
    <div class="spacer" style="height:10px;"></div>
    <!-- Members List -->
    <div class="members">

        <h2 style="text-align: center;">Team Members List</h2>
        <div class="spacer" style="height:30px;"></div>
        <div class="row">
            <div class="col-sm-6"></div>
            <button onclick="location.href='addmember.php'" type="button" class="btn btn-primary">Add Member</button>
        </div>
        <div class="spacer" style="height:10px;"></div>
        <table class="table">
            <thead class="black white-text">
                <tr>
                    <th scope="col">NAME</th>
                    <th>DESIGNITION</th>
                    <th>IMAGE</th>

                    <th>EDIT</th>
                    <th>Delete</th>

                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM `coordinator`";
                    $result= mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="table-content" style="font-size: large;">
                        <tr>
                            <th scope="row"><?php echo $row['name']; ?></th>
                            <td><?php echo $row['duty']; ?></td>

                            <td>
                                <a target="_blank" href="images/Dhruvi-jain.jpg">
                                    <img src="images/<?php echo $row['image']; ?>" alt="Forest" style="width:80px">
                                </a>
                            </td>
                            <form action="updatecoordinator.php" method="POST">
                                <td>
                                    <input type='hidden' name='coordinator_id' value='<?php echo $row['id']; ?>'>
                                    <input type='hidden' name='coordinator_name' value='<?php echo $row['name']; ?>'>
                                    <input type='hidden' name='coordinator_image' value='<?php echo $row['image']; ?>'>
                                    <input type='hidden' name='coordinator_duty' value='<?php echo $row['duty']; ?>'>
                                    <button type="submit" class="btn btn-success">Edit</button> 
                                </td>
                            </form> 
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                <td> 
                                    <input type='hidden' name='delete_id' value='<?php echo $row['id']; ?>'>
                                    <button type='submit' name="delete_id_btn" class='btn btn-danger'>DELETE</button> 
                                </td>
                            </form>
                        </tr>
                    </div>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <div class="spacer" style="height:30px;"></div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>