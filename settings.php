<?php
session_start();
require_once 'connectDB.php';

if (isset($_POST['oldpassword'])) {
    $username = $_SESSION['username'];
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $password_confirm = $_POST['newpassword-check'];
    $newusername = $_POST['newusername'];

    if (!empty($newusername)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s", $newusername);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Username already exists, display an error message
            echo "Error: Username already exists.";
            exit;
        }

        // Update the username in the database
        $stmt = $conn->prepare("UPDATE users SET username=? WHERE username=?");
        $stmt->bind_param("ss", $newusername, $username);
        $stmt->execute();
        $_SESSION['username'] = $newusername;
    }

    if (!empty($newpassword) && $newpassword == $password_confirm) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($oldpassword, $user['password'])) {
            // Old password matches, update the password in the database
            $new_password_hashed = password_hash($newpassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET password=? WHERE username=?");
            $stmt->bind_param("ss", $new_password_hashed, $username);
            $stmt->execute();
            echo "<script>alert('Password updated successfully.');</script>";
        } else {
            // Old password does not match, display an error message
            echo "Error: Old password is incorrect.";
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Settings</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/settings.css">
</head>
<body>
<a href="home.php" class="button">Home</a>
<a href="logout.php" class="button">Logout</a>
<h1>User Settings</h1>
<form method="POST" action="settings.php">
    <img src="images/navLogo.jpg" alt="logo" class="logo">
    <label for="newusername">New Username:</label>
    <input type="text" id="newusername" name="newusername" placeholder="New Username">
		<label for="oldpassword">Old Password:</label>
		<input type="password" id="oldpassword" name="oldpassword" placeholder="Old Password" required>
    <label for="newpassword">New Password:</label>
		<input type="password" id="newpassword" name="newpassword" placeholder="New Password" required>
    <label for="newpassword">Re-enter New Password:</label>
		<input type="password" id="password-check" name="newpassword-check" placeholder="Re-enter New Password" required>
		
		<!-- <label for="theme">Select Theme:</label>
		<select id="theme" name="theme">
			<option value="light">Light</option>
			<option value="dark">Dark</option>
		</select> -->
		<input type="submit" value="Save">
	</form>
</body>
</html>
