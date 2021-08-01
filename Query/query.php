<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/csi-logo.png">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="../css/membership.css?v=<?php echo time(); ?>">

    <title>Query</title>
    <?php
    session_start();
    require_once "../config.php";
    // Fetching Access Details
    $accessquery = 0;
    if (isset($_SESSION["role_id"])) {
        $role_id = $_SESSION["role_id"];
        $accessquery = getSpecificValue("SELECT query FROM `csi_role` WHERE `csi_role`.`id`=$role_id", 'query');
        $accessreplylog = getSpecificValue("SELECT reply_log FROM `csi_role` WHERE `csi_role`.`id`=$role_id", 'reply_log');
    }
    if($accessquery == 0){
        header("location:../index.php");
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['reply_id'])) {
        $id = $_POST['reply_id'];
        $row = getValue("SELECT * FROM csi_query WHERE id='$id'");
        $c_email =  $row['c_email'];
        $email_replied_by = $_SESSION['email'];
        $query =   $row['c_query'];
        $reply = $_POST['Msg'];
        $query = execute("INSERT INTO csi_reply ( c_email  , c_query  , reply , replied_by ) VALUES ('$c_email','$query','$reply','$email_replied_by')");
        $query = execute("DELETE FROM csi_query WHERE id='$id' ");
        if ($query) {
            function_alert("Update Successful ");
        } else {
            function_alert("Update Unsuccessful, Something went wrong.");
        }
    }
    ?>
</head>

<body>
    <header>
        <h2 style="text-align: center;">Queries</h2>
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark default-color sticky-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"><i class="fas fa-home"></i> Home</a>
                </li>
                <?php
                if ($accessreplylog == 1) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="log.php"><i class="fas fa-history"></i> Reply log</a>
                </li>
                <?php
                }
                ?>
            </ul>
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="input-group">
                        <input type="search" onkeyup="SearchFunction()"  id="form1" name="search" placeholder="Search" class="form-control" autocomplete="off" />
                        <button id="search-button" type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </ul>
        </div>
    </nav>
    <table class="table">
        <thead class="table-head">
            <tr>
                <th scope="col">Email ID</th>
                <th>Message</th>
                <th>Reply</th>
                <th>DELETE</th>
            </tr>
        </thead>
        <tbody id="queryTableBody">
            <div class="table-content" style="font-size: large;">
                <?php
                if ($accessquery == 1) {
                    $query = execute('SELECT * FROM csi_query');
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                ?>
                            <tr>
                                <td scope="row"><?php echo $row['c_email']; ?></td>
                                <td>
                                    <div id="summary">
                                        <p class="collapse" id="<?php echo 'collapseSummary' . $row['id']; ?>"><?php echo $row['c_query']; ?> </p>
                                        <a class="collapsed" data-toggle="collapse" href="<?php echo '#collapseSummary' . $row['id']; ?>" aria-expanded="false" aria-controls="collapseSummary"></a>
                                    </div>
                                </td>
                                <td>
                                    <div id="<?php echo 'reply' . $row['id']; ?>">
                                        <button type="button" onClick="<?php echo 'addTextArea(' . $row['id'] . ');'; ?>" class="btn btn-primary">Reply</button>
                                    </div>
                                    <div id="<?php echo 'textArea' . $row['id']; ?>">
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                            <textarea rows='5' cols='50' name='Msg'></textarea>
                                            <br>
                                            <input type="hidden" name="reply_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </form>
                                        <button type="button" onClick="<?php echo 'addTextArea(' . $row['id'] . ');'; ?>" class="btn btn-primary">Cancel</button>
                                    </div>
                                </td>
                                <td><button type="button" class="btn btn-danger">Delete</button></td>
                            </tr>
                            <script type=text/javascript>
                                var t = document.getElementById("<?php echo 'textArea' . $row['id']; ?>");
                                t.style.display = "none";
                            </script>
                <?php
                        }
                    } else {
                        echo "No Record Found.";
                    }
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
    <script>
        function SearchFunction(){
            var  inputValue, tablebody,noOfRows, tr, th, i,lengthOfTable,emailId,txtValue;
            inputValue = document.getElementById('form1').value.toUpperCase();
            tablebody = document.getElementById('queryTableBody');
            noOfRows = tablebody.getElementsByTagName('tr');
            lengthOfTable=noOfRows.length;
            console.log(lengthOfTable);
            //debugger;
            for (i = 0; i < lengthOfTable; i++) {
                th = noOfRows[i].getElementsByTagName("td");
                console.log(th[0].innerHTML);
                if (th) {
                    emailId  = th[0].innerText ;
                    if (emailId.toUpperCase().indexOf(inputValue)>-1) {
                        noOfRows[i].style.display = "";
                    } else {
                        noOfRows[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <script type="text/javascript">
        function addTextArea(id) {
            var reply = "reply";
            var tA = "textArea";
            var combi = id;
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
    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->

</body>

</html>