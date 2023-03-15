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
	<section id="create-account"> <!-- dont show create acct yet (hide) until user clicks sign up-->
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
     //   $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user data into the database
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
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
        <p>Already have an account? <a href="login.php">Log in</a></p>
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