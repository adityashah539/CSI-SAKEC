<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <link rel="stylesheet" href="css/membership.css?v=<?php echo time(); ?>">
    <title>AUDIT</title>
    <style>
        th,
        td {
            text-align: center;
            vertical-align: center;
        }
    </style>
    <?php
        require_once "config.php";
        session_start();
        function function_alert($message)
        {
            echo"<SCRIPT>alert('$message');</SCRIPT>";
        }
        //$html = preg_replace('#<div id="desc">(.*?)</div>#', '', $html);
        //$html = preg_replace('#<button id="btnExport">(.*?)</button>#', '', $html);
        // downloads excell sheet
        if (($_SERVER['REQUEST_METHOD'] == "POST") && ($_SESSION['var'] == 2)) {
            if (isset($_POST["export"])) {
                echo '<script>
                    document.getElementById("btnExport").style.display = "none";
            </script>';
                $filename = "AUDIT".time().".xls";
                header("Content-Type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=\"$filename");
            }
            $_SESSION['var'] = 1;
        }
    ?>
</head>
<body>
    <?php
        if ($_SESSION['var'] == 0) {
    ?>
        <div id="toDate">
            <h3>Choose a date</h3>
            <div class="spacer" style="height: 20px;"></div>
            <form action="<?php $_SESSION['var'] = 1;echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="FROM">FROM :</label>
                <input type="date" id="r" name="from" placeholder="YYYY-MM-DD" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter a date in this formart YYYY-MM-DD" />
                <label for="TO">TO :</label>
                <input type="date" id="r" name="to" placeholder="YYYY-MM-DD" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter a date in this formart YYYY-MM-DD" />
                <button onclick="a()" type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    <?php
        }
        if (($_SERVER["REQUEST_METHOD"] == "POST") && ($_SESSION['var'] == 1)) {
            $from_date = $_POST["from"];
            $to_date = $_POST["to"];
            $sql = "";
            $query = mysqli_query($conn, $sql);
    ?>
    <header>
        <h2 style="text-align: center;">Audit</h2>
    </header>
        <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <!-- header of the excell sheet -->
                        <th scope="col" rowspan="2">SR .NO</th>
                        <th scope="col" rowspan="2">EVENT NAME </th>
                        <th scope="col" rowspan="2">EVENT DATE</th>
                        <th scope="col" rowspan="2">CONDUCTED BY / SPEAKER</th>
                        <th scope="col" rowspan="2">SPEAKER ORGANIZATION</th>
                        <th scope="col" rowspan="2">IN COLLABB(DEPT NAME / CELL NAME)</th>
                        <th scope="col" rowspan="2">DESCRIPTION</th>
                        <th scope="col" colspan="9">NO OF PARTICIPANTS</th>
                        <!-- <th scope="col" rowspan="2">PROFIT/LOSS</th> -->
                    </tr>
                    <tr>
                        <th scope="col">COMPUTER</th>
                        <th scope="col">IT</th>
                        <th scope="col">ELECTRONICS</th>
                        <th scope="col">EXTC</th>
                        <th scope="col">AI - DS</th>
                        <th scope="col">ECS</th>
                        <th scope="col">CYBER - SEC</th>
                        <th scope="col">EXTERNAL</th>
                        <th scope="col">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
    <?php
                    for($index = 1; $row = mysqli_fetch_assoc($gallerysqlstmt); $index++) {
    ?>
                    <tr>
                        <td><?php echo $index;?></td>
                        <td><?php echo $row[''];?></td>
                        <td><?php echo $row[''];?></td>
                        <td><?php echo $row[''];?></td>
                        <td><?php echo $row[''];?></td>
                        <td><?php echo $row[''];?></td>
                        <td><?php echo $row[''];?></td>
                        <td><?php echo $row[''];?></td>
                        <td><?php echo $row[''];?></td>
                        <td><?php echo $row[''];?></td>
                        <td><?php echo $row[''];?></td>
                        <td><?php echo $row[''];?></td>
                        <td><?php echo $row[''];?></td>
                        <td><?php echo $row[''];?></td>
                        <td><?php echo $row[''];?></td>
                        <td><?php echo $row[''];?></td>
                    </tr>
    <?php
                    }
    ?>
                </tbody>
            </table>
    <?php
        }
        if (($_SERVER["REQUEST_METHOD"] == "POST") && ($_SESSION['var'] == 1)) {
    ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <button onclick="a()" type="submit" id="btnExport" name='export' class="btn btn-info">
                        Export to excel
                    </button>
                </form>
    <?php
                $_SESSION['var'] = 2;
        }
    ?>
        </div>

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
        <!-- <script>
            function a() {
                document.getElementById("btnExport").style.display = "none";
                //document.getElementById("btnExport").style.display = "block";
                //  document.getElementById("btnExport").style.display = "none";
            }
        </script> -->
</body>

</html>