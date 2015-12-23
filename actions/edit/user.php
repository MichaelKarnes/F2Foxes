<?php
chdir(dirname(__FILE__));
require_once '../../core/init.php';

if(Input::exists()) { // if at least one input has been submitted
	// if the token matches the one stored in the session variables (i.e. the user didn't submit a fake form from another page)
	if(Session::exists(Config::get('session/token_name')) && Input::get('token') === Session::get(Config::get('session/token_name'))) {

        /*
            Set parameters
        */

        $id = Input::get('id'); // get the id of the user being modified
        $password = Input::get('password'); // get the new password, if specified
        $role = Input::get('role'); // get the new role, if specified

        $user = new User(); // get the current user
        $muser = new User($id); // get the user being modified via the id number

        $db = DB::getInstance(); // get an instance of the database

        $musername = $muser->data()->username; // get the username of the user being modified
        $mrole = $muser->data()->role; // get the old role of the user being modified
        $mpassword = $muser->data()->password; // get the old password of the user being modified

        /* Check to see if current user has permission to modify other user */
        if($mrole >= $user->data()->role && $muser->data()->id != $user->data()->id) { // if the user does not have the correct privileges
            Session::put('error', 'You do not have sufficient permissions to do this.'); // set the error message
            echo 'refresh'; // tell the page to refresh;
            return; // return immediately
        }

        /*
            Edit the user from the f2foxes database
        */

        /* Edit password */
        if(!empty($password)) { // if the password input is set, we need to edit the password
            $hashedpw = Hash::make(Input::get('password'), $muser->data()->salt); // hash the password concatenated with the user's salt, making the password harder to crack
            $db->update('users', $id, array('password' => $hashedpw)); // change the user's password
        }

        /* Edit role */
        if(!empty($role)) { // if the role input is set, we need to edit the role
            $db->update('users', $id, array('role' => $role)); // change the user's role
            if($muser->data()->id == $user->data()->id) echo 'refresh'; // refresh if the user is changing his own role
        }

        /*
            Edit cPanel email account
        */

        if(!empty($password) && $mrole <= 1) return; // return immediately if non-member (non-members don't get an email account)

        /* Import cPanel API */
        require_once '../plugins/xmlapi/xmlapi.php';

        /* Create cPanel API object */
        $xmlapi = new xmlapi(Config::get('cpanel/ip')); // set ip address
        $xmlapi->set_port(Config::get('cpanel/port')); //set port number.
        $xmlapi->password_auth(Config::get('cpanel/username'), Config::get('cpanel/password')); // log in cPanel using username and password
        $xmlapi->set_debug(0); //output to error file  set to 1 to see error_log

        /* Edit password */
        if(!empty($password)) { // if the password input is set, we need to edit the email address
            // change the user's email account password
            $xmlapi->api2_query(Config::get('cpanel/username'), "Email", "passwdpop", array('domain' => Config::get('cpanel/domain'), 'email' => $muser->data()->username, 'password' => $password));
        }

        /* Handle non-member account deletion */
        if(!empty($role)) { // if the role input is set, we need to check for email account deletion
            if($role <= 1 && $mrole > 1) { // if role is being changed to non-member
                // Delete POP email account
                $xmlapi->api2_query(Config::get('cpanel/username'), "Email", "delpop", array('domain' => Config::get('cpanel/domain'), 'email' => $musername.'@'.Config::get('cpanel/domain')));
            }
        }
    }
}
?>