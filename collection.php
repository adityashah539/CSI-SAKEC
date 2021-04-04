<?php
    require_once "config.php";
    $sql = "SELECT `role_name` FROM `role`";
    $result = mysqli_query($conn, $sql);
    $roles=array();
    while ($row = mysqli_fetch_assoc($result)) {
        $roles[]=$row['role_name'];
    }
    $sql = "SELECT `firstName`,`lastName`,`emailID`,`phonenumber`,`branch`,`class`,`role_name` FROM `userdata`  INNER JOIN `role` ON `userdata`.`role`=`role`.`id`";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <select name="role" class="custom-select mb-3">
                <?php
                foreach ($roles as $role) {
                    if($row['role_name']==$role){
                        echo ' <option value="'.$role.'" selected >' .$role.'</option>';
                    }
                    else{
                        echo ' <option value="'.$role.'">' .$role. '</option>';
                    }
                }
                ?>
            </select>
            <?php
        }
    }
   
?>