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
    <title>Manage Event</title>
</head>
<body>
    <div class="spacer" style="height:10px;"></div>
    <header>
        <h2 style="text-align: center;">Manage Events</h2>
    </header>
    <div class="spacer" style="height:10px;"></div>
    <table class="table">
        <thead class="black white-text">
            <tr>
                <th scope="col">Title</th>
                <th>Event date</th>
                <th>Event time</th>
                <th>Event Description</th>
                <th>Fee for Members</th>
                <th>Fee for non-members</th>
                <th>Speaker Description</th>
                <th>Live</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <div class="table-content" style="font-size: large;">
            <?php
                require_once "config.php";
                $sql = 'SELECT * FROM event';
                $query = mysqli_query($conn, $sql);
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                    <th scope="row"><?php echo $row['title']; ?></th>
                    <td>
                        <?php 
                            if($row['e_from_date']!=$row['e_to_date']){
                                echo date("d-m-Y",strtotime($row['e_from_date']))."to".date("d-m-Y",strtotime($row['e_to_date']));
                            }
                            else{
                                echo date("d-m-Y",strtotime($row['e_from_date']));
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                         if($row['e_from_time']!=$row['e_to_time']){
                            echo date("h:i:sa",strtotime($row['e_from_time']))." to ".date("h:i:sa",strtotime($row['e_to_time']));
                        }
                        else{
                            echo date("h:i:sa",strtotime($row['e_from_time']));
                        } 
                        ?>
                    </td>
                    <td>
                        <div id="summary">
                            <p class="collapse" id="<?php echo 'collapseSummary'.$row['id'];?>"><?php echo $row['e_description']; ?></p>
                            <a class="collapsed" data-toggle="collapse" href="<?php echo '#collapseSummary'.$row['id']; ?>" aria-expanded="false" aria-controls="collapseSummary"></a>
                        </div>
                    </td>
                    <td>&#8377;  <?php echo $row['fee_m']; ?></td>
                    <td>&#8377;  <?php echo $row['fee']; ?></td>
                    <td>
                        <div id="s-description">
                            <p class="collapse" id="<?php echo 'collapseSummary'.$row['id'];?>"><?php echo $row['s_descripition']; ?></p>
                            <a class="collapsed" data-toggle="collapse" href="<?php echo '#collapseSummary'.$row['id']; ?>"aria-expanded="false" aria-controls="collapseSummary"></a>
                        </div>
                    </td>
                   <?php
                   if($row['live']==1){
                       ?>
                        <td>
                            <form action="live.php" method="post">
                                <input type="hidden" name="disable_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-success">Live</button>
                            </form>                                
                        </td>
                   <?php
                    }
                   else{
                       ?>
                        <td>
                            <form action="disabled_event.php" method="post">
                            <input type="hidden" name="enable_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-danger"> Disabled</button>
                            </form>
                        </td>
                   <?php
                    }
                   ?>
                   <td>             
                        <form action="delete_event.php" method="post">
                            <input type="hidden" name="delete_id_event" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete_event_btn" class="btn btn-danger"> Delete</button>
                        </form>
                    </td>
                <?php
                    }
                } else {
                    echo "No Record Found";
                }
                ?>
            </div>
        </tbody>
    </table>
    <div class="spacer" style="height:30px;"></div>
    <div class="container text-center">
        <a href="addevent.php">
        <button type="button" class="btn btn-primary" >Add Event</button>    
    </a>
    </div>
    <div class="spacer" style="height:10px;"></div>
    <div class="footer">
        <div class="spacer" style="height:2px;"></div>
        <a href="index.html"><i class="fas fa-home"></i></a>
        <div class="spacer" style="height:0px;"></div>
        <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
        <div class="spacer" style="height:1px;"></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>