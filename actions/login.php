<?php
chdir(dirname(__FILE__));
require_once '../core/init.php';

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array('required' => true),
			'password' => array('required' => true)
		));
		
		if($validation->passed()) {
			$user = new User();
			
			$remember = (Input::get("remember") == "on") ? true : false;
			$user->login(Input::get('username'), Input::get('password'), $remember);
		}
	}
}

Redirect::to($_SERVER['HTTP_REFERER']);
?>
