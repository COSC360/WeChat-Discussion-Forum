<?php
include 'connectDB.php';

$sql = "SELECT * FROM users WHERE user_id = 1"; // replace 1 with the actual user id you want to retrieve

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}

// Fetch the user information
$user = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($conn);
?>

<!-- HTML code to display the user information -->
<div>
  <h2>User Settings</h2>
  <p>Username: <?php echo $user['username']; ?></p>
  <p>Email: <?php echo $user['email']; ?></p>
  <!-- Add more user information here -->
</div>

