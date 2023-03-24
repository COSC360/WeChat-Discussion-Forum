<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User Overview</title>
	<link rel="stylesheet" href="css/viewAcc.css">
	<script src="https://kit.fontawesome.com/41893cf31a.js" crossorigin="anonymous"></script>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
   
</head>
<body>
	<div class = "nav">
        <a href="viewAccount.php" class = "button"> <i class="fa-solid fa-user"></i></a> 
        <a href="createAccount.php" class = "button"> Login</a> 
        <input type = "text" placeholder = "Type here to search..">
        <a href= "#filter" class = "button"><i class="fa-solid fa-filter"></i></a>
        <a href= "home.php" class = "button"><i class="fa-solid fa-house"></i></a>
        <a href= "settings.php" class = "button"><i class="fa-solid fa-gear"></i></a>
        <a href = "logout.php" class = "button">Logout</a>
    </div>
	<div class="container">
		<h1>Hello ben10lover! Here is your overview...</h1>
		<div class="user-info">
            <p style = "color:#A67EF3; font-size: 1.3em;" >u; ben10lover</p>
			<p><strong>Joined:</strong> May 2022</p>
			<p><strong>Score:</strong> 1000</p>
			<p><strong>Status:</strong> Active</p>
		</div>
        <div class = "communities">
            <p style = "color:#A67EF3; font-size: 1.3em;" >My Communities:</p>
            <p>c; Kelowna</p>
            <p>c; Jeans</p>
            <p>c; Cats </p>
        </div>
	</div>
    
        
		<div class="user-posts"> 
			<h2>User Posts</h2>
            <input type = "text" placeholder = "Search for posts and comments">
			<!-- Post 1 -->
			<div class="post1">
				<h3>What are the best restaurants in Kelowna?</h3>
				<p>c; kelowna</p>
				<p>Score: 100</p>
                <div class="post-actions">
                    <a href="#">Comment</a>
                    <a href="#">Share</a>
                    <a href="#">Save</a>
                </div>
            </div>
			<!-- Post 2 -->
			<div class="post2">
				<h3>Am I able to wash denim jeans?</h3>
				<p>c; Jeans</p>
				<p>Score: 50</p>
                <div class="post-actions">
                    <a href="#">Comment</a>
                    <a href="#">Share</a>
                    <a href="#">Save</a>
                </div>
            </div>
			<!-- Post 3 -->
			<div class="post3">
				<h3>How much should I feed my cat</h3>
				<p>c; cats</p>
				<p>Score: 200</p>
                <div class="post-actions">
                    <a href="#">Comment</a>
                    <a href="#">Share</a>
                    <a href="#">Save</a>
                </div>
            </div>
		</div>
	</div>
</body>

</html>
