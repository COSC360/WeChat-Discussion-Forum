<?php

require_once 'connectDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the post ID and vote from the request
    $comment_id = mysqli_real_escape_string($conn, $_POST['comment_id']);

    $vote = $_POST['vote'];

    // Update the post score in the database
    if ($vote === 'up') {
        $query = "UPDATE comments SET comment_score = comment_score + 1 WHERE comment_id = '$comment_id'";
    } else if ($vote === 'down') {
        $query = "UPDATE comments SET comment_score = comment_score - 1 WHERE comment_id = '$comment_id'";
    }
    mysqli_query($conn, $query);

    // Return the new score as JSON
    $query = "SELECT CAST(comment_score AS UNSIGNED) as comment_score FROM comments WHERE comment_id = '$comment_id' ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $newScore = $row['comment_score'];
    echo json_encode(['comment_score' => $newScore]);
}

?>
