<?php
session_start();

require_once 'idiorm.php';
ORM::configure('sqlite:db.sqlite');

$players = array();

$users = ORM::for_table('users')->find_many();

foreach ($users as $user) {
    $players[$user->username] = $user->wins - $user->losses + 0.5 * $user->draws;
}

echo json_encode($players);