<?php
// include('php/connectdb.php');
$tb="counter";
// $conn or die ("ติดต่อกับฐานข้อมูล Mysql ไม่ได้ ");

mysqli_query($conn, "UPDATE counter SET counter = counter + 1");

// Retrieve the updated counter value
$result = mysqli_query($conn, "SELECT counter FROM counter");
$row = mysqli_fetch_assoc($result);
$counter = $row['counter'];

// Display the counter value
echo "Total visitors: " . $counter;

// Close the database connection
mysqli_close($conn);
?>