<?php
    include_once 'core/init.php';
    $user = new User();
    /*$salt = utf8_decode(utf8_encode(Hash::salt(32)));
    echo $salt;
    $user->create(array(
        'username' => 'admin',
        'password' => Hash::make('15A6B!z217', $salt),
        'salt' => utf8_encode($salt),
        'name' => 'Mr. Fox',
        'group' => 1
    ));
    die();*/
    if($user->isLoggedIn()) {
        require_once 'home/inside.php';
    } else {
        require_once 'home/outside.php';
    }
?>