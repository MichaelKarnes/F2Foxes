<?php
chdir(dirname(__FILE__));
//core init required for all pages
require_once '../../core/init.php';

if(Input::exists()) { // if at least one input has been submitted
    // if the token matches the one stored in the session variables (i.e. the user didn't submit a fake form from another page)
	if(Session::exists(Config::get('session/token_name')) && Input::get('token') === Session::get(Config::get('session/token_name'))) {
        $db = DB::getInstance();
        $user_id = Input::get('user_id');
        $user = new User($user_id);

        // get the current user's courses
        $courses = $db->get('courses', array('user_id', '=', $user->data()->id))->results();

        // get the current user's gpa and number of hours
        $gpa = 0;
        $hours = 0;
        foreach($courses as $course) {
            if(empty($course->grade))
                continue;
            $gpa += (floor(max(min(decrypt($course->grade, $user->data()->salt), 90), 50) / 10) - 5) * $course->credits; // turns percentage grade into credits earned
            $hours += $course->credits;
        }
        if($hours > 0) {
            $gpa /= $hours;
            echo number_format($gpa, 2);
        } else {
            echo 'N/A';
        }
    }
}
?>