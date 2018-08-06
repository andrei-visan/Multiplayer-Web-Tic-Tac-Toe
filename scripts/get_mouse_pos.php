<?php
session_start();

require_once 'idiorm.php';
ORM::configure('sqlite:db.sqlite');

$mouse_pos = $_GET['mouse_pos'];

$positions = 400;

$cells = array();

for ($i = 0; $i < $positions; $i++) {
    $cell = ORM::for_table('mouse_pos')->find_one($i + 1);
    array_push($cells, $cell->count);
}

echo json_encode($cells);