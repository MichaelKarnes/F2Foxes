<?php
    

?>
<form action= "announcementsadmin.php" method="POST"><!--method will have to be changed to post later on when we have a database set up-->
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
    <label for="studnet">Student</label>
    <input type="checkbox" id="student" name="student" />
    <label for="studnet">Upperclassmen</label>
    <input type="checkbox" id="student" name="student" />
    <label for="studnet">All(inlcuding parents and old foxes)</label>
    <input type="checkbox" id="student" name="student" />
    </p>
</form>