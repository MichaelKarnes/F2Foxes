<?php
    $username=$_SESSION ['username'];
    $userid=$_SESSION ['userid'];
    $connect=mysql_connect("192.232.249.164", "km310765_admin", "Aftermath2015") or die ("Couldn't connect!");
    mysql_select_db("km310765_f2foxes") or die("Couldn't find db");
?>

<!-- Main Wrapper -->
<div id="main-wrapper">
<div class="wrapper style2">
<div class="inner">
<div class="container">
	<div id="content">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!--<link rel="stylesheet" href="/resources/demos/style.css">-->

    <div id="gradedialog" title="Class Data">
    <form action="addClass.php" method="POST">
        <fieldset class="ui-helper-reset">
        <label for="tab_title">Class Name (ex. MATH-151)</label>
        <input type="text" name="classes" id="classes" value="" class="ui-widget-content ui-corner-all">
        <label for="tab_content">Number of Credit Hours</label>
        <input type="text" name="credits" id="credits" value="3" class="ui-widget-content ui-corner-all"></input>
        </fieldset>
    </form>
    </div>
 
    <button id="add_tab">Add New Class</button>
 
    <div id="tabs">
    <ul>
    <li><a href="#tabs-1">Nunc tincidunt</a> <span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>
    </ul>
    <div id="gradetabs-1">
    <p>Pratie e lectus.</p>
    </div>
    </div>

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
