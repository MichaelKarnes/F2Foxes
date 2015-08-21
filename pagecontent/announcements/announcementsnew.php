<?php
     mysql_connect("192.232.249.164", "km310765_admin", "Aftermath2015") or die ("Couldn't connect!");
    mysql_select_db("km310765_f2foxes") or die("Couldn't find db");
    $date=date('Y-m-y');
    $userid=$_SESSION ['userid'];
    $submit=$_POST['newannounce'];
    if($submit){
        $title=$_POST['title'];
        $body=$_POST['body'];
        $link=$_POST['link'];
        $rights=$_POST['rights'];
        if ($rights=="student")
        {
            $student=1;
            $upperclassmen=1;
            $all=0;
        }
        else if  ($rights=="upperclassmen")
        {
            $student=0;
            $upperclassmen=1;
            $all=0;
        }
        else
        {
            $student=0;
            $upperclassmen=1;
            $all=0;
        }
         mysql_query("INSERT INTO Announcements Values('','$date','$userid','$title','$body','$link','$student','$upperclassmen','$all')") or die("could not create Announcement");
    }

?>
<form action= "announcementsnew.php" method="POST"><!--method will have to be changed to post later on when we have a database set up-->
<!--first name--><p>
    <label for="title">Title</label>
    <input type="text" id="title" name="title"  maxlength="50" />
    </p>
    <p>
    <label for="body">Body</label>
    <input type="text" id="body" name="body"  maxlength="300" />
    </p>
    <p>
    <label for="link">Link</label>
    <input type="text" id="link" name="link"  maxlength="100" />
    </p>
    <p>
     Who Can view
    <label for="rights">Cadet</label>
    <input type="checkbox" id="rights" name="rights" value="student"/>
    <label for="rights">Upperclassmen</label>
    <input type="checkbox" id="rights" name="rights" value="upperclassmen"/>
    <label for="rights">All(inlcuding parents and old foxes)</label>
    <input type="checkbox" id="rights" name="rights" value="all"/>
    </p>
    <input type="submit" name="newannounce" value="submit announcement">
</form>