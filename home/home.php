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
        <br></br>
		<h2><img src="images/favicon.ico" class="faviconhome"alt="auto">Fox Company<img src="images/favicon.ico" class="faviconhome" alt="auto"></h2>
		<p><strong>Where Cadets Become Leaders</strong> </p>
		</header>
	</div>
	</div>
    <div class="slider-wrapper theme-default">
    <style>#slider {width: 65%; margin-left: auto; margin-right: auto;}</style>
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
                            <br></br>
							<section>
								<header class="major">
									<h2>Get Connected</h2>
									<p>F-2 is always looking for support and involvement</p>
								</header>
								<p>Click the button below to visit the Fox Company Facebook page.</p>
								<footer>
									<a href="https://www.facebook.com/TexasAmCorpsOfCadetsCompanyF2Foxes" class="button medium alt icon fa-info-circle">VISIT FACEBOOK</a>
                                    <br></br>
                                    <br></br>
								</footer>
							</section>
						</div>
						<div class="6u 12u(mobile)">
                            <br></br>
							<section>
								<header class="major">
									<h2>Represent F-2</h2>
									<p>wear clothing that resperesents a redass outfit</p>
								</header>
								<p>The Fox Company Store contains F-2 merchandise for cadets and parents.</p>
								<footer>
									<a href="http://foxcompany.core-image.net/" class="button medium alt icon fa-info-circle">FOX COMPANY STORE</a>
                                    <br></br>
                                    <br></br>
								</footer>
							</section>
						</div>
					</div>
				</section>

			</div>
	</div>
</div>