<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="../css/membership.css?v=<?php echo time(); ?>">
    
    <title>AUDIT</title>
    <style>
        th,
        td {
            text-align: center;
            vertical-align: center;
        }
    </style>
    <?php
        require_once "../config.php";
        session_start();
        function function_alert($message)
        {
            echo"<SCRIPT>alert('$message');</SCRIPT>";
        }
        /*
        //$html = preg_replace('#<div id="desc">(.*?)</div>#', '', $html);
        //$html = preg_replace('#<button id="btnExport">(.*?)</button>#', '', $html);
        // downloads excell sheet
        if (($_SERVER['REQUEST_METHOD'] == "POST") && (isset($_POST["export"]))) {
                echo '<script>
                    document.getElementById("btnExport").style.display = "none";
            </script>';
                $filename = "AUDIT".time().".xls";
               // header("Content-Type: application/vnd.ms-excel");
                //header("Content-Disposition: attachment; filename=\"$filename");
        }*/
    ?>
</head>
<body>
    <header><h2 style="text-align: center;">Audit</h2></header>
    <?php
        if (!isset($_GET['to'])||!isset($_GET['from'])) {
    ?>
        <div id="toDate">
            <h3>Choose a date</h3>
            <div class="spacer" style="height: 20px;"></div>
            <form action="<?php $_SESSION['var'] = 1;echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
                <label for="FROM">FROM :</label>
                <input type="date" id="r" name="from" placeholder="YYYY-MM-DD" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter a date in this formart YYYY-MM-DD" />
                <label for="TO">TO :</label>
                <input type="date" id="r" name="to" placeholder="YYYY-MM-DD" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter a date in this formart YYYY-MM-DD" />
                <button type="submit" name="date" value="date" class="btn btn-primary">Submit</button>
            </form>

        </div>
    <?php
        }
        if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET['date'])) {
            $from_date = $_GET["from"];
            $to_date = $_GET["to"];
            // event details
            $sqlevent = "select id, title, e_from_date, e_to_date, e_description
                        from csi_event
                        where e_from_date >= '$from_date' and e_to_date <= '$to_date'
                        group by id";
            $queryevent = mysqli_query($conn, $sqlevent);
    ?>
        <div>
            <table class="table table-bordered" id="tblexportData">
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
                    $branch = array("CS", "IT", "ELEC","EXTC","AI","ECS","CYBER","EXTER");
                    for($index = 1; $rowevent = mysqli_fetch_assoc($queryevent); $index++) {
                        $count = 0;
                        // speaker
                        $sqlspeaker = "SELECT `name`, `organisation` FROM `csi_speaker` WHERE event_id = ".$rowevent['id'];
                        $queryspeaker = mysqli_query($conn, $sqlspeaker);
                        $speakername = "";
                        $speakerorganisation = "";
                        for($i = 1;$rowspeaker = mysqli_fetch_assoc($queryspeaker);$i++){
                            $speakername = $speakername . $i . ". " . $rowspeaker['name'] . "<br>";
                            $speakerorganisation = $speakerorganisation. $i . ". " . $rowspeaker['organisation'] . "<br>";
                        }

                        // collaboration
                        $sqlcollaboration = "SELECT * FROM csi_collaboration WHERE event_id=".$rowevent['id'];
                        $querycollaboration = mysqli_query($conn, $sqlcollaboration);
                        $collaboration = "";
                        for ($i = 1;$rowcollaboration = mysqli_fetch_assoc($querycollaboration);$i++) {
                            $collaboration = $collaboration . $i.". ". $rowcollaboration['collab_body'] . "<br>";
                        }

    ?>
                    <tr>
                        <td><?php echo $index;?></td>
                        <td><?php echo $rowevent['title'];?></td>
                        <td><?php echo $rowevent['e_from_date']."-".$rowevent['e_to_date'];?></td>
                        <td><?php echo $speakername;?></td>
                        <td><?php echo $speakerorganisation;?></td>
                        <td><?php echo $collaboration;?></td>
                        <td><?php echo $rowevent['e_description'];?></td>
    <?php
                        for($i = 0; $i < 8; $i++) {
                            // count number of students who registered for the event
                            $sqlcollection = "select count(u.id) as total
                                    from csi_userdata as u, csi_collection as c
                                    where c.user_id = u.id and u.branch = '$branch[$i]' and c.event_id = ".$rowevent['id'];
                            $querycollection = mysqli_query($conn, $sqlcollection);
                            $rowcollection = mysqli_fetch_assoc($querycollection);
                            $count += $rowcollection['total'];
    ?>
                            <td><?php echo $rowcollection['total'];?></td>
    <?php
                        }
    ?>
                        <td><?php echo $count;?></td>
                    </tr>
    <?php
                    }
    ?>
                </tbody>
            </table>
                    <button onclick="exportToExcel('tblexportData', 'Audit')" type="submit" id="btnExport" name='export' class="btn btn-info">
                        Export to excel
                    </button>                
    <?php
        }
    ?>
        <!-- </div> -->
    <div class="spacer" style="height:100px;"></div>
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
        function exportToExcel(tableID, filename = ''){
            var downloadurl;
            var dataFileType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTMLData = tableSelect.outerHTML.replace(/ /g, '%20');
            // Specify file name
            filename = filename?filename+Date.now()+'.xls':'export_excel_data.xls';
            // Create download link element
            downloadurl = document.createElement("a");
            document.body.appendChild(downloadurl);
            if(navigator.msSaveOrOpenBlob){
                var blob = new Blob(['\ufeff', tableHTMLData], {
                    type: dataFileType
                });
                navigator.msSaveOrOpenBlob( blob, filename);
            }else{
                // Create a link to the file
                downloadurl.href = 'data:' + dataFileType + ', ' + tableHTMLData;
                // Setting the file name
                downloadurl.download = filename;
                //triggering the function
                downloadurl.click();
            }
        }

</script>
    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery-3.4.1.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->

</body>

</html>