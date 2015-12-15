<?php
include 'boot/session.php'; 
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>About Us</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><scrpt src="assets/js/ie/html5shiv.js"></script><![endif]-->
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
		    <div class="row">



            <!--Main Content-- link to about.php it is located in the pagecontent folder -->
            <?php #include 'pagecontent/about/about.php'; ?> 
            <!-- Main Wrapper -->
            <div class="8u 12u(mobile)">
            </div>
            <style>#heading {text-align: left; float: left; position: absolute;}
                .black {color: #000;}
                .centerPic {margin-left: auto; margin-right: auto;}
            </style>
            <br>
            <h2 id="heading"> About Company F-2 </h2>
            <br></br>
            <p class="black"> Thanks for visiting the company F-2 website! Established in 1959, F-2 is the 
            oldest active outfit in the Texas A&M Corps of Cadets. Our outfit motto is 
            "Work Hard, Play Hard!", and we work hard everyday to live by that motto.
            F2 is a STEM (Science, Technology, Engineering, and Math) outfit, but we
            have and support cadets from every major academic concentration. Last year, we won the
            Jounie award for the best academic performance in the Corps. Additionally, F-2 exceeds
            physical fitness and military inspection standards every year. Our main goals are to 
            develop leaders for the 21st century, succeed academically, promote the Corps values,
            and develop lifelong friendships. Our success is made possible through motivated cadets,
            strong leadership, generous alumni, and supportive parents. We greatly appreciate
            any and all support, and strive to improve every year. </p>

            <p class="black">The current commanding officer is Cole Bishop from Little Rock, Colorado. </p>
            <img src="images/Commander_Officer.jpg" alt="auto" width="90%" class="centerPic"/> 

            <div class="4u 12u(mobile)">
            </div>



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