<?php 
$username=$_SESSION ['username'];
$userid=$_SESSION ['userid'];
$connect=mysql_connect("192.232.249.164", "km310765_admin", "Aftermath2015") or die ("Couldn't connect!");
mysql_select_db("km310765_f2foxes") or die("Couldn't find db");
$query5=mysql_query("SELECT Image,ReasonID FROM SignoutReason ORDER BY ReasonID ");
$reasons=array();
while ($row5=mysql_fetch_assoc ($query5))  {  
    $reasonid=$row5['Image'];
    array_push($reasons, "$reasonid");
}
$d=$_SESSION['Week'];
$s="-";
$date=$d[6].$d[7].$d[8].$d[9].$s.$d[0].$d[1].$s.$d[3].$d[4];
$submit=$_POST['signout'];
$a="activity";
if ($submit)
{   
    $query7=mysql_query("SELECT ActivityID FROM SignoutActivity");
    while ($row7=mysql_fetch_assoc($query7))  { 
        $t_actID=$row7['ActivityID'];
        $act=$a.$t_actID;
        $t_aid=strip_tags($_POST["$act"]);
        if($t_aid)
        {   
             //$t_aid=$_SESSION ["$t_actID"];
             if ($_POST['c_reason'])
             {
                 $t_rid=strip_tags($_POST['c_reason']);
                  mysql_query("DELETE FROM Signout WHERE UserID='$userid' AND Date='$date' AND ActivityID='$t_aid'") or die ("error");
                  mysql_query("INSERT INTO Signout VALUES('$date','$userid','$t_rid','$t_aid')") or die ("dead");
             }
        }
    } /*
    for ($i=0;$i<sizeof($array2);$i++)
    {
        $temp_id=$array2[$i];
        mysql_query("DELETE FROM Signout WHERE UserID='$userid' AND Date='$date' AND ReasonID='$temp'");
        mysql_query("INSERT INTO Signout VALUES('','$date','$userid','$ActivityID',')");
    }*/
    $query6=mysql_query("SELECT Date, UserID, ReasonID FROM  (SELECT * FROM Signout WHERE UserID='$userid' AND Date='$date') 
    AS a RIGHT OUTER JOIN SignoutActivity ON a.ActivityID=SignoutActivity.ActivityID ");
    while ($rows6=mysql_fetch_assoc ($query3))
    {
        $tuid=$rows6['UserID'];
        $trid=$rows6['ReasonID'];
    }
}
//echo "$date";
?>
<br><h1>week of <?php echo $date ?>
<li ><a href="lastweek.php"> &larr;Previous Week</a></li>
<li ><a href="nextweek.php"> Next Week&rarr;</a></li></h1>
<form action="signoutsheet.php" method="POST">
<table class="styled_select">
    <tr>
    <th id="blank"> </th>
    <th colspan="4"id="days">Mon </th>
    <th colspan="3"id="days">Tue</th>
    <th colspan="2"id="days">Wed </th>
    <th colspan="3"id="days">Thur </th>
    <th colspan="3"id="days">Fri </th>
    <th>CM </th>     
</tr>
<tr>
    <?php 
        $abre=array('Cadet','MA','BRC','AA','SRC','MA','BRC','SRC','MA','BRC','MA','BRC','SRC','MA','BRC','AA','CM');
        $columns=count($abre);
        for ($i=0;$i<$columns;$i++) {
            echo'<th>'.$abre[$i].'</th>';
        }
    ?>
    <th colspan="2">New Signout</th>
</tr>
<tr > <form action="signoutsheet.php" method="POST">
    <th><?php echo "$username"?></th>
    <?php 
        $query=mysql_query("SELECT * FROM SignoutActivity  ");
                    
    while ($row=mysql_fetch_assoc ($query))  {  
            $name=$row['ActivityID']; 
            $t_name=$a.$name ?>
            
            <td><input type="checkbox" name="<?php echo $t_name ?>" value="<?php echo $name; ?>"></td>
    <?php } ?>
    <td  >
        <select name="c_reason">
            <option value="0">
            </option>
        <?php  $query1=mysql_query("SELECT * FROM SignoutReason ");
        while ($row1=mysql_fetch_assoc($query1))  { 
                $reas=$row1['Reason'];
                $reasID=$row1['ReasonID']-1; ?>
                <option value="<?php echo $reasID ?>"><?php echo "$reas"; ?>
                </option>
            <?php } 
            ?>
            </select>
    </td>
    <td><input type="submit" name="signout" value="Submit Changes"></td>
</tr>
               
<tr>
    <td>Current Signout</td>
<?php //Signout.Date='$date'OR Signout.Date IS NULLWHERE  Signout.UserID = '$userid' OR Signout.Date IS NULL
        $query2=mysql_query("SELECT Date, UserID, ReasonID, Abreviation  FROM  (SELECT * FROM Signout WHERE UserID='$userid'AND Date='$date') AS a RIGHT OUTER JOIN SignoutActivity  
        ON a.ActivityID=SignoutActivity.ActivityID ");
            while ($rows2=mysql_fetch_assoc($query2))  { 
                $uid=$rows2['UserID'];
                $rid=$rows2['ReasonID'];
                $abrev=$rows2['Abreviation']; 
                            
                if ($rid) {?>
                <td><img src="pagecontent/signout/reasonimages/<?php echo $reasons[$rid] ?>"  alt="auto" /> </td>
                    <?php }
                else { ?>
                    <td> </td>
                <?php }
            }?>
    </tr>
           <?php
            $query3=mysql_query("SELECT * FROM Account_info WHERE PositionID BETWEEN 4 AND 13 ORDER BY LastName" );
            while ($rows3=mysql_fetch_assoc($query3))  { 
                $temp_ul=$rows3['LastName'];
                $temp_uf=$rows3['FirstName'];
                $temp_id=$rows3['UserID']; ?>
                <tr> <th><?php echo "$temp_ul, $temp_uf"; ?></th> <?php
                       $query4=mysql_query("SELECT Date, UserID, ReasonID FROM  (SELECT * FROM Signout WHERE UserID='$temp_id'AND Date='$date') 
                       AS a RIGHT OUTER JOIN SignoutActivity ON a.ActivityID=SignoutActivity.ActivityID ");
                       while ($rows4=mysql_fetch_assoc($query4))  { 
                           $tuid=$rows4['UserID'];
                           $trid=$rows4['ReasonID'];
                           if ($trid) { ?>
                           <td><img src="pagecontent/signout/reasonimages/<?php echo $reasons[$trid] ?>"  alt="auto" /> </td>
                                <?php }
                           else { ?>
                                <td> </td>
                            <?php } 
                        } 
                        ?>
                        </tr>  <?php
                     }
?>
</tr> 
</table>
</form>