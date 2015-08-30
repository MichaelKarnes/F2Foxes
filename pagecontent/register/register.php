
<?php
echo"<h1> Register</h1>"; 
$submit=$_POST['submit'];
//form data
$firstname=strip_tags($_POST['firstname']);
$lastname=strip_tags($_POST['lastname']);
$username=strip_tags($_POST['username']);
$password=strip_tags($_POST['password']);
$passcheck=strip_tags($_POST['passcheck']);
$position=strip_tags($_POST['position']);
$email=strip_tags($_POST['email']);
$tamu=strip_tags($_POST['tamu']);
$phone=strip_tags($_POST['phone']);
$date=date("Y-m-d");
if ($submit)//beginning of submit
{    
    $query=$db->query("SELECT a.Username, r.Username FROM  Authentication a, Registration r WHERE a.Username='$username' OR r.Username='$username'");
    $count= mysqli_num_rows($query);//checks to see if there is a row with that username returns 1 if there is
           
    //check that all blocks ared filled out
    if($firstname &&$lastname && $username && $password && $passcheck &&$email&&$phone)
    {    
        if($count==0)
        {
            if ($password==$passcheck)
            {
                // check char length of username and fullname
                if(strlen($username)>25||strlen($firstname)>25)
                {
                    echo "Max limit for username/firstname are 25 characters";
                }
                else
                {
                    if (strlen($password)>25|| strlen($password)<6)
                    {
                        echo "Password must be between 6 and 25 characters";
                    }
                    else
                    {
                        //register the user
                        //encrypt password
                        $password=md5($password);
                        $passcheck=md5($passcheck );

                        $queryreg=$db->query("INSERT INTO Registration VALUES ('$date','','$firstname','$lastname','','','$username','$password','$phone','$email','$tamu','','','','')");
                        //order of insert is (date, UserID(leave blank), firstname, lastname, position,class year,username, password, phone, email, address, state, zip, county
                        die("You have been registered! Please Wait for an Admin to activate your Account. <a href='index.php'>Return to the home page</a>");
                    }
                }
            }//end of password check
            else
                echo "You're passwords do not match";
        }//end of count==0 check
        else 
            echo "Username is already taken";
    }//end of checking that all blocks full
   
    else
    echo "Please fill in <b>all</b> fields";
      
}//end of submit
//echo md5("alex");// shows how to turn a file into md5
?>
    <!--Prevents Mobile Nav Bar From covering up content-->
<h1>Please fill out the form below and hit "Submit" to register for an account</h1>
<form action= "register.php" method="POST"><!--method will have to be changed to post later on when we have a database set up-->
<!--first name--><p>
    <label for="firstname">First Name</label>
    <input type="text" id="firstname" name="firstname" value="<?php echo $firstname?>" maxlength="20" />
    </p>
<!--Last name--> <p>
    <label for="lastname">Last Name</label>
    <input type="text" id="lastname" name="lastname" value="<?php echo $lastname?>" maxlength="20" />
    </p>
    <!--Status-- suggested not what will actually be the admin will decide -->
    <p>
    <?php 
     $i=0;
    ?>
    <label for="status">What is your classification?</label>
       <select name="position">
           <option value="0"></option> <?php
        $query=$db->query("SELECT Position FROM  Authorization ORDER BY Position");
        
        while($row=mysqli_fetch_assoc ($query)){ 
           $poss=$row['Position']; ?>
           <option value="<?php echo $poss ?>"><?php echo $poss ?></option>
        <?php }  ?>
      </select>
    </p>
    <!--Email--><p>
    <label for="email">Current email</label>
    <input type="email" id="email" name="email" value="<?php echo $email ?>" maxlength="50" />
    </p>
    <p>
    <label for="tamu">Tamu email(for students only)</label>
    <input type="email" id="tamu" name="tamu" value="<?php echo $tamu ?>" maxlength="50" />
    </p>
    <!--Phone--><p>
    <label for="phone">Phone number we can reach you at (please enter in 1222323232 format)</label>
    <input type="text" id="phone" name="phone" value="<?php echo $phone ?>" maxlength="10" />
    </p>
    <!--State--><!--<p>
    <label for="state">state of residence</label>
    <input type="text" id="state" name="state" value="<?php echo $state ?>" maxlength="20" />
    </p>-->
    <!--username--><p>
    <label for="username">username you would like</label>
    <input type="text" id="username" name="username" value="<?php echo $username ?>" maxlength="20" />
    </p>
    <p>
    <!--Password--><p>
    <label for="password">password you would like</label>
    <input type="password" id="password" name="password"  maxlength="50" />
    </p>
    <p>
    <label for="passcheck">please enter your password again</label>
    <input type="password" id="passcheck" name="passcheck"  maxlength="50" />
    </p>
    <!--State--><!--<p>
    <label for="state">state of residence</label>
    <input type="text" id="state" name="state" value="<?php echo $state ?>" maxlength="20" />
    </p>-->
<p>
<input type="submit" name="submit" value="register" />
</p>
</form>

