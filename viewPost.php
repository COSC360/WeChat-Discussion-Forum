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
            <?php if($post['image'] != null) {
                echo '<div><img src="postUploads/'.$post['image'].'"></div>';
            }?>
            <h2 style = "color: #D9D9D9;"><?php echo $post['title']; ?></h2>
            <h3 style = "color: #D9D9D9;"><?php echo $post['content']; ?></h3>
            <form class = "createcomment" action="viewPost.php?post_id=<?php echo $post_id; ?>" method="post" onsubmit = "return validateComment();">
                <input type="text" id="commentBox" name="comment" placeholder="Comment"><br>
                <input type="submit" value="Comment" id="postButton" style = "background-color: #A67EF3;">
            </form>
        </div>
    </div>

   
     <!-- displaying comments -->
<div class="commentContainer">
  <?php foreach ($comments as $comment): ?>
  <div class="comment">
    <div class="commentHeader">
      <p style="color:#A67EF3; font-size: .8em;">
        <a href="viewAccount.php?user_id=<?php echo $comment['user_id']; ?>"><?php echo $comment['username']; ?></a>
      </p>
      <button class="toggleComment">Hide</button>
    </div>
    <div class="commentContent">
      <p><?php echo $comment['content']; ?></p>
      <div class="postContainer">
        <div class="postScore"><?php echo $comment['comment_score']; ?></div>
        <div class="upvote" style="cursor: pointer;" comment_id="<?php echo $comment['comment_id']; ?>"><i class="fa-solid fa-arrow-up"></i></div>
        <div class="downvote" style="cursor: pointer;" comment_id="<?php echo $comment['comment_id']; ?>"><i class="fa-solid fa-arrow-down"></i></div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<script>
  const toggleButtons = document.querySelectorAll('.toggleComment');
  toggleButtons.forEach(button => {
    button.addEventListener('click', () => {
      const comment = button.parentNode.parentNode;
      const content = comment.querySelector('.commentContent');
      content.classList.toggle('hidden');
      button.textContent = content.classList.contains('hidden') ? 'Show' : 'Hide';
    });
  });
</script>

<style>
  .hidden {
    display: none;
  }
</style>
        

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
            </script>
            <script src = "scripts/asyncComments.js"></script>
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