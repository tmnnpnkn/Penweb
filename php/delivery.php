<?php
session_start();

include 'connectdb.php'; // รวมไฟล์เพื่อเชื่อมต่อกับฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if order_id is set and not empty
    if (isset($_POST["order_id"]) && !empty($_POST["order_id"])) {
        $orderId = $_POST["order_id"];

        // Update order_status to 3 (delivery)
        $sql_update_status = "UPDATE invoice SET order_status = '3' WHERE invoice_id = '$orderId'";
        $action = "delivered";

        if (mysqli_query($conn, $sql_update_status)) {
            // Redirect to success page or display success message
            echo "<script>alert('Order $action successfully');</script>";
            echo "<script>window.location='confirm_order.php';</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        // If order_id is not set or empty
        echo "<script>alert('Invalid order ID');</script>";
    }

    // Close database connection
    mysqli_close($conn);

    // Prevent further execution of PHP code after redirection
    exit();
}
?>
