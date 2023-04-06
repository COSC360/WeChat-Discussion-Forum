<?php
session_start();
if(empty($_SESSION["user_id"])){
    header("Location: login.php");
}
?>
<?php

include 'connectDB.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $community_name = $_POST['community_name'];
    $description = $_POST['description'];
    $query = "INSERT INTO communities (community_name, description) VALUES ('$community_name', '$description')";
    $result = mysqli_query($conn, $query);
    header("Location: home.php");

    mysqli_close($conn);
}
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
        <a href="viewAccount.php" class = "button"> <?php echo $_SESSION["username"]; ?></a> 
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
    <div class = "flex-create">
        <div class = "createPost">
            <h1 style = "color:#A67EF3; font-size: 1.3em;" >Create Community</h1>
            <form class = "createPosts" name = "createPosts" method = "post" action = "createCommunity.php">
                <input type="text" id="community_name" name="community_name" placeholder="Community Name"><br>
                <input type="text" id="description" name="description" placeholder="Description"><br>
                <input type="submit" value="Create" id="postButton">
            </form>
        </div>
</div>
<script src = "scripts/postValidation.js"></script>
<script src = "scripts/alert.js"></script>

</body>
<footer>
    <p class = "tos">Terms of Service</p>
    <p class = "tos">About</p>
    <p class = "tos">Contact Us</p>
    <p class = "tos">FAQ</p>
    <p class = "tos">Privacy and Policy</p>
</footer>
</html>