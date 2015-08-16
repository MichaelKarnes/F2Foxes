<?php
$username=$_SESSION ['username'];
$userid=$_SESSION ['userid'];
$connect=mysql_connect("192.232.249.164", "km310765_admin", "Aftermath2015") or die ("Couldn't connect!");
mysql_select_db("km310765_f2foxes") or die("Couldn't find db");
$query3=mysql_query("SELECT Image,ReasonID FROM SignoutReason ORDER BY ReasonID ");
$reasons=array();
while ($row3=mysql_fetch_assoc ($query3))  {  
    $resonid=$rows3['Image'];
    array_push($reasons,"$reasonid");

}
$date=date("Y-m-d");
?>
<!-- Main Wrapper --><table>
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
            </tr>
            <tr > 
                <th><?php echo "$username"?></th>
                <?php
                    $query=mysql_query("SELECT * FROM SignoutActivity  ");
                    
                   while ($row=mysql_fetch_assoc ($query))  {  
                       $name=$row['Abreviation']; ?>
                        <td>
                            <select name="<?php echo $name ?>">
                            <option value="0">
                                        </option>
                            <?php  $query1=mysql_query("SELECT * FROM SignoutReason ");
                            while ($row1=mysql_fetch_assoc($query1))  { 
                                    $reas=$row1['Reason'];
                                    $reasID=$row1['Reason']; ?>
                                        <option value="<?php echo $reasID ?>"><?php echo "$reasID"; ?>
                                        </option>
                             <?php } 
                             ?>
                          </select>
                        </td>
                   <?php }
                      ?>
                <td><?php<input type="submit"  value="Submit Changes"></td>?>
            </tr>
                <?php 
                ?>
            <tr>
        <?php
                    $query2=mysql_query("SELECT Date, UserID, ReasonID, Abreviation  FROM  Signout RIGHT OUTER JOIN SignoutActivity  
                    ON Signout.ActivityID=SignoutActivity.ActivityID WHERE (Signout.Date='$date' AND Signout.UserID=$userid) OR Signout.Date IS NULL");//WHERE Signout.UserID IS NULL
                        while ($rows2=mysql_fetch_assoc($query2))  { 
                            $uid=$rows2['UserID'];
                            $rid=$rows2['ReasonID'];
                            $abrev=$rows2['Abreviation'];
                            echo "<td>$abrev $uid $rid</td>";
                        }
          ?>
            </tr></table>
        
                <h1>howdy</h1>
<h1>howdy</h1>