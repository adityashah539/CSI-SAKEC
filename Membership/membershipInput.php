<?php
require_once "../config.php";
session_start();
$email = $_SESSION['email'];
$user_id = getSpecificValue("SELECT `id` from `csi_userdata` where emailID = '$email'", 'id');
$bill = getNumRows("SELECT b.id from csi_userdata as u, csi_membership as m, csi_membership_bills as b where accepted = 0 and b.membership_id = m.id and m.userid = u.id and u.id = $user_id", 'id');
if ($bill == 0) {
    $noOfRows = getNumRows("SELECT `id`  FROM `csi_membership` WHERE userid = $user_id");
?>
    <div class="container ">
        <div class="mt-4">
            <h4>Student Membership <?php echo ($noOfRows == 0) ? "Registration" : "Renewal"; ?></h4>
        </div>
        <p>Fill all the fields carefully</p>
        <hr>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mx-5">
                <?php
                if ($noOfRows == 0) {
                ?>
                    <div class="form-group row">
                        <label for="Dateofbirth" class="col-sm-3">Date of Birth </label>
                        <div class="col-sm-7">
                            <input id="Dateofbirth" type="date" name="dob" required="required" max="<?php echo date('Y-m-d', strtotime('-17 years')); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Primary Email </label>
                        <div class="col-sm-7">
                            <input type="email" name="pemail" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Starting year </label>
                        <div class="col-sm-7">
                            <!-- <input type="number" name="syear" required="required"> -->
                            <select type="number" name="syear" id="syear" required="required">
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
                    <div class="form-group row">
                        <label for="" class="col-sm-3">Ending year </label>
                        <div class="col-sm-7">
                            <!-- <input type="number" name="eyear" required="required"> -->
                            <select type="number" name="eyear" id="eyear" required="required">
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
                    <div class="form-group row">
                        <label for="rnumber" class="col-sm-3">College Registration Number :</label>
                        <div class="col-sm-7">
                            <div class="texts">
                                <input type="number" id="rnumber" name="registration_number" value="" required="required">
                                <small id="rnumberlHelp" class="form-text text-muted">As printed on your ID card</small>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="form-group row">
                    <label class="col-sm-3">Amount paid :</label>
                    <div class="col-sm-7">
                        <input type="text" name="amount" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3">Membership in years :</label>
                    <div class="col-sm-7">
                        <div class="texts">
                            <select name="member_period" class="custom-select mb-3 w-25" required="required">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3">Bill photo :</label>
                    <div class="col-sm-7">
                        <input type="file" name="billphoto" required>
                    </div>
                </div>
                <div class="form-groups row mb-4">
                    <div class="col-sm-5 text-center">
                        <div class="register">
                            <button type="submit" name="submit" class="btn btn-primary">Submit Application</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php
}else{
?>
<div class="spacer" style="height:285px;"></div>
<?php
}
?>