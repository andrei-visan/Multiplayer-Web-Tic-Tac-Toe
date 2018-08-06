<?php

function create_user($username, $password, $rights)
{
  require_once 'scripts/idiorm.php';
  ORM::configure('sqlite:scripts/db.sqlite');

  $result = ORM::for_table('users')
    ->where('username', $username)->findOne();

  if (!$result)
  {
    $user = ORM::for_table('users')->create();
    $user->username = $username;
    $user->password = md5($password);
    $user->rights = $rights;
    $user->save();

    return TRUE;
  }
  else
  {
    return FALSE;
    $errorMsg = "Username already taken!";
  }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){


  if(empty($_POST['username']))
  {
    $errorMsg = "Username is empty!";
  }
  else if(empty($_POST['password']))
  {
    $errorMsg = "Password is empty!";
  }
  else
  {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $rights = '1,3,5,7';
    $result = create_user($username, $password, $rights);
    if ($result)
      $errorMsg = "User successfully created!";
    else
      $errorMsg = "Username already taken";
  }
}
?>

<!doctype html>
  <html lang="zxx">
    <head>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu" >
      <link rel="stylesheet" type="text/css" href="css/login.css">
      <link rel="stylesheet" type="text/css" href="css/gradient_animation.css">
      <title>Poligame - Login</title>
      <meta name="description" content="Signup page for Poligame">
      <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    </head>
    <body>

      <div class="login_box">
        <img class="logo_large" src="images/logo.png" alt="Site logo">
        <h1> Signup for <br> Poligame</h1>
        <form id="form_signup" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <p>
            <input type="text" id="username" name="username" placeholder="Username" />
          </p>
          <p>
            <input type="text" id="password" name="password" placeholder="Password" />
          </p>
          <p>
            <div class="error"><?= $errorMsg ?></div>
            <input  id="submitbutton" type="submit" name="submitbutton" value="Signup"/>
          </p>
        </form>

      <a href = login.php >Back to login page.</a>

      <img class="logo" src="images/logo.png" alt="Site logo">

      <footer>
        Copyright &copy; 2018 Andrei Visan
      </footer>
    </body>
  </html>