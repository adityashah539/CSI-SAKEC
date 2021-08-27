<header class="header_area">
        <div class="main_menu">
            <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
                <?php
                $logo ="images/csi-logo.png";
                while(!file_exists($logo)){
                    $logo= "../".$logo;
                }
                ?>
                <img class="invert" src="<?php echo $logo;?>" alt="SAKEC-icon">
                <a class="navbar-brand" href="#" style="color: aliceblue;"> CSI SAKEC</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll " style="height: auto;">
                        <li class="nav-item active">
                            <a class="nav-link" href="https://www.shahandanchor.com/home/">SAKEC Main Portal</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="http://localhost/csi-sakec/index.php">CSI Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="http://localhost/csi-sakec/index.php#team">Our Team</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="http://localhost/csi-sakec/index.php#events">Events</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="http://localhost/csi-sakec/index.php#gallery">Gallery</a>
                        </li>
                        <?php 
                        if (isset($access) && ($access['role_name'] != "member" || strpos($access['role_name'], "Coordinator") == false || strpos($access['role_name'], "General") == false || strpos($access['role_name'], "Team") == false) ) {
                        ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="http://localhost/csi-sakec/Membership/membership.php">Membership</a>
                        </li>
                        <?php
                        }
                        if (isset($_SESSION['email']) && isset($access)) {
                            if ($access['user_data'] == '1' || $access['role'] == '1') {
                        ?>
                                <li class="nav-item active">
                                    <a class="nav-link" href="http://localhost/csi-sakec/Userdata/database.php">Userdata</a>
                                </li>
                            <?php
                            }
                            if (
                                $access['add_event'] == '1' || $access['budget'] == '1' || $access['edit_attendance'] == '1' || $access['permission_letter'] == '1' ||
                                $access['report'] == '1' ||$access['manage_event'] == '1' || $access['confirm_event_registration'] == '1' || $access['content_repository'] == '1' || $access['feedback_response'] == '1'
                            ) {
                            ?>
                                <li class="nav-item active">
                                    <a class="nav-link" href="http://localhost/csi-sakec/Eventmanagement/eventmanagement.php">Event Management</a>
                                </li>
                            <?php
                            }
                            if ($access['query'] == '1' || $access['reply_log'] == '1') {
                            ?>
                                <li class="nav-item active">
                                    <a class="nav-link" href="http://localhost/csi-sakec/Query/query.php">Query</a>
                                </li>
                            <?php
                            }
                            if ($access['audit']=='1') {
                            ?>
                                <li class="nav-item active">
                                    <a class="nav-link" href="http://localhost/csi-sakec/Audit/audit.php">Audit</a>
                                </li>
                            <?php
                            }
                            if ($access['confirm_membership']=='1') {
                            ?>
                                <li class="nav-item active">
                                    <a class="nav-link" href="http://localhost/csi-sakec/Membership/confirmmembership.php"> Confirm Membership</a>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                    <?php
                    if (isset($_SESSION['email'])) {
                    ?>
                        <a href="http://localhost/csi-sakec/Login/logout.php" class="btn main_btn ">Logout</a>
                        <a href="http://localhost/csi-sakec/edit_profile.php" class="btn main_btn ">Edit Profile</a>
                    <?php
                    } else {
                    ?>
                        <a href="http://localhost/csi-sakec/Login/login.php" class="btn main_btn">Login</a>
                        <a href="http://localhost/csi-sakec/Login/signup.php" class="btn main_btn">Sigup</a>
                    <?php
                    }
                    ?>
                </div>
            </nav>
        </div>
    </header>