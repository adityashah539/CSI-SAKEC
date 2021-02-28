<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="plugins/css/mdb.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="css/admin.css">
    <title>Replied queries</title>
</head>
<body>  
    <header>
    <h2 style="text-align: center;">Log of replied queries</h2>
    </header>
    <div class="spacer" style="height:10px;"></div>
    <table class="table">
        <thead class="black white-text">
            <tr>
                <th scope="col">Email ID</th>
                <th>Query</th>
                <th>Replied Mesaage</th>
                <th>Replied by</th>
                <th>DELETE</th>
            </tr>
        </thead>
        <tbody>
            <div class="table-content" style="font-size: large;">
                 <?php
                    require_once "config.php";
                    session_start();
                    if(isset($_SESSION["id"])){
                        if($_SESSION["role"]==='admin'){
                            $sql = 'SELECT * FROM reply';
                            $query = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query) > 0) {
                                while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                    <td scope="row"><?php echo $row['c_email']; ?></td>
                    <td>
                        <div id="summary">
                            <p class="collapse" id="collapseSummary"><?php echo $row['c_query']; ?></p>
                            <a class="collapsed" data-toggle="collapse" href="#collapseSummary" aria-expanded="false"aria-controls="collapseSummary"></a>
                        </div>
                    </td>
                    <td>
                        <div id="summary">
                            <p class="collapse" id="replied"><?php echo $row['reply']; ?> </p>
                            <a class="collapsed" data-toggle="collapse" href="#replied" aria-expanded="false" aria-controls="collapseSummary"></a>
                        </div>
                    </td>
                    <td><?php echo $row['replied_by']; ?></td>
                    <td><button type="button" class="btn btn-danger">Delete</button></td>
                </tr>
                <?php
                    }
                } else {
                echo "No Record Found.";
                }
            }else {
                echo "You are not allowed.";
            }
        }else {
            echo "You need to Login.";
        }
                ?>
            </div>
        </tbody>
    </table>
    <div class="spacer" style="height:10px;"></div>
    <div class="footer">
        <div class="spacer" style="height:2px;"></div>
        <a href="index.html">
            <i class="fas fa-home"></i>
        </a> 
        <div class="spacer" style="height:0px;"></div>
        <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
        <div class="spacer" style="height:1px;"></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>