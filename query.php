<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <link rel="stylesheet" href="css/membership.css?v=<?php echo time(); ?>">
    <title>Query</title>
    <?php
    require_once "config.php";
    function function_alert($message){
        echo"<SCRIPT>
                window.location.replace('query.php')
                alert('$message');
            </SCRIPT>";
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"&&isset($_POST['reply_id'])){
        $id = $_POST['reply_id'];
        $sql = "SELECT * FROM query WHERE id='$id'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
        $c_email=  $row['c_email'];
        $email_replied_by = $_SESSION['email'];
        $query=   $row['c_query'];
        $reply =$_POST['Msg']; 
        $sql = "INSERT INTO reply ( c_email  , c_query  , reply , replied_by ) VALUES ('$email','$query','$reply','$email_replied_by')";
        $query = mysqli_query($conn, $sql);
        $sql = "DELETE FROM query WHERE id='$id' ";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            function_alert("Update Successful ");
        }else{
            function_alert("Update Unsuccessful, Something went wrong.");
        }
    }
    ?>
</head>
<body>
    <header>
        <h2 style="text-align: center;">Queries</h2>
    </header>
    <div class="spacer" style="height:10px;"></div>
    <table class="table">
        <thead class="table-head">
            <tr>
                <th scope="col">Email ID</th>
                <th>Message</th>
                <th>Reply</th>
                <th>DELETE</th>
            </tr>
        </thead>
        <tbody>
            <div class="table-content" style="font-size: large;">
                <?php
                    require_once "config.php";
                    session_start();
                    if(isset($_SESSION["email"])){
                        if($_SESSION["role"]==='admin'||$_SESSION["role"]==='c'){
                            $sql = 'SELECT * FROM query';
                            $query = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query) > 0) {
                                while ($row = mysqli_fetch_assoc($query)) {
                ?>
                            <script>
                                var textArea = document.getElementById("textArea");
                                textArea.style.display = "none";
                            </script>
                            <tr>
                                <td scope="row"><?php echo $row['c_email']; ?></td>
                                <td>
                                    <div id="summary">
                                        <p class="collapse" id="<?php echo 'collapseSummary'.$row['id'];?>"><?php echo $row['c_query']; ?> </p>
                                        <a class="collapsed" data-toggle="collapse" href="<?php echo '#collapseSummary'.$row['id']; ?>" aria-expanded="false" aria-controls="collapseSummary"></a>
                                    </div>
                                </td>
                                <td>
                                    <div id="<?php echo 'reply'.$row['id']; ?>">
                                        <button type="button" onClick="<?php echo 'addTextArea('.$row['id'].');'; ?>" class="btn btn-primary">Reply</button>
                                    </div>
                                    <div id="<?php echo 'textArea'.$row['id'];?>">
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                            <textarea  rows='5' cols='50' name='Msg'></textarea>
                                            <br>
                                            <input type="hidden" name="reply_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </form>
                                        <button type="button" onClick="<?php echo 'addTextArea('.$row['id'].');'; ?>" class="btn btn-primary">Cancle</button>
                                    </div>
                                </td>
                                <td><button type="button" class="btn btn-danger">Delete</button></td>
                            </tr>
                    <script type=text/javascript>
                        var t = document.getElementById("<?php echo 'textArea'.$row['id']; ?>");
                        t.style.display = "none";
                    </script>
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
        <a href="index.php">
            <i class="fas fa-home"></i>
        </a>
        <div class="spacer" style="height:0px;"></div>
        <h5>CSI-SAKEC 2021 &copy; All Rights Reserved</h5>
        <div class="spacer" style="height:1px;"></div>
    </div>
    <script type="text/javascript">
        function addTextArea(id){
            var reply="reply";
            var tA="textArea";
            var combi=id;
            var x = document.getElementById(reply.concat(combi));
            var y = document.getElementById(tA.concat(combi));
            if (x.style.display === "none") {
                x.style.display = "block";
                y.style.display = "none";
            } else {
                x.style.display = "none";
                y.style.display = "block";
            }
        }
        
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>