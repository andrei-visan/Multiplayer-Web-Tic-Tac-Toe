<?php
session_start();

require_once 'idiorm.php';
ORM::configure('sqlite:db.sqlite');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user = ORM::for_table('users')
    ->where('username', $_SESSION['username'])->findOne();
    $user->bioText = $_POST['bioText'];
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->country = $_POST['country'];
    $user->save();
}