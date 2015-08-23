<?php
    $username=$_SESSION ['username'];
    $userid=$_SESSION ['userid'];
    $connect=mysql_connect("192.232.249.164", "km310765_admin", "Aftermath2015") or die ("Couldn't connect!");
    mysql_select_db("km310765_f2foxes") or die("Couldn't find db");

    #define the SQL query from the html form in grades.php
    $sqlAddClass = "INSERT INTO Grades_Classes (UserId, Class, Credits)
    VALUES($userid,$POST_['classes'],$POST_['credits'])";

    #send the query to the database table Grades_Classes
    mysql_query($sqlAddClass);

    echo"helloword";


?>


