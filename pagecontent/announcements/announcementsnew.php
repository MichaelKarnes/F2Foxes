<?php
    $date=date('Y-m-d');
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
         $db->query("INSERT INTO Announcements Values('','$date','$userid','$title','$body','$link','$student','$upperclassmen','$all')") or die("could not create Announcement");
         echo "Announcement has been sent. Check the announcements tab to see it.";
    }

?>
<p>This page for adding an anouncement so that upperclassmen or just fish can see. If you are trying to only allow certain people to have access then please use a different method or make sure to do a secuity check to make sure that only the people who go to your link are already specified people.  </p>
<form action= "announcementsnew.php" method="POST"><!--method will have to be changed to post later on when we have a database set up-->
<!--first name--><p>
    <label for="title">Title</label>
    <input type="text" id="title" name="title"  maxlength="50" />
    </p>
    <p>
    <label for="body">Body (optional)</label>
    <input type="text" id="body" name="body"  maxlength="300" />
    </p>
    <p>
    <label for="link">Link (optional)</label>
    <input type="text" id="link" name="link"  maxlength="100" />
    </p>
    <p>
     <b>Who Can view</b>
    <label for="rights">Cadet(includes upperclassmen)</label>
    <input type="checkbox" id="rights" name="rights" value="student"/>
    <label for="rights">Upperclassmen</label>
    <input type="checkbox" id="rights" name="rights" value="upperclassmen"/>
    <label for="rights">All(inlcuding parents and old foxes and Cadets)</label>
    <input type="checkbox" id="rights" name="rights" value="all"/>
    </p>
    <input type="submit" name="newannounce" value="submit announcement">
</form>