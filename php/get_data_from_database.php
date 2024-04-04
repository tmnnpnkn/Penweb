<?php
// Include your database connection file
include('connectdb.php');

// Query to fetch data from the database
$sql = "SELECT status FROM invoice"; // Replace "your_table" with the actual table name
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    // Fetch data and store in an array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    // Convert array to JSON and output the result
    echo json_encode($data);
} else {
    // No data found
    echo json_encode(array());
}

// Close the database connection
$conn->close();
?>
