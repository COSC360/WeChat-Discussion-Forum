<?php
// start the session
session_start();
$error = array();
require "connectDB.php";
// require "mail.php";

$mode = "enter_email";
if(isset($_GET['mode'])) {
    $mode = $_GET['mode'];
}
//something is posted
if(count($_POST) > 0){

  switch ($mode) {
    case 'enter_email':
      // code...
      $email = $_POST['email'];
      //validate email
      if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $error[] = "Please enter a valid email";
      }elseif(!valid_email($email)){
        $error[] = "That email was not found";
      }else{

        $_SESSION['forgot']['email'] = $email;
        send_email($email);
        header("Location: resetPassword.php?mode=enter_code");
        die;
      }
      break;

    case 'enter_code':
      // code...
      $code = $_POST['code'];
      $result = is_code_correct($code);

      if($result == "the code is correct"){

        $_SESSION['forgot']['code'] = $code;
        header("Location: resetPassword.php?mode=enter_password");
        die;
      }else{
        $error[] = $result;
      }
      break;

    case 'enter_password':
      // code...
      $password = $_POST['password'];
      $password2 = $_POST['password2'];

      if($password !== $password2){
        $error[] = "Passwords do not match";
      }elseif(!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])){
        header("Location: resetPassword.php");
        die;
      }else{
        
        save_password($password);
        if(isset($_SESSION['forgot'])){
          unset($_SESSION['forgot']);
        }

        header("Location: login.php");
        die;
      }
      break;
    
    default:
      // code...
      break;
  }
}
function send_email($email){
		
  global $conn;

  $expire = time() + (60 * 1);
  $code = rand(10000,99999);
  $email = addslashes($email);

  $query = "insert into codes (email,code,expire) value ('$email','$code','$expire')";
  mysqli_query($conn,$query);

   //send email here
   $to = $email;
   $subject = 'Password reset';
   $message = 'Your code is ' . $code;
   $headers = 'From: webmaster@example.com' . "\r\n" .
     'Reply-To: webmaster@example.com' . "\r\n" .
     'X-Mailer: PHP/' . phpversion();
 
   mail($to, $subject, $message, $headers);
  
}

function save_password($password){
  
  global $conn;

  $password = password_hash($password, PASSWORD_DEFAULT);
  $email = addslashes($_SESSION['forgot']['email']);

  $query = "update users set password = '$password' where email = '$email' limit 1";
  mysqli_query($conn,$query);

}

function valid_email($email){
  global $conn;

  $email = addslashes($email);

  $query = "select * from users where email = '$email' limit 1";		
  $result = mysqli_query($conn,$query);
  if($result){
    if(mysqli_num_rows($result) > 0)
    {
      return true;
     }
  }

  return false;

}

function is_code_correct($code){
  global $conn;

  $code = addslashes($code);
  $expire = time();
  $email = addslashes($_SESSION['forgot']['email']);

  $query = "select * from codes where code = '$code' && email = '$email' order by id desc limit 1";
  $result = mysqli_query($conn,$query);
  if($result){
    if(mysqli_num_rows($result) > 0)
    {
      $row = mysqli_fetch_assoc($result);
      if($row['expire'] > $expire){

        return "the code is correct";
      }else{
        return "the code is expired";
      }
    }else{
      return "the code is incorrect";
    }
  }

  return "the code is incorrect";
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel = "stylesheet" href = "css/resetPassword.css">
    <script src="https://kit.fontawesome.com/41893cf31a.js" crossorigin="anonymous"></script>
    <link rel = "stylesheet" href = "css/style.css">
  </head>
  <body>
  <a href="login.php" class = "button"> Login</a> 
  <a href= "home.php" class = "button">Home</a>


    <div class="conntainer">
      <h2>Forgot Password</h2>
      
    
    <?php 

switch ($mode) {
  case 'enter_email':
    // code...
    ?>
      <form method = "POST" action="resetPassword.php?mode=enter_email">
        <label for="email">Email:</label>
        <span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>
        <input type="email" id="email" name="email" placeholder="Enter your email address">
        <input type="submit" value="Reset Password">
      </form>
      <?php				
					break;

				case 'enter_code':
					// code...
					?>
						<form method="post" action="resetPassword.php?mode=enter_code"> 
							<!-- <h1>Forgot Password</h1> -->
							<h3>Enter your the code sent to your email</h3>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>

							<input class="textbox" type="text" name="code" placeholder="12345"><br>
							<br style="clear: both;">
							<input type="submit" value="Next &#187;">
							<a href="resetPassword.php">
								<input type="button" value="Start Over" style = "width:25%;">
							</a>
							<br><br>
						</form>
					<?php
					break;

				case 'enter_password':
					// code...
					?>
						<form method="post" action="resetPassword.php?mode=enter_password"> 
							<h3>Enter your new password</h3>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>

							<input class="textbox" type="text" name="password" placeholder="Password"><br>
							<input class="textbox" type="text" name="password2" placeholder="Retype Password"><br>
							<br style="clear: both;">
							<input type="submit" value="Next" style="float: right;">
							<a href="resetPassword.php">
								<input type="button" value="Start Over">
							</a>
							<br><br>
						</form>
					<?php
					break;
				
				default:
					// code...
					break;
			}

		?>


    </div>
  </body>
</html>
