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
			

            <!--begin section of NO debugging, 9/2/2015-->
            <?php
                //if admin/ CO / 1SG / display PT Scores need others besides admin
                    
                if ($_SESSION['admin'] == 1 ) {
                    echo '<form action = "" method = "post">' .
                    '<input type = "button" name = "viewPT" value = 
                    "View Outfit PT Scores" > </input>' . '</form>';
                
                    if ($_POST['viewPT'] == 1) {
                        $queryAllPT = $db->query("SELECT * FROM PT");
                    
                        if ($queryAllPT->num_rows > 0) {
                            while ($rowLoop = $queryAllPT->fetch_assoc()) {

                            }
                            
                        }
                        
                    }
                }
            ?>
            <!--end no debug. YOu really need to get XAMPP dude-->
            <br>
            <h1> <?php echo $username . "'s "; ?> PT Scores</h1>
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
