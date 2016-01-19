<?php
chdir(dirname(__FILE__));
//core init required for all pages
require_once '../../core/init.php';

if(Input::exists()) { // if at least one input has been submitted
    // if the token matches the one stored in the session variables (i.e. the user didn't submit a fake form from another page)
	if(Session::exists(Config::get('session/token_name')) && Input::get('token') === Session::get(Config::get('session/token_name'))) {
        $db = DB::getInstance();
        $user_id = Input::get('user_id');
        $course_id = Input::get('course_id');

        $user = new User($user_id);

        // get the course's categories
        $categories = $db->get('grade_categories', array('course_id', '=', $course_id))->results();

        // calculate the course grade
        $grade = 0;
        $total = 0;
        foreach($categories as $category) {
            if(empty($category->earned))
                continue;
            $grade += decrypt($category->earned, $user->data()->salt) / decrypt($category->available, $user->data()->salt) * decrypt($category->total, $user->data()->salt); // turns percentage grade into credits earned
            $total += decrypt($category->total, $user->data()->salt);
        }
        if($total > 0) {
            $grade /= $total / 100;
            $db->update('courses', $course_id, array(
                'grade'    => encrypt($grade, $user->data()->salt)
            ));
            echo number_format($grade, 1);
        } else {
            $db->update('courses', $course_id, array(
                'grade'    => ''
            ));
            echo '--';
        }
    }
}
?>