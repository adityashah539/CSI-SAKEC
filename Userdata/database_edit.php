<?php
require_once "../config.php";
?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> EDIT Admin Profile </h6>
        </div>
        <div class="card-body">
            <?php
            if (isset($_POST['edit_btn'])) {
                $id = $_POST['edit_id'];
                $query = execute("SELECT * FROM csi_userdata WHERE id='$id' ");
                foreach ($query as $row) {
            ?>
                <form action="update.php" method="POST">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                    <div class="form-group">
                        <label> Username </label>
                        <input type="text" name="edit_username" value="<?php echo $row['emailID'] ?>" class="form-control" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="edit_email" value="<?php echo $row['role'] ?>" class="form-control" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="edit_password" value="<?php echo $row['password'] ?>" class="form-control" placeholder="Enter Password">
                    </div>
                    <a href="register.php" class="btn btn-danger"> CANCEL </a>
                    <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>
                </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>