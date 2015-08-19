<?php $connect=mysql_connect("192.232.249.164", "km310765_admin", "Aftermath2015") or die ("Couldn't connect!");
mysql_select_db("km310765_f2foxes") or die("Couldn't find db");
$query5=mysql_query("SELECT Image,ReasonID FROM SignoutReason ORDER BY ReasonID ");
$reasons=array();
while ($row5=mysql_fetch_assoc ($query5))  {  
    $reasonid=$row5['Image'];
    array_push($reasons, "$reasonid");
}
$date = date('Y-m-d', strtotime('previous monday'));
echo $date;
$submit2=$_POST['signoutchange'];
$submit1=$_POST['information'];
if($submit2 ){
    $query6=mysql_query("SELECT UserID FROM Account_info WHERE PositionID BETWEEN 4 AND 13 ORDER BY LastName" );
    $t_act=$_SESSION['signalcheck'];
    while ($row6=mysql_fetch_assoc ($query6))  {
        $temp1_id=$row6['UserID'];
        $acc=strip_tags($_POST["$temp1_id"]);
        echo "$acc";
        mysql_query("DELETE FROM SignoutCheck WHERE UserID='$temp1_id' AND Date='$date' AND ActivityID='$t_act'") or die ("error");
        if($acc=="accountedfor"){
            mysql_query("INSERT INTO SignoutCheck VALUES('$date','$temp1_id','$t_act','1')") or die ("dead");
            echo "here";
        }
        else if ($acc="absent") {
            mysql_query("INSERT INTO SignoutCheck VALUES('$date','$temp1_id','$t_act','')") or die ("dead");
            echo "here1";
        }
    }
    
}

?>
<form action="signal.php" method="POST"><table class="selectsignout">
    <tr>
    <th>Signal Chain Signout Check</th>
   <td><select name="activity">
<?php
$query1=mysql_query("SELECT * FROM SignoutActivity ");
        while ($row1=mysql_fetch_assoc($query1))  { 
                $act=$row1['Abreviation'];
                $actID=$row1['ActivityID']; ?>
                <option value="<?php echo $actID ?>"><?php echo "$act"; ?>
                </option>
        <?php       } ?>
    </select></td>
        <td><input type="submit" name="information" value="Get Information"></td>
    </tr>
    </table>
</form>
<?php
    if ($submit1){
        $t_act=$_POST['activity'];
        $_SESSION['signalcheck']=$t_act; ?>
        
        <form action="signal.php" method="POST"><table  class="signal"><tr class="signoutadmin">
        <th >Cadet Name</th>
        <th><?php echo $t_act ?></th>
        <th>Accounted For</th>
        </tr>
        <?php
        $query3=mysql_query("SELECT * FROM Account_info WHERE PositionID BETWEEN 4 AND 13 ORDER BY LastName" );
        while ($rows3=mysql_fetch_assoc($query3))  { 
            $temp_ul=$rows3['LastName'];
            $temp_uf=$rows3['FirstName'];
            $temp_id=$rows3['UserID']; ?>
            <tr class="reason_hover" class="signoutadmin"> <th><?php echo "$temp_ul, $temp_uf"; ?></th> <?php
                    $query4=mysql_query("SELECT Date, UserID, ReasonID, Text FROM  (SELECT * FROM Signout WHERE UserID='$temp_id' AND Date='$date' AND ActivityID='$t_act') 
                    AS a RIGHT OUTER JOIN SignoutActivity ON a.ActivityID=SignoutActivity.ActivityID WHERE SignoutActivity.ActivityID='$t_act' ");
                    while ($rows4=mysql_fetch_assoc($query4))  { 
                        $tuid=$rows4['UserID'];
                        $trid=$rows4['ReasonID'];
                        if ($trid) { 
                            $tid=$trid+1;
                            $query8=mysql_query("SELECT Reason FROM SignoutReason WHERE ReasonID='$tid'");
                            $row8=mysql_fetch_assoc($query8);
                            $t_text=$row8['Reason']; 
                            $intext=$rows4['Text']; 
                            ?>
                            <td ><a class="test_hover"><img src="pagecontent/signout/reasonimages/<?php echo $reasons[$trid] ?>"  alt="auto" />
                            <?php if ($intext){ ?> <div><?php echo $intext; ?> </div> <?php }
                                        else { ?> <div> <?php echo $t_text; ?> </div> <?php } ?>
                            </a> </td>
                        <?php }
                        else { ?>
                            <td> 
                        <?php } 
                    } 
                    ?>
                <td class="radio-toolbar">
                    <input type="radio" name="<?php echo $temp_id ?>" value="accountedfor">
                    <label for="radio1">Good</label>
                    <input type="radio" name="<?php echo $temp_id ?>" value="absent" Checked>
                    <label for="radio1">Not Good</label></td>

                    </tr><?php        } ?> 
            <tr>
            <td><input type="submit" name="signoutchange" value="Submit accountablity"></tr>
</table></form>
<?php } ?>