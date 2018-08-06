<?php
session_start();

require_once 'idiorm.php';
ORM::configure('sqlite:db.sqlite');

$games = ORM::for_table('games')
->find_many();

$game_arr = array();

foreach ($games as $game) {
    if ($game->result == '' && $game->player2 == '')
        array_push($game_arr, $game->player1);
}

echo json_encode($game_arr);
