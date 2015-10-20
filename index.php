<?php
    include_once 'core/init.php';
    $user = new User();
    /*$salt = utf8_decode(utf8_encode(Hash::salt(32)));
    echo $salt."<br>";
    $user->create(array(
        'username' => 'admin',
        'password' => Hash::make('password', $salt),
        'salt' => $salt,
        'first' => 'Mr.',
        'last' => 'Fox',
        'group' => 1
    ));
    print_r($user);
    die();*/
    if($user->isLoggedIn()) {
        require_once 'pages/home/inside.php';
    } else {
        require_once 'pages/home/outside.php';
    }
?>