<?php
session_start(); // Start the session.

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is already logged in, if yes then redirect him to the appropriate page
if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') {
    // Redirect based on the session redirect value or default to adminmenu.php
    $redirectPage = isset($_SESSION['redirect']) ? $_SESSION['redirect'] : 'adminmenu.php';
    header("Location: $redirectPage");
    exit;
}

// Initialize variables for messages
$loginError = '';
$isLoginError = false;
$isLoginSuccess = false;

// Login processing logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Assuming 'admin' and 'admin' are your credentials for simplicity
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['username'] = $username; // Save the username in the session

        // Determine the redirection based on the session or default to adminmenu.php
        $redirectPage = isset($_SESSION['redirect']) ? $_SESSION['redirect'] : 'adminmenu.php';
        header("Location: $redirectPage");
        $isLoginSuccess = true;
        exit;
    } else {
        if ($username !== 'admin') {
            $loginError = 'Incorrect username.';
        } elseif ($password !== 'admin') {
            $loginError = 'Incorrect password.';
        } else {
            $loginError = 'Login error. Please try again.';
        }
        $isLoginError = true; // Login failed
    }
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="css/adminmenulogin.css">
    <link rel="stylesheet" href="css/menunoti.css">
  
    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="css/basket.css">
    <title>Responsive Login Form Sign In Sign Up</title>
  </head>
  <body>
    <div class="login">
      <div class="login__content">
        <div class="login__img">
          <img src="images/basketicon.png" alt="">
        </div>

        <div class="login__forms">
          <form action="" method="POST" class="login__registre" id="login-in">
            <h1 class="login__title">Sign In</h1>
  
            <div class="login__box">
              <i class='bx bx-user login__icon'></i>
              <input type="text" placeholder="Username" name="username" class="login__input">
            </div>
  
            <div class="login__box">
              <i class='bx bx-lock-alt login__icon'></i>
              <input type="password" placeholder="Password" name="password" class="login__input">
            </div>

            <a href="#" class="login__forgot">Forgot password?</a>

            <button type="submit" class="login__button">Sign In</button>

            <div>
              <span class="login__account">Don't have an Account ?</span>
              <span class="login__signin" id="sign-up" onclick="onSignUpClicked()">Sign Up</span>

            </div>
            </form>

          <form action="" class="login__create none" id="login-up">
            <h1 class="login__title">Create Account</h1>
  
            <div class="login__box">
              <i class='bx bx-user login__icon'></i>
              <input type="text" placeholder="Username" class="login__input">
            </div>
  
            <div class="login__box">
              <i class='bx bx-at login__icon'></i>
              <input type="text" placeholder="Email" class="login__input">
            </div>

            <div class="login__box">
              <i class='bx bx-lock-alt login__icon'></i>
              <input type="password" placeholder="Password" class="login__input">
            </div>

            <button type="submit" class="login__button">Sign Up</button>

            <div>
              <span class="login__account">Already have an Account ?</span>
              <span class="login__signup" id="sign-in">Sign In</span>
            </div>

            <div class="login__social">
              <a href="#" class="login__social-icon"><i class='bx bxl-facebook' ></i></a>
              <a href="#" class="login__social-icon"><i class='bx bxl-twitter' ></i></a>
              <a href="#" class="login__social-icon"><i class='bx bxl-google' ></i></a>
            </div>
          </form>
        </div>
      </div>
    </div>
  <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/notification.js"></script>
<script src="js/login.js"></script>
  <script>
window.onload = function() {
  var isLoginError = <?php echo json_encode($isLoginError); ?>;
    <?php if ($isLoginError): ?>
        showNotification("<?php echo $loginError; ?>");
    <?php endif; ?>
    <?php if ($isLoginSuccess): ?>
        showNotification("Login successful.");
    <?php endif; ?>
};

function onSignUpClicked() {
    showNotification("This feature will be available in the near future");
}
</script>

  </body>
</html>
