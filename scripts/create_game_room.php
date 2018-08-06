<?php
session_start();

require_once 'idiorm.php';
ORM::configure('sqlite:db.sqlite');

$player = $_SESSION['username'];

$game = ORM::for_table('games')->create();
$game->player1 = $player;
$game->turn = $player;
$game->board = '---------';;
$game->save();

header("location: ../game.php");
