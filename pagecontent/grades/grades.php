<?php
    $username=$_SESSION ['username'];
    $userid=$_SESSION ['userid'];
?>

<!-- Main Wrapper -->
<div id="main-wrapper">
<div class="wrapper style2">
<div class="inner">
<div class="container">
	<div id="contentdifferentstyle">
    
    <!--slight modification to make for smaller and have arrow image-->
    <style> 
    form{
        color: Black;
        width: 65%;
    }
    select{
          background: url(images/new_arrow.jpg) no-repeat right;     
    }
    </style>

    <h1>Please update your grades on a regular basis!</h1>
    <p>Use the selector below to add, edit, or delete class information</p>
    <form method="POST">
    <select name="classoptions">
    <option value=""> </option>
    <option value="addClass">Add Class</option>
    <option value="editClass">Edit Class</option>
    <option value="deleteClass">Delete Class</option>
    </select>
    <input type="submit">
    </form>

    <br></br>

    <?php
        if($_POST['classoptions'] == "addClass") {
            echo "Please enter the class name and corresponding credit hours";
            echo'<form action="classes.php" method="POST">
                <fieldset>
                <label for="classes">Class Name (ex. MATH-151)</label>
                <input type="text" name="classes" id="classes" value="">
                <label for="credits">Number of Credit Hours (ex. 3)</label>
                <input type="text" name="credits" id="credits" value="3"></input>
                </fieldset>
                <input type="submit"></input>
                </form>'; 
        } elseif ($_POST['classoptions'] == "editClass") {
            echo "Please e"
            
        }
    ?>

    
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
