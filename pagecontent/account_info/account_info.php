<!-- Main Wrapper -->
<?php  
$userid=$_SESSION['userid'];

$submit=$_POST['contactinfo'];
if ($submit)
{   
    
    $newfirstname=strip_tags($_POST['firstname']);
    $newlastname=strip_tags($_POST['lastname']);;
    $newclassyear=strip_tags($_POST['classyear']);
    $newphone=strip_tags($_POST['phone']);
    $newemail=strip_tags($_POST['email']);
    $comma=", ";
    $newlast_f=$newlastname.$comma.$newfirstname[0];
    
    $db->query("UPDATE  Contact_Info SET ClassYear='$newclassyear', Phone='$newphone', Email='$newemail' WHERE UserID='$userid' ") or die ("Could not update Account");
    $db->query("UPDATE  Account_info SET FirstName='$newfirstname', LastName='$lastname' WHERE UserID='$userid' ") or die ("Could not update Account");
    if ($_SESSION['student']){
        $db->query("UPDATE  Account_info SET FirstName='$newfirstname', LastName='$newlastname' WHERE UserID='$userid' ") or die ("Could not update Account");
    }
    echo "Account Updated";
}

$query=$db->query("SELECT * FROM Contact_Info c INNER JOIN Account_info a ON c.UserID=a.UserID WHERE c.UserID='$userid'  ");
$row=mysqli_fetch_assoc ($query);
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
    <label for="firstname">First Name</label>
    <input type="text" id="classyear" name="firstname" value="<?php echo $firstname ?>" maxlength="20" /><br>
    <label for="lastname">Last Name</label>
    <input type="text" id="classyear" name="lastname" value="<?php echo $lastname ?>" maxlength="20" /><br>
    <label for="classyear"> classyear </label>
    <input type="text" id="classyear" name="classyear" value="<?php echo $classyear ?>" maxlength="2" /><br>
    <label for="phone"> Phone </label>
    <input type="text" id="phone" name="phone" value="<?php echo $phone ?>" maxlength="10" /><br>
    <label for="email"> Email</label>
    <input type="text" id="phone" name="email" value="<?php echo $email ?>" maxlength="50" /><br>
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

 
		