<?php
include 'connectDB.php';

$query = "SELECT COUNT(*) as count FROM users";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

echo json_encode($data);
?>
