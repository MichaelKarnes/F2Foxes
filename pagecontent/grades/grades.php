<?php
    
//reference=https://www.youtube.com/watch?v=v8HoVdenZFM
    $username=$_SESSION ['username'];
    $userid=$_SESSION ['userid'];
?>

<!-- Main Wrapper -->
<div id="main-wrapper">
<div class="wrapper style2">
<div class="inner">
<div class="container">
	<div id="contentdifferentstyle">

    <!--slight modification to make selector have arrow image-->
    <style>
        select {
            background: url(images/new_arrow.jpg) no-repeat right;
        }
        .hide { position:absolute; top:-1px; right:-1px; width:0px; height:0px; }
    </style>

    <!--hidden iframe prevents form submit button from switching pages-->
    <iframe name ="hiddenFrame" class="hide"></iframe>

    <h1>Please update your grades on a regular basis!</h1>
    <p>Use the selector below to add a new class or to collapse the new class form</p>
    <form  method="POST">
    <select name="classoptions">
    <option value="">Click anywhere on this box to make a selection!</option>
    <option value="addClass">Add Class</option>
    <option value="noForm">Collapse Form</option>
    </select>
    <input type="submit">
    </form>

    <br></br>
    
    <!--if the user wishes to add a new class, the following php code will display the form.
    Otherwise the if condition is false, and the form will not be displayed. -->
    <?php
        if($_POST['classoptions'] == "addClass") {
            #the form targets a hidden iframe to prevent having to reload the page
            echo'<form name="newclass" target="hiddenFrame" class="hideForm">
                <fieldset>
                <label for="classes">Class Name (ex. MATH-151)</label>
                <input type="text" name="classes" id="classes" value="math"></input>
                <label for="credits">Number of Credit Hours (ex. 3)</label>
                <input type="text" name="credits" id="credits" value="3"></input>
                <input type="button" value="class" id ="hide" onClick="new_class();"></input>
                </fieldset>
                </form>';

                //commented out what you did David incase you want to go back but it works
                /*echo'<form action="pagecontent/grades/addClass.php" method="POST" target="hiddenFrame" class="hideForm">
                <fieldset>
                <label for="classes">Class Name (ex. MATH-151)</label>
                <input type="text" name="classes" id="classes" value=""></input>
                <label for="credits">Number of Credit Hours (ex. 3)</label>
                <input type="text" name="credits" id="credits" value="3"></input>
                <input type="submit" id ="hide"></input>
                </fieldset>
                </form>';*/
        } 
    ?>
     <div id="classes"></div>
    <p>hi</p>
        

    
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
