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
                            <div id="slider" class="nivoSlider">
                                <img src="home/images/F-2CompanySpring2015.jpg" data-thumb="home/images/F-2CompanySpring2015.jpg" alt="auto" />
                                <img src="home/images/Corps.jpg" data-thumb="home/images/Corps.jpg" alt="auto" />
                                <img src="home/images/MarchInFall2014.jpg" data-thumb="home/images/MarchInFall2014.jpg" alt="auto" />
                                <!--<img src="home/images/toystory.jpg" data-thumb="home/images/toystory.jpg" alt="auto" />
                                <a href="http://dev7studios.com"><img src="home/images/up.jpg" data-thumb="home/images/up.jpg" alt="auto" title="This is an example of a caption" /></a>
                                <img src="home/images/walle.jpg" data-thumb="home/images/walle.jpg" alt="auto" data-transition="slideInLeft" />
                                <img src="home/images/nemo.jpg" data-thumb="home/images/nemo.jpg" alt="auto" title="#htmlcaption" />-->
                            </div>
                            <div id="htmlcaption" class="nivo-html-caption">
                                <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>. 
                            </div>
                        </div>
                    <?php /*?>
					<div class="row">
						<div class="4u 12u(mobile)">
							<section>
								<a href="https://youtu.be/jofNR_WkoCE" class="image featured"><img src="images/pic01.jpg" alt="auto" /></a>
								<header class="second icon fa-user">
									<h3>Here's a Heading</h3>
									<p>And a subtitle</p>
                                    
								</header>
							</section>
						</div>
						<div class="4u 12u(mobile)">
							<section>
								<a href="#" class="image featured"><img src="images/pic02.jpg" alt="auto" /></a>
								<header class="second icon fa-cog">
									<h3>Also a Heading</h3>
									<p>And another subtitle</p>
								</header>
							</section>
						</div>
						<div class="4u 12u(mobile)">
							<section>
								<a href="#" class="image featured"><img src="images/pic03.jpg" alt="auto" /></a>
								<header class="second icon fa-bar-chart-o">
									<h3>Another Heading</h3>
									<p>And yes, a subtitle</p>
								</header>
							</section>
						</div>
					</div>
					<div class="row">
						<div class="12u">
							<p>Phasellus quam turpis, feugiat sit amet ornare in, hendrerit in lectus. Praesent semper
							bibendum ipsum, et tristique augue fringilla eu. Vivamus id risus vel dolor auctor euismod
							quis eget mi. Etiam eu ante risus. Aliquam erat volutpat. Aliquam luctus mattis lectus sit
							amet pulvinar. Nam nec turpis.</p>
						</div>
					</div>*/
                    ?>
				</section>

		</div>
	</div>
    <div class="wrapper style1">
		<div class="inner">
            <section class="container box feature1">
                <div class="12u">
                   <?php $query=$db->query("SELECT * FROM Videos");
                        while ($row=mysqli_fetch_assoc ($query))  { 
                         $code=$row['Embededcode'];  
                         echo $code;
                        } ?>

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
									<h2>Get Conected!</h2>
									<p>F-2 is always looking for support and involvement</p>
								</header>
								<p>Currently f-2 is working on feugiat sit amet ornare in, hendrerit in lectus.
								Praesent semper mod quis eget mi. Etiam eu ant risus. Aliquam erat volutpat.
								Aliquam luctus et mattis lectus sit amet pulvinar. Nam turpis nisi
								consequat etiam.</p>
								<footer>
									<a href="" class="button medium icon fa-arrow-circle-right">Let's do this</a>
								</footer>
							</section>
						</div>
						<div class="6u 12u(mobile)">
							<section>
								<header class="major">
									<h2>Represent F-2</h2>
									<p>wear clothing that resperesents a redass outfit</p>
								</header>
								<p>The Fox Company Store contains F2 merchandise for cadets and parents. If you want to represent a redass outfit, click the button below. </p>
								<footer>
									<a href="http://foxcompany.core-image.net/" class="button medium alt icon fa-info-circle">FOX COMPANY STORE</a>
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