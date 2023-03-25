<?php
session_start();
require_once 'connectDB.php';
if (isset($_POST['username']) && isset($_POST['oldpassword']) && isset($_POST['newpassword']) && isset($_POST['newpassword-check'])) {
$username = $_POST['username'];
$oldpassword = $_POST['oldpassword'];
$newpassword = $_POST['newpassword'];
$password_confirm = $_POST['newpassword-check'];

if ($newpassword != $password_confirm) {
    // Passwords do not match, display an error message
    echo "Error: Passwords do not match.";
    exit;
}

$stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
$stmt->bind_param("ss", $username, $oldpassword);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // Invalid username/password combination, display an error message
    echo "Error: Invalid username or password.";
    exit;
}

$stmt = $conn->prepare("UPDATE users SET password=? WHERE username=?");
$stmt->bind_param("ss", $newpassword, $username);
$stmt->execute();

echo "<script>alert('Password updated successfully.');</script>";
header("Location: login.php");
exit;
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
<a href= "home.php" class = "button">Home</a>
<a href = "logout.php" class = "button">Logout</a>
	<h1>User Settings</h1>
	<form method = "POST" action= "settings.php">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" placeholder="Username" required>
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
