<div id="membershipStatus"></div>
<div id="message"></div>
<?php
require_once "../config.php";
session_start();
$email = $_SESSION['email'];
$user_id = getSpecificValue("SELECT `id` from `csi_userdata` where emailID = '$email'", 'id');
$bill = getNumRows("SELECT b.id from csi_userdata as u, csi_membership as m, csi_membership_bills as b where accepted = 0 and b.membership_id = m.id and m.userid = u.id and u.id = $user_id", 'id');
if ($bill == 0) {
    $noOfRows = getNumRows("SELECT `id`  FROM `csi_membership` WHERE userid = $user_id");
?>
    <div class="container text-center" id="registration">
        <div class="">
            <h4>Student Membership <?php echo ($noOfRows == 0) ? "Registration" : "Renewal"; ?></h4>
        </div>
        <p>Fill all the fields carefully</p>
        <hr>
        <form action="" method="POST" enctype="multipart/form-data">
            <?php
            if ($noOfRows == 0) {
            ?>
                <div class="form-group row justify-content-sm-center">
                    <label for="Dateofbirth" class="col-sm-3 text-left">Date of Birth </label>
                    <div class="col-sm-3">
                        <input id="Dateofbirth" type="date" name="dob" required="required" max="<?php echo date('Y-m-d', strtotime('-17 years')); ?>">
                    </div>
                </div>
                <div class="form-group row justify-content-sm-center">
                    <label for="" class="col-sm-3 text-left">Primary Email </label>
                    <div class="col-sm-3">
                        <input type="email" name="pemail" required="required">
                    </div>
                </div>
                <div class="form-group row justify-content-sm-center">
                    <label for="" class="col-sm-3 text-left">Starting year </label>
                    <div class="col-sm-3">
                        <select type="number" name="syear" id="syear" class="custom-select mb-3 w-40" required="required">
                            <?php
                            $selected_year = date('Y');
                            $earliest_year = date('Y', strtotime('-10 years'));
                            foreach (range($selected_year, $earliest_year) as $x) {
                                echo '<option value="' . $x . '"' . ($x === $selected_year ? ' selected="selected"' : '') . '>' . $x . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row justify-content-sm-center">
                    <label for="" class="col-sm-3 text-left">Ending year</label>
                    <div class="col-sm-3">
                        <select type="number" name="eyear" id="eyear" class="custom-select mb-3 w-40" required="required">
                            <?php
                            $selected_year = date('Y', strtotime('+4 years'));
                            $earliest_year = date('Y');
                            foreach (range($selected_year, $earliest_year) as $x) {
                                echo '<option value="' . $x . '"' . ($x === $selected_year ? ' selected="selected"' : '') . '>' . $x . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row justify-content-sm-center">
                    <label for="rnumber" class="col-sm-3 text-left">College Registration Number :</label>
                    <div class="col-sm-3">
                        <div class="texts">
                            <input type="number" id="rnumber" name="registration_number" value="" required="required">
                            <small id="rnumberlHelp" class="form-text text-muted">As printed on your ID card</small>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="form-group row justify-content-sm-center">
                <label class="col-sm-3 text-left">Amount paid :</label>
                <div class="col-sm-3">
                    <input type="text" name="amount" required>
                </div>
            </div>
            <div class="form-group row justify-content-sm-center">
                <label class="col-sm-3 text-left">Membership in years :</label>
                <div class="col-sm-3">
                    <div class="texts">
                        <select name="member_period" class="custom-select mb-3 w-40" required="required">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group row justify-content-sm-center">
                <label class="col-sm-3 text-left">Bill photo :</label>
                <div class="col-sm-3">
                    <input type="file" name="billphoto" required>
                </div>
            </div>
            <div class="form-groups row mb-4 justify-content-sm-center">
                <div class="col-sm-3 mt-4 text-center">
                    <div class="register">
                        <button type="submit" name="submit" class="btn main_btn_read_more">Submit </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php
} else {
?>

<?php
}
?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#membershipStatus").load("membershipStatus.php");
        $("#syear").on('change', function() {
            var val = parseInt($("#syear").children("option:selected").val());
            $("#eyear").val(val + 4);
        });
        $("form").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "membershipsubmit.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#message").html(data);
                    $("#registration").html('');
                    $("#membershipStatus").load("membershipStatus.php");
                }
            });
        }));
    });
</script>