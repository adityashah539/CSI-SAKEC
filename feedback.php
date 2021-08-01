<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/csi-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <link href="https://fonts.googleapis.com/css?family=Oswald|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <link rel="stylesheet" href="css/membership.css?v=<?php echo time(); ?>">
    <title> FEEDBACK </title>
    <?php
    require_once "config.php";
    session_start();
    //checking wheather user is logged in
    if(!isset($_SESSION['email'])){
        redirect_after_msg("please login",'Login/login.php');
    }

    //taking event id 
    if(isset($_GET['e_id']))
        $event_id=$_GET['e_id'];
    else if(isset($_POST['e_id']))
        $event_id=$_POST['e_id'];

    //checking if feedback is enabled
    $eventquery = execute("SELECT * FROM csi_event WHERE id='$event_id' and feedback='1'");
    $number_of_event = mysqli_num_rows($eventquery);
    if($number_of_event==0){
        redirect_after_msg("feedback is disabled for the event contact admin",'index.php');
    }
    $rowevent = mysqli_fetch_assoc($eventquery);
    
    //checking wheather user is registered
    $query = execute("SELECT `id` FROM csi_collection WHERE event_id='$event_id' and user_id=(SELECT `id` FROM csi_userdata WHERE emailID='".$_SESSION['email']."')");
    $number_of_rows = mysqli_num_rows($query);
    if($number_of_rows==0){
        redirect_after_msg("You have not registered for event ", 'index.php');
    }
    $row = mysqli_fetch_assoc($query);
    $collection_id=$row['id'];

    //checking wheather user has already filled he feedback
    $number_of_rows = getNumRows("SELECT * FROM csi_feedback WHERE collection_id='".$collection_id."'");
    if($number_of_rows>=1){
        redirect_after_msg("You have already filled the feedback ", 'index.php');
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit_btn'])){
        $user_id=$_SESSION['email'];
        $q1=$_POST['one'];
        $q2=$_POST['two'];
        $q3=$_POST['three'];
        $q4=$_POST['four'];
        $q5=$_POST['five'];
        $q6=$_POST['six'];
        $q7=$_POST['seven'];
        $query=$_POST['query'];
        $stmt = execute("INSERT INTO `csi_feedback`( `collection_id`,`Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `Q6`, `Q7`, `any_queries`) 
                        VALUES ('$collection_id','".$_POST['one']."','".$_POST['two']."','".$_POST['three']."','".$_POST['four']."','".$_POST['five']."','".$_POST['six']."','".$_POST['seven']."','".$_POST['query']."')");
        
        $selfie_img = mysqli_insert_id($conn);
    
        if (isset($_FILES['selfie'])) {
            $image = fileTransfer('selfie', 'Selfies');
            if($image['error'] == NULL){
                $file_new_selfie = $image['file_new_name'];
                execute("UPDATE `csi_feedback` SET `selfie`='$file_new_selfie' WHERE id='$selfie_img'");
            } else {
                function_alert($image['error']);
            }
        }
        redirect_after_msg("thank you for filling  the feedback", 'index.php');
    }
    ?>
</head>

<body>
    <header>
        <h6>
            MAHAVIR EDUCATION TRUST'S<br>
            SHAH AND ANCHOR KUTCHHI ENGINEERING COLLEGE<br>
            COMPUTER SOCIETY OF INDIA
        </h6>
        <h4>CSI-SAKEC</h4>
        <h2>
        <?php
                // collaboration of event
                $querycollaboration = execute("SELECT * FROM csi_collaboration WHERE event_id='$event_id'");
                $collaboration = "";
                for($i = mysqli_num_rows($querycollaboration); $i > 0; $i--){
                    $rowcollaboration = mysqli_fetch_assoc($querycollaboration);
                    $collaboration = $collaboration.$rowcollaboration['collab_body'];
                    if($i != 1)$collaboration = $collaboration.", ";
                }
                if(mysqli_num_rows($querycollaboration)){
                    echo "In collaboration with ".$collaboration." ";
                }
            ?>
        oraganises a sesion on <?php echo $rowevent['title']; ?> </h2>
    </header>
    <div class="spacer" style="height:15px;"></div>
    <div class="container">
    
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="e_id" value="<?php echo $event_id; ?>">
            <div class="spacer" style="height:20px;"></div>
            <input type="hidden" name="eventName" value=" ">
            <input type="hidden" name="email" value=" ">
            <input type="hidden" name="name" value=" ">
            <input type="hidden" name="mobile" value=" ">
            <input type="hidden" name="college" value=" ">
            <div class="spacer" style="height:20px;"></div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="labels">
                        <label >Q1: Was the session contents relevant and helpful ?</label>
                    </div>
                </div>
                <div class="col-sm-5">
                <div class="texts">
                        <input type="radio" name="one" value="1" required="required">
                        <input type="radio" name="one" value="2">                    
                        <input type="radio" name="one" value="3">
                        <input type="radio" name="one" value="4">
                        <input type="radio" name="one" value="5">
                    </div>
                </div>
            </div>
            <div class="spacer" style="height:20px;"></div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="labels">
                        <label >Q2:How informative did you find this session ? </label>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="texts">
                        <input type="radio" name="two" value="1" required="required">
                        <input type="radio" name="two" value="2">                    
                        <input type="radio" name="two" value="3">
                        <input type="radio" name="two" value="4">
                        <input type="radio" name="two" value="5">
                    </div>
                </div>
            </div>
            <div class="spacer" style="height:20px;"></div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="labels">
                        <label >Q3: How much would you rate the Presenter ?</label>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="texts">
                        <input type="radio" name="three" value="1" required="required">
                        <input type="radio" name="three" value="2">                    
                        <input type="radio" name="three" value="3">
                        <input type="radio" name="three" value="4">
                        <input type="radio" name="three" value="5">
                    </div>
                </div>
            </div>
            <div class="spacer" style="height:20px;"></div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="labels">
                        <label >Q4: How timely, efficient and effective was the execution of the session ? </label>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="texts">
                        <input type="radio"  name="four" value="1" required="required">
                        <input type="radio"  name="four" value="2">                    
                        <input type="radio"  name="four" value="3">
                        <input type="radio"  name="four" value="4">
                        <input type="radio"  name="four" value="5">
                    </div>
                </div>
            </div>
            <div class="spacer" style="height:20px;"></div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="labels">
                        <label >Q5 : How would you rate your overall experience with this session ? </label>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="texts">
                        <input type="radio"  name="five" value="1" required="required">
                        <input type="radio"  name="five" value="2">                    
                        <input type="radio"  name="five" value="3">
                        <input type="radio"  name="five" value="4">
                        <input type="radio"  name="five" value="5">
                    </div>
                </div>
            </div>
            <div class="spacer" style="height:20px;"></div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="labels">
                        <label >Q6:Would you like to participate in future such Session, Events and Activities with
us ?</label>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="texts">
                        <input type="radio" name="six" value="1" required="required">
                        <input type="radio" name="six" value="2">                    
                        <input type="radio" name="six" value="3">
                        <input type="radio" name="six" value="4">
                        <input type="radio" name="six" value="5">
                    </div>
                </div>
            </div>
            <div class="spacer" style="height:20px;"></div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="labels">
                        <label >Q7: How do you want the pace of teaching? </label>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="texts">
                        <input type="radio"  name="seven" value="fast" required="required">
                        <label >I want fast</label>
                        <br>
                        <input type="radio"  name="seven" value="current">
                        <label >Current speed is good</label>
                        <br>                    
                        <input type="radio"  name="seven" value="slow">
                        <label>I want slow</label>
                        <br>
                    </div>
                </div>
            </div>
            <div class="spacer" style="height:20px;"></div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="labels">
                        <label >ANY QUERIES </label>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="texts">
                        <textarea  name="query" required="required"></textarea>
                    </div>
                </div>
            </div>
            <div class="spacer" style="height:20px;"></div>
            <?php 
                if($rowevent['selfie']==1){
            ?>
            <div class="row">
                <div class="col-sm-7">
                    <div class="labels">
                        <label for="banner-img">Upload Selfie :</label>
                    </div>
                </div>
                <div class="col-sm-5">
                    <input type="file" id="img" name="selfie" required="required">
                </div>
            </div>
            <?php 
                }
            ?>
        </div>

    <div class="spacer" style="height:20px;"></div>
    <!-- <button type="button" onclick="collaboration_appearance()" class="btn btn-primary" id="collaboration_id_button">Collaboration</button> -->
    <!-- <button type="button" onclick="Disappear()" class="btn btn-primary" id="speaker_nospeaker">No Speaker</button> -->
    <button type="submit" name="submit_btn" class="btn btn-primary">Sumbit</button>
    <div class="spacer" style="height:40px;"></div>
    </form>
    <div class="spacer" style="height:40px;"></div>
    <div class="footer">
        <div class="spacer" style="height:2px;"></div>
        <a href="index.php"><i class="fas fa-home"></i></a>
        <div class="spacer" style="height:0px;"></div>
        <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
        <div class="spacer" style="height:1px;"></div>
    </div>
</body>
</html>