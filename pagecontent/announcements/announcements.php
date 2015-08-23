<?php
$query=$db->query("SELECT AnnouncementID FROM Announcements ");
while ($row=mysqli_fetch_assoc ($query))  { 
    $t_annID=$row['AnnouncementID'];
    $delete=$_POST["$t_annID"];
    if($delete)
    {
        $db->query("DELETE FROM Announcements WHERE AnnouncementID='$t_annID'");
    }
}
if ($_SESSION['upperclassmen']==1){ 
?>
<h3 >Announcements</h3>
<p>
<a href="announcementsnew.php" class="button alt icon fa-file-o">New Announcement/Document</a></p>
<?php } ?>
<?php //a INNER JOIN Account_info b WHERE a.UserID=b.UserID FirstName, LastName,
    if ($_SESSION['upperclassmen'])
    {
        $query=$db->query("SELECT b.FirstName, b.LastName, a.Date, a.Body, a.Title, a.Link, a.UserID, a.AnnouncementID FROM Announcements a INNER JOIN Account_info b WHERE a.UserID=b.UserID");
    }
    else if ($_SESSION['student']){
        $query=$db->query("SELECT b.FirstName, b.LastName, a.Date, a.Body, a.Title, a.Link, a.UserID, a.AnnouncementID  FROM Announcements a INNER JOIN Account_info b WHERE a.UserID=b.UserID AND Upperclassmen='0' ");
    }
    else if ($_SESSION['username']){
        $query=$db->query("SSELECT b.FirstName, b.LastName, a.Date, a.Body, a.Title, a.Link, a.UserID, a.AnnouncementID  FROM Announcements a INNER JOIN Account_info b WHERE a.UserID=b.UserID AND Upperclassmen='0'AND Cadet='0' ORDER BY Date");
    }?>
    
    <?php while ($row=mysqli_fetch_assoc ($query))  { 
          $title=$row['Title'];  
          $body=$row['Body']; 
          $link=$row['Link']; 
          $firstname=$row['FirstName'];
          $lastname=$row['LastName'];
          $t_userID=$row['LastName'];
          $date=$row['Date'];
         $annID=$row['AnnouncementID']; ?>
           <hr noshade size="2"> 
          <form action="announcements.php" method="POST"><div >
          <h1 class="titleannouncement"><b>  <?php  echo $title ?></b></h1>
          <p class="individualannouncement"><b>Date added :</b> <?php echo $date ?> <b>Person Who added :</b> <?php echo "$lastname, $firstname" ?><br>
          <?php echo $body ?></p><p class="individualannouncement"><table class="table_announcement"><tr>
           <?php if ($row['Link']){ ?>
                <td><a href="<?php echo $link ?>" class="button alt icon fa-file-o" class="link">Link </a></td>
           <?php } 
           if ($_SESSION['userid']==$t_userID||$_SESSION['admin']==1){ ?>
              <td><p><input type="submit" name="<?php echo $annID; ?>" value="Delete"></p></td>
                <?php } ?>
            </tr></table>
            </div></form> 
           

    <?php    }
     ?>


