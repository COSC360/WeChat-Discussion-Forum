<?php

include 'connectDB.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $community_name = $_POST['community_name'];
    $description = $_POST['description'];
    $query = "INSERT INTO communities (community_name, description) VALUES ('$community_name', '$description')";
    $result = mysqli_query($conn, $query);

    mysqli_close($conn);
}
?>

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
    <div class = "flex-create">
        <div class = "createPost">
            <h1 style = "color:#A67EF3; font-size: 1.3em;" >Create Community</h1>
            <form class = "createPosts" name = "createPosts" method = "post" action = "createCommunity.php" onsubmit="return(validate());">
                <input type="text" id="community_name" name="community_name" placeholder="Community Name"><br>
                <input type="text" id="description" name="description" placeholder="Description"><br>
                <input type="submit" value="Create" id="postButton">
            </form>
        </div>
</div>
<script src = "scripts/postValidation.js"></script>
</body>
<footer>
    <p class = "tos">Terms of Service</p>
    <p class = "tos">About</p>
    <p class = "tos">Contact Us</p>
    <p class = "tos">FAQ</p>
    <p class = "tos">Privacy and Policy</p>
</footer>
</html>