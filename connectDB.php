<?php
//Database credentials
$host = 'localhost';
$username = 'db_user';
$password = 'db_password';
$dbname = 'my_database'; //db name here

//Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

//Check connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
echo 'Connected successfully';
?>
