<?php
$conn = mysqli_connect('localhost', 'root', '', 'cms');
if (isset($_POST['submit'])) {
  $user = mysqli_real_escape_string($conn, $_POST['uname']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pwd = sha1($_POST['pass']);
  $rpwd = sha1($_POST['repass']);
  $query = "select * from userdb where Username='$user' and Password='$pwd'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    $error[] = 'user already exist!';
  } elseif ($pwd != $rpwd) {
    $error[] = 'password not matched!';
  } else {
    $insert = "insert into userdb(Username,Phone,Email,Password) values('$user','$phone','$email','$pwd')";
    mysqli_query($conn, $insert);
    header('location:loginform.php');
  }
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>/* Reset styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
}

.signup-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.signup-side {
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.signup-welcome-row {
  margin-bottom: 20px;
}

.signup-welcome-row h1 {
  font-size: 24px;
  color: #333;
}

.my-form {
  max-width: 400px;
}

.text-field {
  margin-bottom: 15px;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="tel"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.my-form__button {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

.my-form__button:hover {
  background-color: #0056b3;
}

.error-msg {
  color: #ff0000;
  margin-bottom: 10px;
}

.my-form__actions {
  margin-top: 10px;
}

.my-form__actions a {
  color: #007bff;
  text-decoration: none;
}

.my-form__actions a:hover {
  text-decoration: underline;
}
</style>
</head>

<body>
  <div class="signup-wrapper">

    <div class="signup-side">
      <!-- <a href="#" title="Logo">
          <img
            class="logo"
            src="images/jawalogo.png"
            width="100px"
            height="100px"
            alt="Logo"
          />
        </a> -->
      <div class="my-form__wrapper">
        <div class="signup-welcome-row">
          <h1>&nbsp;Create Your Account &#x1F44F;</h1>
          <!-- <p>&nbsp; &nbsp;Please enter your details!</p> -->
        </div>
        <form class="my-form" action="" method="post">
          <?php
          if (isset($error)) {
            foreach ($error as $error) {
              echo '<span class="error-msg">' . $error . '</span>';
            }
          };
          ?>
          <div class="text-field">
            <label for="name">Username:</label>
            <input type="text" id="uname" name="uname" placeholder="Username" pattern="[A-Za-z][A-Za-z0-9_]*"
             title="Username must start with an alphabet and can only contain letters, numbers, and underscores" required />
          </div>
          <div class="text-field">
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" placeholder="Phone Number" title="Phone number must start with '98' and be 10 digits long" pattern="^98\d{8}$" required />
          </div>

          <div class="text-field">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Email" required />
          </div>
          <div class="text-field">
            <label for="password">Password:</label>
            <input type="password" id="password" name="pass" placeholder="Enter your Password" title="Minimum 6 characters at least 1 Alphabet and 1 Number" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$" required />
          </div>
          <div class="text-field">
            <label for="password"> Confirm Password:</label>
            <input type="password" id="password" name="repass" placeholder="Confirm your Password" title="Minimum 6 characters at least 1 Alphabet and 1 Number" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$" required />
          </div>
      
          <input type="submit" class="my-form__button" name="submit" value="Signup" />
          <div class="my-form__actions">
            <p><a href="loginform.php" title="Login">
                Already have an account?
              </a></p>
          </div>
        </form>
      </div>
    </div>
    <!-- <div class="info-side"> -->
    <!-- <img src="images/slider8.jpg" alt="Mock" class="mockup" /> -->
    <!-- <div class="welcome-message">
                    <h2>Navitron Maps! 👋</h2>
                    <p>
                       Your ultimate guide to navigating the world 
                       and discovering new places with ease.
                    </p>    
                </div> -->
    <!-- </div> -->
  </div>
  <!-- <script>
            let signupForm = document.querySelector(".my-form");

            signupForm.addEventListener("submit", (e) => {
            e.preventDefault();
            let uname = document.getElementById("uname");
            let pass = document.getElementById("pass");

            console.log("Username:", uname.value);
            console.log("Password:", pass.value);
  // process and send to API
});

    </script> -->
</body>

</html>