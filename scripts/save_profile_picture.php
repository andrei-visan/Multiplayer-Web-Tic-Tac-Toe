<?php
session_start();

require_once 'idiorm.php';
ORM::configure('sqlite:db.sqlite');

$uploadOk = 1;


// $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
// if($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
// } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
// }

if ($uploadOk) 
{
    $info = pathinfo($_FILES['fileToUpload']['name']);
    $ext = $info['extension'];
    $newname = $_SESSION['username'];
    // "." . $ext;
    $targetdir = '../profile_pictures/'; 
    $target = $targetdir.$newname;
    if(file_exists($target))
        unlink($target);
    move_uploaded_file( $_FILES['fileToUpload']['tmp_name'], $target);

    $user = ORM::for_table('users')
    ->where('username', $_SESSION['username'])->findOne();
}

?>