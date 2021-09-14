<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/csi-logo.png">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <!-- CSS file  -->
    <link rel="stylesheet" href="../css/membership.css?v=<?php echo time(); ?>">
    
    <title>FEEDBACK RESPONSES</title>
    
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
        // Fetching Access Details
        $access = 0;
        if (isset($_SESSION["role_id"])) {
            $role_id = $_SESSION["role_id"];
            $access = getSpecificValue("SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id", 'feedback_response');
        }
        if ($access == 0) {
            header("location:../index.php");
        }
        $event=$_GET['event_id'];
        $query = execute("SELECT `Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `Q6`, `Q7`, `any_queries`, `csi_userdata`.`name`, `csi_userdata`.`emailID` FROM `csi_feedback`,`csi_userdata`,`csi_collection` WHERE csi_collection.event_id='$event' and csi_collection.id=csi_feedback.collection_id and csi_userdata.id=csi_collection.user_id");
        $number_of_responses = mysqli_num_rows($query);
    ?>
</head>
<body>
    <header>
        <h2 style="text-align: center;">RESPONSES</h2>
    </header>
        <div>
            <table class="table table-bordered" id="tblexportData">
                <thead>
                    <tr>
                        <!-- header of the excell sheet -->
                        <th scope="col" rowspan="2">SR .NO</th>
                        <th scope="col" rowspan="2">NAME</th>
                        <th scope="col" rowspan="2">EMAIL ID</th>
                        <th scope="col" colspan="7">RESPONSES</th>
                        <th scope="col" rowspan="2">QUERIES</th>
                        <!-- <th scope="col" rowspan="2">PROFIT/LOSS</th> -->
                    </tr>
                    <tr>
                        <th scope="col">Q1</th>
                        <th scope="col">Q2</th>
                        <th scope="col">Q3</th>
                        <th scope="col">Q4</th>
                        <th scope="col">Q5</th>
                        <th scope="col">Q6</th>
                        <th scope="col">Q7</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $Q1=0;$Q2=0;$Q3=0;$Q4=0;$Q5=0;$Q6=0;$Q71=0;$Q72=0;$Q73=0;
                    for($index=1;$row = mysqli_fetch_assoc($query);$index++){
                ?>
                    <tr>
                        <td><?php echo $index;?></td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['emailID'];?></td>
                        <td><?php echo $row['Q1']; $Q1+=$row['Q1'];?></td>
                        <td><?php echo $row['Q2']; $Q2+=$row['Q2'];?></td>
                        <td><?php echo $row['Q3']; $Q3+=$row['Q3'];?></td>
                        <td><?php echo $row['Q4']; $Q4+=$row['Q4'];?></td>
                        <td><?php echo $row['Q5']; $Q5+=$row['Q5'];?></td>
                        <td><?php echo $row['Q6']; $Q6+=$row['Q6'];?></td>
                        <?php
                        if($row['Q7']=="fast"){
                            $Q71++;
                        }
                        else if($row['Q7']=="current"){
                            $Q72++;
                        }
                        else if($row['Q7']=="slow"){
                            $Q73++;
                        }
                        ?>
                        <td><?php echo $row['Q7']; ?></td>
                        <td><?php echo $row['any_queries'];?></td>
                    </tr>
                <?php 
                    }
                ?>
                </tbody>
            </table>
            <button onclick="exportToExcel('tblexportData', 'Audit')" type="submit" id="btnExport" name='export' class="btn btn-info">
                 Export to excel
            </button>
            <br><br>
        <table  class="table table-bordered" >
            <thead>
                <tr>
                    <th>QUESTION NO. </th>
                    <th>QUESTIONS </th>
                    <th>AVERAGE </th>
                </tr>
            </thead>
            <?php  
                if($number_of_responses==0){
                    $number_of_responses=1;
                }
            ?>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Was the session contents relevant and</td>
                    <td><?php echo $Q1/$number_of_responses; ?></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>How informative did you find this</td>
                    <td><?php echo $Q2/$number_of_responses; ?></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>How much would you rate the</td>
                    <td><?php echo $Q3/$number_of_responses; ?></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>How timely, efficient and effective was the execution of the</td>
                    <td><?php echo $Q4/$number_of_responses; ?></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>How would you rate your overall experience with this</td>
                    <td><?php echo $Q5/$number_of_responses; ?></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td> Would you like to participate in future such Session, Events and Activities with </td>
                    <td><?php echo $Q6/$number_of_responses; ?></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>  How do you want the pace of teaching ?</td>
                    <td>WANT FAST : <?php echo $Q71; ?><br>
                        WANT CURRENT :<?php echo $Q72; ?><br>
                        WANT SLOW :<?php echo $Q73; ?>
                    </td>
                </tr>
            </tbody>
        </table>          
    <?php
        
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
        function exportToExcel(tableID, filename = 'Audit'){
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
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->

</body>

</html>