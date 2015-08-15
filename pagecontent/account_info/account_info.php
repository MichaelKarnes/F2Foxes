<!-- Main Wrapper -->
<?php  $connect=mysql_connect("192.232.249.164", "km310765_admin", "Aftermath2015") or die ("Couldn't connect!");
mysql_select_db("km310765_f2foxes") or die("Couldn't find db"); 
$userid=$_SESSION['userid'];

$submit=$_POST['contactinfo'];
if ($submit)
{   
    $newclassyear=$_POST['classyear'];
    $newphone=$_POST['phone'];
    $newemail=$_POST['email'];
    
    mysql_query("UPDATE  Contact_Info SET ClassYear='$newclassyear', Phone='$newphone', Email='$newemail' WHERE UserID='$userid' ") or die ("Could not update Account");
    echo "Account Updated";
}

$query=mysql_query("SELECT * FROM Contact_Info c INNER JOIN Account_info a ON c.UserID=a.UserID WHERE c.UserID='$userid'  ");
$row=mysql_fetch_assoc ($query);
$firstname= $row['FirstName'];
$lastname= $row['LastName'];
$classyear= $row['ClassYear'];
$phone= $row['Phone'];
$address= $row['Address'];
$state= $row['State'];
$county= $row['Country'];
$zip= $row['Zip'];
$email= $row['Email']; 
?>
<h1>ACCOUNT INFO</h1> 
<form action="account_info.php" method="POST">
    <label for="firstname">Firstname</label>
    <input type="text" id="classyear" name="classyear" value="<?php echo $firstname ?>" maxlength="15" /><br>
    <label for="classyear"> classyear </label>
    <input type="text" id="classyear" name="classyear" value="<?php echo $classyear ?>" maxlength="15" /><br>
    <label for="phone"> Phone </label>
    <input type="text" id="classyear" name="classyear" value="<?php echo $classyear ?>" maxlength="15" /><br>
    <label for="phone"> Phone </label>
    <input type="text" id="phone" name="phone" value="<?php echo $phone ?>" maxlength="15" /><br>
    <label for="email"> Email</label>
    <input type="text" id="phone" name="email" value="<?php echo $email ?>" maxlength="15" /><br>
    <?php  /*?><label for="address"> email</label>
    <input type="text" id="phone" name="address" value="<?php echo $address ?>" maxlength="15" /><br>
    <label for="phone"> State </label>
    <input type="text" id="phone" name="phone" value="<?php echo $state ?>" maxlength="15" /><br>
    

<h2>Your Current Class Year = <?php $clasyear ?></h2>
<h2>Your Current Class Year = <?php $phone ?></h2>
<h2>Your Current Class Year = <?php $address ?></h2> */
    ?>

    <input type="submit" name="contactinfo" value="make changes" />
</form>

 
		
