<?php
include 'boot/session.php'; 
if (!($_SESSION['student']==1)){ die("Sorry you do not have access to this file "); } 
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Grades</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body class="no-sidebar">
		<div id="page-wrapper">

        <?php include 'pagecontent/header.php'; ?> 

        <?php include 'pagecontent/grades/grades.php'?>
            
        <?php include 'pagecontent/footer.php'; ?>
		</div>	
 
</body>
</html>