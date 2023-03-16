
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
<form action = "createAccount.php" method = "POST">
            <input type="text" id="new-username" name="new-username" placeholder="Username" required><br>
            <input type="email" id="email" name="email" placeholder="Email Address" required><br>
            <input type="password" id="new-password" name="new-password" placeholder="Password" required><br>
            <input type = "password" id = "confirm-password" name = "confirm-password" placeholder="Confirm Password" required><br>
            <input type="submit" value="Create Account">
        </form>
</body>
