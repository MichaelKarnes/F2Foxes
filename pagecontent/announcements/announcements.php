<?php
    mysql_connect("192.232.249.164", "km310765_admin", "Aftermath2015") or die ("Couldn't connect!");
    mysql_select_db("km310765_f2foxes") or die("Couldn't find db");
 if ($_SESSION['upperclassmen']==1){ 
?>
<h3 >Announcements</h3>
<p>
<a href="announcementsnew.php" class="button alt icon fa-file-o">New Announcement/Document</a></p>
<?php } ?>
<?php //a INNER JOIN Account_info b WHERE a.UserID=b.UserID FirstName, LastName,
    if ($_SESSION['upperclassmen'])
    {
        $query=mysql_query("SELECT b.FirstName, b.LastName, a.Date, a.Body, a.Title, a.Link, a.UserID FROM Announcements a INNER JOIN Account_info b WHERE a.UserID=b.UserID");
    }
    else if ($_SESSION['student']){
        $query=mysql_query("SELECT b.FirstName, b.LastName, a.Date, a.Body, a.Title, a.Link, a.UserID FROM Announcements a INNER JOIN Account_info b WHERE a.UserID=b.UserID AND Upperclassmen='0' ");
    }
    else if ($_SESSION['username']){
        $query=mysql_query("SSELECT b.FirstName, b.LastName, a.Date, a.Body, a.Title, a.Link, a.UserID FROM Announcements a INNER JOIN Account_info b WHERE a.UserID=b.UserID AND Upperclassmen='0'AND Cadet='0' ORDER BY Date");
    }
    while ($row=mysql_fetch_assoc ($query))  { 
          $title=$row['Title'];  
          $body=$row['Body']; 
          $link=$row['Link']; 
          $firstname=$row['FirstName'];
          $lastname=$row['LastName'];
          $t_userID=$row['LastName'];
          $date=$row['Date'];  ?>
          <form action="announcements.php" method="POST"><div >
          <p class="titleannouncement"><b>  <?php  echo $title ?></b></p>
          <p class="individualannouncement"><b>Date added :</b> <?php echo $date ?> <b>Person Who added :</b> <?php echo "$lastname, $firstname" ?><br>
          <?php echo $body ?></p><p class="individualannouncement"><table class="table_announcement"><tr>
           <?php if ($row['Link']){ ?>
                <td><a href="<?php echo $link ?>" class="button alt icon fa-file-o" class="link">Link</a></td>
           <?php } 
           if ($_SESSION['userid']==$t_userID||$_SESSION['admin']==1){ ?>
                <td><p><label for="delete">Delete</label>
                    <input type="checkbox" name="delete" value="<?php echo $userid ?>"></td></p>
              <td><input type="submit" name="delete_s" value="delete announcement"></td>
                <?php } ?>
              </tr></table>
            </div></form>
           

    <?php    } ?>


