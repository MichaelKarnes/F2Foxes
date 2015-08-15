<?php
$username=$_SESSION ['username'];
$userid=$_SESSION ['username'];
$connect=mysql_connect("192.232.249.164", "km310765_admin", "Aftermath2015") or die ("Couldn't connect!");
mysql_select_db("km310765_f2foxes") or die("Couldn't find db");
$date=date("Y-m-d");
?>
<!-- Main Wrapper -->
<div id="main-wrapper">
	<div class="wrapper style3">
		<div class="inner">
			<div class="container">
					<form >
            <table>
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
                <td><input type="submit"  value="Submit Changes"></td>
            </tr>
                <?php ?>
            <tr>
                <?php  ?>
                    <th> Currently signed out for</th>
                    <?php 
                        $query2=mysql_query("SELECT s.UserID, s.ReasonID, sa.Abreviation  FROM Signout s RIGHT OUTER JOIN SignoutActivity sa ON s.ActivityID=sa.ActivityID WHERE s.UserID='$userid' and s.Date='$date' ");
                        while ($row2=mysql_fetch_assoc($query2))  { 
                            $uid=$rows2['s.UserID'];
                            $rid=$rows2['s.ReasonID'];
                            $abrev=$rows2['sa.Abreviation'];
                            ?>
                             <td><?php echo $rid ?> </td>
                     <?php } 
                     ?>
                <?php 
                ?>
            </tr>
            <?php /* for ($i=0;$i<3;$i++){?>
    
                 <tr>
                
                    <th>user</th>
                     <?php for ($p=0;$p<$columns-1;$p++){?>
                        <td><img src="pagecontent/signout/reasonimages/class.png"  alt="auto" /></td>
                     <?php } ?>
                     
                </tr> */ ?>
            </table>
        </form>
			</div>
		</div>
	</div>
</div>
