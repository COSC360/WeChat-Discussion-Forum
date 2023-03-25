<?php
require_once 'connectDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    // Delete post and comments associated to user from the database
    $stmt = $conn->prepare("DELETE FROM comments WHERE created_by = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
    //posts
    $stmt = $conn->prepare("DELETE FROM posts WHERE created_by = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();

    //Delete User
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
    // Redirect to the homepage
    header('Location: admin.php');
    exit();
}
?>