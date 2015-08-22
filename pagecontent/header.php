
<!-- Header -->
<div id="header-wrapper">
	<div class="container">
<?php 
 $username=$_SESSION ['username'];
if ($_SESSION ['username']){?>
    <link rel="stylesheet" href="pagecss/header.css" /><!--changes the size of the tabs on the top-->
<?php }?>
<!-- Header -->
	<header id="header">
		<div class="inner">

			<!-- Logo --><!--changes the logo once someone logs in-->
                    <?php if ($_SESSION ['username']){?>
				<h1><a href="index.php" id="logo"><?php echo "$username"?></a></h1>
                    <?php }else{ ?> 
                <h1><a href="index.php" id="logo">F-2 Foxes</a></h1>
                <?php }?>

			<!-- Nav -->
				<nav id="nav">
					<ul>
						<li ><a href="index.php">Home</a></li>
                        <li><a href="">Recruiting</a>
                        <ul>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="recruiting.php">Join F-2</a></li>
                        <li><a href="http://foxcompany.core-image.net/">Shop</a></li>
                        </ul>
                        <li><a href="events.php">Events</a></li>

                        <?php
                        if ($_SESSION['student']){ ?>
                            <li><a href="">Student</a>
                        <ul>
                            <li><a href="Announcements.php">Announcements</a></li>
                            <li><a href="grades.php">Grades</a></li>
                            <li><a href="signoutstartdate.php">Signout Sheet</a></li>
                            <li><a href="training.php">Training</a></li>
                            <li><a href="events.php">Events</a></li>
                        </ul></li>
                       
                        <?php } /*

                        if ($_SESSION['training']==1){ ?>
                            <li><a href="trainingchain.php">T Admin</a></li>
                        <?php } */

                         if ($_SESSION['admin']==1 ||$_SESSION['signout']==1){ ?>
                            <li><a href="">Admin</a>
                                <ul>
                                    <?php if ($_SESSION['admin']==1){ ?>
                                    <li><a href="admin_reg.php">Admin_reg</a></li>
                                    <li><a href="admin_users.php">Admin_users</a></li>
                                    <li><a href="adminvideo.php">Admin_videos</a></li>
                                    <?php } 
                                    if ($_SESSION['signout']==1){ ?>
                                        <li><a href="signal.php">Admin_signout</a></li>
                                    <?php } ?>
                                </ul>
                             </li>
                        <?php } ?>
                        <li><a href="">Account</a>
                            <ul>

                                <?php if ($_SESSION['username']){ ?>
                                        <li><a href="logout.php">Log Out</a></li>
                                        <li><a href="account_info.php">Account Info</a></li>
                                <?php } 
                                    if (!($_SESSION['username'])){ ?>
                                        <li><a href="login.php">Log In</a></li>
                                        <li><a href="register.php">Register</a></li>    
                                <?php }?> 
                            </ul>
                        </li>         
					</ul>
				</nav>
		    </div>
	    </header>
	</div>
</div>