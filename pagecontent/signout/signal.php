<?php
$query5=$db->query("SELECT Image,ReasonID FROM SignoutReason ORDER BY ReasonID ");
$reasons=array();
while ($row5=mysqli_fetch_assoc ($query5))  {  
    $reasonid=$row5['Image'];
    array_push($reasons, "$reasonid");
}
$date = date('w') == 1 ? date('Y-m-d') : date('Y-m-d', strtotime('previous monday'));
echo $date;
$submit2=$_POST['signoutchange'];
$submit1=$_POST['information'];
if($submit2 ){
    $t_act=$_SESSION['signalcheck'];
    $db->query("DELETE FROM SignoutCheck WHERE Date='$date' AND ActivityID='$t_act'")or die("Could not delete from Grades");
    $db->query("INSERT INTO SignoutCheck Values('$date','$t_act')");
    $query6=$db->query("SELECT UserID FROM Account_info WHERE PositionID BETWEEN 4 AND 14");
    while ($row6=mysqli_fetch_assoc ($query6))  {
        $temp1_id=$row6['UserID'];
        $acc=strip_tags($_POST["$temp1_id"]);
        $query8=$db->query("SELECT UserID FROM Signout WHERE Userid='$temp1_id'AND Date='$date'AND ActivityID='$t_act'");
        $count8= mysqli_num_rows($query8);
        if (!($count8))
        {
            $db->query("INSERT INTO Signout VALUES('$date','$temp1_id','1','$t_act','','1')") or die ("dead");
        }
        if($acc=="accountedfor"){
            $db->query("UPDATE  Signout SET AccountedFor='3'WHERE UserID='$temp1_id'AND Date='$date' AND ActivityID='$t_act' ") or die ("Could not update Account");
            
        }
        else if ($acc="absent") {
            $db->query("UPDATE  Signout SET AccountedFor='2' WHERE UserID='$temp1_id'AND Date='$date' AND ActivityID='$t_act'") or die ("Could not update Account");
        }
    }
    
}

?>
<form action="signal.php" method="POST"><table class="selectsignout">
    <tr>
    <th>Signal Chain Signout Check</th>
   <td><select name="activity">
<?php
$query1=$db->query("SELECT * FROM SignoutActivity ");
        while ($row1=mysqli_fetch_assoc($query1))  { 
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
        $query3=$db->query("SELECT * FROM Account_info WHERE PositionID BETWEEN 4 AND 14 ORDER BY LastName" );
        while ($rows3=mysqli_fetch_assoc($query3))  { 
            $temp_ul=$rows3['LastName'];
            $temp_uf=$rows3['FirstName'];
            $temp_id=$rows3['UserID']; ?>
            <tr class="reason_hover" class="signoutadmin"> <th><?php echo "$temp_ul, $temp_uf"; ?></th> <?php
                    $query4=$db->query("SELECT Date, UserID, ReasonID, Text, AccountedFor FROM  (SELECT * FROM Signout WHERE UserID='$temp_id' AND Date='$date' AND ActivityID='$t_act') 
                    AS a RIGHT OUTER JOIN SignoutActivity ON a.ActivityID=SignoutActivity.ActivityID WHERE SignoutActivity.ActivityID='$t_act' ");
                    while ($rows4=mysqli_fetch_assoc($query4))  { 
                        $tuid=$rows4['UserID'];
                        $trid=$rows4['ReasonID']-1;
                        $account=$rows4['AccountedFor'];
                        //$roll=$rows4['AccountedFor'];
                        if ($trid>0) { 
                            $tid=$trid;
                            $query8=$db->query("SELECT Reason FROM SignoutReason WHERE ReasonID='$tid'");
                            $row8=mysqli_fetch_assoc($query8);
                            $t_text=$row8['Reason']; 
                            $intext=$rows4['Text']; 
                            ?>
                            <td ><a class="test_hover"><img src="pagecontent/signout/reasonimages/<?php echo $reasons[$trid] ?>"  alt="auto" />
                            <?php if ($intext){ ?> <div><?php echo $intext; ?> </div> <?php }
                                  else { ?> <div> <?php echo $t_text; ?> </div> <?php } 
                                  /*if($roll=="11"){ ?> <img src="pagecontent/signout/reasonimages/check.png"  alt="auto" /> <?php }
                                  else if ($roll=="01") { ?> <img src="pagecontent/signout/reasonimages/X.png"  alt="auto" /> <?php } */
                                  ?>
                            </a> </td>
                        <?php }
                        else if($trid==1){ 
                             ?>
                            <td> </td>
                        <?php } 
                        else { 
                             ?>
                            <td> </td>
                        <?php } 
                     
                    ?>
                <td class="radio-toolbar">
                    <input type="radio" name="<?php echo $temp_id ?>" value="accountedfor"<?php if($account==3){ echo "Checked";} ?>>
                    <label for="<?php echo $temp_id ?>">Good</label>
                    <input type="radio" name="<?php echo $temp_id ?>" value="absent" <?php if($account!=3){ echo "Checked";} ?>>
                    <label for="<?php echo $temp_id ?>">Not Good</label></td>

                    </tr><?php        } } ?> 
            <tr>
            <td><input type="submit" name="signoutchange" value="Submit accountablity"></tr>
</table></form>
<?php } ?>