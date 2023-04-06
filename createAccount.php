<?php
session_start();
require 'connectDB.php';
if(!empty($_SESSION["user_id"])){
    header("Location: home.php");
}
if(isset($_POST["submit"])){
    $username = $_POST['new-username'];
    $email = $_POST['email'];
    $password = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];
    if(isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
        // Get file information
        $fileName = basename($_FILES["profile"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // Check if file is an image
        $allowedTypes = array("jpg", "jpeg", "png", "gif");
        if(!in_array($fileType, $allowedTypes)) {
            echo "<script>alert('File must be an image.');</script>";
            exit;
        }

        // Move uploaded file to designated directory
        $uploadDir = "uploads/";
        $uploadPath = $uploadDir . $fileName;
        if(move_uploaded_file($_FILES["profile"]["tmp_name"], $uploadPath)) {
            // File was uploaded successfully
            // Save file path to database for user profile
            $profilePicPath = $uploadPath;
            // existing code
        } else {
            echo "<script>alert('Error uploading file.');</script>";
            exit;
        }
    }
    $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");
    if(mysqli_num_rows($duplicate)> 0){
        echo 
        "<script>
            alert('Username or email already exists');</script>";
    }else{
        if($password == $confirmPassword){
            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (username, email, password, profile) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $passwordHashed, $fileName);
            $result = mysqli_stmt_execute($stmt);

            echo 
                "<script>
                    alert('Account created successfully');</script>";    
    }else{
             echo 
                "<script>
                    alert('Password does not match');</script>";
        }
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
    
    <title>Create Account</title>
</head>
<body>
<a href = "home.php" class = "button">Home</a>
	<section id="create-account"> 
        <h1>Create Account</h1>

        <form action = "" method = "POST" autocomplete = "off" enctype="multipart/form-data">
            <input type="text" id="new-username" name="new-username" placeholder="Username" required value = ""><br>
            <input type="email" id="email" name="email" placeholder="Email Address" required value = ""><br>
            <input type="file" id="profile" name="profile" accept="image/*"><br>
            <input type="password" id="new-password" name="new-password" placeholder="Password" required value= ""><br>
            <input type = "password" id = "confirm-password" name = "confirm-password" placeholder="Confirm Password" required value = ""><br>
            <button class = "button" type="submit" name="submit">Create Account</button>
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

</body>
<footer>
    <p class = "tos">Terms of Service</p>
    <p class = "tos">About</p>
    <p class = "tos">Contact Us</p>
    <p class = "tos">FAQ</p>
    <p class = "tos">Privacy and Policy</p>
</footer>
</html>