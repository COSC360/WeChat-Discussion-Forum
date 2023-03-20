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
    <div class="createCommunity">
        <a href="createCommunity.php" class="button">Create Community</a>
    </div>
    <div class="community-container">
        <?php
        include_once 'connectDB.php';

        $query = "SELECT community_id, community_name FROM communities";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="communities">';
            echo '<p style="color:#A67EF3; font-size: 1.6em;">' . $row['community_id'] . '</p>';
            echo '<a href="community.php?community_id=' . $row['community_id'] . '" style="font-size: 1.5em;">' . $row['community_name'] . '</a>';
            echo '<div class="postContainer">';
            echo '<div style="font-size: 1.2em;" class="button">Join</div>';
            echo '</div>';
            echo '</div>';
        }
        
        // close the database connection
        mysqli_close($conn);
        ?>

    </div>
    
</body>
</html>