<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

$GLOBALS['config'] = array(
    'cpanel'    => array(
        'ip'        => '192.232.249.164',
		'username'  => 'km310765',
		'password'  => 'BestInAcademicsF2!',
        'domain'    => 'f2foxes.com',
        'port'      => 2083
    ),
	'mysql'     => array(
		/*'host' => 'localhost',
		'username' => 'f2foxesUp5qu',
		'password' => '5K;0WZP^?o@;',
		'db' => 'f2foxes'*/
        'host'      => '192.232.249.164',
		'username'  => 'km310765_admin',
		'password'  => 'Aftermath2015',
		'db'        => 'km310765_f2foxes'
	),
	'remember'  => array(
		'cookie_name'   => 'hash',
		'cookie_expiry' => 604800
	),
	'session'   => array(
		'session_name'  => 'user',
		'token_name'    => 'token'
	)
);

chdir(dirname(__FILE__));

spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

require_once '../functions/sanitize.php';

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('sessions/session_name'))) {
	$hash = Cookie::get(Config::get('remember/cookie_name'));
	$hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));
	
	if($hashCheck->count()) {
		$user = new User($hashCheck->first()->user_id);
		$user->login();
	}
}
?>