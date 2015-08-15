
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
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="events.php">Events</a></li>
                                			
                        <li><a href="recruiting.php">Join F-2</a></li>
                        <li><a href="http://foxcompany.core-image.net/">Shop</a></li>

                        <?php
                        if ($_SESSION['student']==1){ ?>
                            <li><a href="grades.php">Grades</a></li>
                            <li><a href="signoutsheet.php">Signout Sheet</a></li>
                            <li><a href="training.php">Training</a></li>
                        <?php } 

                        if ($_SESSION['signout']==1){ ?>
                            <li><a href="signal.php">S Admin</a></li>
                        <?php } /*

                        if ($_SESSION['training']==1){ ?>
                            <li><a href="trainingchain.php">T Admin</a></li>
                        <?php } */

                         if ($_SESSION['admin']==1){ ?>
                            <li><a href="admin_reg.php">Admin_reg</a></li>
                            <li><a href="admin_users.php">Admin_users</a></li>
                        <?php } 

                        if ($_SESSION['username']){ ?>
                            <li><a href="logout.php">Log Out</a></li>

                        <?php } 
                            if (!($_SESSION['username'])){ ?>
                        <li><a href="login.php">Log In</a></li>
                        <li><a href="register.php">Register</a></li>    
                        <?php }?>          
					</ul>
				</nav>
		    </div>
	    </header>
	</div>
</div>