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
	<div id="contentdifferentstyle">
    
    <form action="class.php">
    <select name="cars">
    <option value="addClass">addClass</option>
    <option value="deleteClass">deleteClass</option>
    <option value="editClass">editClass</option>
    </select>
    <input type="submit">
    </form>

    <div id="gradedialog" title="Class Data">
    <form action="addClass.php" method="POST">
        <fieldset class="ui-helper-reset">
        <label for="classes">Class Name (ex. MATH-151)</label>
        <input type="text" name="classes" id="classes" value="" class="ui-widget-content ui-corner-all">
        <label for="credits">Number of Credit Hours</label>
        <input type="text" name="credits" id="credits" value="3" class="ui-widget-content ui-corner-all"></input>
        </fieldset>
    <input type="submit"></input>
    </form>
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
