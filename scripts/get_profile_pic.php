<?php
session_start();

$target = '../profile_pictures/' . $_SESSION['username'];

if(file_exists($target))
    $target = '../profile_pictures/' . $_SESSION['username'];
else
    $target = '../images/placeholder_profile_picture.jpg';

$info   = getimagesize($target);
$type = $info['mime'];

header('Content-Type:'.$type);
header('Content-Length: ' . filesize($target));
readfile($target);