<?php

session_start();
if(empty($_SESSION["user_id"])){
    header("Location: login.php");
}


include 'connectDB.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $community = $_POST['community'];
    $description = $_POST['description'];
    $username = $_SESSION['user_id'];
    //user id is placeholder for the user_id of poster
    $query = "INSERT INTO posts (title, content, created_by, community_id) VALUES (?,?,?,?)";
    $stmt = mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($stmt, "ssii", $title, $description, $username, $community);
    $result = mysqli_stmt_execute($stmt);

    mysqli_close($conn);
}
?>

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
            <h1 style = "color:#A67EF3; font-size: 1.3em;" >Create Post</h1>
            <form class = "createPosts" name = "createPosts" method = "post" action = "createPost.php" onsubmit="return(validate());">
                <input type="text" id="title" name="title" placeholder="Title"><br>
                <select id="community" name="community">
        <option value="">Choose Community</option>
        <?php
            // Connect to the database
            include 'connectDB.php';
            
            // Get all communities from the database
            $query = "SELECT * FROM communities";
            $result = mysqli_query($conn, $query);
            
            // Loop through each community and create an option element for the select element
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['community_id'] . "'>" . $row['community_name'] . "</option>";
            }
            
            // Close the database connection
            mysqli_close($conn);
        ?>
    </select><br>
                <input type="text" id="description" name="description" placeholder="Description (optional)"><br>
                <input type="image" name="image" id="image" alt ="Add image"/><br>
                <input type="submit" value="Post" id="postButton">
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