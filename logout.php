<?php
session_start();
require 'connectDB.php';
$_SESSION = [];
session_unset();
session_destroy();
header("Location: home.php");
?>