<?php
$step = $_POST['step'];
if($step=='error'){
    $error = $_POST['error'];
    $part1 = '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    $part2 = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button></div>';
    echo $part1.$error.$part2;
}else if ($step == 1) {
?>
    <div class="down-1 d-flex justify-content-center my-4 ">
        <label for="Email"><i class="far fa-user-circle fa-2x"></i></label>
        <input id="Email" type="text" class="form-control w-25 mx-3 " name="email" required="required" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="down-2">
        <button name="submit" value="2" class="btn main_btn">Submit <i class="fa fa-arrow-circle-right "></i></button>
    </div>
<?php
} else if ($step == 2) {
?>
    <div class="down-1 d-flex justify-content-center my-3">
        <label for="Password"></label>
        <div class='h2'><i class="fas fa-clock"></i> Time left <br><span id="timer"></span></div>
    </div>
    <div class="down-2 d-flex justify-content-center my-4 ">
        <form method="get" class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off">
            <input type="number" class="onenumber" id="digit-1" name="digit-1" data-next="digit-2" />
            <input type="number" class="onenumber" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" />
            <input type="number" class="onenumber" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" />
            <span class="splitter">&ndash;</span>
            <input type="number" class="onenumber" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" />
            <input type="number" class="onenumber" id="digit-5" name="digit-5" data-next="digit-6" data-previous="digit-4" />
            <input type="number" class="onenumber" id="digit-6" name="digit-6" data-previous="digit-5" />
        </form>
        <button name="submit" type="button" id = "resendOtp" value="4" class="btn main_btn"><i class="fas fa-sync"></i> Resend otp </button>
    </div>
    <div class="down-3 d-flex justify-content-center my-4 ">
        <button name="submit" value="1" class="btn btn-back"><i class="fas fa-arrow-circle-left fa-2x"></i></button>
        <button name="submit" value="3" class="btn main_btn">Submit <i class="fa fa-arrow-circle-right"></i></button>
    </div>
<?php
} else if ($step == 3) {
?>
    <div class="down-1 d-flex justify-content-center my-4 ">
        <label for="Password"><i class="fas fa-lock-open fa-2x"></i></label>
        <input id="Password" type="password" class="form-control w-25 mx-3 " name="newPassword" required="required" placeholder="New Password" aria-label="New Password" aria-describedby="basic-addon1">
    </div>
    <div class="down-2 d-flex justify-content-center my-4 ">
        <label for="ConfirmPassword"><i class="fas fa-lock fa-2x"></i></label>
        <input id="ConfirmPassword" type="password" class="form-control w-25 mx-3 " name="confirmPassword" required="required" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="basic-addon1">
    </div>
    <div class="down-3">
        <button name="submit" value="5" class="btn main_btn">Submit <i class="fa fa-arrow-circle-right"></i></button>
    </div>
<?php
}else if ($step == 5){
    require_once "../config.php";
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password =password_hash($password, PASSWORD_BCRYPT);
    $user_id = getValue("SELECT id FROM csi_userdata where emailID = '$email'");
    if (execute("UPDATE `csi_password` SET `password`='$password' WHERE `user_id`='$user_id'")){
        redirect_after_msg("Your password has been now you can login.", "login.php");
    }
}
?>