<?php
include 'boot/session.php'; 
if (!($_SESSION['student']==1)&&!($_SESSION['root']==1)){ die("Sorry you do not have access to this file "); } 
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Grades</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="pagecontent/grades/gradeStyle.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#hide").click(function () {
                    $(".hideForm").remove();
                });
            });
            function new_class() {
                $.post('pagecontent/grades/addClass.php', { class: newclass.classes.value , credit: newclass.credits.value }, 
                    function (output) {
                        $('#classes').html(output).show();
                    });
            }
         </script>
	</head>
	<body class="no-sidebar">
		<div id="page-wrapper">

        <?php include 'pagecontent/header.php'; ?> 

       
        <!--Main Content-- link to about.php it is located in the pagecontent folder-->
        <?php include 'pagecontent/grades/grades.php'?>
				    
        
            
        <?php include 'pagecontent/footer.php'; ?>
		</div>	

        <!--Script-- can be found in the pagecontent folder script.php-->
        <?php include 'pagecontent/script.php'?>
 
</body>
</html>