<?php

session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: login.php");
    exit;
}

?>

<!doctype html>
  <html lang="zxx">
    <head>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu" >
      <link rel="stylesheet" type="text/css" href="css/game.css">
      <link rel="stylesheet" type="text/css" href="css/gradient_animation.css">
      <title>Poligame - Play</title>
      <meta name="description" content="Play Poligame">
      <meta http-equiv="content-type" content="text/html;charset=UTF-8">
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="scripts/game.js"></script>
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
            <a href="profile.php">Profile</a>
            <a href="my_scores.php">My Scores</a>
          </div>
        </div>
        </div>
      </header>

      <div class="row">
        <div class="column left">
          <canvas id='game_canvas' width='500' height='500'></canvas>
          <br>
          <div id="game_state"></div>
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