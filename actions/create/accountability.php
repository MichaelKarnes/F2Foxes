<?php
	// this script is intended to calculate both Army and Corps PT scores, and add them to the database

    chdir(dirname(__FILE__));
    //core init required for all pages
    require_once '../../core/init.php';

    if(Input::exists()) { // if at least one input has been submitted
    // if the token matches the one stored in the session variables (i.e. the user didn't submit a fake form from another page)
	    if(Session::exists(Config::get('session/token_name')) && Input::get('token') === Session::get(Config::get('session/token_name'))) {
        $numRows = Input::get('numrows');
        $date = Input::get('date');
        $event = Input::get('event');

        $db = DB::getInstance();
        // get users who have signed out
        $sql = "SELECT users.last, users.first, signout.current_week
                FROM users INNER JOIN signout ON
                users.id = signout.user_id";
        $name = $db->query($sql)->results();

        // create arrays for first and last names of users who have signed out
        $j = 0;
        foreach ($name as $i) {
          $last[$j] = $i->last;
          $first[$j] = $i->first;
          $j++;
        }

        $j = 0;
        // we loop through each user who has signed out
        while ($j < $numRows) {
          // if the user is not there, their checkbox is on, record the absence
          if (Input::get($j) == "on") {
            $insertLast = $last[$j];
            $insertFirst = $first[$j];

            $db->insert('accountability', array(
              "last"=>$insertLast,
              "first"=>$insertFirst,
              "date_absent"=>$date,
              "event"=>$event));

          }
          $j++;
        }

      }
    }

    echo "Submission Successful. ";
    echo '<a href="../../pages/signal/">Click Here</a>';




?>
