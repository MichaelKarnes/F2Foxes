<?php 
$username=$_SESSION ['username'];
$userid=$_SESSION ['userid'];
$query5=$db->query("SELECT * FROM SignoutReason ORDER BY ReasonID ");
$imagearray=array();
$reasons=array();
$reasonsid=array();
while ($row5=mysqli_fetch_assoc ($query5))  {  
    $image=$row5['Image'];
    $reason=$row5['Reason'];
    $reasonid=$row5['ReasonID'];
    array_push($imagearray, "$image");
    array_push($reasons, "$reason");
    array_push($reasonsid, "$reasonid");
}
$d=$_SESSION['Week'];
$current_week=date('w') == 1 ? date('m/d/Y') : date('m/d/Y', strtotime('previous monday'));
$s="-";
$date=$d[6].$d[7].$d[8].$d[9].$s.$d[0].$d[1].$s.$d[3].$d[4];
$submit=$_POST['signout'];
$delete=$_POST['delete'];
$a="activity";
if ($delete)
{
     $query7=$db->query("SELECT ActivityID FROM SignoutActivity");
     while ($row7=mysqli_fetch_assoc($query7))  { 
        $t_actID=$row7['ActivityID'];
        $act=$a.$t_actID;
        $t_aid=strip_tags($_POST["$act"]);
        if($t_aid)
        {
            $db->query("DELETE FROM Signout WHERE UserID='$userid' AND Date='$date' AND ActivityID='$t_aid'") or die ("error");
        }
     }
}
 if ($submit)
{   
    $query7=$db->query("SELECT ActivityID FROM SignoutActivity");
    while ($row7=mysqli_fetch_assoc($query7))  { 
        $t_actID=$row7['ActivityID'];
        $act=$a.$t_actID;
        $t_aid=strip_tags($_POST["$act"]);
        if($t_aid)
        {   

             //$t_aid=$_SESSION ["$t_actID"];
             if($_POST['text_input'])
             {
                 $db->query("DELETE FROM Signout WHERE UserID='$userid' AND Date='$date' AND ActivityID='$t_aid'") or die ("error");
                 $t_text=strip_tags($_POST['text_input']);
                 $db->query("INSERT INTO Signout VALUES('$date','$userid','20','$t_aid','$t_text','1')") or die ("dead");
             }
             else if  ($_POST['c_reason'])
             {
                 $t_rid=strip_tags($_POST['c_reason']);
                 $db->query("DELETE FROM Signout WHERE UserID='$userid' AND Date='$date' AND ActivityID='$t_aid'") or die ("error");
                 $db->query("INSERT INTO Signout VALUES('$date','$userid','$t_rid','$t_aid','','1')") or die ("dead");
             }
        }
    } 
} ?>
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
    <th colspan="2">New Signout</th> 
</tr>
<tr>
    <?php 
        $abre=array('Cadet','MA','BRC','AA','SRC','MA','BRC','SRC','MA','BRC','MA','BRC','SRC','MA','BRC','AA','CM');
        $columns=count($abre);
        for ($i=0;$i<$columns;$i++) {
            echo'<th>'.$abre[$i].'</th>';
        }
    ?>
    <td colspan="2"><input type="submit" name="delete" value="Remove Selected"></td>
</tr>
    <?php  if ($_SESSION['Week']>=$current_week){  ?>
<tr > <form action="signoutsheet.php" method="POST">
    <th><?php echo "$username"?></th>
    <?php 
        $query=$db->query("SELECT * FROM SignoutActivity  ");
                    
    while ($row=mysqli_fetch_assoc ($query))  {  
            $name=$row['ActivityID']; 
            $t_name=$a.$name; 
            $queryc=$db->query("SELECT * FROM SignoutCheck WHERE Date='$date' AND ActivityID='$name'");
            $countc= mysqli_num_rows($queryc);
            if ($countc==0) { ?>
            
            <td><input type="checkbox" name="<?php echo $t_name ?>" value="<?php echo $name; ?>"></td>
            <?php  } else { ?> <td> </td> <?php  } ?>
    <?php } ?>
    <td  >
        <select name="c_reason">
            <option value="0">
            </option>
        <?php  /*$query1=mysql_query("SELECT * FROM SignoutReason ");
        while ($row1=mysql_fetch_assoc($query1))  { 
                $reas=$row1['Reason'];
                $reasID=$row1['ReasonID']-1; */
                
                for ($i=0;$i<sizeof($reasons);++$i){ 
                   $temp1= $reasonsid["$i"];
                   $temp2=$reasons["$i"];
                   if ($temp2!="Text"){ ?>
                        <option value="<?php echo "$temp1" ?>"><?php echo "$temp2"; ?>
                        </option>
                    <?php  }
                 } ?>
            </select>
    </td>
    <td><input type="submit" name="signout" value="Submit Changes"></td>
</tr>
               
<tr>
    <td>Current Signout</td>
<?php //Signout.Date='$date'OR Signout.Date IS NULLWHERE  Signout.UserID = '$userid' OR Signout.Date IS NULL
        $query2=$db->query("SELECT Date, UserID, ReasonID, Abreviation,Text  FROM  (SELECT * FROM Signout WHERE UserID='$userid'AND Date='$date') AS a RIGHT OUTER JOIN SignoutActivity  
        ON a.ActivityID=SignoutActivity.ActivityID ");
            while ($rows2=mysqli_fetch_assoc($query2))  { 
                $uid=$rows2['UserID'];
                $rid=$rows2['ReasonID'];
                $abrev=$rows2['Abreviation']; 
                            
                if ($rid>1) { 
                                 $rid-=1;/*
                               $query8=mysql_query("SELECT Reason FROM SignoutReason WHERE ReasonID='$tid'");
                               $row8=mysql_fetch_assoc($query8);
                               $t_text=$row8['Reason']; */
                               $intext=$rows2['Text']; 
                               $t_text=$reasons["$rid"];
                                ?>
                               <td ><a class="test_hover"><img src="pagecontent/signout/reasonimages/<?php echo $imagearray[$rid] ?>"  alt="auto" />
                                <?php if ($intext){ ?> <div><?php echo $intext; ?> </div> <?php }
                                            else { ?> <div> <?php echo $t_text; ?> </div> <?php } ?>
                                </a> </td>
                           <?php }
                           else { ?>
                                <td> </td>
                            <?php } 
                        } 
                        ?>
    <th>If Text</th><td><input type="text" name="text_input" maxlength="50" ></td>
    </tr >
    <?php  } ?>
           <?php
            $query3=$db->query("SELECT * FROM Account_info WHERE PositionID BETWEEN 4 AND 15 ORDER BY LastName" );
            while ($rows3=mysqli_fetch_assoc($query3))  { 
                $temp_ul=$rows3['LastName'];
                $temp_uf=$rows3['FirstName'];
                $temp_id=$rows3['UserID']; 
                $t_first_letter=$temp_uf['0'];?>
                <tr class="reason_hover"> <th ><b><?php echo "$temp_ul, $t_first_letter"; ?></b></th> <?php
                       $query4=$db->query("SELECT Date, UserID, ReasonID, Text, AccountedFor FROM  (SELECT * FROM Signout WHERE UserID='$temp_id'AND Date='$date') 
                       AS a RIGHT OUTER JOIN SignoutActivity ON a.ActivityID=SignoutActivity.ActivityID ");
                       while ($rows4=mysqli_fetch_assoc($query4))  { 
                           $tuid=$rows4['UserID'];
                           $trid=$rows4['ReasonID'];
                            $check=$rows4['AccountedFor'];
                           if ($trid>1) { 
                                $trid-=1;/*
                               $query8=mysql_query("SELECT Reason FROM SignoutReason WHERE ReasonID='$tid'");
                               $row8=mysql_fetch_assoc($query8);
                               $t_text=$row8['Reason']; */
                               $intext=$rows4['Text']; 
                               $t_text=$reasons["$trid"];
                                ?>
                               <td ><a class="signout_hover"><img src="pagecontent/signout/reasonimages/<?php echo $imagearray[$trid] ?>"  alt="auto" />
                                <?php if ($intext){ ?> <div><?php echo $intext; ?> </div> <?php }
                                            else { ?> <div> <?php echo $t_text; ?> </div> <?php } 
 ?>
                                </a>
                           <?php }
                           else { ?><td>
                                
                            <?php } ?>
                          <?php  if ($check=='3') { ?> <a style="position: relative; left: 0; top: 0;" ><img src="pagecontent/signout/reasonimages/check.png"  alt="auto" /></a>
                                    <?php  }
                              if ($check=='2') { ?> <a style="position: relative; left: 0; top: 0;"><img  src="pagecontent/signout/reasonimages/x.png"  alt="auto" /></a>
                                    <?php  }
                                    ?>
                            </td>
                        <?php } 
                        ?>
                        </tr>  <?php
                     }
?>
</tr> 
</table>
</form>