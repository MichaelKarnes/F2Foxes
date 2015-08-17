<?php
include 'boot/session.php'; 
$_SESSION['Week']= date('m/d/Y', strtotime($_SESSION['Week']." + 1 Week"));
include 'signoutsheet.php';
?>
