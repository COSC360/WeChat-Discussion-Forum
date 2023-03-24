<?php
// start the session
session_start();

// connect to the database
$conn = mysqli_connect("localhost", "root", "pw", "discussiondatabase");

// check if the form has been submitted
if (isset($_POST["submit"])) {
  // get the email address entered by the user
  $email = $_POST["email"];

  // generate a random password
  $new_password = bin2hex(random_bytes(8));

  // update the user's password in the database
  $query = "UPDATE users SET password = '$new_password' WHERE email = '$email'";
  mysqli_query($conn, $query);

  // send a confirmation email
  $to = $email;
  $subject = "Password Reset";
  $message = "Your new password is: $new_password";
  $headers = "From: webmaster@example.com" . "\r\n" .
             "Reply-To: webmaster@example.com" . "\r\n" .
             "X-Mailer: PHP/" . phpversion();
  mail($to, $subject, $message, $headers);

  // set a success message in the session
  $_SESSION["success"] = "Your password has been reset. Please check your email for your new password.";

  // redirect the user to the login page
  header("Location: login.php");
  exit();
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


    <div class="container">
      <h2>Forgot Password</h2>
      <?php
    // check if there is an error message in the session
    if (isset($_SESSION["error"])) {
      echo "<p style='color:red'>" . $_SESSION["error"] . "</p>";
      unset($_SESSION["error"]);
    }

    // check if there is a success message in the session
    if (isset($_SESSION["success"])) {
      echo "<p style='color:green'>" . $_SESSION["success"] . "</p>";
      unset($_SESSION["success"]);
    }
    ?>
      <form>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email address">
        <input type="submit" value="Reset Password">
      </form>
    </div>
  </body>
</html>
