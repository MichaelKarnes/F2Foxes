<?php 
include 'boot/session.php'; 
if (!($_SESSION['admin']==1)){ die("Sorry you do not have access to this file "); }
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Sign Up</title>
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
            <?php
                //if admin/ CO / 1SG / display PT Scores need others besides admin
                if ($_SESSION['admin'] == 1 ) {
                    echo '<form action = "adminOutfitPT.php" method = "post">' .
                    '<input type = "button" name = "viewPT" value = 
                    "View Outfit PT Scores" > </input>' . '</form>';
                    echo '<br>';

                    if ($_POST['viewPT'] == 1) {
                        $queryAllPT = $db->query("SELECT * FROM PT");
                    
                        if ($queryAllPT->num_rows > 0) {
                            while ($rowLoop = $queryAllPT->fetch_assoc()) {

                            }
                            
                        }
                        
                    }
                }
            ?>
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

