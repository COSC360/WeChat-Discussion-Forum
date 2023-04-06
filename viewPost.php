<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" href = "css/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://kit.fontawesome.com/41893cf31a.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeChat</title>
</head>
<body>
<div class = "nav">
        <a href="viewAccount.php" class = "button"> <?php if(isset($_SESSION["user_id"])) {echo $_SESSION["username"]; } else {echo "";} ?></a> 
        <a href="createAccount.php" class = "button"> Login</a>
        <div class = "search-container"> 
            <form method = "POST">
                <input type = "text" name = "search" placeholder = "Type here to search..">
                <button type = "submit" name = "submit"> <i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <a href= "#filter" class = "button"><i class="fa-solid fa-filter"></i></a>
        <a href= "home.php" class = "button"><i class="fa-solid fa-house"></i></a>
        <a href= "settings.php" class = "button"><i class="fa-solid fa-gear"></i></a>
        <a href = "logout.php" class = "button">Logout</a>
    </div>
    <?php 
    
    require_once 'connectDB.php';

    //get post_id from parameter
    $post_id = $_GET['post_id'];

    //fetching posts and associated user and community name.
    $query = "SELECT p.*, u.username, u.user_id, c.community_name FROM posts p INNER JOIN users u ON p.created_by = u.user_id 
    INNER JOIN communities c ON p.community_id = c.community_id
    WHERE p.post_id = '$post_id'";

        $result = mysqli_query($conn, $query);
        $post = mysqli_fetch_assoc($result);

   
    $query = "SELECT c.*, u.username, u.user_id FROM comments c INNER JOIN users u ON c.created_by = u.user_id 
    WHERE c.post_id = '$post_id'";

     // check if search query has been submitted
     if(isset($_POST['submit'])) {
        $search = $_POST['search'];
        $query .= " AND (u.username LIKE '%$search%' OR c.content LIKE '%$search%')";
    } 

    $result = mysqli_query($conn, $query);
    $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if(isset($_POST['comment'])) {
        $comment = $_POST['comment'];
        $created_by = $_SESSION['user_id'];
        $created_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO comments (content, created_by, created_at, post_id) VALUES ('$comment', '$created_by', '$created_at', '$post_id')";
        mysqli_query($conn, $query);
        
        header("Location: viewPost.php?post_id=$post_id");
        exit();
    }

    ?>
    <div class = "flex-comment">
        <div class = "createPost">
            <h1 style = "color:#A67EF3; font-size: 1.3em;" ><?php echo $post['community_name']; ?></h1>
            <h2 style = "color: #D9D9D9;"><?php echo $post['title']; ?></h2>
            <h3 style = "color: #D9D9D9;"><?php echo $post['content']; ?></h3>
            <form class = "createcomment" action="viewPost.php?post_id=<?php echo $post_id; ?>" method="post" onsubmit = "return validateComment();">
                <input type="text" id="commentBox" name="comment" placeholder="Comment"><br>
                <input type="submit" value="Comment" id="postButton" style = "background-color: #A67EF3;">
            </form>
        </div>
    </div>
    <div class = "scroll">
        <!-- displaying comments -->
        <?php foreach ($comments as $comment): ?>
    <div class="comment">
    <p style="color:#A67EF3; font-size: .8em;"><a href="viewAccount.php?user_id=<?php echo $comment['user_id']; ?>"><?php echo $comment['username']; ?></a></p>
        <p><?php echo $comment['content']; ?></p>
        <div class="postContainer">
            <div class="postScore"><?php echo $comment['comment_score']; ?></div>
            <div class="upvote" style="cursor: pointer;" comment_id="<?php echo $comment['comment_id']; ?>"><i class="fa-solid fa-arrow-up"></i></div>
            <div class="downvote" style="cursor: pointer;" comment_id="<?php echo $comment['comment_id']; ?>"><i class="fa-solid fa-arrow-down"></i></div>
        </div>
    </div>
    <?php endforeach; ?>
        </div>

        <script>
            //checks if there is content in the comment box
            function validateComment() {
                var commentBox = document.getElementById("commentBox");
                if(commentBox.value.trim() == "") {
                    alert("Enter comment to submit");
                    return false;
                }
                return true;
            }

            // Get the upvote and downvote buttons
    const upvoteButtons = document.querySelectorAll('.upvote');
    const downvoteButtons = document.querySelectorAll('.downvote');

    // Add a click event listener to each upvote button
    upvoteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const comment_id = button.getAttribute('comment_id');
            const scoreElement = button.parentNode.querySelector('.postScore');

            // Make an AJAX call to update the post score
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'updateCommentScore.php');
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
            xhr.send(`comment_id=${comment_id}&vote=up`);
        });
    });

    // Add a click event listener to each downvote button
    downvoteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const comment_id = button.getAttribute('comment_id');
            const scoreElement = button.parentNode.querySelector('.postScore');

            // Make an AJAX call to update the post score
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'updateCommentScore.php');
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
            xhr.send(`comment_id=${comment_id}&vote=down`);
        });
    });
            </script>

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