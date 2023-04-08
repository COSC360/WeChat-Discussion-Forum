<?php
session_start();
?>

<!-- php code for search functionality -->
<?php 
require_once 'connectDB.php';
require_once "updateScore.php";

if(isset($_GET['submit'])) {
$search_term = mysqli_real_escape_string($conn, $_GET['search']);
//query that checks search term using LIKE
$query = "SELECT p.*, u.username, u.user_id, c.community_name FROM posts p 
INNER JOIN users u ON p.created_by  = u.user_id
INNER JOIN communities c on p.community_id = c.community_id
WHERE p.title LIKE '%$search_term%'
OR c.community_name LIKE '%$search_term%'
OR u.username LIKE '%$search_term%'";
} else {
//query to show all posts
$query = "SELECT p.*, u.username, u.user_id, c.community_name FROM posts p 
INNER JOIN users u ON p.created_by = u.user_id
INNER JOIN communities c ON p.community_id = c.community_id";
}
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" href = "css/style.css">
    <script src="https://kit.fontawesome.com/41893cf31a.js" crossorigin="anonymous"></script>
    <link rel="icon" href="images/logo.jpg">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeChat</title>
</head>
<body>
    <div class = "nav">
        <img src = "images/navLogo.jpg" alt = "logo" class = "logo">
        <?php if(isset($_SESSION["user_id"])) { ?>
        <a href="viewAccount.php" class="button"><?php echo $_SESSION["username"]; ?></a>
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
        <a href= "home.php" class = "button" style = "color: #fbeee0;"><i class="fa-solid fa-house"></i></a>
        <a href= "settings.php" class = "button"><i class="fa-solid fa-gear"></i></a>
        <a href = "logout.php" class = "button">Logout</a>
    </div>

<div class = "flex-container">
    <div class = "flex">
        <div >
            <a href="createPost.php" class = "button" style= "font-size: 1.6em; margin-top: 2em; margin-bottom: 0.5em;">Create Post</a>
        </div>
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
            echo '<button class="upvote" style="cursor: pointer; background-color:transparent; border:none;" data-postid="' . $row['post_id'] . '"><i class="fa-solid fa-arrow-up"></i></button>';
            echo '<button class="downvote" style="cursor: pointer; background-color:transparent; border:none;" data-postid="' . $row['post_id'] . '"><i class="fa-solid fa-arrow-down"></i></button>';
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
    </div>
    </div>
    <div class = "flex-left"> 
        <div class = "popular">
            <?php 
            require_once 'connectDB.php';
            $query = 'SELECT c.community_name, u.community_id, COUNT(u.user_id)as numJoined FROM communities c JOIN user_community u
             ON c.community_id = u.community_id GROUP BY c.community_id ORDER BY numJoined DESC
            LIMIT 5';
            $result = mysqli_query($conn, $query);
            echo '<p style = "color:#A67EF3; font-size: 1.3em;" >Top Communities</p>';
            while($row = mysqli_fetch_assoc($result)) {
            $community_id = $row['community_id'];
            $community_name = $row['community_name'];
            echo '<p><a href = "community.php?community_id='.$community_id.'">'.$community_name.'</a></p>';
            }
             ?>
        </div>
        <div class = "categories">
            <p style = "color:#A67EF3; font-size: 1.3em;" >Communities</p>
            <!-- <a href="communityList.php" >Communities</a></p> -->
            
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
            echo '<button type="submit" class="deleteButton1" style="display: inline-block;"><i style="color: red; background: none;" class="fa-solid fa-sign-out"></i></button>';
            echo '<p style="display: inline-block; margin-left: 1em;"><a href="community.php?community_id='.$community_id.'">'.$community_name.'</a></p>';
            echo '</form>';
            }
        } else {
            echo '<p> Login To Join Communities </p>';
        }
             ?>
            <a href="createCommunity.php" class = "button">Create</a>
            <a href="communityList.php" class = "button">Join</a>

        </div>
      
    </div>
</div>
<script src = "scripts/script.js"></script>
<script src = "scripts/async.js"></script>

</body>
<footer>
    <p class = "tos">Terms of Service</p>
    <p class = "tos">About</p>
    <p class = "tos">Contact Us</p>
    <p class = "tos">FAQ</p>
    <p class = "tos">Privacy and Policy</p>
</footer>
</html>