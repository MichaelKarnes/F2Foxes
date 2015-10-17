<?php
include 'boot/session.php'; 
$username=$_SESSION ['username'];
$userid=$_SESSION ['userid'];

$toDelete = $_POST['delete'];
$idDelete = key($toDelete);

$query = $db->query("DELETE FROM PT WHERE UserID = '$userid' && ID = '$idDelete'");
echo "PT score deleted. Redirecting....";
?>

<!--automatically refresh pt.php after running php code above-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="refresh" content="1;url=pt.php" />
        <script type ="text/javascript">
            window.location.href = "pt.php"
        </script>
        <title>Updating Scores</title>
    </head>
    <body>
        <a href="pt.php">Click here if the automatic redirect is not working</a>
    </body>
</html>
