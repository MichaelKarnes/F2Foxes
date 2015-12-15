<?php
include 'boot/session.php'; 
if (!($_SESSION['admin']==1)){ die("Sorry you do not have access to this file "); }
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Admin</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="pagecontent/admin/admin.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body class="no-sidebar">
		<div id="page-wrapper">

            <!--header-->
            <?php include 'pagecontent/header.php'; ?>

            <div id="main-wrapper">
	        <div class="wrapper style2">
		    <div class="inner">
			<div class="container">
		    <div id="content">

            <!--Main Content-- link to about.php it is located in the pagecontent folder-->
            <?php #include 'pagecontent/admin/admin_reg.php'?>

            <!-- Main Wrapper -->
            <?php
            $submit=$_POST['change'];
            //form data
            $a="a";
            $d="d";
            if ($submit) {   
                $query3=$db->query("SELECT Username FROM Registration ");

                while ($row3=mysqli_fetch_assoc ($query3)) {
                    $user=$row3['Username'];
                    $avalue_name=$a.$user;
                    $dvalue_name=$d.$user;
                    $delete_value=strip_tags($_POST["$dvalue_name"]);
                    $position_value=strip_tags($_POST["$user"]);
                    $activation_value=strip_tags($_POST["$avalue_name"]);
                    if ($delete_value) {
                        $db->query("DELETE FROM Registration WHERE Username='$delete_value'")or die ("Couldn't delete from Registration");
                    } else if ($position_value && $activation_value) {
                        $query4=$db->query("SELECT * FROM Registration WHERE Username='$user'");
                        $row4=mysqli_fetch_assoc ($query4);
                        //ignored Requested_Position only good for registration page
                        $a_Reg_Date=$row4['Reg_Date'];
                        $a_UserID=$row4['UserID'];
                        $a_FirstName=$row4['FirstName'];
                        $a_LastName=$row4['LastName'];
                        $a_Username=$row4['Username'];
                        $a_Password=$row4['Password'];
                        $a_classyear= $row['classyear']; 
                        $a_Phone=$row4['Phone']; 
                        $a_Email=$row4['Email'];
                        $a_tamu=$row4['TamuEmail'];
                        $a_Address=$row4['Address'];
                        $a_State=$row4['State'];
                        $a_Zip=$row4['Zip'];
                        $a_Country=$row4['Country'];
                        // Needs to insert into the Account_info, Authentication, Grades, Contact_Info
                        $db->query("INSERT INTO Account_info VALUES('$a_UserID','$a_FirstName','$a_LastName','$position_value','')") or die ("Couldn't insert into Account_info");
                        $db->query("INSERT INTO Authentication VALUES('$a_UserID','$a_Username','$a_Password')")or die ("Couldn't insert into Authentication");
                        $db->query("INSERT INTO Contact_Info VALUES('$a_UserID','$a_Reg_Date','$a_classyear','$a_Phone','$a_Address','$a_State','$a_Country','$a_Zip','$a_Email','$a_tamu')")or die ("Couldn't insert into Contact_info");            
                        $db->query("DELETE FROM Registration WHERE Username='$user' ")or die ("Couldn't delete from Registration");
                    }
                }
            }   

        ?>
        <?php 
            $query=$db->query("SELECT * FROM Registration ");
            $numrows=mysqli_num_rows($query);
        ?>
       
        <h1> Users Registered but not active = <?php echo "$numrows"; ?> </h1>
        <form action="admin_reg.php" method="POST">
        <table>
            <tr>
                <th>Reg_Date</th>
                <th>UserID</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Requested position</th>
                <th>Class Year</th>
                <th>Username</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Delete</th>
                <th>Activiate</th>
                <th>Position</th>

            </tr>
           <?php  while ($row=mysqli_fetch_assoc ($query))  { ?>
            <tr>
                <?php 
                $reg_date= $row['Reg_Date']; 
                $userid= $row['UserID']; 
                $firstname= $row['FirstName'];
                $lastname= $row['LastName']; 
                $requested_position= $row['Requested_Position']; 
                $classyear= $row['classyear']; 
                $username= $row['Username']; 
                $password= $row['Password']; 
                $phone= $row['Phone']; 
                $email= $row['Email']; 
                $address= $row['Address']; 
                $state= $row['State']; 
                $zip= $row['Zip']; 
                $country= $row['Country']; 
                echo "<td>$reg_date</td><td>$userid</td><td>$firstname</td><td>$lastname</td><td>$requested_position</td><td>$classyear</td>
                <td>$username</td><td>$phone</td><td>$email</td>" ?>
                <td>
                    <input type="checkbox" name="d<?php echo $username ?>" value="<?php echo $username ?>">delete account<br>
                </td>
                <td>
                    <input type="checkbox" name="a<?php echo $username ?>" value="<?php echo $username ?>">activate<br>
                </td>
                <td>
                    <select name="<?php echo $username ?>">
                       <?php  $query2=$db->query("SELECT PositionID, Position FROM Authorization ");
                        while ($row2=mysqli_fetch_assoc ($query2))  {
                            $value=$row2['PositionID'];
                            $label= $row2['Position'];
                        ?>
                        <option value="<?php echo $value ?>" <?= ($_POST["$username"]=="$value") ? "selected": "";  ?> > <?php echo $label  ?> </option>
                        <?php  } ?>
                    </select>
                </td>
            </tr>
            <?php  } ?>

        </table> <?php ?>
            <input type="submit" name="change" value="change" />
         </form>



		    </div>
			</div>
		    </div>
	        </div>
            </div>
            
			<!-- Footer  -->
            <?php include 'pagecontent/footer.php'; ?>
				

		</div>

		<!--Script-- can be found in the pagecontent folder script.php-->
        <?php include 'pagecontent/script.php'?>

	</body>
</html>