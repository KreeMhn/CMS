<?php
include ('partials-front/nav.php');

function isLoggedIn()
{
    // Check if the 'username' session variable exists
    return isset($_SESSION['username']);
}
$uname=$_SESSION['username'];

// If the user is not logged in, redirect them to the login page
if (!isLoggedIn()) {
    header('Location: loginform.php');
    exit;
}

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to your database (Assuming you have already done this)

    // Sanitize and validate the submitted data
    $uname = $_SESSION['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = sha1($_POST['pass']);

    // Update the user data in the database
    $sql = "UPDATE `userdb` SET `Phone` = '$phone', `Email` = '$email', `Password` = '$password' WHERE `Username` = '$uname'";
    
    if ($conn->query($sql) === TRUE) {
        echo "User data updated successfully";
    } else {
        echo "Error updating user data: " . $conn->error;
    }
}

// Fetch user data after updating
$sql = "SELECT * FROM `userdb` WHERE `Username` = '$uname'";
$result = $conn->query($sql);

$userData = [];
if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    echo "No user data found.";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .my-form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .text-field {
            margin-bottom: 15px;
        }
        .text-field label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .text-field input[type="text"],
        .text-field input[type="tel"],
        .text-field input[type="email"],
        .text-field input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        .text-field input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .text-field input[type="submit"]:hover {
            background-color: #45a049;
        }
        .update {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 10px;
}

/* Hover effect */
.update:hover {
    background-color: #45a049;
}
    </style>
</head>
<body>
<form class="my-form" action="" method="post">
    <div class="text-field">
        <label for="name">Username:</label>
        <input type="text" id="uname" name="uname" placeholder="Username" pattern="[A-Za-z][A-Za-z0-9_]*"
             title="Username must start with an alphabet and can only contain letters, numbers, and underscores"
         value="<?php echo htmlspecialchars($userData['Username']); ?>"  />
    </div>
    <div class="text-field">
        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" placeholder="Phone Number" 
        title="Phone number must start with '98' and be 10 digits long" 
        pattern="^98\d{8}$" value="<?php echo htmlspecialchars($userData['Phone']); ?>"  />
    </div>
    <div class="text-field">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" 
        placeholder="Email" value="<?php echo htmlspecialchars($userData['Email']); ?>" />
    </div>
    <div class="text-field">
        <label for="password">Password:</label>
        <input type="password" id="password" name="pass" placeholder="Enter your Password"
         title="Minimum 6 characters at least 1 Alphabet and 1 Number" 
         pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$" value="<?php echo htmlspecialchars($userData['Password']); ?>" />
    </div>
    <input type="submit" class="update" name="update" value="Update"/>
</form>
</body>
</html>
