<?php
require 'connectDB.php';
session_start();
if(empty($_SESSION["user_id"])){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/viewAcc.css">

	<script src="https://kit.fontawesome.com/41893cf31a.js" crossorigin="anonymous"></script>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>

<body>
	<div class="nav">
        <a href="viewAccount.php" class="button"><i class="fa-solid fa-user"></i></a> 
        <input type="text" placeholder="Type here to search..">
        <a href="#filter" class="button"><i class="fa-solid fa-filter"></i></a>
        <a href="home.php" class="button"><i class="fa-solid fa-house"></i></a>
        <a href="settings.php" class="button"><i class="fa-solid fa-gear"></i></a>
        <a href="logout.php" class="button">Logout</a>
    </div>

	<div class="container">
		<?php
			// Retrieve user's username and account creation date from the database
			$user_id = $_SESSION['user_id'];
			$sql = "SELECT username, created_at, profile FROM users WHERE user_id = $user_id";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			$username = $row['username'];
			$created_at = $row['created_at'];
			$profile_pic = $row['profile'];

			// Format the account creation date as a human-readable date
			$join_date = date('F Y', strtotime($created_at));
		?>

		<h1 style ="color:#A67EF3;">Hello <?php echo $username; ?>! Here is your overview...</h1>

		<div class="user-info">
			<p style="color:#A67EF3; font-size: 1.3em;">u; <?php echo $username; ?></p>
			<img src="uploads/<?php echo $profile_pic; ?>" alt="Profile Picture">
			<p><strong>Joined:</strong> <?php echo $join_date; ?></p>
		</div>

        <div class="communities">
			<?php
				// Retrieve user's communities from the database
				$user_id = $_SESSION['user_id'];
				$sql = "SELECT communities.community_name FROM user_community
						JOIN communities ON user_community.community_id = communities.community_id
						WHERE user_community.user_id = $user_id";
				$result = mysqli_query($conn, $sql);
			?>

			<p style="color:#A67EF3; font-size: 1.3em;">My Communities:</p>

			<?php
				// Display user's communities on the page
				while ($row = mysqli_fetch_assoc($result)) {
					$community_name = $row['community_name'];
					echo "<p>c; $community_name</p>";
				}
			?>
		</div>
		
		<div class="user-posts">
		<h2 style="color:#A67EF3; font-size: 1.3em;">My Posts: </h2>
			<input type="text" name = "search" placeholder="Search for posts and comments">
            <?php 
require_once 'connectDB.php';
require_once "updateScore.php";

// get user's ID from session
$user_id = $_SESSION['user_id'];

if(isset($_GET['submit'])) {
    $search_term = mysqli_real_escape_string($conn, $_GET['search']);
    //query that checks search term using LIKE
    $query = "SELECT p.*, u.username, c.community_name FROM posts p 
    INNER JOIN users u ON p.created_by = u.user_id
    INNER JOIN communities c ON p.community_id = c.community_id
    WHERE (p.title LIKE '%$search_term%'
    OR c.community_name LIKE '%$search_term%'
    OR u.username LIKE '%$search_term%')
    AND p.created_by = $user_id";
} else {
    //query to show all posts
    $query = "SELECT p.*, u.username, c.community_name FROM posts p 
    INNER JOIN users u ON p.created_by = u.user_id
    INNER JOIN communities c ON p.community_id = c.community_id
    WHERE p.created_by = $user_id";
}

$result = mysqli_query($conn, $query);

// loop through posts and display them
while($row = mysqli_fetch_assoc($result)) {
    $post_id = $row['post_id'];
    $title = $row['title'];
    $community = $row['community_name'];
    $actions = "<a href='#'>Comment</a>
                <a href='#'>Share</a>
                <a href='#'>Save</a>";

    echo "<div class='posts'>
            <h3>$title</h3>
            <p>c; $community</p>
            <div class='post-actions'>
                $actions
            </div>
          </div>";
}
?>
		
			


			

			
		</div>

	</div>
	<div class = user-comments>
	<h2 style="color:#A67EF3; font-size: 1.3em;">My Comments: </h2>
	<?php
		  // Get the comments for the current post
		  //Retrieve user's comments from the database
		  $user_id = $_SESSION['user_id'];
		  $sql = "SELECT comments.content, posts.title, communities.community_name 
				  FROM comments 
				  JOIN posts ON comments.post_id = posts.post_id 
				  JOIN communities ON posts.community_id = communities.community_id 
				  WHERE comments.created_by = $user_id";
		  
		  $result = mysqli_query($conn, $sql);
		  
		  // Display user's comments on the page
		  
		  while ($row = mysqli_fetch_assoc($result)) {
			  $content = $row['content'];
			  $post_title = $row['title'];
			  $community_name = $row['community_name'];
		  
			  echo "<div class='comments'>
					  <h3>$post_title</h3>
					  <p>c; $community_name</p>
					  <p>$content</p>
					</div>";
		  }



?>
</div>
</body>
<footer>
    <p class = "tos">Terms of Service</p>
    <p class = "tos">About</p>
    <p class = "tos">Contact Us</p>
    <p class = "tos">FAQ</p>
    <p class = "tos">Privacy and Policy</p>
</footer>

</html>
