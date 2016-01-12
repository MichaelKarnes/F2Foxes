<?php
	// this script is intended to calculate both Army and Corps PT scores, and add them to the database
	
    chdir(dirname(__FILE__));
    //core init required for all pages
    require_once '../../core/init.php';
	
    if(Input::exists()) { // if at least one input has been submitted
    // if the token matches the one stored in the session variables (i.e. the user didn't submit a fake form from another page)
	    if(Session::exists(Config::get('session/token_name')) && Input::get('token') === Session::get(Config::get('session/token_name'))) {
            $user = new User();
			$db = DB::getInstance();
			
			
			// this code creates a CSV string to store into the database
			// based off the status of the checkboxes from the form
			$j = 0;
			$signOut = "";
			$numBoxes = Input::get('numboxes');
			while ($j < $numBoxes) {
				if (Input::get($j) == "on") {
					$signOut = $signOut . "," . "on";
				} else {
					$signOut = $signOut . "," . "off";
				}
				$j++;
			}
			// the substr function is used to remove the first character which is always ","
			$signOut = substr($signOut,1);
			
			
			// if there is already a signout in the current week for the user, then
			// update the existing
			#input data into database table called signout, see cPanel for more info
			$db->insert("signout", array(
                "user_id"=>$user->data()->id,
                "current_week"=>$signOut));
          }
    }
	
    Redirect::to($_SERVER['HTTP_REFERER']);  
	
?>