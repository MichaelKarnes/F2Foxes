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
        <style>
            table,td,th {border: 1px solid black; text-align: center;}
            tr:nth-child(odd) {color: white; background-color: DarkRed; text-shadow: 1px 1px blue;} 
            /*tr:nth-child(even) {text-shadow: 1px 1px DarkGray;}*/
            td,th {padding: 2px 1px 2px 1px;}
            #formIn {width: 20em;}
        </style>
        
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

            <?php
                #check to see if admin,CO,PL,1SG, or training. Can see outfit scores.
            $query = $db->query("SELECT PositionID FROM Account_info WHERE UserID='$userid'");
            if($query->num_rows > 0) {
                    while($row = mysqli_fetch_assoc($query)) {
                       
                        if ($row["PositionID"] == 5 || $row["PositionID"] == 4 || $row["PositionID"] == 7 || $row["PositionID"] == 6 || $row["PositionID"] == 8 || $row["PositionID"] == 12) {
                            echo "Hey, Listen! Your position warrants the ability to view outfit
                            pt scores. Click the button below" . '<br>' .
                            '<form action="adminOutfitPT.php" method="post">' . 
                            '<input type="submit" value = "View Outfit PT Scores!"/>' . 
                            '</form>'; 
                        }
                    }
            }
            ?>
            <br>
            <h1> <?php echo $username . "'s "; ?> PT Scores</h1>
            <table style="width: 90%">
            <tr>
                <td>Date</td> <td>Raw Push Ups</td> <td>Push Up Score</td>
                <td>Raw Sit Ups</td> <td>Sit Up Score</td>
                <td>Raw Run</td> <td>Run Score</td> <td>Overall Score</td> 
                <td>Pass/Fail</td> <td>Delete</td>
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

                        "<td>" .   
                            '<form action = "ptDelete.php" method = "post">' .
                            '<input type = "submit" value = "X" class = "tableSub" 
                            name = "delete[' . $row["ID"] . ']" />' . '</form>' .
                        "</td>" .  
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
            <br>
           
            <form action="ptSubmit.php" method="POST">
            <label>Type of PT test</label>
            <input type="radio" name="type" value="army" checked>Army
            <input type="radio" name="type" value="corps">Corps

            <label>Date of PT test (ex. 09-24-2015):  </label>
            <input type="text" id="formIn" name="date" maxlength="15"/>
            
            <label>Raw Push Ups (ex. 80):  </label>
            <input type="text" id="formIn" name="pushUpsRaw" maxlength="3"/>
          
            <label>Raw Sit Ups (ex. 90):  </label>
            <input type="text" id="formIn" name="sitUpsRaw" maxlength="3"/>
           
            <label>Run Time (ex. 12:30):  </label>
            <input type="text" id="formIn" name="runRaw" maxlength="10"/>
          
            <label>Male or Female?:  </label>
            <input type="radio" name="gender" value="male" checked>Male
            <input type="radio" name="gender" value="female">Female
            <br><br>
            <input type="submit">
            </form>       
			<br></br>

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
