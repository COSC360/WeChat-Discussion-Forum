<?php
//Database credentials
/* $host = 'localhost';
$username = 'root';
$password = 'rootpw';
$dbname = 'discussiondatabase'; //db name here
*/
$host = 'localhost';
$username = '80772049';
$password = '80772049';
$dbname = 'db_80772049'; //db name here

//Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

if(mysqli_connect_error()) {
echo "DB Connection error: " . mysqli_error($conn);
exit();
}
?>
