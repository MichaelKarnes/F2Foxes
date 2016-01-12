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
						$reason = Input::get('reason'); //comes from html select tag, reason for the sign out
            $j = 0; // counter for loop
            $signOut = ""; // initialize an empty string to insert into signout table in mysql database
            $numBoxes = Input::get('numboxes'); // the admin can change the number of boxes which
            // corresponds to the number of training times per week

            // if there is already a signout in the current week for the user, then
            // update the existing row in the database
            $exists = $db->get('signout', array('user_id','=', $user->data()->id))->results();
            foreach($exists as $i) {
              $idForUpdate = $i->id;
            }

            if (isset($idForUpdate) == TRUE) {
              $tempArray = explode(",",$i->current_week);
              var_dump($tempArray);

              // numBoxes allows to us to execute the loop for however many training times there are
              while ($j < $numBoxes) {
                  if (Input::get($j) == "on") {
                    // if the checkbox is on, we overwrite or insert a new reason
                    $signOut = $signOut . "," . $reason;
                  } else {
                    // otherwise we keep the current datapoint in the CSV string
                    $signOut = $signOut . "," . $tempArray[$j];
                  }
                  $j++;
              }
              // after this loop executes, there will always be a comma as the
              // character. substr removes this comma
              $signOut = substr($signOut,1);

              $db->update('signout', $idForUpdate, array(
                  "user_id"=>$user->data()->id,
                  "current_week"=>$signOut));
            } else { // this code executes in the case of the first sign out
              // or if the user decides to delete their signout
              while ($j < $numBoxes) {
                  if (Input::get($j) == "on") {
                    $signOut = $signOut . "," . $reason;
                  } else {
                    // this time insert none for no signout
                    $signOut = $signOut . "," . "none";
                  }
                  $j++;
              }
              $signOut = substr($signOut,1);

              $db->insert('signout', array(
                  "user_id"=>$user->data()->id,
                  "current_week"=>$signOut));
            }

    				}
    }

    Redirect::to($_SERVER['HTTP_REFERER']);

?>
