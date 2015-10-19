<?php
    $token = Token::generate();
    require_once '../plugins/nivoslider/nivoslider.php';
?>

<!DOCTYPE HTML>
<!--
	ZeroFour by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>F-2 Foxes</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
        <script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-viewport.min.js"></script>
		<script src="js/util.js"></script>
		<!--[if lte IE 8]><script src="js/ie/respond.min.js"></script><![endif]-->
		<script src="js/main.js"></script>
        <?php
            $nivo = new NivoSlider('../plugins/nivoslider');
            $nivo->render_includes();

            $nivo->add_slide('../images/a&m-vs-arkansas-banner.jpg','','A&M vs. Arkansas');
            $nivo->add_slide('../images/march-in-banner.jpg','','March In');
        ?>
	</head>
	<body class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
                <?php $nivo->render_slides(); ?>
                <style>
                    #slider {
                        position: absolute;
                        width: 100%;
                        height: 712px;
                        z-index: -1;
                    }
                </style>
				<div id="header-wrapper">
					<div class="container">

						<!-- Header -->
							<header id="header">
								<div class="inner">

									<!-- Logo -->
										<h1><a href="/" id="logo">Fox Company</a></h1>

									<!-- Nav -->
										<nav id="nav">
											<ul>
												<li class="current_page_item"><a href="/">Home</a></li>
												<li>
													<a href="#">Dropdown</a>
													<ul>
														<li><a href="#">Lorem ipsum dolor</a></li>
														<li><a href="#">Magna phasellus</a></li>
														<li>
															<a href="#">Phasellus consequat</a>
															<ul>
																<li><a href="#">Lorem ipsum dolor</a></li>
																<li><a href="#">Phasellus consequat</a></li>
																<li><a href="#">Magna phasellus</a></li>
																<li><a href="#">Etiam dolore nisl</a></li>
															</ul>
														</li>
														<li><a href="#">Veroeros feugiat</a></li>
													</ul>
												</li>
												<li><a href="left-sidebar.php">Left Sidebar</a></li>
												<li><a href="right-sidebar.php">Right Sidebar</a></li>
												<li>
                                                    <form action="actions/login.php" method="post">
                                                        <input type="hidden" name="username" value="admin" />
                                                        <input type="hidden" name="password" value="password" />
                                                        <input type="hidden" name="remember" value="off" />
                                                        <input type="hidden" name="token" value="<?php echo $token; ?>" />
                                                        <a style="cursor: pointer;" onclick="$(this).parent().submit();">Login</a>
                                                    </form>
                                                </li>
											</ul>
										</nav>

								</div>
							</header>

						<!-- Banner -->
                            <div id="banner">
								<h2><strong>Fox Company</strong>
								<br />
								Where cadets become leaders</h2>
								<p>Want to stay updated on our upcoming events?</p>
								<a href="#" class="button big icon fa-check-circle">Subscribe</a>
							</div>
							<!--<div id="banner">
								<h2><strong>ZeroFour:</strong> A free responsive site template
								<br />
								built on HTML5 and CSS3 by <a href="http://html5up.net">HTML5 UP</a></h2>
								<p>Does this statement make you want to click the big shiny button?</p>
								<a href="#" class="button big icon fa-check-circle">Yes it does</a>
							</div>-->

					</div>
				</div>

			<!-- Main Wrapper -->
				<div id="main-wrapper">
					<div class="wrapper style1">
						<div class="inner">

							<!-- Feature 1 -->
								<section class="container box feature1">
									<div class="row">
										<div class="12u">
											<header class="first major">
												<h2>The best outfit on the Quad</h2>
												<p>Upholding the highest standards for our Nation and the Corps</p>
											</header>
										</div>
									</div>
									<div class="row">
										<div class="4u 12u(mobile)">
											<section>
												<a href="#" class="image featured"><img src="images/rozelle-commissioning-small.jpg" alt="" /></a>
												<header class="second">
													<h3>Officers</h3>
													<p>Leading America's Army</p>
												</header>
											</section>
										</div>
										<div class="4u 12u(mobile)">
											<section>
												<a href="#" class="image featured"><img src="images/final-review-2015-small.jpg" alt="" /></a>
												<header class="second">
													<h3>Students</h3>
													<p>Achieving greatness</p>
												</header>
											</section>
										</div>
										<div class="4u 12u(mobile)">
											<section>
												<a href="#" class="image featured"><img src="images/arkansas-officers-of-the-day-small.jpg" alt="" /></a>
												<header class="second">
													<h3>Professionals</h3>
													<p>Prepared to face any challenge</p>
												</header>
											</section>
										</div>
									</div>
									<div class="row">
										<div class="12u">
											<p>Company F-2 strives for excellence in all we do. We train future officers of the United States military,
                                            develop students who are known across the quad for their outstanding grades, and create future leaders
                                            of America who are prepared to face any challenge that lies before them.</p>
										</div>
									</div>
								</section>

						</div>
					</div>
					<div class="wrapper style2">
						<div class="inner">

							<!-- Feature 2 -->
								<section class="container box feature2">
									<div class="row">
										<div class="6u 12u(mobile)">
											<section>
												<header class="major">
													<h2>What can I do to help?</h2>
													<p>Buy some of our merchandise!</p>
												</header>
												<p>By buying our merchandise, you are giving F-2 the opportunity to give back to
                                                you. Every year, we host public tailgates, banquets, and cookouts. The money that
                                                we get from you helps contribute to these events and make them as awesome as possible!</p>
												<footer>
													<a href="#" class="button medium icon fa-arrow-circle-right">To the shop!</a>
												</footer>
											</section>
										</div>
										<div class="6u 12u(mobile)">
											<section>
												<header class="major">
													<h2>Ol' Foxes looking to reconnect</h2>
													<p>Apply to be included in the Fox Hall of Fame</p>
												</header>
												<p>When you submit your information to our database of Ol' Foxes, you'll be included in our
                                                <a href="#">Fox Hall of Fame</a> with all of the other great Foxes. We'll also keep
                                                you informed of our latest achievements, as well as ways to help out current foxes.</p>
												<footer>
													<a href="#" class="button medium icon fa-arrow-circle-right">Apply for the Hall of Fame</a>
												</footer>
											</section>
										</div>
									</div>
								</section>

							</div>
					</div>
					<div class="wrapper style3">
						<div class="inner">
							<div class="container">
								<div class="row">
									<div class="8u 12u(mobile)">

										<!-- Article list -->
											<section class="box article-list">
												<h2 class="icon fa-file-text-o">Recent Posts</h2>

												<!-- Excerpt -->
													<article class="box excerpt">
														<a href="#" class="image left"><img src="images/pic04.jpg" alt="" /></a>
														<div>
															<header>
																<span class="date">July 24</span>
																<h3><a href="#">Repairing a hyperspace window</a></h3>
															</header>
															<p>Phasellus quam turpis, feugiat sit amet ornare in, hendrerit in lectus
															semper mod quisturpis nisi consequat etiam lorem. Phasellus quam turpis,
															feugiat et sit amet ornare in, hendrerit in lectus semper mod quis eget mi dolore.</p>
														</div>
													</article>

												<!-- Excerpt -->
													<article class="box excerpt">
														<a href="#" class="image left"><img src="images/pic05.jpg" alt="" /></a>
														<div>
															<header>
																<span class="date">July 18</span>
																<h3><a href="#">Adventuring with a knee injury</a></h3>
															</header>
															<p>Phasellus quam turpis, feugiat sit amet ornare in, hendrerit in lectus
															semper mod quisturpis nisi consequat etiam lorem. Phasellus quam turpis,
															feugiat et sit amet ornare in, hendrerit in lectus semper mod quis eget mi dolore.</p>
														</div>
													</article>

												<!-- Excerpt -->
													<article class="box excerpt">
														<a href="#" class="image left"><img src="images/pic06.jpg" alt="" /></a>
														<div>
															<header>
																<span class="date">July 14</span>
																<h3><a href="#">Preparing for Y2K38</a></h3>
															</header>
															<p>Phasellus quam turpis, feugiat sit amet ornare in, hendrerit in lectus
															semper mod quisturpis nisi consequat etiam lorem. Phasellus quam turpis,
															feugiat et sit amet ornare in, hendrerit in lectus semper mod quis eget mi dolore.</p>
														</div>
													</article>

											</section>
									</div>
									<div class="4u 12u(mobile)">

										<!-- Spotlight -->
											<section class="box spotlight">
												<h2 class="icon fa-file-text-o">Spotlight</h2>
												<article>
													<a href="#" class="image featured"><img src="images/pic07.jpg" alt=""></a>
													<header>
														<h3><a href="#">Neural Implants</a></h3>
														<p>The pros and cons. Mostly cons.</p>
													</header>
													<p>Phasellus quam turpis, feugiat sit amet ornare in, hendrerit in lectus semper mod
													quisturpis nisi consequat ornare in, hendrerit in lectus semper mod quis eget mi quat etiam
													lorem. Phasellus quam turpis, feugiat sed et lorem ipsum dolor consequat dolor feugiat sed
													et tempus consequat etiam.</p>
													<p>Lorem ipsum dolor quam turpis, feugiat sit amet ornare in, hendrerit in lectus semper
													mod quisturpis nisi consequat etiam lorem sed amet quam turpis.</p>
													<footer>
														<a href="#" class="button alt icon fa-file-o">Continue Reading</a>
													</footer>
												</article>
											</section>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			<!-- Footer Wrapper -->
				<div id="footer-wrapper">
					<footer id="footer" class="container">
						<div class="row">
							<div class="3u 12u(mobile)">

								<!-- Links -->
									<section>
										<h2>Filler Links</h2>
										<ul class="divided">
											<li><a href="#">Quam turpis feugiat dolor</a></li>
											<li><a href="#">Amet ornare in hendrerit </a></li>
											<li><a href="#">Semper mod quisturpis nisi</a></li>
											<li><a href="#">Consequat etiam phasellus</a></li>
											<li><a href="#">Amet turpis, feugiat et</a></li>
											<li><a href="#">Ornare hendrerit lectus</a></li>
											<li><a href="#">Semper mod quis et dolore</a></li>
											<li><a href="#">Amet ornare in hendrerit</a></li>
											<li><a href="#">Consequat lorem phasellus</a></li>
											<li><a href="#">Amet turpis, feugiat amet</a></li>
											<li><a href="#">Semper mod quisturpis</a></li>
										</ul>
									</section>

							</div>
							<div class="3u 12u(mobile)">

								<!-- Links -->
									<section>
										<h2>More Filler</h2>
										<ul class="divided">
											<li><a href="#">Quam turpis feugiat dolor</a></li>
											<li><a href="#">Amet ornare in in lectus</a></li>
											<li><a href="#">Semper mod sed tempus nisi</a></li>
											<li><a href="#">Consequat etiam phasellus</a></li>
										</ul>
									</section>

								<!-- Links -->
									<section>
										<h2>Even More Filler</h2>
										<ul class="divided">
											<li><a href="#">Quam turpis feugiat dolor</a></li>
											<li><a href="#">Amet ornare hendrerit lectus</a></li>
											<li><a href="#">Semper quisturpis nisi</a></li>
											<li><a href="#">Consequat lorem phasellus</a></li>
										</ul>
									</section>

							</div>
							<div class="6u 12u(mobile)">

								<!-- About -->
									<section>
										<h2><strong>ZeroFour</strong> by HTML5 UP</h2>
										<p>Hi! This is <strong>ZeroFour</strong>, a free, fully responsive HTML5 site
										template by <a href="http://n33.co/">AJ</a> for <a href="http://html5up.net/">HTML5 UP</a>.
										It's <a href="http://html5up.net/license/">Creative Commons Attribution</a>
										licensed so use it for any personal or commercial project (just credit us
										for the design!).</p>
										<a href="#" class="button alt icon fa-arrow-circle-right">Learn More</a>
									</section>

								<!-- Contact -->
									<section>
										<h2>Get in touch</h2>
										<div>
											<div class="row">
												<div class="6u 12u(mobile)">
													<dl class="contact">
														<dt>Twitter</dt>
														<dd><a href="#">@untitled-corp</a></dd>
														<dt>Facebook</dt>
														<dd><a href="#">facebook.com/untitled</a></dd>
														<dt>WWW</dt>
														<dd><a href="#">untitled.tld</a></dd>
														<dt>Email</dt>
														<dd><a href="#">user@untitled.tld</a></dd>
													</dl>
												</div>
												<div class="6u 12u(mobile)">
													<dl class="contact">
														<dt>Address</dt>
														<dd>
															1234 Fictional Rd<br />
															Nashville, TN 00000-0000<br />
															USA
														</dd>
														<dt>Phone</dt>
														<dd>(000) 000-0000</dd>
													</dl>
												</div>
											</div>
										</div>
									</section>

							</div>
						</div>
						<div class="row">
							<div class="12u">
								<div id="copyright">
									<ul class="menu">
										<li>&copy; Untitled. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
									</ul>
								</div>
							</div>
						</div>
					</footer>
				</div>

		</div>
	</body>
</html>