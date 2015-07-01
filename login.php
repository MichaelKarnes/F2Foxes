<?php
    $connection = new mysqli("localhost","user","password") or die("Couldn't connect to database");
?>

<!DOCTYPE HTML>
<!--
	ZeroFour by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>log in</title>
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
            <?php include 'header.php'; ?>
            <!--end of header-->


			<!-- Main Wrapper -->
				<div id="main-wrapper">
					<div class="wrapper style2">
						<div class="inner">
							<div class="container">
								<div id="content">
                                     <!--Prevents Mobile Nav Bar From covering up content-->
                                    <br></br>
                                    <h1>Please Log In</h1>
                                    <form action= "login_submit.php" method="post">
                                    <p>
                                    <label for="user">Username</label>
                                    <input type="text" id="user" name="user" value="" maxlength="10" />
                                    </p>
                                    <p>
                                    <label for="pass">Password</label>
                                    <input type="password" id="pass" name="pass" value="" maxlength="10" />
                                    </p>
                                    <p>
                                    <input type="submit" value="Login" />
                                    </p>
                                    </fieldset>
                                    </form>

								</div>
							</div>
						</div>
					</div>
					<div class="wrapper style3">
						<div class="inner">
							<div class="container">
								<div class="row">
									<div class="8u 12u(mobile)">
									</div>
                                    
									<div class="4u 12u(mobile)">
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>

			
			         <!-- Footer  -->
                    <?php include 'footer.php'; ?>
                     <!--end of Footer-->
				
				</div>
			</div>
				
		</div>

		<!-- Scripts -->

			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>