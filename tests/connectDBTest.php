<?php
// use GuzzleHttp\Client;
// class connectDBTest extends \PHPUnit\Framework\TestCase{
//     //Test that the database connection is successful
//     public function testConnectionSuccess()
//     {
//         //connectDB.php file
//         require_once 'connectDB.php';

//         //check that the $conn variable is set and not null
//         $this->assertNotNull($conn);

//         //check that the mysqli_connect_error() function returns false
//         $this->assertFalse(mysqli_connect_error());
//     }

//     //Test that error is thrown if connection fails
//     public function testConnectionError()
//     {
//         //temporarily change the database credentials to force a connection error
//         $host = 'localhost';
//         $username = 'root';
//         $password = '';
//         $dbname = 'discussiondatabase';

//         //attempt to connect to the database with the incorrect credentials
//         $conn = mysqli_connect($host, $username, $password, $dbname);

//         //check that the mysqli_connect_error() function returns a non-empty string
//         $this->assertNotEmpty(mysqli_connect_error());

//         //close the conn
//         mysqli_close($conn);
//     }
// }
?>