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
    <link rel="stylesheet" href="css/query.css">
    <title>Query</title>
</head>
<body>
    <header>
        <h2 style="text-align: center;">Queries</h2>
    </header>
    <div class="spacer" style="height:10px;"></div>
    <table class="table">
        <thead class="black white-text">
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
                    $sql = 'SELECT * FROM query';
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                ?>
                            <tr>
                                <td scope="row"><?php echo $row['c_email']; ?></td>
                                <td>
                                    <div id="summary">
                                        <p class="collapse" id="<?php echo 'collapseSummary'.$row['id'];?>"><?php echo $row['c_query']; ?> </p>
                                        <a class="collapsed" data-toggle="collapse" href="<?php echo '#collapseSummary'.$row['id']; ?>" aria-expanded="false" aria-controls="collapseSummary"></a>
                                    </div>
                                </td>
                                <td>
                                    <button id="foo" type="button"  onClick="addTextArea();" class="btn btn-primary">Reply</button>
                                    <div id="reply"></div>
                                    <div style="height: 10px;" id="send"></div></td>
                                <td><button type="button" class="btn btn-danger">Delete</button></td>
                            </tr>
                <?php
                        }
                    } else {
                    echo "No Record Found";
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
        <h5>CSI-SAKEC 2021 &copy; All Rights Reserved</h5>
        <div class="spacer" style="height:1px;"></div>
    </div>
    <script type="text/javascript">
        function addTextArea(){
            var div = document.getElementById('reply');
            div.innerHTML += "<textarea  rows='5' cols='20' name='new_quote[]' />";
            var div1 = document.getElementById('send');
            div1.innerHTML  += `<button class="btn btn-primary">Send</button>`;
            el=document.getElementById("foo");
            el.remove();
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>