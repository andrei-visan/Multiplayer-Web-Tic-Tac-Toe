<?php
session_start();

require_once 'idiorm.php';
ORM::configure('sqlite:db.sqlite');

$message = ORM::for_table('chat')->create();
$message->username = $_SESSION['username'];
$message->message = $_GET['message'];
$message->time = date('H:i:s');
$message->save();