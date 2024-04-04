<?php
// Include your database connection file
include('connectdb.php');

// Check if the invoice_id and status parameters are set in the GET request
if (isset($_GET['invoice_id']) && isset($_GET['status'])) {
    // Get the invoice_id and status parameters from the AJAX request
    $invoiceId = $_GET['invoice_id'];
    $status = $_GET['status'];

    // Prepare and execute a query to update the status in the database
    $sql = "UPDATE invoice SET status = ? WHERE invoice_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $invoiceId);
    $stmt->execute();

    // Check if the status was updated successfully
    if ($stmt->affected_rows > 0) {
        // Send a success response back to JavaScript
        echo "success";
    } else {
        // Send an error response back to JavaScript
        echo "error";
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // If invoice_id or status parameters are not set, return error message
    echo "Error: Missing parameters.";
}

// Close the database connection
$conn->close();
?>
