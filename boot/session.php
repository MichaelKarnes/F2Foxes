<?php
session_start();

//comment out next line if working from home 
 //$db = mysqli_connect("localhost", "km310765_admin", "Aftermath2015", "km310765_f2foxes") or die($connect_error);

 // comment out next line if working from pushed website
 $db=mysqli_connect("192.232.249.164", "km310765_admin", "Aftermath2015","km310765_f2foxes") or die ("Couldn't connect!");
?>