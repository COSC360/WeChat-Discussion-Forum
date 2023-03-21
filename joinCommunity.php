<?php
session_start();
if(isset($_SESSION["user_id"])){

include_once 'connectDB.php';

// Get the user ID from the current session
$user_id = $_SESSION['user_id'];

// Get the community ID from the submitted form data
$community_id = $_POST['community_id'];

// Insert a new row into the user_community table
$query = "INSERT INTO user_community (user_id, community_id) VALUES ('$user_id', '$community_id')";
mysqli_query($conn, $query);

// Close the database connection
mysqli_close($conn);

header("Location: community.php");
}
?>