<?php
include 'boot/session.php'; 
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>forgot password</title>
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
	        <div class="wrapper style2">
		    <div class="inner">
			<div class="container">
			<div id="content">
            <!--Main Content-->
                     
            <br></br> 
            <?php
                #check to see if both passwords match from forgot.php
                #also validate the new password length
                $newPass = $_POST['newPass'];
                $newPass2 = $_POST['newPass2'];

                if($newPass != $newPass2) {
                    echo '<p>Passwords do not match.<a href ="forgot.php"> Please Try Again.</a></p>';
                } 
                elseif(strlen($newPass) >= 25 || strlen($newPass) <= 6) {
                    echo '<p>Passwords must be between 6 to 25 characters.<a href ="forgot.php"> Please Try Again.</a></p>';
                }
                #insert new password into the database for admin to see the next time admin 
                #logs on. See login.php     
                else {
                    $userForgot = $_POST['userForgot'];
                    $timestamp = time();
                    echo $timestamp;
                    $date = date("M-D-Y");
                    echo $date;
                    #insert date and time , the user who Forgot, and the new desired password
                    $query = $db->query("INSERT INTO Forgot_Password VALUES(' ', '$date', '$timestamp', '$userForgot', '$newPass')");
                    echo '<p>Your request has been succesfully sent to the website admins,
                    David M and Peter M. One of us will contact you by phone for confirmation 
                    within the next 24 hours. Once we verify your request, your password will 
                    be changed and encrypted. Alternatively, you can contact one of us directly
                    to speed up the process.</p>';
                    echo '<p><br></br><a href ="index.php"> Return to the home page. </a>';
                }

            ?>
            <br></br>
            
            
                         
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
