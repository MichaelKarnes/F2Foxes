<?php
include 'boot/session.php'; 
if (!($_SESSION['username'])){ die("Sorry you do not have access to this file "); } 
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Account Info</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body class="no-sidebar">
		<div id="page-wrapper">

            <!--header-->
            <?php include 'pagecontent/header.php'; ?>

            <div id="main-wrapper">
	        <div class="wrapper style3">
		    <div class="inner">
			<div class="container">
			<div class="content">


            <!--Main Content-- link to about.php it is located in the pagecontent folder-->
            <?php #include 'pagecontent/account_info/account_info.php'?>
            <!-- Main Wrapper -->
            <?php  
                $userid=$_SESSION['userid'];

                $submit=$_POST['contactinfo'];
                if ($submit) {   
                    $newfirstname=strip_tags($_POST['firstname']);
                    $newlastname=strip_tags($_POST['lastname']);;
                    $newclassyear=strip_tags($_POST['classyear']);
                    $newphone=strip_tags($_POST['phone']);
                    $newemail=strip_tags($_POST['email']);
                    $comma=", ";
                    $newlast_f=$newlastname.$comma.$newfirstname[0];
    
                    $db->query("UPDATE  Contact_Info SET ClassYear='$newclassyear', Phone='$newphone', Email='$newemail' WHERE UserID='$userid' ") or die ("Could not update Account");
                    $db->query("UPDATE  Account_info SET FirstName='$newfirstname', LastName='$lastname' WHERE UserID='$userid' ") or die ("Could not update Account");
                    if ($_SESSION['student']){
                        $db->query("UPDATE  Account_info SET FirstName='$newfirstname', LastName='$newlastname' WHERE UserID='$userid' ") or die ("Could not update Account");
                    }

                    echo "Account Updated";
                }

                $query=$db->query("SELECT * FROM Contact_Info c INNER JOIN Account_info a ON c.UserID=a.UserID WHERE c.UserID='$userid'  ");
                $row=mysqli_fetch_assoc ($query);
                $firstname= $row['FirstName'];
                $lastname= $row['LastName'];
                $classyear= $row['ClassYear'];
                $phone= $row['Phone'];
                $address= $row['Address'];
                $state= $row['State'];
                $county= $row['Country'];
                $zip= $row['Zip'];
                $email= $row['Email']; 
        ?>

        <h1>ACCOUNT INFO</h1> 
        <form action="account_info.php" method="POST">
        <label for="firstname">First Name</label>
        <input type="text" id="classyear" name="firstname" value="<?php echo $firstname ?>" maxlength="20" /><br>
        <label for="lastname">Last Name</label>
        <input type="text" id="classyear" name="lastname" value="<?php echo $lastname ?>" maxlength="20" /><br>
        <label for="classyear"> classyear </label>
        <input type="text" id="classyear" name="classyear" value="<?php echo $classyear ?>" maxlength="2" /><br>
        <label for="phone"> Phone </label>
        <input type="text" id="phone" name="phone" value="<?php echo $phone ?>" maxlength="10" /><br>
        <label for="email"> Email</label>
        <input type="text" id="phone" name="email" value="<?php echo $email ?>" maxlength="50" /><br>
        <input type="submit" name="contactinfo" value="make changes" />
        </form>

		</div>
		</div>
		</div>
	    </div>
        </div>

			<!-- Footer  -->
            <?php include 'pagecontent/footer.php'; ?>
				

		</div>

		<!--Script-- can be found in the pagecontent folder script.php-->
        <?php include 'pagecontent/script.php'?>

	</body>
</html>