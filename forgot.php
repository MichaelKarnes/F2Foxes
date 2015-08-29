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
                      
            <p>If you have forgotten your password, please fill out the form below.</p>
            <form action="forgotSubmit.php" method="POST">
            <fieldset>
            <label>Username</label>
            <input type="text" name="userForgot" maxlength="20" />
            <label>New Password </label>
            <input type="password" name="newPass" maxlength="20" />
            <label>Enter New Password Again </label>
            <input type="password" name="newPass2" maxlength="20" />
            <br></br>
            <input type="submit" />
            </fieldset>
            </form>

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
