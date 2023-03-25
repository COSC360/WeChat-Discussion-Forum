<?php
require_once 'connectDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = mysqli_real_escape_string($conn, $_POST['post_id']);

    $stmt = $conn->prepare("DELETE FROM comments WHERE post_id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $stmt->close();
    // Delete post from the database
    $stmt = $conn->prepare("DELETE FROM posts WHERE post_id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $stmt->close();
    // Redirect to the homepage
    header('Location: admin.php');
    exit();
}
?>