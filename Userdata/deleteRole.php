<?php
session_start();
require_once "../config.php";
$role = NULL;
if (isset($_SESSION["role_id"])) {
    $role_id = $_SESSION["role_id"];
    $sql = "SELECT * FROM `csi_role` WHERE `csi_role`.`id`=$role_id";
    $query =  mysqli_query($conn, $sql);
    $role = mysqli_fetch_assoc($query);
}
if (isset($_SESSION['email'])) {
    if (isset($role) && $role["role"] === "1") {
        $role_id = $_POST["role_id"];
        $sql = "DELETE FROM `csi_role` WHERE `csi_role`.`id`='$role_id'";
        mysqli_query($conn, $sql);
?>
        <table class="table" id="myTable">
            <thead class="table-head">
                <tr>
                    <th>Name</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION['email'])) {
                    if (isset($role) && $role["role"] === "1") {
                        $sql = "SELECT * FROM `csi_role`";
                        $query = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($query) > 0) {
                            $index = 0;
                            while ($row = mysqli_fetch_assoc($query)) {
                ?>
                                <tr>
                                    <td>
                                        <form action="edit_role.php" method="get">
                                            <input type="hidden" name="role_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="textbutton">
                                                <?php echo ucfirst($row['role_name']); ?>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <button type="submit" name="delete_btn" value="<?php echo $row['id'] ?>" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                <?php
                            }
                        } else {
                            echo "<td>No Record Found.</td><td/>";
                        }
                    } else {
                        header("location:../index.php");
                    }
                } else {
                    header("../Login/login.php?notlogin=true");
                }
                ?>
            </tbody>
        </table>
<?php
    }else{
        header("location:../index.php");
    }
}
?>