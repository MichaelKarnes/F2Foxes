<!-- Main Wrapper -->
<?php
    //mysql_connect("192.232.249.164", "km310765_admin", "Aftermath2015") or die ("Couldn't connect!");
//mysql_select_db("km310765_f2foxes") or die("Couldn't find db");
?>
<div id="main-wrapper">
	<div class="wrapper style1">
		<div class="inner">

			<!-- Feature 1 -->
				<section class="container box feature1">
					<div class="row">
						<div class="12u">
							<header class="first major">
								<h2><img src="images/favicon.ico" class="faviconhome"alt="auto">Fox Company<img src="images/favicon.ico" class="faviconhome" alt="auto"></h2>
								<p><strong>Where Cadets Become Leaders</strong> </p>
							</header>
						</div>
					</div>
                        <div class="slider-wrapper theme-default">
                            <style>#slider {width: 80%; height:500px; margin-left: auto; margin-right: auto;}</style>
                            <div id="slider" class="nivoSlider">
                                <img src="home/images/March_In.jpg" data-thumb="home/images/March_In.jpg" alt="auto" />
                                <img src="home/images/rudders.jpg" data-thumb="home/images/rudders.jpg" alt="auto" />
                                <img src="home/images/Good_Bull.jpg" data-thumb="home/images/Good_Bull.jpg" alt="auto" />
                            </div>
                            <div id="htmlcaption" class="nivo-html-caption">
                                <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>. 
                            </div>
                        </div>
                    
				</section>

		</div>
	</div>
    <div class="wrapper style1">
		<div class="inner">
            
            <section class="container box feature1">
                <br></br>
                <p>F-2 cadets participating in the Rudder's Rangers Quad Assault and the
                Fish Drill Team Competition!</p>
                <div class="12u">
                   <?php $query=$db->query("SELECT * FROM Videos");
                        while ($row=mysqli_fetch_assoc ($query))  { 
                         $code=$row['Embededcode'];  
                         echo $code;
                        } ?>

                    </div>
                </section>
        </div>
        <br></br>
    </div>
	<div class="wrapper style2">
		<div class="inner">

			<!-- Feature 2 -->
				<section class="container box feature2">
                    <div class="row">
						<div class="6u 12u(mobile)">
							<section>
								<header class="major">
									<h2>Get Conected</h2>
									<p>F-2 is always looking for support and involvement</p>
								</header>
								<p>Click the button below to visit the Fox Company Facebook page.</p>
								<footer>
									<a href="https://www.facebook.com/TexasAmCorpsOfCadetsCompanyF2Foxes" class="button medium alt icon fa-info-circle">VISIT FACEBOOK</a>
                                    <br></br>
								</footer>
							</section>
						</div>
						<div class="6u 12u(mobile)">
							<section>
								<header class="major">
									<h2>Represent F-2</h2>
									<p>wear clothing that resperesents a redass outfit</p>
								</header>
								<p>The Fox Company Store contains F-2 merchandise for cadets and parents.</p>
								<footer>
									<a href="http://foxcompany.core-image.net/" class="button medium alt icon fa-info-circle">FOX COMPANY STORE</a>
                                    <br></br>
								</footer>
							</section>
						</div>
					</div>
				</section>

			</div>
	</div>
    <?php /* ?>
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
										<a href="#" class="image left"><img src="images/pic04.jpg" alt="auto" /></a>
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
										<a href="#" class="image left"><img src="images/pic05.jpg" alt="auto" /></a>
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
										<a href="#" class="image left"><img src="images/pic06.jpg" alt="auto" /></a>
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
									<a href="#" class="image featured"><img src="images/pic07.jpg" alt="auto"></a>
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
	</div>*/
    ?>
</div>