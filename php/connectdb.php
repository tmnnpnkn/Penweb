<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db2";

// Create a connection to the database
$conn = mysqli_connect($servername, $username, $password, $dbname);

$perpage = 5;
if (isset($_GET['page'])) {
$page = $_GET['page'];
} else {
$page = 1;
}
$start = ($page - 1) * $perpage;
//  if($conn){
//     echo "connected";
// }
// Check the connection and print an error message if it fails
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>