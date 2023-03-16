<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "css/login.css">
    <link rel = "stylesheet" href = "css/style.css">
    
    <title>Login & Create Account</title>
</head>
<body>
<a href= "home.php" class = "button">Home</a>
<section id="login">
        <h1>Login</h1>
        <?php
// Start the session
session_start();

// Include the database connection file
include 'connectDB.php';

// Check if the login form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Query the database using prepared statement to select the user record that matches the inputted username or email
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if a matching user record was found
    if ($result && mysqli_num_rows($result) > 0) {

        // Get the user record
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {

            // Set the user as logged in by creating a session and storing their user ID in the session data
            $_SESSION['user_id'] = $user['user_id'];

            // Redirect the user to the homepage
            header('location: home.php');
            exit();

        } else {
            // Display an error message if the password is incorrect
            $error = 'Incorrect password';
        }

    } else {
        // Display an error message if no matching user record was found
        $error = 'Invalid username or email';
    }

}

// Close the database connection
mysqli_close($conn);
?>

<form action = "login.php" method = "POST">
    <input type="text" id="username" name="username" placeholder="Username" required><br>
    <input type="password" id="password" name="password" placeholder="Password" required><br>
    <input type="submit" value="Log in">
</form>
        <p>New to WeChat? <a href="createAccount.php">Sign Up</a></p>
    </section>

    <!--
    <script src = "scripts/login.js"></script>
    <script src = "scripts/passwordValidation.js"></script>
-->
</body>
<footer>
    <p class = "tos">Terms of Service</p>
    <p class = "tos">About</p>
    <p class = "tos">Contact Us</p>
    <p class = "tos">FAQ</p>
    <p class = "tos">Privacy and Policy</p>
</footer>
</html>