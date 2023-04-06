<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" href = "css/style.css">
    <script src="https://kit.fontawesome.com/41893cf31a.js" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeChat</title>
</head>
<body>
<div class = "nav">
        <a href="viewAccount.php" class = "button"><?php if(isset($_SESSION["user_id"])) {echo $_SESSION["username"]; } else {echo "";} ?></a> 
        <a href="createAccount.php" class = "button"> Login</a>
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
    <div class="createCommunity">
        <a href="createCommunity.php" class="button">Create Community</a>
    </div>
    <div class="community-container">
        <?php
        require_once 'connectDB.php';

        if(isset($_GET['community_id'])){
            $community_id = $_GET['community_id'];
        }
        $query = "SELECT community_id, community_name, description FROM communities WHERE community_id = $community_id";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result)) {
        
            echo '<div class="communities">';
            echo '<p style="color:#A67EF3; font-size: 1.6em;">'.$row['community_id'].'</p>';
            echo '<p style="font-size: 1.5em;">'.$row['community_name'].'</p>';
            echo '<div style="color:#A67EF3; font-size: 1.2em;">'.$row['description'].'</div> ';
            echo ' <div class="postContainer">';
            echo '<form method="POST" action="joinCommunity.php">';
            echo '<input type="hidden" name="community_id" value="' . $row['community_id'] . '">';
            echo '<input type = "submit" value = "Join" name = "join" style="font-size: 1.2em;" class="button"</input>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            
        }
        ?> 
    </div> 
    <div class = "flex-container">
        <div class = "flex">
            <div class = "scroll">
            <?php 
            require_once 'connectDB.php';
            require_once "updateScore.php";
            if(isset($_GET['community_id'])) {
                $community_id = $_GET['community_id'];
            } else {
                $community_id = 0;
            }
            $query = "SELECT p.*, u.username, u.user_id, c.community_name FROM posts p 
            INNER JOIN users u ON p.created_by = u.user_id
            INNER JOIN communities c ON p.community_id = c.community_id
            WHERE p.community_id = $community_id";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class = "posts">';
                echo '<div class = "top">';
                echo '<p style="color:#A67EF3; font-size: .8em;"><a href="viewAccount.php?user_id='.$row['user_id'].'">'.$row['username'].'</a></p>';
                echo '<p style = "color:#A67EF3; font-size: .8em;">'.$row['community_name'].'</p>';
                echo '</div>';
                if($row['image'] != null) {
                    echo '<div><img src="postUploads/'.$row['image'].'"></div>';
                }
                echo '<p onclick="redirectToPost('.$row['post_id'].')" style="cursor: pointer;">' . $row['title'] . '</p>';
                echo '<div class="postContainer">';
                echo '<div class="postScore">' . $row['score'] . '</div>';
                echo '<div class="upvote" style="cursor: pointer;" data-postid="' . $row['post_id'] . '"><i class="fa-solid fa-arrow-up"></i></div>';
                echo '<div class="downvote" style="cursor: pointer;" data-postid="' . $row['post_id'] . '"><i class="fa-solid fa-arrow-down"></i></div>';
                echo '<div class="commentButton" style="cursor: pointer;" onclick="redirectToPost('.$row['post_id'].')"><i class="fa-regular fa-comment"></i></div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
            
            <script>
        function redirectToPost(post_id){
            window.location.href = "viewPost.php?post_id="+post_id;
        }
    
        // Get the upvote and downvote buttons
        const upvoteButtons = document.querySelectorAll('.upvote');
        const downvoteButtons = document.querySelectorAll('.downvote');
    
        // Add a click event listener to each upvote button
        upvoteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const postId = button.dataset.postid;
                const scoreElement = button.parentNode.querySelector('.postScore');
    
                // Make an AJAX call to update the post score
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'updateScore.php');
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Update the score in the UI
                        const newScore = JSON.parse(xhr.responseText).newScore;
                        scoreElement.innerHTML = newScore;
                        button.classList.add('active');
                        button.parentNode.querySelector('.downvote').classList.remove('active');
                    } else {
                        console.error('Error updating score');
                    }
                };
                xhr.send(`postId=${postId}&vote=up`);
            });
        });
    
        // Add a click event listener to each downvote button
        downvoteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const postId = button.dataset.postid;
                const scoreElement = button.parentNode.querySelector('.postScore');
    
                // Make an AJAX call to update the post score
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'updateScore.php');
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Update the score in the UI
                        const newScore = JSON.parse(xhr.responseText).newScore;
                        scoreElement.innerHTML = newScore;
                        button.classList.add('active');
                        button.parentNode.querySelector('.upvote').classList.remove('active');
                    } else {
                        console.error('Error updating score');
                    }
                };
                xhr.send(`postId=${postId}&vote=down`);
            });
        });
    </script>
        </div>
        </div>
</body>
</html>