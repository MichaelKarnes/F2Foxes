
<!-- Main Wrapper -->
<?php
//session_start();
$username=$_POST['username'];
$password=$_POST['password'];
if ($username && $password)
{
    
    $query2=$db->query("SELECT * FROM Authentication WHERE Username='$username' ");
    $numrows=mysqli_num_rows($query2);
    // echo "rows is $numrows"; this is a quick check to see if the username exists
    if ($numrows!=0)
    {
        //code to login
        while ($row2=mysqli_fetch_assoc ($query2))
        {
            $dbusername=$row2 ['Username'];
            $dbpassword=$row2 ['Password'];
            $dbuserid=$row2 ['UserID'];
        }
        //cehck to see if they match!
        if($username==$dbusername&&md5($password)==$dbpassword)// password is stored as an md5
        {
            echo"You're in! <a href='index.php'>Click here to enter. </a>";// edit this to change were the use goes after logingin
            $_SESSION['username']=$dbusername;
            $_SESSION['userid']=$dbuserid;
            $query=$db->query("SELECT a.Admin, a.Root, a.Training, a.Grades, a.Signout, a.Student, a.OldFox, a.Parent, a.Public_Relations, a.Upperclassmen FROM Account_info i INNER JOIN Authorization a ON i.PositionID = a.PositionID WHERE i.UserID='$dbuserid' ");
            $row=mysqli_fetch_assoc ($query);
            $_SESSION['admin']=$row['Admin'];
            $_SESSION['training']=$row['Training'];
            $_SESSION['grades']=$row['Grades'];
            $_SESSION['signout']=$row['Signout'];
            $_SESSION['student']=$row['Student'];
            $_SESSION['oldfox']=$row['OldFox'];
            $_SESSION['parent']=$row['Parent'];
            $_SESSION['root']=$row['Root'];
            $_SESSION['upperclassmen']=$row['Upperclassmen'];
            $_SESSION['public_relations']=$row['Public_Relations']; 
           // header("Location: index.php");
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
<fieldset>
<label for="username">Username</label>
<input type="text" id="username" name="username" value="" maxlength="20" />
<label for="password">Password  </label>
<input type="password" id="password" name="password" value="" maxlength="20" />
<br></br>
<input type="submit" value="Login" />
</fieldset>
</form>
<p><a href="forgot.php"> (Forgot Password?)</a>     <a href="register.php">Not Registered? Click here.</a></p>
