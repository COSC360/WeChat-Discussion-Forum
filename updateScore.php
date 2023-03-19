<?php

require_once 'connectDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the post ID and vote from the request
    $postId = $_POST['postId'];
    $vote = $_POST['vote'];

    // Update the post score in the database
    if ($vote === 'up') {
        $query = "UPDATE posts SET score = score + 1 WHERE post_id = $postId";
    } else if ($vote === 'down') {
        $query = "UPDATE posts SET score = score - 1 WHERE post_id = $postId";
    }
    mysqli_query($conn, $query);

    // Return the new score as JSON
    $query = "SELECT score FROM posts WHERE post_id = $postId";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $newScore = $row['score'];
    echo json_encode(['newScore' => $newScore]);
}

?>
