<?php
session_start();

require_once 'idiorm.php';
ORM::configure('sqlite:db.sqlite');

$messages_ret = array();

$count = ORM::for_table('chat')->count();


for ($i = 1; $i <= $count; $i++) {
    $message = ORM::for_table('chat')->find_one($i);
    $messages_ret[$message->id] = [$message->username, $message->message, $message->time];

}

echo json_encode($messages_ret);