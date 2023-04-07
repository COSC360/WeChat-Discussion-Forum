<?php
session_start();
?>

<!-- php code for search functionality -->
<?php 
require_once 'connectDB.php';

if(isset($_GET['submit'])) {
$search_term = mysqli_real_escape_string($conn, $_GET['search']);
//query that checks search term using LIKE
$query = "SELECT p.*, u.username, c.community_name FROM posts p 
INNER JOIN users u ON p.created_by  = u.user_id
INNER JOIN communities c on p.community_id = c.community_id
WHERE p.title LIKE '%$search_term%'
OR c.community_name LIKE '%$search_term%'
OR u.username LIKE '%$search_term%'";
} else {
//query to show all posts
$query = "SELECT p.*, u.username, c.community_name FROM posts p 
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeChat</title>
</head>
<body>
<div class = "nav">
        <img src = "images/navLogo.jpg" alt = "logo" class = "logo">
        <?php  require_once 'connectDB.php';
            $query = 'SELECT isAdmin, user_id FROM users WHERE isAdmin = 1';
            $res = mysqli_query($conn, $query);
            if(isset($_SESSION["user_id"])) {
            while ($rw = mysqli_fetch_assoc($res) ) {
                $admin = $rw['user_id'];
            if (($_SESSION["user_id"] == $admin)) {
                echo '<a href = "admin.php" class = "button" style = "color: #fbeee0;">Admin</a>'; 
                } 
            }}?>  
                    <button id="UserStatistics" class = "button"><i class="fas fa-chart-bar fa-lg"></i></button>
                    <script>
                        const userStatsButton = document.getElementById("UserStatistics");
                        userStatsButton.addEventListener("click", function() {
                        window.location.href = "adminGraph.php";
                        });
                    </script>

        <div class = "search-container"> 
            <form method = "GET">
                <input type = "text" name = "search" placeholder = "Type here to search..">
                <button type = "submit" name = "submit"> <i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <a href= "#filter" class = "button"><i class="fa-solid fa-filter"></i></a>
        <a href= "home.php" class = "button"><i class="fa-solid fa-house"></i></a>
        <a href= "settings.php" class = "button"><i class="fa-solid fa-gear"></i></a>
        <a href = "logout.php" class = "button">Logout</a>
        

    </div>

<div class = "flex-container">
    <div class = "flex">
        <div class = "scroll">
        <?php 
        
        while ($row = mysqli_fetch_assoc($result)) {
            $community_name = $row['community_name'];
            $community_id = $row['community_id'];
            $title = $row['title'];
            $post_id = $row['post_id'];
            echo '<div class = "posts">';
            echo '<div class = "top">';
            echo '<p style = "color:#A67EF3; font-size: .8em;">'.$row['username'].'</p>';
            echo '<p style = "color:#A67EF3; font-size: .8em;"><a href = "community.php?community_id='.$community_id.'">'.$community_name.'</a></p>';
            echo '</div>';
            echo '<a href="viewPost.php?post_id='.$post_id.'">'.$title.'</a>';
            echo '<div class="postContainer">';
            echo '<a href="viewPost.php?post_id='.$post_id.'" class="commentButton" style="cursor: pointer;"><i class="fa-regular fa-comment"></i></a>';
            echo '<form method="post" action="deletePost.php" style ="margin-left: 1em;" class="deleteForm">';
            echo '<input style ="margin-left: 1em;" type="hidden" name="post_id" value="'.$post_id.'">';
            echo '<button type="submit" class="deleteButton"><i style=" color: #A67EF3; " class="fa-solid fa-trash"></i></button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
    </div>
    <div class = "flex-left"> 
        <div class = "popular">
            <?php 
            require_once 'connectDB.php';
            if(isset($_POST['submit'])){
                $search_term = mysqli_real_escape_string($conn, $_POST['search']);
                $query = "SELECT username, email, user_id FROM users WHERE username LIKE '%$search_term%' 
                OR email LIKE '%$search_term%' LIMIT 4";
            } else { 
                $query = 'SELECT username, user_id FROM users LIMIT 4';
            }
            $result = mysqli_query($conn, $query);
            echo '<p style = "color:#A67EF3; font-size: 1.3em;" >Users</p>';
            echo '<div class = "search-container">';
            echo '<form method = "POST">';
                echo '<input type = "text" name = "search" placeholder = "Search users..">';
                echo '<button type = "submit" name = "submit"> <i class="fa-solid fa-magnifying-glass"></i></button>';
            echo '</form>';
            echo '</div>';
            while($row = mysqli_fetch_assoc($result)) {
            $username = $row['username'];
            $user_id = $row['user_id'];
            echo '<div style = "display: flex; align-items: center;">';
            echo '<form method="post" action="deleteUser.php" style ="margin-left: 1em;" class="deleteForm">';
            echo '<input  type="hidden" name="user_id" value="'.$user_id.'">';
            echo '<button type="submit" class="deleteButton" style = "display: inline-block;" ><i style=" color: #A67EF3; " class="fa-solid fa-trash"></i></button>';
            echo '<p style = "display: inline-block; margin-left:1.6em;">'.$username.'</p>';
            echo '</form>';
            echo '</div>';
            }
             ?>
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
            echo '<p><a href = "community.php?community_id='.$community_id.'">'.$community_name.'</a></p>';
            }
        } else {
            echo '<p> Login To Join Communities </p>';
        }
             ?>
        </div>
      
    </div>
</div>
<script src = "scripts/script.js"></script>
</body>
<footer>
    <p class = "tos">Terms of Service</p>
    <p class = "tos">About</p>
    <p class = "tos">Contact Us</p>
    <p class = "tos">FAQ</p>
    <p class = "tos">Privacy and Policy</p>
</footer>
</html>