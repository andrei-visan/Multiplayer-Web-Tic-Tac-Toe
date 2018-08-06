<?php
session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}

require_once 'scripts/idiorm.php';
ORM::configure('sqlite:scripts/db.sqlite');

$user = ORM::for_table('users')
->where('username', $_SESSION['username'])->findOne();
$bioText = $user->bioText;
$name = $user->name;
$email = $user->email;
$country = $user->country;

?>

<!doctype html>
  <html lang="zxx">
    <head>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu" >
      <link rel="stylesheet" type="text/css" href="css/profile.css">
      <link rel="stylesheet" type="text/css" href="css/gradient_animation.css">
      <title>Poligame - My Profile</title>
      <meta name="description" content="My Poligame Profile">
      <meta http-equiv="content-type" content="text/html;charset=UTF-8">
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="scripts/profile.js"></script>
      <script src="scripts/chat.js"></script>
    </head>
    <body>

      <header>
        <div class="navbar">
        <a href="game_rooms.php" class="btn_left"><b>Play</b></a>
        <a href="index.php" class="btn_left">Home</a>
        <a href="scripts/logout.php" class="btn_left">Log out</a>
        <a href="#" class="btn_right">Contact</a>
        <a href="site_statistics.php" class="btn_right">Site statistics</a>
        <div class="dropdown btn_right">
          <button class="dropbtn">Account 
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-content">
            <a href="#">Profile</a>
            <a href="my_scores.php">My Scores</a>
          </div>
        </div>
        </div>
      </header>

      <div class="row">
      <div class="column left">
          <h2>My profile</h2>

          <h3>Bio</h3>
          <input type="text" readonly id="bioText" value="<?= $bioText ?>" >
          <br>
          
          <h3>Info</h3>
          <div class="info">
            <b>Name: </b><input type="text" readonly id="name" value="<?= $name ?>" >
            <br><br>
            <b>Email: </b><input type="text" readonly id="email" value="<?= $email ?>" >
            <br><br>
            <b>Country: </b><input type="text" readonly id="country" value="<?= $country ?>" >
            <br><br>
          </div>

          <input id="editBio" type="button" value="Edit"/>
          <input id="saveBio" type="submit" value="Save"/>

          <h4>Profile picture</h4>

          <img class="profile_picture" id="profile_picture" src="scripts/get_profile_pic.php" alt="Profile picture">

          <form enctype="multipart/form-data">
            <input name="fileToUpload" type="file" />
            <input id="uploadButton" type="button" value="Upload" />
          </form>

        </div>

        <div class="column right">

          <h2>Chat</h2>

          <div class="messages_container"></div>

          <textarea name="Chat New Message" rows="2" class="chat_new_message_text"></textarea>

          <input  id="message_post_button" type="button" value="Send"/>

        </div>
      </div>

      <img class="logo" src="images/logo.png" alt="Site logo">

      <footer>
        Copyright &copy; 2018 Andrei Visan
      </footer>
    </body>
  </html>