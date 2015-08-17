
<!-- Main Wrapper -->
  <?php
    $connect=mysql_connect("192.232.249.164", "km310765_admin", "Aftermath2015") or die ("Couldn't connect!");
    mysql_select_db("km310765_f2foxes") or die("Couldn't find db");
$submit=$_POST['change'];
$c="c";
$d="d";
if ($submit)//beginning of submit
{   
    $query3=mysql_query("SELECT UserID,PositionID FROM Account_info ");
     while ($row3=mysql_fetch_assoc ($query3))  {
         $user=$row3['UserID'];
         $p_id=$row3['PositionID'];
         $cvalue_name=$c.$user;
         $dvalue_name=$d.$user;
         $delete_value=strip_tags($_POST["$dvalue_name"]);
         $position_value=strip_tags($_POST["$user"]);
         $change_value=strip_tags($_POST["$cvalue_name"]);
         if ($delete_value)
         {
            mysql_query("DELETE FROM Account_info WHERE UserID='$delete_value'") or die("Could not delete from Account_info");
           // mysql_query("DELETE FROM Account_info,Contat_Info,Authentication WHERE UserID='$delete_value'") or die("Could not delete ");
            mysql_query("DELETE FROM Contact_Info WHERE UserID='$delete_value'")or die("Could not delete from Contact_info");
            mysql_query("DELETE FROM Authentication WHERE UserID='$delete_value'")or die("Could not delete from Authentication");
            mysql_query("DELETE FROM Grades WHERE UserID='$delete_value'")or die("Could not delete from Grades");//some users may not be in this table
         }
         else if ($position_value && $change_value)
         {
             $oldpostion=$row3['PositionID'];
             $firstname=$row3['FirstName'];
             $lastname=$row3['LastName'];
            // Needs to insert into the Account_info, Authentication, Grades, Contact_Info
            mysql_query("UPDATE  Account_info SET PositionID='$position_value' WHERE UserID='$user' ") or die ("Could not update Account");
            $c2=$position_value>3;
            $c3=$position_value<13;
            $c4=$p_id>0;
            $c5=$p_id<4;
            $c6=$p_id==0;
            if (($c2&&$c3)&&(($c4&&$c5)||$c6))
            {
               mysql_query("INSERT INTO Grades Values('$user','')");
               echo "<p>UserID $user inserted into grades</p>";
            }
            $c7=$p_id>3;
            $c8=$p_id<13;
            $c9=$position_value>0;
            $c10=$position_value<4;
            $c11=$position_value==0;
            if (($c7&&$c8)&&(($c9&&$c10)||$c11))
            {
               mysql_query("DELETE FROM Grades WHERE UserID='$user'");
               echo "<p>UserID $user Deleted from grades</p>";
            }
            echo "<p>UserID $user Updated</p>";
          } 
     }
} /*
     
     if ($_POST["$pvalue_name"])
     {
         ?> <h1><?php echo "$pvalue_name"; ?>here</h1>
<?php
     }*/
  

?>
<?php 
    $query=mysql_query("SELECT * FROM Account_info a INNER JOIN Authorization b ON a.PositionID = b.PositionID ");
    $numrows=mysql_num_rows($query);
    ?>
       
        <h1> Active Users = <?php echo "$numrows"; ?> </h1>
<form action="admin_users.php" method="POST"> 
        <table>
            <tr>
                <th>UserID</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Position</th>
                <th>Delete</th>
                <th>Change Position</th>
                <th>New Position</th>


            </tr>
           <?php  while ($row=mysql_fetch_assoc ($query))  { ?>
            <tr>
                <?php 
                $userid= $row['UserID']; 
                $firstname= $row['FirstName'];
                $lastname= $row['LastName'];
                $position= $row['Position']; 
                echo "<td>$userid</td><td>$firstname</td><td>$lastname</td><td>$position</td>" ?>
                <td>
                         <input type="checkbox" name="d<?php echo $userid ?>" value="<?php echo $userid ?>">delete account<br>
                </td>
                <td>
                         <input type="checkbox" name="c<?php echo $userid ?>" value="<?php echo $userid ?>">change position<br>
                </td>
                <td>
                    <select name="<?php echo $userid ?>">
                       <?php  $query2=mysql_query("SELECT PositionID, Position FROM Authorization ");
                        while ($row2=mysql_fetch_assoc ($query2))  {
                            $value=$row2['PositionID'];
                            $label= $row2['Position'];
                        ?>
                        <option value="<?php echo $value ?>" <?= ($_POST["$userid"]=="$value") ? "selected": "";  ?> > <?php echo $label  ?> </option>
                        <?php  } ?>
                    </select>
                </td>
            </tr>
            <?php  } ?>

        </table> <?php ?>
<input type="submit" name="change" value="change" />
</form>