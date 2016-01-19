<?php
chdir(dirname(__FILE__));
//core init required for all pages
require_once '../../core/init.php';

if(Input::exists()) { // if at least one input has been submitted
    // if the token matches the one stored in the session variables (i.e. the user didn't submit a fake form from another page)
	if(Session::exists(Config::get('session/token_name')) && Input::get('token') === Session::get(Config::get('session/token_name'))) {

        /*
            Set parameters
        */

        $id = Input::get('id'); // Grade ID
        $name = Input::get('name'); // Name
        $earned = Input::get('earned'); // Score
        $total = Input::get('total'); // Total

        $db = DB::getInstance();

        $user = new User();

        /*
            Check for any errors
        */

        if(!isset($id)) { echo 'Grade ID must be set.'; return; }
        if(!isset($name)) { echo 'Name must be set.'; return; }
        if(!isset($earned)) { echo 'Score must be set set.'; return; }
        if(!isset($total)) { echo 'Total must be set.'; return; }

        /*
            Edit the grade on the f2foxes database
        */

        $db->update('grades', $id, array(
            'name'          => $name,
            'earned'        => encrypt($earned, $user->data()->salt),
            'total'         => encrypt($total, $user->data()->salt)
        ));
    }
}
?>