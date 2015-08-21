<?php
mysql_connect("192.232.249.164", "km310765_admin", "Aftermath2015") or die ("Couldn't connect!");
mysql_select_db("km310765_f2foxes") or die("Couldn't find db");
$delete=$_POST['delete'];
$submit=$_POST['mewvideo'];
if ($delete){
    $query=mysql_query("SELECT * FROM Videos");
    while ($row=mysql_fetch_assoc ($query))  { 
          $t_videoid=$row['VideoID'];  
          $temp=$_POST["$t_videoid"];
          if ($temp)
          {
              mysql_query("DELETE FROM Videos WHERE VideoID='$temp'")or die("Issue deleting video/videos");
          }
    }
}
if($submit)
{
    $title=$_POST['title'];
    $embededcode=$_POST['newvideo'];
    mysql_query("INSERT INTO Videos VALUES('','$title','$emebededcode')") or die("Issue inserting video");
}
?>
<h1>Videos from youtube</h1>
<form action="adminvideo.php" method="POST"> 
<table>
    <tr>
    <th>Video ID</th><th>Title</th><th>Video embeded link</th><th>delete button</th></tr>
<?php $query=mysql_query("SELECT * FROM Videos");
 while ($row=mysql_fetch_assoc ($query))  { 
    $videoid=$row['VideoID'];
    $t_title=$row['Title'];
    $code=$row['Embededcode']; ?>
    <tr>
        <td><?php echo $videoid ?></td>
        <td><?php echo $title ?></td>
        <td><?php echo $code ?></td>
        <td><input type="checkbox" name="<?php echo $code ?>" value="<?php echo $code ?>" /></td>
        
    </tr>
<?php } ?>
</table>
    <input type="submit" name="delete" value="delete selected">
</form><br><br><br><br>
<form action="adminvideo.php" method="POST">
<h1>Add Video</h1>
<p>
<label for="newvideo">Please copy and paste the embeded html code from youtube into this field</label>
<input type="text" id="newvideo" name="newvideo"  maxlength="300" /></p>
<p><label for="title">Film Title for future reference</label>
<input type="text" id="title" name="title"  maxlength="100" />
<input type="submit" name="insert" value="insert video"></p>
</form>



