<?php
session_start();
if(isset($_SESSION["user_id"])){

include_once 'connectDB.php';

// Get the user ID from the current session
$user_id = $_SESSION['user_id'];

// Get the community ID from the submitted form data
$community_id = $_POST['community_id'];

$query = "SELECT * FROM user_community WHERE user_id = '$user_id' AND community_id = '$community_id'";
$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result) == 0){
    // Insert a new row into the user_community table

    $query = "INSERT INTO user_community (user_id, community_id) VALUES ('$user_id', '$community_id')";
    mysqli_query($conn, $query);
}

// Close the database connection
mysqli_close($conn);

header("Location: home.php");
}
?>