<!DOCTYPE html>
<html lang="en">

<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
    <link rel="stylesheet" href="css/membership.css?v=<?php echo time(); ?>">
    <title> Membership</title>
    <?php
    require_once "config.php";
    session_start();
    function function_alert($message){
        echo"<SCRIPT>
            window.location.replace('index.php')
            alert('$message');
        </SCRIPT>";
    }
    if(isset($_SESSION["email"])){
        $email = $_SESSION["email"];
        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
            $id = trim($_POST["id"]);
            $firstname = trim($_POST["fname"]);
            $middlename = trim($_POST["mname"]);
            $lastname = trim($_POST["lname"]);
            $rollno = trim($_POST["rollno"]);
            $year = trim($_POST["year"]);
            $division = trim($_POST["division"]);
            $phone = trim($_POST["phone"]);
            $branch = trim($_POST["branch"]);
            $sqlupdate = "UPDATE `userdata` SET `firstName`='$firstname',`middleName`='$middlename',`lastName`='$lastname',`year`='$year',`division`='$division',`rollNo`='$rollno',`phonenumber`='$phone',`branch`='$branch' WHERE id = $id";
            $result = mysqli_query($conn, $sqlupdate);
        }
        $sqlshowdata = "SELECT `id`, `firstName`, `middleName`, `lastName`, `year`, `division`, `rollNo`, `emailID`, `phonenumber`, `branch`, `password`, `r_number`, `role`, `gender` FROM `userdata` WHERE emailID = '$email'";
        $resulshowdata = mysqli_query($conn, $sqlshowdata);
        $rowshowdata = mysqli_fetch_assoc($resulshowdata);
    }else{
        function_alert("Login First");
    }
    ?>
</head>

<body>
    <header>
        <h6>
            MAHAVIR EDUCATION TRUST'S<br>
            SHAH AND ANCHOR KUTCHHI ENGINEERING COLLEGE<br>
            COMPUTER SOCIETY OF INDIA
        </h6>
        <h4>CSI-SAKEC</h4>
    </header>
    <div class="spacer" style="height:15px;"></div>
    <div class="changedata">
        <div class="container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="id" value = "<?php echo $rowshowdata['id']; ?>">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="fname">First Name :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="texts">
                            <input type="text" id="fname" name="fname" value = "<?php echo $rowshowdata['firstName']; ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="mname">Middle Name :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="texts">
                            <input type="text" id="mname" name="mname" value = "<?php echo $rowshowdata['middleName']; ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="lname">Last Name :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="texts">
                            <input type="text" id="lname" name="lname" value = "<?php echo $rowshowdata['lastName']; ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="year">Select Year :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
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
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="division">Select Division :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
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
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="rollno">Roll No :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="texts">
                            <input type="number" id="rollno" name="rollno" value = "<?php echo $rowshowdata['rollNo']; ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="phone">Phone number :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="texts">
                            <input type="tel" id="phone" name="phone" value = "<?php echo $rowshowdata['phonenumber']; ?>" pattern="[1-9]{1}[0-9]{9}" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="labels">
                            <label for="branch">Select Branch :</label>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="texts">
                            <select id="branch" name="branch" required="required" class="custom-select mb-3">
                                <option value="CS"<?php if($rowshowdata['branch'] == "CS") echo "selected";  ?> >Computer Science</option>
                                <option value="IT"<?php if($rowshowdata['branch'] == "IT") echo "selected";  ?> >Information Technology</option>
                                <option value="Electronics"<?php if($rowshowdata['branch'] == "Electronics") echo "selected";?> > Electronics</option>
                                <option value="EXTC"<?php if($rowshowdata['branch'] == "EXTC") echo "selected";?>>EXTC</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" name = "submit" class="btn btn-primary">Change</button>
            </form>
        </div>
    </div>
    <div class="spacer" style="height:50px;"></div>
    <div class="footer">
        <div class="spacer" style="height:2px;"></div>
        <a href="index.php"><i class="fas fa-home"></i></a>
        <div class="spacer" style="height:0px;"></div>
        <h5>Copyright &copy; CSI-SAKEC 2020-21 All Rights Reserved</h5>
        <div class="spacer" style="height:1px;"></div>
    </div>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>