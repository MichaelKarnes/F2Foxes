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
                #if they do, email the admin
                $newPass = $_POST['newPass'];
                $newPass2 = $_POST['newPass2'];

                if($newPass != $newPass2) {
                    echo '<p>Passwords do not match.<a href ="forgot.php"> Please Try Again.</a></p>';
                }      
                else {
                    $userForgot = $_POST['userForgot'];
                    $message = "Username: " . $userForgot . "\n New Password: " . $newPass;
                    $header = "From: dm@f2foxes.com"
                    mail("dtmcderm@verizon.net","F2 Foxes Password Reset",$message);
                    echo '<p>Your request has been succesfully emailed to the website admins,
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
