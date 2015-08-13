<?php
function get($name)
{
    return isset($_REQUEST[$name])?$_REQUEST[$name]:'';
}
function is_valid_index($index,$array)
{
   return $index >=0 && $index<count($array);
}
function run_names_selection()
{
    
}
function reason_image($number){
    $reasonarray= array('Blank.png','armytraining.png','CadetPerformanceReviewBoard.php','Class.png','CorpsCenterGuard.png','DarlingRecruitingCompany.png','FishDrillTeam.png','IEEE.png','Lab.png','ParsonsMountedCavalry.png','RangerChallenge.png','Rec.png','ReconPlatoon.png','RossVolunteerCompany.png','RuddersRangers.png','Test.png','Tutoring.png','Work.png');
    return $reasonarray[$number];
    
}
include 'boot/session.php'; 
//https://www.youtube.com/watch?v=SaRh2HauIXY has good video for watching how to work with arrays
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>events</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="pagecontent/signout/css/signout.css" />
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
				            <div class="row">
                            <!--Main Content-- link to about.php it is located in the pagecontent folder-->
                            <?php include 'pagecontent/signout/signoutsheet.php'?>
                            </div>
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