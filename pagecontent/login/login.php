
<!-- Main Wrapper -->
<?php
session_start();
$username=$_POST['username'];
$password=$_POST['password'];
if ($username && $password)
{
    $connect=mysql_connect("192.232.249.164", "km310765_admin", "Aftermath2015") or die ("Couldn't connect!");
    mysql_select_db("km310765_f2foxes") or die("Couldn't find db");
    $query=mysql_query("SELECT * FROM Authentication WHERE Username='$username' ");
    $numrows=mysql_num_rows($query);
    // echo "rows is $numrows"; this is a quick check to see if the username exists
    if ($numrows!=0)
    {
        //code to login
        while ($row=mysql_fetch_assoc ($query))
        {
            $dbusername=$row ['Username'];
            $dbpassword=$row ['Password'];
            $dbuserid=$row ['UserID'];
        }
        //cehck to see if they match!
        if($username==$dbusername&&md5($password)==$dbpassword)// password is stored as an md5
        {
            echo"You're in! <a href='index.php'>Click</a> here to enter";// edit this to change were the use goes after logingin
            $_SESSION['username']=$dbusername;
            $_SESSION['userid']=$dbuserid;
            $query=mysql_query("SELECT a.Admin, a.Training, a.Grades, a.Signout, a.Student, a.OldFox, a.Parent, a.Public_Relations FROM Account_info i INNER JOIN Authorization a ON i.PositionID = a.PositionID WHERE i.UserID='$dbuserid' ");
            $row=mysql_fetch_assoc ($query);
            $_SESSION['admin']=$row['Admin'];
            $_SESSION['training']=$row['Training'];
            $_SESSION['grades']=$row['Grades'];
            $_SESSION['signout']=$row['Signout'];
            $_SESSION['student']=$row['Student'];
            $_SESSION['oldfox']=$row['OldFox'];
            $_SESSION['parent']=$row['Parent'];
            $_SESSION['public_relations']=$row['Public_Relations'];
               
        }
        else
            echo " incorrect password";
    }
    else
        echo "user does not exits";
       
}
else{
    //echo("please enter a username and a password");
}
?>
    <!--Prevents Mobile Nav Bar From covering up content-->
<br></br>
<h1>Please Log In</h1>
<form action= "login.php" method="post">
<p>
<label for="username">Username</label>
<input type="text" id="username" name="username" value="" maxlength="20" />
</p>
<p>
<label for="password">Password</label>
<input type="password" id="password" name="password" value="" maxlength="20" />
</p>
<p>
<input type="submit" value="Login" />
</p>
</fieldset>
</form><p><a href="register.php">Not Registered? Click here.</a></p>