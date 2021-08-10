
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Basic -->
    <link rel="icon" href="../images/csi-logo.png">
    <!-- Boostrap-4.6.0-->
    <link rel="stylesheet" href="../plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">

    <!-- CSS file  -->
    <link rel="stylesheet" href="../css/membership.css?v=<?php echo time(); ?>">
    <title>Database</title>
    <?php
    require_once "../config.php";
    session_start();
    $access=NULL;
    if(isset($_SESSION["role_id"])){
        $role_id = $_SESSION["role_id"];
        $access = getValue("SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id");
    }
    if (isset($access) && $access["role"] === "0") {
        header("location:../index.php");
    }
    ?>
    
</head>

<body>
    <?php
    // Database Connection
    if (isset($_SESSION['email'])) {
        if (isset($access) && $access["role"] === "1") {
            $role_id = $_GET["role_id"];
            $row = getValue("SELECT * FROM `csi_role` WHERE id='$role_id'");
    ?>
            <header>
                <h2 style="text-align: center;">Edit Role for <?php echo $row["role_name"]; ?></h2>
            </header>
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-dark default-color sticky-top">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
                    <form action="" method="get"></form>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="role.php"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php"><i class="fas fa-home"></i> Home</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto nav-flex-icons">
                    </ul>
                </div>
            </nav>
            <!-- Navbar -->
            
            <!-- Main -->
            <table class="table" id="myTable">
                <thead class="table-head">
                    <tr>
                        <th>Features</th>
                        <th>Access</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="table-content" style="font-size: large;">
                        <div class="table-data">
                            <tr>
                                <td>Main Page Edit</td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn btn-outline-success ">
                                            <input type="radio" name='mge' value="1" <?php if ($row['main_page_edit'] == "1") {echo 'checked';} ?>> <i class="fas fa-check"></i>
                                        </label>
                                        <label class="btn btn-outline-danger ">
                                            <input type="radio" name='mge' value="0" <?php if ($row['main_page_edit'] == "0") {echo 'checked';} ?>> <i class="fas fa-times"></i>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>User-Data</td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn btn-outline-success ">
                                            <input type="radio" name='ud' value="1" <?php if ($row['user_data'] == "1") {echo 'checked';} ?>> <i class="fas fa-check"></i>
                                        </label>
                                        <label class="btn btn-outline-danger ">
                                            <input type="radio" name='ud' value="0" <?php if ($row['user_data'] == "0") {echo 'checked';} ?>> <i class="fas fa-times"></i>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn btn-outline-success ">
                                            <input type="radio" name='role' value="1" <?php if ($row['role'] == "1") {echo 'checked';} ?>> <i class="fas fa-check"></i>
                                        </label>
                                        <label class="btn btn-outline-danger ">
                                            <input type="radio" name='role' value="0" <?php if ($row['role'] == "0") {echo 'checked';} ?>> <i class="fas fa-times"></i>
                                        </label>
                                    </div>
                                </td>
                            </tr><tr>
                                <td>Add Event</td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn btn-outline-success ">
                                            <input type="radio" name='ae' value="1" <?php if ($row['add_event'] == "1") {echo 'checked';} ?>> <i class="fas fa-check"></i>
                                        </label>
                                        <label class="btn btn-outline-danger ">
                                            <input type="radio" name='ae' value="0" <?php if ($row['add_event'] == "0") {echo 'checked';} ?>> <i class="fas fa-times"></i>
                                        </label>
                                    </div>
                                </td>
                            </tr><tr>
                                <td>Budget</td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn btn-outline-success ">
                                            <input type="radio" name='budget' value="1" <?php if ($row['budget'] == "1") {echo 'checked';} ?>> <i class="fas fa-check"></i>
                                        </label>
                                        <label class="btn btn-outline-danger ">
                                            <input type="radio" name='budget' value="0" <?php if ($row['budget'] == "0") {echo 'checked';} ?>> <i class="fas fa-times"></i>
                                        </label>
                                    </div>
                                </td>
                            </tr><tr>
                                <td>Manage Event</td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn btn-outline-success ">
                                            <input type="radio" name='me' value="1" <?php if ($row['manage_event'] == "1") {echo 'checked';} ?>> <i class="fas fa-check"></i>
                                        </label>
                                        <label class="btn btn-outline-danger ">
                                            <input type="radio" name='me' value="0" <?php if ($row['manage_event'] == "0") {echo 'checked';} ?>> <i class="fas fa-times"></i>
                                        </label>
                                    </div>
                                </td>
                            </tr><tr>
                            </tr><tr>
                                <td>Edit Attendance</td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn btn-outline-success ">
                                            <input type="radio" name='edit_a' value="1" <?php if ($row['edit_attendance'] == "1") {echo 'checked';} ?>> <i class="fas fa-check"></i>
                                        </label>
                                        <label class="btn btn-outline-danger ">
                                            <input type="radio" name='edit_a' value="0" <?php if ($row['edit_attendance'] == "0") {echo 'checked';} ?>> <i class="fas fa-times"></i>
                                        </label>
                                    </div>
                                </td>
                            </tr><tr>
                                <td>Permission Letter</td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn btn-outline-success ">
                                            <input type="radio" name='pl' value="1" <?php if ($row['permission_letter'] == "1") {echo 'checked';} ?>> <i class="fas fa-check"></i>
                                        </label>
                                        <label class="btn btn-outline-danger ">
                                            <input type="radio" name='pl' value="0" <?php if ($row['permission_letter'] == "0") {echo 'checked';} ?>> <i class="fas fa-times"></i>
                                        </label>
                                    </div>
                                </td>
                            </tr><tr>
                                <td>Report</td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn btn-outline-success ">
                                            <input type="radio" name='report' value="1" <?php if ($row['report'] == "1") {echo 'checked';} ?>> <i class="fas fa-check"></i>
                                        </label>
                                        <label class="btn btn-outline-danger ">
                                            <input type="radio" name='report' value="0" <?php if ($row['report'] == "0") {echo 'checked';} ?>> <i class="fas fa-times"></i>
                                        </label>
                                    </div>
                                </td>
                            </tr><tr>
                                <td>Confirm Event Registration</td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn btn-outline-success ">
                                            <input type="radio" name='cer' value="1" <?php if ($row['confirm_event_registration'] == "1") {echo 'checked';} ?>> <i class="fas fa-check"></i>
                                        </label>
                                        <label class="btn btn-outline-danger ">
                                            <input type="radio" name='cer' value="0" <?php if ($row['confirm_event_registration'] == "0") {echo 'checked';} ?>> <i class="fas fa-times"></i>
                                        </label>
                                    </div>
                                </td>
                            </tr><tr>
                                <td>Content Repository</td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn btn-outline-success ">
                                            <input type="radio" name='cr' value="1" <?php if ($row['content_repository'] == "1") {echo 'checked';} ?>> <i class="fas fa-check"></i>
                                        </label>
                                        <label class="btn btn-outline-danger ">
                                            <input type="radio" name='cr' value="0" <?php if ($row['content_repository'] == "0") {echo 'checked';} ?>> <i class="fas fa-times"></i>
                                        </label>
                                    </div>
                                </td>
                            </tr><tr>
                                <td>Feedback Response</td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn btn-outline-success ">
                                            <input type="radio" name='fr' value="1" <?php if ($row['feedback_response'] == "1") {echo 'checked';} ?>> <i class="fas fa-check"></i>
                                        </label>
                                        <label class="btn btn-outline-danger ">
                                            <input type="radio" name='fr' value="0" <?php if ($row['feedback_response'] == "0") {echo 'checked';} ?>> <i class="fas fa-times"></i>
                                        </label>
                                    </div>
                                </td>
                            </tr><tr>
                                <td>Query</td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn btn-outline-success ">
                                            <input type="radio" name='query' value="1" <?php if ($row['query'] == "1") {echo 'checked';} ?>> <i class="fas fa-check"></i>
                                        </label>
                                        <label class="btn btn-outline-danger ">
                                            <input type="radio" name='query' value="0" <?php if ($row['query'] == "0") {echo 'checked';} ?>> <i class="fas fa-times"></i>
                                        </label>
                                    </div>
                                </td>
                            </tr><tr>
                                <td>Reply Log</td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn btn-outline-success ">
                                            <input type="radio" name='rl' value="1" <?php if ($row['reply_log'] == "1") {echo 'checked';} ?>> <i class="fas fa-check"></i>
                                        </label>
                                        <label class="btn btn-outline-danger ">
                                            <input type="radio" name='rl' value="0" <?php if ($row['reply_log'] == "0") {echo 'checked';} ?>> <i class="fas fa-times"></i>
                                        </label>
                                    </div>
                                </td>
                            </tr><tr>
                                <td>Audit</td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn btn-outline-success ">
                                            <input type="radio" name='audit' value="1" <?php if ($row['audit'] == "1") {echo 'checked';} ?>> <i class="fas fa-check"></i>
                                        </label>
                                        <label class="btn btn-outline-danger ">
                                            <input type="radio" name='audit' value="0" <?php if ($row['audit'] == "0") {echo 'checked';} ?>> <i class="fas fa-times"></i>
                                        </label>
                                    </div>
                                </td>
                            </tr><tr>
                                <td>Confirm Membership</td>
                                <td>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn btn-outline-success ">
                                            <input type="radio" name='cm' value="1" <?php if ($row['confirm_membership'] == "1") {echo 'checked';} ?>> <i class="fas fa-check"></i>
                                        </label>
                                        <label class="btn btn-outline-danger ">
                                            <input type="radio" name='cm' value="0" <?php if ($row['confirm_membership'] == "0") {echo 'checked';} ?>> <i class="fas fa-times"></i>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        </div>
                    </div>
                </tbody>
            </table>
            <!-- Main -->
    <?php       
        } else {
            header("location:../index.php");
        }
    } else {
        header("../Login/login.php?notlogin=true");
    }
    ?>

    <!-- Spacer -->
    <div class="spacer" style="height:59px;"></div>
    <!-- Spacer -->

    <!-- Footer -->
    <div class="footer">
        <div class="spacer" style="height:2px;"></div>
        <a href="index.php"><i class="fas fa-home"></i></a>
        <div class="spacer" style="height:0px;"></div>
        <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
        <div class="spacer" style="height:1px;"></div>
    </div>
    <!-- Footer -->

    <!-- DO NOT DELETE THIS  -->
    <script src="../plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="../plugins/jquery.min.js"></script>
    <script src="../plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
    <!-- DO NOT DELETE THIS  -->

    <!-- To Update the database  -->
    <script>
        //jquery code for data
        $(document).ready(function(){
            $("input[name='mge']").click(function() {
                var radioValue = $("input[name='mge']:checked").val();
                if(radioValue){
                    $.post("changePermission.php",{
                        role_id:"<?php echo $role_id; ?>",
                        value:radioValue,
                        update:"main_page_edit"
                    });
                }
            });
            $("input[name='ud']").click(function() {
                var radioValue = $("input[name='ud']:checked").val();
                if(radioValue){
                    $.post("changePermission.php",{
                        role_id:"<?php echo $role_id; ?>",
                        value:radioValue,
                        update:"user_data"
                    });
                }
            });
            $("input[name='role']").click(function() {
                var radioValue = $("input[name='role']:checked").val();
                if(radioValue){
                    $.post("changePermission.php",{
                        role_id:"<?php echo $role_id; ?>",
                        value:radioValue,
                        update:"role"
                    });
                }
            });
            $("input[name='ae']").click(function() {
                var radioValue = $("input[name='ae']:checked").val();
                if(radioValue){
                    $.post("changePermission.php",{
                        role_id:"<?php echo $role_id; ?>",
                        value:radioValue,
                        update:"add_event"
                    });
                }
            });
            $("input[name='budget']").click(function() {
                var radioValue = $("input[name='budget']:checked").val();
                if(radioValue){
                    $.post("changePermission.php",{
                        role_id:"<?php echo $role_id; ?>",
                        value:radioValue,
                        update:"budget"
                    });
                }
            });
            $("input[name='me']").click(function() {
                var radioValue = $("input[name='me']:checked").val();
                if(radioValue){
                    $.post("changePermission.php",{
                        role_id:"<?php echo $role_id; ?>",
                        value:radioValue,
                        update:"manage_event"
                    });
                }
            });
            $("input[name='edit_a']").click(function() {
                var radioValue = $("input[name='edit_a']:checked").val();
                if(radioValue){
                    $.post("changePermission.php",{
                        role_id:"<?php echo $role_id; ?>",
                        value:radioValue,
                        update:"edit_attendance"
                    });
                }
            });
            $("input[name='pl']").click(function() {
                var radioValue = $("input[name='pl']:checked").val();
                if(radioValue){
                    $.post("changePermission.php",{
                        role_id:"<?php echo $role_id; ?>",
                        value:radioValue,
                        update:"permission_letter"
                    });
                }
            });
            $("input[name='report']").click(function() {
                var radioValue = $("input[name='report']:checked").val();
                if(radioValue){
                    $.post("changePermission.php",{
                        role_id:"<?php echo $role_id; ?>",
                        value:radioValue,
                        update:"report"
                    });
                }
            });
            $("input[name='cer']").click(function() {
                var radioValue = $("input[name='cer']:checked").val();
                if(radioValue){
                    $.post("changePermission.php",{
                        role_id:"<?php echo $role_id; ?>",
                        value:radioValue,
                        update:"confirm_event_registration"
                    });
                }
            });
            $("input[name='cr']").click(function() {
                var radioValue = $("input[name='cr']:checked").val();
                if(radioValue){
                    $.post("changePermission.php",{
                        role_id:"<?php echo $role_id; ?>",
                        value:radioValue,
                        update:"content_repository"
                    });
                }
            });
            $("input[name='fr']").click(function() {
                var radioValue = $("input[name='fr']:checked").val();
                if(radioValue){
                    $.post("changePermission.php",{
                        role_id:"<?php echo $role_id; ?>",
                        value:radioValue,
                        update:"feedback_response"
                    });
                }
            });
            $("input[name='query']").click(function() {
                var radioValue = $("input[name='query']:checked").val();
                if(radioValue){
                    $.post("changePermission.php",{
                        role_id:"<?php echo $role_id; ?>",
                        value:radioValue,
                        update:"query"
                    });
                }
            });
            $("input[name='rl']").click(function() {
                var radioValue = $("input[name='rl']:checked").val();
                if(radioValue){
                    $.post("changePermission.php",{
                        role_id:"<?php echo $role_id; ?>",
                        value:radioValue,
                        update:"reply_log"
                    });
                }
            });
            $("input[name='audit']").click(function() {
                var radioValue = $("input[name='audit']:checked").val();
                if(radioValue){
                    $.post("changePermission.php",{
                        role_id:"<?php echo $role_id; ?>",
                        value:radioValue,
                        update:"audit"
                    });
                }
            });
            $("input[name='cm']").click(function() {
                var radioValue = $("input[name='cm']:checked").val();
                if(radioValue){
                    $.post("changePermission.php",{
                        role_id:"<?php echo $role_id; ?>",
                        value:radioValue,
                        update:"confirm_membership"
                    });
                }
            });
        });
    </script>
    <!-- To Update the database  -->

</body>

</html>