<?php
session_start();

require_once 'idiorm.php';
ORM::configure('sqlite:db.sqlite');

$game = ORM::for_table('games')
    ->where('player1', $_GET['player1'])->findOne();

$game->player2 = $_SESSION['username'];
$game->save();

echo 'success';