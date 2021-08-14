<!DOCTYPE html>
<html lang="en">

<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/csi-logo.png">
    <link rel="stylesheet" href="plugins/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/changeuserdata.css?v=<?php echo time(); ?>">
    <title> Edit Profile</title>
    <?php
    require_once "config.php";
    session_start();
    if(isset($_SESSION["email"])){
        $email = $_SESSION["email"];
        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
            $id = trim($_POST["id"]);
            $name = trim($_POST["name"]);
            $rollno = trim($_POST["rollno"]);
            $year = trim($_POST["year"]);
            $division = trim($_POST["division"]);
            $phone = trim($_POST["phone"]);
            $branch = trim($_POST["branch"]);
            $result = execute("UPDATE `csi_userdata` SET `name`='$name',`year`='$year',`division`='$division',`rollNo`='$rollno',`phonenumber`='$phone',`branch`='$branch' WHERE id = $id");
        }
        $rowshowdata = getValue("SELECT `id`, `name`, `year`, `division`, `rollNo`, `emailID`, `phonenumber`, `branch` FROM `csi_userdata` WHERE `emailID` = '$email'");
    }else{
        function_alert("Login First");
    }
    ?>
</head>

<body>
    <header>
        <h2 style="text-align: center;">Edit rofile</h2>
    </header>
    <div class="spacer" style="height:46px;"></div>
    <div class="changedata">
        <div class="container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="id" value = "<?php echo $rowshowdata['id']; ?>">
                <div class="row justify-content-center">
                    <div class="col-sm-2">
                        <div class="labels">
                            <label for="fname">First Name :</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="texts">
                            <input type="text" id="fname" name="name" value = "<?php echo $rowshowdata['name']; ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-2">
                        <div class="labels">
                            <label for="year">Select Year :</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="texts">
                            <select id="year" name="year" required="required" class="custom-select mb-3">
                                <option value="FE"<?php if($rowshowdata['year'] == 'FE')echo "selected"; ?>>FE</option>
                                <option value="SE"<?php if($rowshowdata['year'] == 'SE')echo "selected"; ?>>SE</option>
                                <option value="TE"<?php if($rowshowdata['year'] == 'TE')echo "selected"; ?>>TE</option>
                                <option value="BE"<?php if($rowshowdata['year'] == 'BE')echo "selected"; ?>>BE</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <?php
                if(isset($rowshowdata['division'])){
                ?>
                <div class="row justify-content-center">
                    <div class="col-sm-2">
                        <div class="labels">
                            <label for="division">Select Division :</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="texts">
                            <select id="division" name="division" required="required" class="custom-select mb-3" value="SE">
                                <option value="1" <?php if($rowshowdata['division'] == "1") echo "selected";  ?>>1</option>
                                <option value="2" <?php if($rowshowdata['division'] == "2") echo "selected";  ?>>2</option>
                                <option value="3" <?php if($rowshowdata['division'] == "3") echo "selected";  ?>>3</option>
                                <option value="4" <?php if($rowshowdata['division'] == "4") echo "selected";  ?>>4</option>
                                <option value="5" <?php if($rowshowdata['division'] == "5") echo "selected";  ?>>5</option>
                                <option value="6" <?php if($rowshowdata['division'] == "6") echo "selected";  ?>>6</option>
                                <option value="7" <?php if($rowshowdata['division'] == "7") echo "selected";  ?>>7</option>
                                <option value="8" <?php if($rowshowdata['division'] == "8") echo "selected";  ?>>8</option>
                                <option value="9" <?php if($rowshowdata['division'] == "9") echo "selected";  ?>>9</option>
                                <option value="10"<?php if($rowshowdata['division'] == "10") echo "selected"; ?>>10</option>
                                <option value="11"<?php if($rowshowdata['division'] == "11") echo "selected"; ?>>11</option>
                                <option value="12"<?php if($rowshowdata['division'] == "12") echo "selected"; ?>>12</option>
                                <option value="13"<?php if($rowshowdata['division'] == "13") echo "selected"; ?>>13</option>
                                <option value="14"<?php if($rowshowdata['division'] == "14") echo "selected"; ?>>14</option>
                                <option value="15"<?php if($rowshowdata['division'] == "15") echo "selected"; ?>>15</option>
                            </select>
                        </div>
                    </div>
                </div>
                <?php
                }
                if(isset($rowshowdata['rollNo'])){
                ?>
                <div class="row justify-content-center">
                    <div class="col-sm-2">
                        <div class="labels">
                            <label for="rollno">Roll No :</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="texts">
                            <input type="number" id="rollno" name="rollno" value = "<?php echo $rowshowdata['rollNo']; ?>" required/>
                        </div>
                    </div>
                </div>
                
                <?php
                }
                ?>
                <div class="row justify-content-center">
                    <div class="col-sm-2">
                        <div class="labels">
                            <label for="phone">Phone number :</label>
                        </div>
                    </div>
                    <div class="col-sm-2 justify-content-center">
                        <div class="texts">
                            <input type="tel" id="phone" name="phone" value = "<?php echo $rowshowdata['phonenumber']; ?>" pattern="[1-9]{1}[0-9]{9}" required/>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-2">
                        <div class="labels">
                            <label for="branch">Select Branch :</label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="texts">
                            <select id="branch" name="branch" required="required" class="custom-select mb-3">
                                <option value="CS"<?php if($rowshowdata['branch'] == "CS") echo "selected";  ?> >CS</option>
                                <option value="IT"<?php if($rowshowdata['branch'] == "IT") echo "selected";  ?> >IT</option>
                                <option value="Electronics"<?php if($rowshowdata['branch'] == "Electronics") echo "selected";?> > Electronics</option>
                                <option value="EXTC"<?php if($rowshowdata['branch'] == "EXTC") echo "selected";?>>EXTC</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" name = "submit" class="btn main_btn">Change</button>
            </form>
        </div>
    </div>
    <div class="spacer" style="height:100px;"></div>


    <!-- Footer -->
    <?php require_once 'footer.php';?>
    <!-- Footer -->

    

    <!-- Javascript -->
    <script src="plugins/fontawesome-free-5.15.3-web/js/all.min.js"></script>
    <script src="plugins/jquery.min.js"></script>
    <script src="plugins/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
</body>
</html>