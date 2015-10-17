<?php 
    include 'boot/session.php'; 
    $username=$_SESSION ['username'];
    $userid=$_SESSION ['userid'];
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Outfit PT Scores</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <style>
            table,td,th {border: 1px solid black; text-align: center;}
        </style>
	</head>


	<body class="no-sidebar">
		<div id="page-wrapper">

            <!--header-->
            <?php include 'pagecontent/header.php'; ?>
            <div id="main-wrapper">
	            <div class="wrapper style2">
                <br></br>

                <a href="pt.php">Click here to return to the previous page</a>
                <br>
                <br>

                <table style="width: 90%">
                <tr>
                <td>Last Name</td> <td>First Name</td> </td><td>Date</td> 
                <td>Raw Push Ups</td> <td>Push Up Score</td>
                <td>Raw Sit Ups</td> <td>Sit Up Score</td>
                <td>Raw Run</td> <td>Run Score</td> <td>Overall Score</td> 
                <td>Pass/Fail</td> 
                </tr>
                
                 <?php 
                     $query = $db->query("SELECT * FROM PT");

                     if($query->num_rows > 0) {
                        while($row = mysqli_fetch_assoc($query)) {
                        #while data can be fetched, create HTML Table of PT Scores
                        echo "<tr>" . 
                        "<td>" . $row["LastName"] . "</td>" .
                        "<td>" . $row["FirstName"] . "</td>" .
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
                 <br></br> 
                 </div>
            </div>
			<!-- Footer  -->
            <?php include 'pagecontent/footer.php'; ?>
				
		</div>

		<!--Script-- can be found in the pagecontent folder script.php-->
        <?php include 'pagecontent/script.php'?>

	</body>
</html>

