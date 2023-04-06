<?php
session_start();
require 'connectDB.php';
if(!empty($_SESSION["user_id"])){
    header("Location: home.php");
}
if(isset($_POST["submit"])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if($user){
        if(password_verify($password, $user['password'])){
            $_SESSION["username"] = $user['username'];
            $_SESSION["user_id"]= $user["user_id"];
            header("Location: home.php");
            exit();
        }else{
            echo "<script>alert('Oops, Wrong Password');</script>";
        }
    }else{
        echo "<script>alert('Sorry, user is not registered');</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "css/login.css">
    <link rel = "stylesheet" href = "css/style.css">
    
    <title>Login</title>
</head>
<body>
<a href= "home.php" class = "button">Home</a>
<section id="login">
        <h1>Login</h1>

<form action = "" method = "POST" autocomplete = "off">
    <input type="text" id="username" name="username" placeholder="Username" required><br>
    <input type="password" id="password" name="password" placeholder="Password" required><br>
    <!-- <input type="submit" value="Log in"> -->
    <a href="resetPassword.php">Forgot Password?</a>
    
    <button class = "button" type="submit" name="submit">Log in</button>

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