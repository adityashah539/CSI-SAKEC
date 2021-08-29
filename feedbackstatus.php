<?php
require_once "config.php";
session_start();

$part3 = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">';
$part4 = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></div>';
//taking event id 
$event_id = $_GET['e_id'];
?>

<div class="container" id="registration">
    <?php
    //checking if feedback is enabled
    $eventquery = execute("SELECT * FROM csi_event WHERE id='$event_id'");
    // collaboration of event
    $querycollaboration = execute("SELECT * FROM csi_collaboration WHERE event_id='$event_id'");
    $collaboration = "";
    $rowevent = mysqli_fetch_assoc($eventquery);
    for ($i = mysqli_num_rows($querycollaboration); $i > 0; $i--) {
        $rowcollaboration = mysqli_fetch_assoc($querycollaboration);
        $collaboration = $collaboration . $rowcollaboration['collab_body'];
        if ($i != 1) $collaboration = $collaboration . ", ";
    }
    ?>
    <header class="container text-center my-4">
        <h2>
            Event Registration for <?php echo $rowevent['title']; ?>
            <?php
            if (mysqli_num_rows($querycollaboration)) {
                echo "In collaboration with " . $collaboration . " ";
            }
            ?>
        </h2>
    </header>
    <?php

    //checking wheather user is logged in
    if (!isset($_SESSION['email'])) {
        echo ("$part3 Please Login $part4");
    } else {

        //checking if feedback is enabled
        $eventquery = execute("SELECT * FROM csi_event WHERE id='$event_id' and feedback='1'");
        $number_of_event = mysqli_num_rows($eventquery);
        if ($number_of_event == 0) {
            echo ("$part3 feedback is disabled for the event contact admin $part4");
        } else {
            $rowevent = mysqli_fetch_assoc($eventquery);

            //checking wheather user is registered
            $query = execute("SELECT `id` FROM csi_collection WHERE event_id='$event_id' and user_id=(SELECT `id` FROM csi_userdata WHERE emailID='" . $_SESSION['email'] . "')");
            $number_of_rows = mysqli_num_rows($query);
            if ($number_of_rows == 0) {
                echo ("$part3 You have not registered for event $part4");
            } else {
                $row = mysqli_fetch_assoc($query);
                $collection_id = $row['id'];

                //checking wheather user has already filled he feedback
                $number_of_rows = getNumRows("SELECT * FROM csi_feedback WHERE collection_id='" . $collection_id . "'");
                if ($number_of_rows >= 1) {
                    echo ("$part3 You have already filled the feedback form $part4");
                } else {
    ?>
                    <div id='message'></div>
                    <input type="hidden" id="e_id" value="<?php echo $_GET['e_id']; ?>">
                    <form action="" method="POST" enctype="multipart/form-data" id="form">
                        <input type="hidden" name="e_id" value="<?php echo $event_id; ?>">
                        <div class="spacer" style="height:20px;"></div>
                        <div class="spacer" style="height:20px;"></div>
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="labels">
                                    <label>Q1: Was the session contents relevant and helpful ?</label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="texts">
                                    <input class="feedback_option" type="radio" id="one" name="one" value="1" required="required">
                                    <input class="feedback_option" type="radio" id="one" name="one" value="2">
                                    <input class="feedback_option" type="radio" id="one" name="one" value="3">
                                    <input class="feedback_option" type="radio" id="one" name="one" value="4">
                                    <input class="feedback_option" type="radio" id="one" name="one" value="5">
                                </div>
                            </div>
                        </div>
                        <div class="spacer" style="height:30px;"></div>
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="labels">
                                    <label>Q2:How informative did you find this session ? </label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="texts">
                                    <input class="feedback_option" type="radio" name="two" value="1" required="required">
                                    <input class="feedback_option" type="radio" name="two" value="2">
                                    <input class="feedback_option" type="radio" name="two" value="3">
                                    <input class="feedback_option" type="radio" name="two" value="4">
                                    <input class="feedback_option" type="radio" name="two" value="5">
                                </div>
                            </div>
                        </div>
                        <div class="spacer" style="height:30px;"></div>
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="labels">
                                    <label>Q3: How much would you rate the Presenter ?</label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="texts">
                                    <input class="feedback_option" type="radio" name="three" value="1" required="required">
                                    <input class="feedback_option" type="radio" name="three" value="2">
                                    <input class="feedback_option" type="radio" name="three" value="3">
                                    <input class="feedback_option" type="radio" name="three" value="4">
                                    <input class="feedback_option" type="radio" name="three" value="5">
                                </div>
                            </div>
                        </div>
                        <div class="spacer" style="height:30px;"></div>
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="labels">
                                    <label>Q4: How timely, efficient and effective was the execution of the session ? </label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="texts">
                                    <input class="feedback_option" type="radio" name="four" value="1" required="required">
                                    <input class="feedback_option" type="radio" name="four" value="2">
                                    <input class="feedback_option" type="radio" name="four" value="3">
                                    <input class="feedback_option" type="radio" name="four" value="4">
                                    <input class="feedback_option" type="radio" name="four" value="5">
                                </div>
                            </div>
                        </div>
                        <div class="spacer" style="height:30px;"></div>
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="labels">
                                    <label>Q5 : How would you rate your overall experience with this session ? </label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="texts">
                                    <input class="feedback_option" type="radio" name="five" value="1" required="required">
                                    <input class="feedback_option" type="radio" name="five" value="2">
                                    <input class="feedback_option" type="radio" name="five" value="3">
                                    <input class="feedback_option" type="radio" name="five" value="4">
                                    <input class="feedback_option" type="radio" name="five" value="5">
                                </div>
                            </div>
                        </div>
                        <div class="spacer" style="height:30px;"></div>
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="labels">
                                    <label>Q6:Would you like to participate in future such Session, Events and Activities with us ?</label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="texts">
                                    <input class="feedback_option" type="radio" name="six" value="1" required="required">
                                    <input class="feedback_option" type="radio" name="six" value="2">
                                    <input class="feedback_option" type="radio" name="six" value="3">
                                    <input class="feedback_option" type="radio" name="six" value="4">
                                    <input class="feedback_option" type="radio" name="six" value="5">
                                </div>
                            </div>
                        </div>
                        <div class="spacer" style="height:30px;"></div>
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="labels">
                                    <label>Q7: How do you want the pace of teaching? </label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="texts">
                                    <input class="feedback_option" type="radio" name="seven" value="fast" required="required">
                                    <label>I want fast</label>
                                    <br>
                                    <input class="feedback_option" type="radio" name="seven" value="current">
                                    <label>Current speed is good</label>
                                    <br>
                                    <input class="feedback_option" type="radio" name="seven" value="slow">
                                    <label>I want slow</label>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="spacer" style="height:30px;"></div>
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="labels">
                                    <label>ANY QUERIES </label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="texts">
                                    <textarea name="query" required="required"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="spacer" style="height:30px;"></div>
                        <?php
                        if ($rowevent['selfie'] == 1) {
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
                        <div class="spacer" style="height:20px;"></div>
                        <div class="text-center">
                            <button type="submit" name="submit_btn" class="btn btn-primary">Sumbit</button>
                        </div>

                        <div class="spacer" style="height:40px;"></div>
                    </form>
    <?php
                }
            }
        }
    }
    ?>

</div>
<script>
    $(document).ready(function(e) {
        $("form").on('submit', (function(e) {
            console.log($("#e_id").val());
            e.preventDefault();
            $.ajax({
                url: "feedbacksubmit.php?e_id=" + $("#e_id").val(),
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#message").html(data);
                    $("#form").html('');
                }
            });
        }));
    });
</script>