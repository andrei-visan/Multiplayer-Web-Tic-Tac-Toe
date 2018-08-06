<?php
require_once 'idiorm.php';
ORM::configure('sqlite:db.sqlite');

ORM::get_db()->exec('DROP TABLE IF EXISTS users;');
ORM::get_db()->exec(
        'CREATE TABLE users (' .
        'id INTEGER PRIMARY KEY AUTOINCREMENT, ' .
        'username VARCHAR(50), ' .
        'password VARCHAR(50), ' .
        'bioText VARCHAR(200), ' .
        'name VARCHAR(40), ' .
        'email VARCHAR(30), ' .
        'country VARCHAR(20), ' .
        'wins NUMBER(6), ' .
        'losses NUMBER(6), ' .
        'draws NUMBER(6), ' .
        'rights NUMBER(1)' .
        ')'
    );
 
function create_user($username, $password, $rights)
{
    $user = ORM::for_table('users')->create();
    $user->username = $username;
    $user->password = $password;
    $user->rights = $rights;
    $user->bioText = 'Hello, I am new here!';
    $user->name = 'New User';
    $user->email = 'me@example.com';
    $user->country = '';
    $user->wins = 0;
    $user->losses = 0;
    $user->draws = 0;
    $user->save();
    return $user;
}
 
create_user('admin', '21232f297a57a5a743894a0e4a801fc3','0');
create_user('user', '8287458823facb8ff918dbfabcd22ccb','1');
create_user('guest', '8287458823facb8ff918dbfabcd22ccb','1');
create_user('andrei','8287458823facb8ff918dbfabcd22ccb', '1');
create_user('georgiana','8287458823facb8ff918dbfabcd22ccb', '1');
create_user('matei','8287458823facb8ff918dbfabcd22ccb', '1');


ORM::get_db()->exec('DROP TABLE IF EXISTS games;');
ORM::get_db()->exec(
        'CREATE TABLE games (' .
        'id INTEGER PRIMARY KEY AUTOINCREMENT, ' .
        'player1 VARCHAR(50), ' .
        'player2 VARCHAR(50), ' .
        'turn VARCHAR(50), ' .
        'board VARCHAR(9), ' .
        'result VARCHAR(50) ' .
        ')'
    );
 
function create_game($player)
{
    $game = ORM::for_table('games')->create();
    $game->player1 = $player;
    $game->turn = $player;
    $game->board = '---------';;
    $game->save();
    return $game;
}

create_game('matei');
create_game('georgiana');


ORM::get_db()->exec('DROP TABLE IF EXISTS mouse_pos;');
ORM::get_db()->exec(
        'CREATE TABLE mouse_pos (' .
        'id INTEGER PRIMARY KEY AUTOINCREMENT, ' .
        'count NUMBER(9) ' .
        ')'
    );
 
function create_cell()
{
    $cell = ORM::for_table('mouse_pos')->create();
    $cell->count = 0;
    $cell->save();
    return $cell;
}

for ($i = 0; $i < 400; $i++) {
    create_cell();
}


ORM::get_db()->exec('DROP TABLE IF EXISTS chat;');
ORM::get_db()->exec(
        'CREATE TABLE chat (' .
        'id INTEGER PRIMARY KEY AUTOINCREMENT, ' .
        'username VARCHAR(50), ' .
        'message VARCHAR(10), ' .
        'time VARCHAR(50) ' .
        ')'
    );
 
function create_message($username, $text)
{
    $message = ORM::for_table('chat')->create();
    $message->username = $username;
    $message->message = $text;
    $message->time = date('H:i:s');
    $message->save();
    return $message;
}

create_message('matei', 'Salutare tuturor!');
create_message('georgiana', 'Salut si tie.');
create_message('andrei', 'Vrea sa joace cineva?');

?>