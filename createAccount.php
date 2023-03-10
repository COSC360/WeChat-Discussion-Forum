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
        <form>
            <input type="text" id="username" name="username" placeholder="Username" required><br>
            <input type="password" id="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Log in">

        </form>
        <p>New to WeChat? <a href="#" onclick="CreateAccountPage()">Sign Up</a></p>
    </section>
    
	<section id="create-account" style="display:none"> <!-- dont show create acct yet (hide) until user clicks sign up-->
        <h1>Create Account</h1>
        <form>
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