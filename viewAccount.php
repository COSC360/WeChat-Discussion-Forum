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
	<link rel="stylesheet" href="css/style.css">
	

	<script src="https://kit.fontawesome.com/41893cf31a.js" crossorigin="anonymous"></script>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>

<body>
<!-- USER ID RETRIEVAL -------------------->
<?php 
require_once 'connectDB.php';
//getting user_id
if(isset($_GET['user_id'])) {
    // use the user ID from the URL instead of the session user ID
    $user_id = $_GET['user_id'];
} else {
    // use the session user ID if no user ID is specified in the URL
    $user_id = $_SESSION['user_id'];
}
?>

<!-- NAV -------------------->
<div class = "nav">
        <img src = "images/navLogo.jpg" alt = "logo" class = "logo">
        <?php if(isset($_SESSION["user_id"])) { ?>
        <a href="viewAccount.php" class="button" style = "color: #fbeee0;"><?php echo $_SESSION["username"]; ?></a>
        <?php } else { ?>
        <a href="createAccount.php" class="button">Login</a>
        <?php } ?>
        <?php  require_once 'connectDB.php';
            $query = 'SELECT isAdmin, user_id FROM users WHERE isAdmin = 1';
            $res = mysqli_query($conn, $query);
            if(isset($_SESSION["user_id"])) {
            while ($rw = mysqli_fetch_assoc($res) ) {
                $admin = $rw['user_id'];
            if (($_SESSION["user_id"] == $admin)) {
                echo '<a href = "admin.php" class = "button">Admin</a>'; 
                } 
            }}?>  
        <div class = "search-container"> 
            <form method = "GET">
                <input type = "text" name = "search" placeholder = "Type here to search..">
                <button type = "submit" name = "submit"> <i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <a href= "home.php" class = "button"><i class="fa-solid fa-house"></i></a>
        <a href= "settings.php" class = "button"><i class="fa-solid fa-gear"></i></a>
        <a href = "logout.php" class = "button">Logout</a>
    	</div>
<!-- END-NAV -------------------->

		<?php
			if (isset($_GET['user_id'])) {
				$user_id = $_GET['user_id'];
				// Retrieve information for the specified user
				$sql = "SELECT username, created_at, profile FROM users WHERE user_id = $user_id";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$username = $row['username'];
				$created_at = $row['created_at'];
				$profile_pic = $row['profile'];
				// Format the account creation date as a human-readable date
				$join_date = date('F Y', strtotime($created_at));
			} else {
				// Retrieve information for the logged-in user
				$user_id = $_SESSION['user_id'];
				$sql = "SELECT username, created_at, profile FROM users WHERE user_id = $user_id";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$username = $row['username'];
				$created_at = $row['created_at'];
				$profile_pic = $row['profile'];
				// Format the account creation date as a human-readable date
				$join_date = date('F Y', strtotime($created_at));
				
			}
		?>


<!-- POST QUERIES -------------------->
		<?php 
require_once 'connectDB.php';
require_once "updateScore.php";

if(isset($_GET['submit'])) {
$search_term = mysqli_real_escape_string($conn, $_GET['search']);
//query that checks search term using LIKE
$query = "SELECT p.*, u.username, u.user_id, c.community_name FROM posts p 
INNER JOIN users u ON p.created_by  = u.user_id
INNER JOIN communities c on p.community_id = c.community_id
WHERE (p.title LIKE '%$search_term%'
OR c.community_name LIKE '%$search_term%')
AND p.created_by = $user_id";
} else {
//query to show all posts
$query = "SELECT p.*, u.username, u.user_id, c.community_name FROM posts p 
INNER JOIN users u ON p.created_by = u.user_id
INNER JOIN communities c ON p.community_id = c.community_id
WHERE p.created_by = $user_id";
}
$result = mysqli_query($conn, $query);
?>
<body>
    
<!-- END POST QUERIES -------------------->


<!-- DISPLAY POSTS -------------------->
<div class = "flex-container">
    <div class = "flex">
	<h1 style='color:#A67EF3;'>Posts</h1>
        <div class = "scroll">
        <?php 
        while ($row = mysqli_fetch_assoc($result)) {
            $community_name = $row['community_name'];
            $community_id = $row['community_id'];
            $title = $row['title'];
            $post_id = $row['post_id'];
            $image = $row['image'];
            echo '<div class = "posts">';
            echo '<div class = "top">';
            echo '<p style="color:#A67EF3; font-size: .8em;"><a href="viewAccount.php?user_id='.$row['user_id'].'">'.$row['username'].'</a></p>';
            echo '<p style = "color:#A67EF3; font-size: .8em;"><a href = "community.php?community_id='.$community_id.'">'.$community_name.'</a></p>';
            echo '</div>';
            if($row['image'] != null) {
                echo '<div><img src="postUploads/'.$image.'"></div>';
            }
            echo '<a href="viewPost.php?post_id='.$post_id.'">'.$title.'</a>';
            echo '<div class="postContainer">';
            echo '<div class="postScore">' . $row['score'] . '</div>';
            echo '<a href="viewPost.php?post_id='.$post_id.'" class="commentButton" style="margin-left: 1em;cursor: pointer;"><i class="fa-regular fa-comment"></i></a>';
            echo '</div>';
            echo '</div>';
        }
        ?>
        
        <script>
    function redirectToPost(post_id){
        window.location.href = "viewPost.php?post_id="+post_id;
    }
    </script>
	<!-- END DISPLAY POSTS -------------------->

    	</div> <!-- closes scroll --->
    </div> <!-- closes flex --->


	<!-- USER INFO -------------------->
    <div class = "flex-left"> 
	<h1 style='color:#A67EF3;'>Info</h1>
        <div class = "popular">
		
		<?php
			if (isset($_GET['user_id'])) {
				$user_id = $_GET['user_id'];
				// Retrieve information for the specified user
				$sql = "SELECT username, created_at, profile FROM users WHERE user_id = $user_id";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$username = $row['username'];
				$created_at = $row['created_at'];
				$profile_pic = $row['profile'];
				// Format the account creation date as a human-readable date
				$join_date = date('F Y', strtotime($created_at));
				echo '<div>';
				echo '<p style="color:#A67EF3; font-size: 2em;">'. $username. '</p>';
				echo '<img src="uploads/'. $profile_pic.'" alt="Profile Picture" style="max-width: 200px;">';
				echo '<p><strong>Joined:</strong>'.$join_date.'</p>';
				echo '</div>';
			} else {
				// Retrieve information for the logged-in user
				$user_id = $_SESSION['user_id'];
				$sql = "SELECT username, created_at, profile FROM users WHERE user_id = $user_id";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$username = $row['username'];
				$created_at = $row['created_at'];
				$profile_pic = $row['profile'];
				// Format the account creation date as a human-readable date
				$join_date = date('F Y', strtotime($created_at));
				// Display the logged-in user's information
				echo '<div>';
				echo '<p style="color:#A67EF3; font-size: 2em;">'. $username. '</p>';
				echo '<img src="uploads/'. $profile_pic.'" alt="Profile Picture" style="max-width: 200px;">';
				echo '<p><strong>Joined:</strong>'.$join_date.'</p>';
				echo '</div>';
			}
		?>
		<!-- END USER INFO -------------------->

        </div>
        <div class = "categories">
            <p style = "color:#A67EF3; font-size: 1.3em;" ><a href="communityList.php" >Communities</a></p>
            <?php 
            require_once 'connectDB.php';
            if(isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $query = "SELECT c.community_name, u.community_id FROM communities c JOIN user_community u ON c.community_id = u.community_id WHERE u.user_id = '$user_id' LIMIT 7";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)) {
            $community_id = $row['community_id'];
            $community_name = $row['community_name'];
            echo '<form method="post" action="leaveCommunity.php">';
            echo '<input type="hidden" name="community_id" value="'.$community_id.'">';
            echo '<button type="submit" class="deleteButton" style="display: inline-block;"><i style="color: red; background: none;" class="fa-solid fa-sign-out"></i></button>';
            echo '<p style="display: inline-block; margin-left: 1em;"><a href="community.php?community_id='.$community_id.'">'.$community_name.'</a></p>';
            echo '</form>';
            }
        } else {
            echo '<p> Login To Join Communities </p>';
        }
             ?>
            <a href="createCommunity.php" class = "button">Create</a>
        </div>
      
    </div> <!-- this closes flex left -->

	<div class = "flex-right"> 
	<h1 style='color:#A67EF3;'>Comments</h1>
        <div class = "popularAdmin">
			<div class = "scroll">
		<?php
			// Get the comments for the current post
		  //Retrieve user's comments from the database
		  if(isset($_GET['user_id'])) {
			// use the user ID from the URL instead of the session user ID
			$user_id = $_GET['user_id'];
		} else {
			// use the session user ID if no user ID is specified in the URL
			$user_id = $_SESSION['user_id'];
		}
		  $sql = "SELECT comments.content, posts.title, posts.post_id, communities.community_name 
				  FROM comments 
				  JOIN posts ON comments.post_id = posts.post_id 
				  JOIN communities ON posts.community_id = communities.community_id 
				  WHERE comments.created_by = $user_id";
		  
		  $result = mysqli_query($conn, $sql);
		  
		  // Display user's comments on the page
		  
		  while ($row = mysqli_fetch_assoc($result)) {
			  $content = $row['content'];
			  $post_title = $row['title'];
			  $post_id = $row['post_id'];
			  $community_name = $row['community_name']; 
            echo '<a href="viewPost.php?post_id='.$post_id.'">'.$post_title.'</a>';
            echo '<p>'.$content.'</p>';
			echo '<hr>';
		  }
		?>
		</div>

        </div>
      
    </div> <!-- this closes flex right -->
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
