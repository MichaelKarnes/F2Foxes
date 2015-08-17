
<!-- Main Wrapper -->
  <?php
    $connect=mysql_connect("192.232.249.164", "km310765_admin", "Aftermath2015") or die ("Couldn't connect!");
    mysql_select_db("km310765_f2foxes") or die("Couldn't find db");
$submit=$_POST['change'];
//form data
$a="a";
$d="d";
if ($submit)//beginning of submit
{   
    $query3=mysql_query("SELECT Username FROM Registration ");
     while ($row3=mysql_fetch_assoc ($query3))  {
         $user=$row3['Username'];
         $avalue_name=$a.$user;
         $dvalue_name=$d.$user;
         $delete_value=strip_tags($_POST["$dvalue_name"]);
         $position_value=strip_tags($_POST["$user"]);
         $activation_value=strip_tags($_POST["$avalue_name"]);
         if ($delete_value)
         {
            mysql_query("DELETE FROM Registration WHERE Username='$delete_value'");
         }
         else if ($position_value && $activation_value)
         {
            $query4=mysql_query("SELECT * FROM Registration WHERE Username='$user'");
            $row4=mysql_fetch_assoc ($query4);
            //igrnored Requested_Position only good for registration page
            $a_Reg_Date=$row4['Reg_Date'];
            $a_UserID=$row4['UserID'];
            $a_FirstName=$row4['FirstName'];
            $a_LastName=$row4['LastName'];
            $a_Username=$row4['Username'];
            $a_Password=$row4['Password'];
            $a_Phone=$row4['Phone']; 
            $a_Email=$row4['Email'];
            $a_Address=$row4['Address'];
            $a_State=$row4['State'];
            $a_Zip=$row4['Zip'];
            $a_Country=$row4['Country'];
            // Needs to insert into the Account_info, Authentication, Grades, Contact_Info
            mysql_query("INSERT INTO Account_info VALUES('$a_UserID','$a_FirstName','$a_LastName','$position_value')");
            mysql_query("INSERT INTO Authentication VALUES('$a_UserID','$a_Username','$a_Password')");
            mysql_query("INSERT INTO Contact_Info VALUES('$a_UserID','$a_Phone',$a_Address','$a_State','$a_Country','$a_Zip','$a_Email','$a_Reg_Date')");
            mysql_query("INSERT INTO Grades VALUES('$a_UserID','')");
            
            mysql_query("DELETE FROM Registration WHERE Username='$user' ");
         }
     }
     /*if ($_POST["$pvalue_name"])
     {
         ?> <h1><?php echo "$pvalue_name"; ?>here</h1>
<?php
     }*/
}   

?>
<?php 
    $query=mysql_query("SELECT * FROM Registration ");
    $numrows=mysql_num_rows($query);
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
                <th>Password</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>State</th>
                <th>Zip</th>
                <th>Country</th>
                <th>Delete</th>
                <th>Activiate</th>
                <th>Position</th>

            </tr>
           <?php  while ($row=mysql_fetch_assoc ($query))  { ?>
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
                <td>$username</td><td>$password</td><td>$phone</td><td>$email</td><td>$address</td><td>$state</td><td>$zip</td><td>$country</td>" ?>
                <td>
                         <input type="checkbox" name="d<?php echo $username ?>" value="<?php echo $username ?>">delete account<br>
                </td>
                <td>
                         <input type="checkbox" name="a<?php echo $username ?>" value="<?php echo $username ?>">activate<br>
                </td>
                <td>
                    <select name="<?php echo $username ?>">
                       <?php  $query2=mysql_query("SELECT PositionID, Position FROM Authorization ");
                        while ($row2=mysql_fetch_assoc ($query2))  {
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