<?php
    chdir(dirname(__FILE__));
    //core init required for all pages
    require_once '../../core/init.php';

     if(Input::exists()) { // if at least one input has been submitted 
    // if the token matches the one stored in the session variables (i.e. the user didn't submit a fake form from another page)
	    if(Session::exists(Config::get('session/token_name')) && Input::get('token') === Session::get(Config::get('session/token_name'))) {
            // obtain the id of the entry we want to delete according to the pt data table
            $user = new User();
            $toDelete = Input::get('delete');
            $toDelete = key($toDelete);
            
            $db = DB::getInstance();
            $db->delete("pt", array("id", "=", $toDelete));
        }
     }
     Redirect::to($_SERVER['HTTP_REFERER']); 
     $db = DB::get
?>
