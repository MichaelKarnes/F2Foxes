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
        $abbrev = Input::get('abbrev');
        $num = Input::get('num');
        $credits = Input::get('credits');
        $name = Input::get('name');
        $note = Input::get('note');
        $pointsystem = Input::get('pointsystem');
        $gradecategories = json_decode(Input::get('gradecategories'));
        $gradecategorypoints = json_decode(Input::get('gradecategorypoints'));

        $db = DB::getInstance();

        $user = new User($user_id);

        /*
            Check for any errors
        */

        if(!isset($abbrev)) { return; }
        if(!isset($num)) { return; }
        if(!isset($credits)) { return; }
        if(!isset($pointsystem)) { return; }
        if(!isset($gradecategories)) { return; }
        if(!isset($gradecategorypoints)) { return; }

        /*
            Add a new course to the f2foxes database
        */

        $db->insert('courses', array(
            'user_id'       => $user_id,
            'abbrev'        => strtoupper($abbrev),
            'num'           => $num,
            'name'          => $name,
            'credits'       => $credits,
            'grade'         => '',
            'pointsystem'   => $pointsystem,
            'updated'       => date('Y-m-d'),
            'note'          => $note
        ));

        $res = get_object_vars($db->query('SELECT LAST_INSERT_ID()')->first());
        $course_id = $res['LAST_INSERT_ID()'];

        for($i = 0; $i < count($gradecategories); $i++) {
            $gradecategory = $gradecategories[$i];
            $gradepoints = $gradecategorypoints[$i];
            $db->insert('grade_categories', array(
                'course_id'     => $course_id,
                'name'          => $gradecategory,
                'earned'        => '',
                'available'     => '',
                'total'         => encrypt($gradepoints, $user->data()->salt)
            ));
        }
    }
}
?>