<?php
session_start();

require_once 'idiorm.php';
ORM::configure('sqlite:db.sqlite');

$game = ORM::for_table('games')
->where_any_is(array(
    array('player1' => $_SESSION['username']),
    array('player2' => $_SESSION['username'])))
->findOne();

$game->delete();