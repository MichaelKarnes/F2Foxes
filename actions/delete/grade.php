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

        $db = DB::getInstance();

        /*
            Check for any errors
        */

        if(!isset($id)) { echo 'Grade ID must be set.'; return; }

        /*
            Delete the grade from the f2foxes database
        */

        $db->delete('grades', array('id', '=', $id));

        /*
            Update course
        */

        $category_id = $db->get('grades', array('id', '=', $id))->first()->category_id;
        $course_id = $db->get('grade_categories', array('id', '=', $category_id))->first()->course_id;
        $db->update('courses', $course_id, array('updated' => date('Y-m-d')));
    }
}
?>