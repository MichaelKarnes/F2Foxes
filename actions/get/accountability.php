<?php
chdir(dirname(__FILE__));
//core init required for all pages
require_once '../../core/init.php';

if(Input::exists()) { // if at least one input has been submitted
    // if the token matches the one stored in the session variables (i.e. the user didn't submit a fake form from another page)
	if(Session::exists(Config::get('session/token_name')) && Input::get('token') === Session::get(Config::get('session/token_name'))) {
        $db = DB::getInstance();
        $user_id = Input::get('user_id');
        $date = Input::get('date');

        if(isset($user_id)) { // if the user_id is specified
            // get the user's accountability information
            $reports = $db->get('accountability', array('user_id', '=', $user_id))->results();

            //fill in some extra information about the user
            $user = new User($user_id);
            foreach($reports as $report) {
                $report->first = $user->data()->first;
                $report->last = $user->data()->last;
            }
        } else if(isset($date)) { // if the date is specified
            // get the date's accountability information
            $reports = $db->get('accountability', array('date_absent', '=', date('Y-m-d', strtotime($date))))->results();

            //fill in some extra information each user
            foreach($reports as $report) {
                $user = new User($report->user_id);
                $report->first = $user->data()->first;
                $report->last = $user->data()->last;
            }
        }
        
        // return the accountability information
        echo json_encode($reports);        
    }
}
?>