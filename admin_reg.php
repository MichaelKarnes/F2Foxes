<?php
include 'boot/session.php'; 
if (!($_SESSION['admin']==1)){ die("Sorry you do not have access to this file "); }
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Admin</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="pagecontent/admin/admin.css" />
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
                                <!--Main Content-- link to about.php it is located in the pagecontent folder-->
                                <?php include 'pagecontent/admin/admin_reg.php'?>
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