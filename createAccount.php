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
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database to select the user record that matches the inputted username or email
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    // Check if a matching user record was found
    if ($result && mysqli_num_rows($result) > 0) {

        // Get the user record
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {

            // Set the user as logged in by creating a session and storing their user ID in the session data
            $_SESSION['user_id'] = $user['user_id'];

            // Redirect the user to the homepage
            header('Location: home.php');
            exit;

        } else {
            // Display an error message if the password is incorrect
            echo 'Incorrect password';
        }

    } else {
        // Display an error message if no matching user record was found
        echo 'Invalid username or email';
    }

}

// Close the database connection
mysqli_close($conn);
?>

        <form action = "createAccount.php" method = "POST">
            <input type="text" id="username" name="username" placeholder="Username" required><br>
            <input type="password" id="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Log in">

        </form>
        <p>New to WeChat? <a href="#" onclick="CreateAccountPage()">Sign Up</a></p>
    </section>
    
	<section id="create-account" style="display:none"> <!-- dont show create acct yet (hide) until user clicks sign up-->
        <h1>Create Account</h1>
         <?php
    // Include the database connection file
        include 'connectDB.php';
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
        $username = $_POST['new-username'];
        $email = $_POST['email'];
        $password = $_POST['new-password'];

    // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user data into the database
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        $result = mysqli_query($conn, $query);

    // Close the database connection
        mysqli_close($conn);
        }
        ?> 
        <form action = "createAccount.php" method = "POST">
            <input type="text" id="new-username" name="new-username" placeholder="Username" required><br>
            <input type="email" id="email" name="email" placeholder="Email Address" required><br>
            <input type="password" id="new-password" name="new-password" placeholder="Password" required><br>
            <input type = "password" id = "confirm-password" name = "confirm-password" placeholder="Confirm Password" required><br>
            <input type="submit" value="Create Account">
        </form>
        <p>Already have an account? <a href="#" onclick="LoginPage()">Log in</a></p>
    </section>
    <div id="passwordRules">
        <h3>Password must contain the following:</h3>
        <p id="lowLetter" class="invalid">A <b>lowercase</b> letter</p>
        <p id="upperCapital" class="invalid">An <b>uppercase</b> letter</p>
        <p id="number" class="invalid">A <b>number</b></p>
        <p id="maxLength" class="invalid">Minimum <b>8 characters</b></p>
      </div>
    
	<script src = "scripts/login.js"></script>
    <script src = "scripts/passwordValidation.js"></script>
</body>
<footer>
    <p class = "tos">Terms of Service</p>
    <p class = "tos">About</p>
    <p class = "tos">Contact Us</p>
    <p class = "tos">FAQ</p>
    <p class = "tos">Privacy and Policy</p>
</footer>
</html>