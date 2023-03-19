<!--<?php
    
    session_start();
    require_once 'connectDB.php';
    $user = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id=?");
    $stmt->bind_param("i", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

?>
-->
<!DOCTYPE html>
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
        <a href="viewAccount.php" class = "button"> <i class="fa-solid fa-user"></i></a> 
        <a href="createAccount.php" class = "button"> Login</a> 
        <input type = "text" placeholder = "Type here to search..">
        <a href= "#filter" class = "button"><i class="fa-solid fa-filter"></i></a>
        <a href= "home.php" class = "button"><i class="fa-solid fa-house"></i></a>
        <a href= "settings.php" class = "button"><i class="fa-solid fa-gear"></i></a>
    </div>
<div class = "flex-container">
    <div class = "flex">
        <div class = "createPost">
            <a href="createPost.php" class = "button">Post</a>
        </div>
        <div class = "scroll">
        <div class = "posts" id = "post1">
            <p style = "color:#A67EF3; font-size: .8em;">User3</p>
            <p onclick="redirectToPost();" style = "cursor: pointer;">What are the best restaurants in Kelowna?</p>
            <div class = "postContainer">
            <div class = "postScore">10</div>
            <div class = "upvote" style = "cursor: pointer;"><i class="fa-solid fa-arrow-up"></i></div>
            <div class = "downvote" style = "cursor: pointer;"><i class="fa-solid fa-arrow-down"></i></div>
            <div class = "commentButton" style = "cursor: pointer;" onclick="redirectToPost();"><i class="fa-regular fa-comment"></i></div>
        </div>
        </div>
        <div class = "posts" id = "post2">
            <p style = "color:#A67EF3; font-size: .8em;">ben10lover</p>
            <p onclick="redirectToPost();" style = "cursor: pointer;">How do I center a div using css? </p>
            <div class = "postContainer">
                <div class = "postScore">10</div>
                <div class = "upvote" style = "cursor: pointer;"><i class="fa-solid fa-arrow-up"></i></div>
                <div class = "downvote" style = "cursor: pointer;"><i class="fa-solid fa-arrow-down"></i></div>
                <div class = "commentButton" style = "cursor: pointer;" onclick="redirectToPost();"><i class="fa-regular fa-comment"></i></div>
            </div>    
        </div>
        <div class = "posts" id = "post3" >
            <p style = "color:#A67EF3; font-size: .8em;">carltonw23</p>
            <p onclick="redirectToPost();" style = "cursor: pointer;">Today I woke up, ate breakfast and went to class</p>
            <div class = "postContainer">
                <div class = "postScore">10</div>
                <div class = "upvote" style = "cursor: pointer;"><i class="fa-solid fa-arrow-up"></i></div>
                <div class = "downvote" style = "cursor: pointer;"><i class="fa-solid fa-arrow-down"></i></div>
                <div class = "commentButton" style = "cursor: pointer;" onclick="redirectToPost();"><i class="fa-regular fa-comment"></i></div>
            </div>    
        </div>
        <div class = "posts" id = "post4">
            <p style = "color:#A67EF3; font-size: .8em;">marcuspork</p>
            <p onclick="redirectToPost();" style = "cursor: pointer;">Sunset!</p>
            <img src = "images/19223285_web1_191104-KCN-Sunet-Photos.jpg" alt = "sunset">
            <div class = "postContainer">
                <div class = "postScore">10</div>
                <div class = "upvote" style = "cursor: pointer;"><i class="fa-solid fa-arrow-up"></i></div>
                <div class = "downvote" style = "cursor: pointer;"><i class="fa-solid fa-arrow-down"></i></div>
                <div class = "commentButton" style = "cursor: pointer;" onclick="redirectToPost();"><i class="fa-regular fa-comment"></i></div>
            </div>    
        </div>
        <div class = "posts" id = "post5">
            <p style = "color:#A67EF3; font-size: .8em;">cheeseh8ter</p>
            <p onclick="redirectToPost();" style = "cursor: pointer;">How to improve at Baseball?</p>
            <div class = "postContainer">
                <div class = "postScore">10</div>
                <div class = "upvote" style = "cursor: pointer;"><i class="fa-solid fa-arrow-up"></i></div>
                <div class = "downvote" style = "cursor: pointer;"><i class="fa-solid fa-arrow-down"></i></div>
                <div class = "commentButton" style = "cursor: pointer;" onclick="redirectToPost();"><i class="fa-regular fa-comment"></i></div>
            </div>    
        </div>
        <script>
            function redirectToPost(){
                window.location.href = "viewPost.php";
            }

        </script>
    </div>
    </div>
    <div class = "flex-left"> 
        <div class = "popular">
            <p style = "color:#A67EF3; font-size: 1.3em;" >Popular</p>
            <p>Manchester United</p>
            <p>Call of Duty</p>
            <p>Cats</p>
            <p>Turkey</p>
        </div>
        <div class = "categories">
            <p style = "color:#A67EF3; font-size: 1.3em;" ><a href="community.php" >Communities</a></p>
            <p>Gaming</p>
            <p>Sports</p>
            <p>Nature</p>
            <p>Business</p>
            <p>More...</p>
            <a href="createCommunity.php" class = "button">Create</a>
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