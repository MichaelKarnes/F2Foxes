<?php
include 'boot/session.php'; 
$monday = date('w') == 1 ? date('m/d/Y') : date('m/d/Y', strtotime('previous monday'));
$_SESSION['Week']=$monday;
include 'signoutsheet.php';
?>