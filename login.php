<?php
require_once 'scripts/idiorm.php';

session_start();
if(isset($_SESSION['username']) || !empty($_SESSION['username']))
{
  header("location: index.php");
}

function CheckLoginInDB($username,$password)
{
  ORM::configure('sqlite:scripts/db.sqlite');

  $pwdmd5 = md5($password);
  $result = ORM::for_table('users')
          ->where(array(
            'username' => $username,
            'password' => $pwdmd5
          ))
          ->findOne();

  if (!$result)
  {
    return false;
  }
  return true;
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
    
    if(CheckLoginInDB($username,$password))
    {
      session_start();
    
      $_SESSION["username"] = $username;
      
      header("Location: index.php");
    }
    else
    {
      $errorMsg = "Invalid username or password.";
    }
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
      <meta name="description" content="Login page for Poligame">
      <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    </head>
    <body>

      <div class="login_box">
        <img class="logo_large" src="images/logo.png" alt="Site logo">
        <h1> Log in to <br> Poligame</h1>
        <form id="form_login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <p>
            <input type="text" id="username" name="username" placeholder="Username" />
          </p>
          <p>
            <input type="password" id="password" name="password" placeholder="Password" />
          </p>
          <p>
            <div class="error"><?= $errorMsg ?></div>
            <input  id="submitbutton" type="submit" name="submitbutton" value="Login"/>
          </p>
        </form>
        <a href = signup.php >Sign up now!</a>
      </div>

      <img class="logo" src="images/logo.png" alt="Site logo">

      <footer>
        Copyright &copy; 2018 Andrei Visan
      </footer>
    </body>
  </html>