<?php
chdir(dirname(__FILE__));
require_once '../../core/init.php';

if(Input::exists()) { // if at least one input has been submitted
    // if the token matches the one stored in the session variables (i.e. the user didn't submit a fake form from another page)
	if(Session::exists(Config::get('session/token_name')) && Input::get('token') === Session::get(Config::get('session/token_name'))) {

        /*
            Set parameters
        */

        $fname = Input::get('fname'); // First Name
        $lname = Input::get('lname'); // Last Name
        $username = Input::get('username'); // Username
        $gender = Input::get('gender'); // Gender
        $password = Input::get('password'); // Password
        $role = Input::get('role'); // Role

        $salt = utf8_encode(Hash::salt(32)); // create a salt of length 32, essentially a string of 32 random characters

        $user = new User(); // create a blank user object
        $hashedpw = Hash::make(Input::get('password'), $salt); // hash the password with the salt to create an uncrackable password

        /*
            Add a new user to the f2foxes database
        */

        // register a new user
        $user->create(array(
            'username'  => $username,
            'password'  => $hashedpw,
            'salt'      => $salt,
            'first'     => Input::get('fname'),
            'last'      => Input::get('lname'),
            'gender'    => $gender,
            'role'      => Input::get('role'),
            'accessed'  => date('Y-m-d')
        ));

        /*
            Create cPanel email account
        */

        if($role <= 1) return; // return immediately if non-member (non-members don't get an email account)

        /* Import cPanel API */
        require_once '../plugins/xmlapi/xmlapi.php';

        /* Create cPanel API object */
        $xmlapi = new xmlapi(Config::get('cpanel/ip')); // set ip address
        $xmlapi->set_port(Config::get('cpanel/port')); //set port number.
        $xmlapi->password_auth(Config::get('cpanel/username'), Config::get('cpanel/password')); // log in cPanel using username and password
        $xmlapi->set_debug(0); //output to error file  set to 1 to see error_log
        
        /* Set email parameters */
        $eusername = $username.'@'.Config::get('cpanel/domain'); // set email username as username concatenated with @f2foxes.com
        $epassword = $password; // set password
        $equota = 'Unlimited'; // set account quota (in MB or Unlimited) 
        $edomain = Config::get('cpanel/domain'); // set domain as f2foxes.com

        /* Create POP email account */
        $xmlapi->addpop(Config::get('cpanel/username'), array($eusername, $epassword, $equota, $edomain));
    }
}
?>