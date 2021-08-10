<?php

?>
<h4>Step 2: Fill the details</h4>

<input type="text" name="email" value="<?php echo $email; ?>" hidden>
<div class="grid-item item3">
    <div class="texts ">
        <select id="gender" required="required" class="custom-select my-2 bg-transparent text-light w-auto">
            <option disabled>Select Gender</option>
            <option class="text-secondary" value="male">Male</option>
            <option class="text-secondary" value="female">Female</option>
        </select>
    </div>
</div>
<div class="d-flex justify-content-center my-4">
    <label ><i class="fas fa-lock fa-2x"></i></label>
    <input type="password" class="form-control w-25 p-3 mx-3" name="password" required="required" placeholder="Password">
</div>
<div class="d-flex justify-content-center my-4">
    <label><i class="fa fa-key fa-2x"></i></label>
    <input type="password" class="form-control w-25 p-3 mx-3" name="confirmPassword" required="required" placeholder="Confirm Password">
</div>
<button class="btn btn-primary" name="sign_up_sakec">Sign Up <i class="fas fa-user-plus "></i></button></br></br>


<input type="text" name="email" value="<?php echo $email; ?>" hidden>
<div class="d-flex justify-content-center my-4">
    <label><i class="fas fa-file-signature fa-2x"></i></label>
    <input type="text" class="form-control w-25 p-3 mx-3" name="Name" required="required" placeholder="Name">
</div>
<div class="grid-container">
    <div class="grid-item item1">
        <div class="texts">
            <select id="branch" required="required" class="custom-select my-2 bg-transparent text-white w-auto">
                <option disabled>Select Branch</option>
                <option class="text-secondary" value="CS">Computer Science</option>
                <option class="text-secondary" value="IT">Information Technology</option>
                <option class="text-secondary" value="Electronics"> Electronics</option>
                <option class="text-secondary" value="EXTC">EXTC</option>
            </select>
        </div>
    </div>
    <div class="grid-item item1">
        <div class="texts">
            <select id="gender" required="required" class="custom-select my-2 bg-transparent text-white w-auto">
                <option disabled>Select Gender</option>
                <option class="text-secondary" value="male">Male</option>
                <option class="text-secondary" value="female">Female</option>
            </select>
        </div>
    </div>
    <div class="grid-item item2">
        <div class="texts">
            <select id="year" required="required" class="custom-select my-2 bg-transparent text-white w-auto">
                <option disabled>Select Class</option>
                <option class="text-secondary" value="FE">FE</option>
                <option class="text-secondary" value="SE">SE</option>
                <option class="text-secondary" value="TE">TE</option>
                <option class="text-secondary" value="BE">BE</option>
            </select>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center my-4">
    <label><i class="fas fa-university fa-2x"></i></label>
    <input type="password" class="form-control w-25 p-3 mx-3" name="collegeName" required="required" placeholder="College Name">
</div>
<div class="d-flex justify-content-center my-4">
    <label><i class="fas fa-phone fa-2x"></i></label>
    <input type="password" class="form-control w-25 p-3 mx-3" name="phonenumber" required="required" placeholder="Phone Number">
</div>
<div class="d-flex justify-content-center my-4">
    <label ><i class="fas fa-lock fa-2x"></i></label>
    <input type="password" class="form-control w-25 p-3 mx-3" name="password" required="required" placeholder="Password">
</div>
<div class="d-flex justify-content-center my-4">
    <label><i class="fa fa-key fa-2x"></i></label>
    <input type="password" class="form-control w-25 p-3 mx-3" name="confirmPassword" required="required" placeholder="Confirm Password">
</div>
<button class="btn btn-primary" name="sign_up_non-sakec">Sign Up <i class="fas fa-user-plus "></i></button></br></br>
<p>Existing User <a class="text-primary" href="login.php">Login</a></p>