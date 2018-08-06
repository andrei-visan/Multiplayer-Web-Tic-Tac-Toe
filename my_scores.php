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
$wins = $user->wins;
$losses = $user->losses;
$draws = $user->draws;

?>


<!doctype html>
  <html lang="zxx">
    <head>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu" >
      <link rel="stylesheet" type="text/css" href="css/index.css">
      <link rel="stylesheet" type="text/css" href="css/gradient_animation.css">
      <title>Poligame - Main Page</title>
      <meta name="description" content="My Scores Poligame">
      <meta http-equiv="content-type" content="text/html;charset=UTF-8">
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="scripts/chat.js"></script>
    </head>
    <body>

      <header>
        <div class="navbar">
        <a href="game_rooms.php" class="btn_left"><b>Play</b></a>
        <a href="index.php" class="btn_left">Home</a>
        <a href="scripts/logout.php" class="btn_left">Log out</a>
        <a href="#" class="btn_right">Contact</a>
        <a href="site_statistics.php" class="btn_right">Site Statistics</a>
        <div class="dropdown btn_right">
          <button class="dropbtn">Account 
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdown-content">
            <a href="profile.php">Profile</a>
            <a href="#">My Scores</a>
          </div>
        </div>
        </div>
      </header>

      <div class="row">
        <div class="column left">
          <h2>My scores</h2>
          <br>

          <h4>Wins:</h4>
          <?= $wins ?>
          <br><br>
            
          <h4>Losses:</h4>
          <?= $losses ?>
          <br><br>

          <h4>Draws:</h4>
          <?= $draws ?>
          <br><br>
          

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