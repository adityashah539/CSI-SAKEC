<?php
$step = $_POST['step'];
if ($step == 1) {
?>
    <div class="d-flex justify-content-center my-4">
        <label for="Email"><i class="far fa-user-circle fa-2x"></i></label>
        <input id="Email" type="text" class="form-control w-25 mx-3" name="email" required="required" placeholder=" Username" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <button name="submitEmail" class="btn main_btn">Submit<i class="fas fa-sign-in-alt"></i></button>
<?php
} else if ($step == 2) {
?>
    <div class="down- d-flex justify-content-center my-4 ">
        <label for="Password"></label>
        <div><i class="fas fa-lock-open fa-2x"></i>Time left = <span id="timer"></span></div>
    </div>
    <div class="down- d-flex justify-content-center my-4 ">
        <form method="get" class="digit-group" data-group-name="digits" data-autosubmit="false" autocomplete="off">
            <input type="number" class="onenumber" id="digit-1" name="digit-1" data-next="digit-2" />
            <input type="number" class="onenumber" id="digit-2" name="digit-2" data-next="digit-3" data-previous="digit-1" />
            <input type="number" class="onenumber" id="digit-3" name="digit-3" data-next="digit-4" data-previous="digit-2" />
            <span class="splitter">&ndash;</span>
            <input type="number" class="onenumber" id="digit-4" name="digit-4" data-next="digit-5" data-previous="digit-3" />
            <input type="number" class="onenumber" id="digit-5" name="digit-5" data-next="digit-6" data-previous="digit-4" />
            <input type="number" class="onenumber" id="digit-6" name="digit-6" data-previous="digit-5" />
        </form>
    </div>
    <div class="down- d-flex justify-content-center my-4 ">
        <input type="submit" name="submit_opt" class="btn btn-primary">
        <button class="btn main-btn"></button>
    </div>
<?php
} else if ($step == 3) {
?>
    <div class="down-1 d-flex justify-content-center my-4 ">
        <label for="Password"><i class="fas fa-lock-open fa-2x"></i></label>
        <input id="Password" type="text" class="form-control w-25 mx-3 " name="newPassword" required="required" placeholder="New Password" aria-label="New Password" aria-describedby="basic-addon1">
    </div>
    <div class="down-2 d-flex justify-content-center my-4 ">
        <label for="ConfirmPassword"><i class="fas fa-lock fa-2x"></i></label>
        <input id="ConfirmPassword" type="text" class="form-control w-25 mx-3 " name="confirmPassword" required="required" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="basic-addon1">
    </div>
    <div class="down-3">
        <button name="submitPassword" class="btn main_btn">Submit <i class="fa fa-arrow-circle-right"></i></button>
    </div>

<?php
}
?>