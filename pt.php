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
			
            <br>
            <h1>My PT Scores</h1>
            <table style="width: 90%">
            <tr>
                <td>Date</td> <td>Raw Push Ups</td> <td>Push Up Score</td>
                <td>Raw Sit Ups</td> <td>Sit Up Score</td>
                <td>Raw Run</td> <td>Run Score</td> <td>Overall Score</td> 
                <td>Pass/Fail</td>
            </tr>
            <?php
                #search the database for any existing pt scores according to user id
                $query = $db->query("SELECT * FROM PT WHERE UserID = '$userid'");
                #if a non zero number of rows is returned, fetch each row for display
                if($query->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($query)) {
                        #while data can be fetched, create HTML Table of PT Scores
                        echo "<tr>" . 
                        "<td>" . $row["Date"] . "</td>" .
                        "<td>" . $row["Push_Ups_Raw"] . "</td>" .
                        "<td>" . $row["Push_Ups_Score"] . "</td>" .
                        "<td>" . $row["Sit_Ups_Raw"] . "</td>" .
                        "<td>" . $row["Sit_Ups_Score"] . "</td>" .
                        "<td>" . $row["Run_Time"] . "</td>" .
                        "<td>" . $row["Run_Score"] . "</td>" .
                        "<td>" . $row["Overall_Score"] . "</td>" .
                        "<td>" . $row["Pass"] . "</td>" .
                        "</tr>"; 
                    } 
                } else {
                    echo "<br>" . "No PT Scores to Date!";
                }
                
            ?> 
            </table>
            
            <br>
            <p>Please fill out the form below to add a PT Score. Your score will be
            calculated from raw scores (ex. You did 80 push ups, enter 80).</p>
            <!--Note that this form calls a Javascript function. Thus, action is 
                null and the normal "submit" is replaced with "button". See pt.css
                and pt.js for more details.-->
            <form action="ptSubmit.php" method="POST">
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
            <br>
            <input type="submit">
            <br></br>
            </form>       
			<br>

            <?php /*
                #collect score data from the above form
                $date = $_POST['date'];
                $pushUpsRaw = intval($_POST['pushUpsRaw']);
                $sitUpsRaw = intval($_POST['sitUpsRaw']);
                $runRaw = intval($_POST['runRaw']);
                #for the run Score, convert to seconds
                #substr picks off the minutes and the seconds from the form run input xx:xx
                #for the minutes, convert to seconds by multiplying by 60,
                #both minutes and seconds converted to integers, add!!!!
                $runRaw = (intval(substr($runRaw,0,2))*60) + intval(substr($runRaw,3,2));

                #if the form has been set, do some calculations and communicate with
                #the PT table in the database. Notice if statements for male or female.
                if(isset($_POST['pressButton'])) {
                    if($_POST['gender'] == "male") {
                    #raw push ups to score using linear regression on score tables
                    #from military.com
                        if($pushUpsRaw <= 71) { 
                            $pushUpsScore = ($pushUpsRaw*1.37925) + 2.06930;
                        } else {
                            #calculate score over 100
                            $pushUpsScore = 100 + ($pushUpsRaw - 71);
                        }

                        #regression for mens running scores
                        if ($runScore >= 780) {
                            $runScore = ($runRaw * -.22988) + 279.298; 
                        } else {
                            #extra point for every 6 seconds below 13:00 or 780 secs
                            #5 is negative to increase score rather than decrease
                            $runScore = 100 + (($runScore - 780) / -5);
                        }
                        
                        #sit Ups Scores calculated same way for both genders, done at end
                    } else {
                        #female so new regression
                        if($pushUpsRaw <= 42) { 
                            $pushUpsScore = ($pushUpsRaw*1.73996) + 26.9508;
                        } else {
                            #calculate score over 100
                            $pushUpsScore = 100 + ($pushUpsRaw - 42);
                        }

                        if ($runScore >= 936) {
                            $runScore = ($runSecsRaw*-.2020765) + 289.1643;
                        } else {
                            #extra point for every 6 seconds below 15:36 or 936 secs
                            #5 is negative to increase score rather than decrease
                            $runScore = 100 + (($runScore - 936) / -5);
                        }

                    }

                    #finally calculate sit Ups Score
                    if($sitUpsRaw < 21) {
		                $sitUpsScore = 0;
	                } elseif($sitUpsRaw >=21 && $sitUpsRaw <= 78) {
		                $sitUpsScore = (1.5996*$sitUpsRaw) - 24.786;
	                } else {
	                    $sitUpsScore = 100 + ($sitUpsRaw - 78);
	                }

                    #input data into database 
                    echo $pushUpsRaw . $pushUpsScore . $sitUpsRaw . $sitUpsScore . $runRaw . $runScore; 
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
