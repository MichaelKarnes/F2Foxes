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

        $user_id = Input::get('user_id');
        $category_id = Input::get('category_id'); // Category ID
        $name = Input::get('name'); // Name
        $earned = Input::get('earned'); // Score
        $total = Input::get('total'); // Total

        $db = DB::getInstance();

        $user = new User($user_id);

        //$course_id = $db->get('courses_assignments', array('id', '=', $assignment_id))->first()->id;

        /*
            Check for any errors
        */

        if(!isset($category_id)) { /*echo json_encode(array('error', 'Assignment ID must be set.'));*/ return; }
        if(!isset($name)) { /*echo json_encode(array('error', 'Name must be set.'));*/ return; }
        if(!isset($earned)) { /*echo json_encode(array('error', 'Score must be set set.'));*/ return; }
        if(!isset($total)) { /*echo json_encode(array('error', 'Total must be set.'));*/ return; }

        /*
            Add a new grade to the f2foxes database
        */

        $db->insert('grades', array(
            'category_id'   => $category_id,
            'name'          => $name,
            'earned'        => encrypt($earned, $user->data()->salt),
            'total'         => encrypt($total, $user->data()->salt)
        ));

        /*
            Return grade id and update course
        */

        $res = get_object_vars($db->query('SELECT LAST_INSERT_ID()')->first());
        $grade_id = $res['LAST_INSERT_ID()'];

        $course_id = $db->get('grade_categories', array('id', '=', $category_id))->first()->course_id;
        $db->update('courses', $course_id, array('updated' => date('Y-m-d')));

        echo $grade_id;
    }
}
?>