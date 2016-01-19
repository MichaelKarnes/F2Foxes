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

        $id = Input::get('id'); // Course ID

        $db = DB::getInstance();

        /*
            Check for any errors
        */

        if(!isset($id)) { echo 'Course ID must be set.'; return; }

        /*
            Delete the course from the f2foxes database
        */

        $categories = $db->get('grade_categories', array('course_id', '=', $id))->results();
        foreach($categories as $category) {
            $db->delete('grades', array('category_id', '=', $category->id));
            $db->delete('grade_categories', array('id', '=', $category->id));
        }

        $db->delete('courses', array('id', '=', $id));
    }
}
?>