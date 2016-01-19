<?php
chdir(dirname(__FILE__));
//core init required for all pages
require_once '../../core/init.php';

if(Input::exists()) { // if at least one input has been submitted
    // if the token matches the one stored in the session variables (i.e. the user didn't submit a fake form from another page)
	if(Session::exists(Config::get('session/token_name')) && Input::get('token') === Session::get(Config::get('session/token_name'))) {
        $db = DB::getInstance();
        $user_id = Input::get('user_id');
        $category_id = Input::get('category_id');

        $user = new User($user_id);

        // get the category's grades
        $grades = $db->get('grades', array('category_id', '=', $category_id))->results();

        // calculate the category grade
        $cEarned = 0;
        $cAvailable = 0;
        foreach($grades as $grade) {
            if(empty($grade->earned))
                continue;
            $cEarned += decrypt($grade->earned, $user->data()->salt);
            $cAvailable += decrypt($grade->total, $user->data()->salt);
        }
        if($cAvailable > 0 || $cEarned > 0) {
            $db->update('grade_categories', $category_id, array(
                'earned'    => encrypt($cEarned, $user->data()->salt),
                'available' => encrypt($cAvailable, $user->data()->salt)
            ));
            echo number_format($cEarned, 1).'/'.number_format($cAvailable, 1);
        } else {
            $db->update('grade_categories', $category_id, array(
                'earned'    => '',
                'available' => ''
            ));
            echo '--/--';
        }
    }
}
?>