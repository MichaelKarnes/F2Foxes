<?php
include 'boot/session.php'; 
$username=$_SESSION ['username'];
$userid=$_SESSION ['userid'];
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>PT</title>
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
			
            <h1>My PT Scores</h1>
            <table style="width: 90%">
            <tr>
                
            </tr>
            <?php
                #search the database for any existing pt scores according to user id
                $query = $db->query("SELECT * FROM PT WHERE UserID = '$userid'");
                #if a non zero number of rows is returned, fetch each row for display
                if($query->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($query)) {
                        echo"blue";
                        #while data can be fetched, create HTML Table
                        echo "<tr>" . 
                        "<td>" . $row["Date"] . "</td>" .
                        "<td>" . $row["Push_Ups_Raw"] . "</td>" .
                        "<td>" . $row["Push_Ups_Score"] . "</td>" .
                        "<td>" . $row["Sit_Ups_Raw"] . "</td>" .
                        "<td>" . $row["Sit_Ups_Score"] . "</td>" .
                        "<td>" . $row["Run_Raw"] . "</td>" .
                        "<td>" . $row["Run_Score"] . "</td>" .
                        "<td>" . $row["Overall_Score"] . "</td>" .
                        "</tr>"; 
                    } 
                } else {
                    echo "No PT Scores to Date!";
                }
                
            ?> 
            </table>
            
            <p>Please fill out the form below to add a PT Score. Your score will be
            calculated from raw scores (ex. You did 80 push ups, enter 80)</p>
            <!--Note that this form calls a Javascript function. Thus, action is 
                null and the normal "submit" is replaced with "button". See pt.css
                and pt.js for more details.-->
            <form action="" method="POST">
            <fieldset>
            <label>Date of PT test (ex. 09-24-2015) </label>
            <input type="text" name="date" maxlength="15"/>
            <label>Raw Push Ups (ex. 80) </label>
            <input type="text" name="pushUpsRaw" maxlength="3"/>
            <label>Raw Sit Ups (ex. 90) </label>
            <input type="text" name="sitUpsRaw" maxlength="3"/>
            <label>Run Time (ex. 12:30) </label>
            <input type="text" name="runRaw" maxlength="15"/>
            <label>Male or Female? </label>
            <input type="radio" name="gender" value="male" checked>Male
            <br>
            <input type="radio" name="gender" value="female">Female
            <br></br>
            <input type="button" class="imSpecial">
            </fieldset>
            </form>       
			

            <?php
                
                #if the form has been set, do some calculations and communicate with
                #the PT table in the database. Note if statement for male or female.
                /*
                if(check if form is set isset()  1) {
                    if($_POST['gender'] == "male") {
                    #raw push ups to score using linear regression on score tables
                    #from military.com
                        if($pushUpsRaw <= 71) { 
                        $pushUpsScore = ($pushUpsRaw*1.37925) + 2.06930;
                        } else {
                            #calculate score over 100
                            $pushUpsScore = 100 + ($pushUpsRaw - 71);
                        }
                    } else {
                        #female so new regression
                        if($pushUpsRaw <= 71) { 
                        $pushUpsScore = ($pushUpsRaw*1.37925) + 2.06930;
                        } else {
                            #calculate score over 100
                            $pushUpsScore = 100 + ($pushUpsRaw - 71);
                        }
                    }
                }
                */
            ?>

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
