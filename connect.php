<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
//$database = 'atnstore';
$database = 'id21054473_atn_store';

// Create connection
$conn = mysqli_connect($hostname, $username, $password,$database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
?>