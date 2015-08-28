<?php
include 'boot/session.php'; 
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>events</title>
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
                $newPass = $_POST['newPass'];
                $newPass2 = $_POST['newPass2'];
                if($newPass != $newPass2) {
                    echo '<p>Passwords do not match. <a href ="forgot.php">Please Try Again</a></p>';
                }

                $userForgot = $_POST['userForgot'];
                $checkUserQuery = $db->query("SELECT * FROM Authentication WHERE Username='$userForgot' ");
                if($checkUserQuery != 1 ) {
                    echo '<p>Username does not exist. <a href ="forgot.php">Please Try Again</a></p>';
                }

            ?>
            <br></br>
            

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
