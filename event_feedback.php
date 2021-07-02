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
    <title>FEEDBACK RESPONSES</title>
    
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
        $event=$_GET['event_id'];
        $sql = "SELECT `Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `Q6`, `Q7`, `any_queries`, userdata.firstName, userdata.middleName , userdata.lastName , userdata.emailID FROM `feedback`,`userdata`,`collection` WHERE collection.event_id='$event' and collection.id=feedback.collection_id and userdata.id=collection.user_id";
        $query = mysqli_query($conn, $sql);
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
                    $Q1=0;$Q2=0;$Q3=0;$Q4=0;$Q5=0;$Q6=0;$Q7=0;
                    for($index=1;$row = mysqli_fetch_assoc($query);$index++){
                ?>
                    <tr>
                        <td><?php echo $index;?></td>
                        <td><?php echo $row['firstName']." ".$row['middleName']." ".$row['lastName'];?></td>
                        <td><?php echo $row['emailID'];?></td>
                        <td><?php echo $row['Q1']; $Q1+=$row['Q1'];?></td>
                        <td><?php echo $row['Q2']; $Q2+=$row['Q2'];?></td>
                        <td><?php echo $row['Q3']; $Q3+=$row['Q3'];?></td>
                        <td><?php echo $row['Q4']; $Q4+=$row['Q4'];?></td>
                        <td><?php echo $row['Q5']; $Q5+=$row['Q5'];?></td>
                        <td><?php echo $row['Q6']; $Q6+=$row['Q6'];?></td>
                        <td><?php echo $row['Q7']; $Q7+=$row['Q7'];?></td>
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
                    <td>How do you want the pace of teaching</td>
                    <td><?php echo $Q7/$number_of_responses; ?></td>
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
</body>

</html>