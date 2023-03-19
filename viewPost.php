<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" href = "css/style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeChat</title>
</head>
<body>
    <div class = "nav">
        <a href="#user" class = "button"> User</a> 
        <a href="createAccount.php" class = "button"> Login</a> 
        <input type = "text" placeholder = "Type here to search..">
        <a href= "#filter" class = "button">Filter</a>
        <a href= "home.php" class = "button">Home</a>
        <a href= "#settings" class = "button">Settings</a>
    </div>
    <?php 
    require_once 'connectDB.php';

    //get post_id from parameter
    $post_id = $_GET['post_id'];

    //fetching posts and associated user and community name.
    $query = "SELECT p.*, u.username, c.community_name FROM posts p INNER JOIN users u ON p.created_by = u.user_id 
    INNER JOIN communities c ON p.community_id = c.community_id
    WHERE p.post_id = '$post_id'";

    $result = mysqli_query($conn, $query);
    $post = mysqli_fetch_assoc($result);

    //fetching comments associated with post_id supplied
    $query = "SELECT c.*, u.username FROM comments c INNER JOIN users u ON c.created_by = u.user_id 
    WHERE c.post_id = '$post_id'";

    $result = mysqli_query($conn, $query);
    $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

    ?>
    <div class = "flex-comment">
        <div class = "createPost">
            <h1 style = "color:#A67EF3; font-size: 1.3em;" ><?php echo $post['community_name']; ?></h1>
            <h2 style = "color: #D9D9D9;"><?php echo $post['title']; ?></h2>
            <h3 style = "color: #D9D9D9;"><?php echo $post['content']; ?></h3>
            <form class = "createcomment">
                <input type="text" id="commentBox" name="comment" placeholder="Comment"><br>
                <input type="submit" value="Comment" id="postButton" style = "background-color: #A67EF3;">
            </form>
        </div>
    </div>
    <div class = "scroll">
        
        <?php foreach ($comments as $comment): ?>
        <div class = "comment">
            <p style = "color:#A67EF3; font-size: .8em;"><?php echo $comment['username']; ?></p>
            <p><?php echo $comment['content']; ?></p>
        </div>
        <?php endforeach; ?>
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