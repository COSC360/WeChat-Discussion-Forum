<?php
require_once 'connectDB.php';
session_start();
// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Retrieve selected community ID from form submission
$community_id = mysqli_real_escape_string($conn, $_POST['community_id']);

// Check if user is a member of the selected community
$sql = "SELECT COUNT(*) AS count FROM user_community WHERE user_id = $user_id AND community_id = $community_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];

if ($count == 1) {
    // Remove user from community
    $sql = "DELETE FROM user_community WHERE user_id = $user_id AND community_id = $community_id";
    mysqli_query($conn, $sql);
}

// Close database connection
mysqli_close($conn);

// Redirect to remaining communities page
header('Location: home.php');
exit();

?>