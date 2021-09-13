<?php
require_once "../config.php";
session_start();

$email = $_SESSION['email'];
$user_id = getSpecificValue("SELECT `id` from `csi_userdata` where emailID = '$email'", 'id');
$noOfRows = getNumRows("SELECT `id`  FROM `csi_membership` WHERE userid = $user_id");
// Shows the status of the membership
if ($noOfRows != 0) {
    // Membership exists
    $membership_ends = getSpecificValue("SELECT `duration` FROM `csi_membership` WHERE userid = $user_id", 'duration');
    if ($membership_ends >= date("Y-m-d")) {
?>
        <div class='alert alert-success text-center' role='alert'>
            Your Current Membership expires on  <?php echo date("d-m-Y", strtotime($membership_ends)) ; ?>
        </div>
<?php
    } else if($membership_ends != null) {
?>
        <div class='alert alert-danger text-center ' role='alert' >
            Your last Membership expired on <?php echo date("d-m-Y", strtotime($membership_ends)) ; ?>
        </div>
<?php
    }
} 
// Shows any pending status of membership
$bill = getNumRows("SELECT b.id from csi_userdata as u, csi_membership as m, csi_membership_bills as b where accepted = 0 and b.membership_id = m.id and m.userid = u.id and u.id = $user_id", 'id');
if ($bill > 0) {
?>
    
    <div class='container-sm'>
        <div class="alert alert-warning text-center" role='alert'>
            Your current bill is pending for acceptance
        </div>
    </div>
<?php
} 
?>