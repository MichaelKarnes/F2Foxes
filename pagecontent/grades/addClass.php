<?php
    //when online use this 
    $db = mysqli_connect("localhost", "km310765_admin", "Aftermath2015", "km310765_f2foxes") or die($connect_error);

    session_start();
    $username=$_SESSION ['username'];
    $userid=$_SESSION ['userid'];
    $class=strip_tags($_POST["class"]);
    $credit=strip_tags($_POST["credit"]);
    //$db=mysqli_connect("192.232.249.164", "km310765_admin", "Aftermath2015","km310765_f2foxes") or die ("Couldn't connect!");
     #define the SQL query from the html form in grades.php//has to be defined here unlike before. Reason IDK.
    $sqlAddClass = "INSERT INTO Grades_Classes VALUES('$userid','$class','$credit')";
    #send the query to the database table Grades_Classes
    $db->query($sqlAddClass);
    //echo "userid=$userid";
    //echo "credit=$credit";
    //echo "class=$class";
    //echo "helloword";
    ?>
<p>Inserted class=<?php echo $class; ?>  with credits=<?php echo $credit; ?></p>



