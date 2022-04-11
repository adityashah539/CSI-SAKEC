<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Boostrap-4.6.0-->
    <link rel="icon" href="../images/csi-logo.png">
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="../css/membership.css?v=<?php echo time(); ?>">
    <title>Replied queries</title>
    <?php
    require_once "../config.php";
    session_start();

    // Fetching Access Details
    $access = NULL;
    if (isset($_SESSION["role_id"])) {
        $role_id = $_SESSION["role_id"];
        $access = getValue("SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id");
    }
    if ($access['reply_log'] == 0) {
        header("location:../index.php");
    }
    ?>
</head>

<body>
    <header>
        <h2 style="text-align: center;">Log of replied queries</h2>
    </header>
    <nav class="navbar navbar-expand-lg navbar-dark default-color sticky-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="query.php"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"><i class="fas fa-home"></i> Home</a>
            </ul>
            <ul class="navbar-nav ml-auto nav-flex-icons">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="input-group">
                        <input type="search" id="form1" name="search" placeholder="Search" class="form-control" autocomplete="off" />
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
                <th>Query</th>
                <th>Replied Subject</th>
                <th>Replied body</th>
                <th>Replied by</th>
                <th>DELETE</th>
            </tr>
        </thead>
        <tbody>
            <div class="table-content" style="font-size: large;">
                <?php
                if ($access['reply_log'] == 1) {
                    $query = execute('SELECT * FROM csi_reply');
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                ?>
                            <tr id="<?php echo $row['id'] ?>">
                                <td scope="row"><?php echo $row['c_email']; ?></td>
                                <td>
                                    <div id="summary">
                                        <p class="collapse" id="collapseSummary"><?php echo $row['c_query']; ?></p>
                                        <a class="collapsed" data-toggle="collapse" href="#collapseSummary" aria-expanded="false" aria-controls="collapseSummary"></a>
                                    </div>
                                </td>
                                <td>
                                    <div id="summary">
                                        <p class="collapse" id="repliedSubject"><?php echo $row['reply_subject']; ?> </p>
                                        <a class="collapsed" data-toggle="collapse" href="#repliedSubject" aria-expanded="false" aria-controls="collapseSummary"></a>
                                    </div>
                                </td>
                                <td>
                                    <div id="summary">
                                        <p class="collapse" id="repliedBody"><?php echo $row['reply_body']; ?> </p>
                                        <a class="collapsed" data-toggle="collapse" href="#repliedBody" aria-expanded="false" aria-controls="collapseSummary"></a>
                                    </div>
                                </td>
                                <td><?php echo $row['replied_by']; ?></td>
                                <td><button type="button" name="deleteReplied" value="<?php echo $row['id'] ?>" class="btn btn-danger">Delete</button></td>
                            </tr>
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
        <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
        <div class="spacer" style="height:1px;"></div>
    </div>
    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->
    <script>
        $("button[name='deleteReplied']").on("click", function() {
            var id = $(this).val();
            $.ajax({
                url: '<?php echo $protocol.$domainName; ?>/api/deleteReply.php',
                type: 'POST',
                data: {
                    "id": id
                },
                dataType: 'JSON',
                success: function(response) {
                    var error = response.error;
                    if (!error) {
                        console.log(error);
                        $("#" + id).hide(1000);
                    } else {
                        console.log(error);
                    }
                }
            });
        })
    </script>
</body>

</html>