<?php
// Start the session
session_start();

// Check if the form is submitted
if (isset($_POST['submit'])) {
  // Database connection
  $conn = mysqli_connect('localhost', 'root', '', 'cms');

  // Escape user inputs to prevent SQL injection
  $user = mysqli_real_escape_string($conn, $_POST['uname']);
  $pwd = sha1($_POST['pass']); // Note: SHA1 is not secure, consider using stronger hashing algorithms like bcrypt


  // Query to check user credentials
  $query = "SELECT * FROM userdb WHERE Username='$user' AND Password='$pwd'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    // User found, store user information in session variables
    $_SESSION['username'] = $user;
    

    // Redirect user to the dashboard or homepage
    header('location: afterloginindex.php');
    exit;
  } else {
    // Invalid credentials
    $error = 'Incorrect username or password!';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login Example</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/logincss.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <div class="login-wrapper">
    <div class="login-side">
      <div class="my-form__wrapper">
        <div class="login-welcome-row">
          <h1>&nbsp;Welcome back &#x1F44F;</h1>
          <p>&nbsp; &nbsp;Please enter your details!</p>
        </div>
        <form class="my-form" action="" method="post">
          <?php if (isset($error)): ?>
            <span class="error-msg"><?php echo $error; ?></span>
          <?php endif; ?>
          <div class="text-field">
            <!-- <label for="name">Username:</label> -->
            <input type="text" id="uname" name="uname" placeholder="Username" required />
            <i class='bx bxs-user'></i>
          </div>
          <div class="text-field">
            <!-- <label for="password">Password:</label> -->
            <input type="password" id="pass" name="pass" placeholder="Enter your Password" required />
            <i class='bx bxs-lock-alt'></i>
          </div>
          
          <input type="submit" class="my-form__button" name="submit" value="Login" />
          <div class="my-form__actions">
            <p><a href="signupform.php" title="Create Account">Create an account</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>