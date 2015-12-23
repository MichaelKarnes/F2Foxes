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

        $user = new User(); // get the current user
        $muser = new User($id); // get the user being modified via the id number

        $db = DB::getInstance(); // get an instance of the database

        $musername = $muser->data()->username; // get the username of the user being modified
        $mrole = $muser->data()->role; // get the role of the user being modified

        /* Check to see if current user has permission to modify other user */
        if($mrole >= $user->data()->role && $muser->data()->id != $user->data()->id) { // if the user does not have the correct privileges
            Session::put('error', 'You do not have sufficient permissions to do this.'); // set the error message
            return; // return immediately
        }

        if($muser->data()->id == $user->data()->id) echo 'refresh'; // refresh if the user is deleting himself

        /*
            Delete the user from the f2foxes database
        */

        /* Delete user */
        $db->delete('users', array('id', '=', $id));

        /*
            Delete cPanel email account
        */

        if($mrole <= 1) return; // return immediately if non-member (non-members don't get an email account)

        /* Import cPanel API */
        require_once '../plugins/xmlapi/xmlapi.php';

        /* Create cPanel API object */
        $xmlapi = new xmlapi(Config::get('cpanel/ip')); // set ip address
        $xmlapi->set_port(Config::get('cpanel/port')); //set port number.
        $xmlapi->password_auth(Config::get('cpanel/username'), Config::get('cpanel/password')); // log in cPanel using username and password
        $xmlapi->set_debug(0); //output to error file  set to 1 to see error_log

        /* Delete account */
        $xmlapi->api2_query(Config::get('cpanel/username'), "Email", "delpop", array('domain' => Config::get('cpanel/domain'), 'email' => $musername.'@'.Config::get('cpanel/domain')));
    }
}
?>