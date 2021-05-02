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
        echo "after date section";
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
    ?>
    <?php
    if (($_SERVER["REQUEST_METHOD"] == "POST") && ($_SESSION['var'] == 1)) {
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
                        <th scope="col" colspan="2">AMOUNT COLLECTED FROM PARTICIPANTS</th>
                        <th scope="colgroup" colspan="2"> AMOUNT SPENT</th>
                        <th scope="col" rowspan="2">PROFIT/LOSS</th>
                    </tr>
                    <tr>
                        <th scope="col">FROM MEMBERS </th>
                        <th scope="col">FROM NON MEMBERS</th>
                        <th scope="col">ITEM</th>
                        <th scope="col">AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //$startDate = "2021-01-01";
                    $startDate =$_POST["from"];
                   // $endDate = "2021-04-02";
                    $endDate =$_POST["to"];
                    $sr_no = 1;
                    $sql = "SELECT * FROM `event` WHERE e_from_date >= '$startDate' AND e_from_date <= '$endDate'";
                    // echo "</br>".$sql."</br>";
                    //$sql = "SELECT title,id,e_from_date FROM `event`";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($query);
                    if ($row > 0) {
                        while ($rows = mysqli_fetch_assoc($query)) {
                            $id = $rows['id'];
                            $spend = 0;
                            $collection = 0;
                            // query to fetch amount collected from members and non members
                            $sql1 = "SELECT `id`, `event_id`, `collection`, `expense`, `balance` FROM `budget` WHERE event_id='$id'";
                            $query1 = mysqli_query($conn, $sql1);
                            $rows1 = mysqli_num_rows($query1);
                            $rows1A = mysqli_fetch_assoc($query1)
                    ?>
                            <tr>
                                <td <?php echo "rowspan='" . $rows1 . "'"; ?>> <?php echo $sr_no;$sr_no += 1; ?> </td>
                                <td <?php echo "rowspan='" . $rows1 . "'"; ?>> <?php echo $rows["title"]; ?> </td>
                                <td <?php echo "rowspan='" . $rows1 . "'"; ?>> <?php echo $rows["e_from_date"]; ?> </td>
                                <!-- from databse of amount collected from member and nonmembers -->
                                <td colspan="1" <?php echo "rowspan=" . $rows1; ?>> <?php $collection+=$rows1A["collection"]; echo $rows1A["collection"]; ?> </td>
                                <td colspan="1" <?php echo "rowspan=" . $rows1; ?>> <?php echo $rows1A["balance"]; ?> </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php
                            $sqlR = "SELECT `id`, `spent_on`, `bill_amount` FROM `expences` WHERE budget_id='$id'";
                            //$sql = "SELECT title,id,e_from_date FROM `event`";
                            $queryR = mysqli_query($conn, $sqlR);
                            $rowsR = mysqli_num_rows($queryR);
                            //$rows1 = mysqli_fetch_assoc($query1);
                            while ($rowsR = mysqli_fetch_assoc($queryR)) {
                        ?>
                                <!-- amount spend -->
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td> <?php echo $rowsR["s_on"]; ?></td>
                                    <td> <?php $spend += $rowsR["bill_amount"];echo $rowsR["bill_amount"]; ?></td>
                                    <td></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <th>Total</th>
                                <td><?php echo $collection; ?></td>
                                <th>Total</th>
                                <td><?php echo $spend; ?></td>
                                <td><?php $pl = ($collection - $spend);
                                    echo $pl; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                <?php
                        }
                    } else {
                        echo "No data";
                    }
                }
                ?>

                </tbody>
            </table>
            <?php
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