<?php
// Include your database connection file
include('connectdb.php');

// Check if the status parameter is set in the GET request
if (isset($_GET['status'])) {
    // Get the status parameter from the AJAX request
    $status = $_GET['status'];

    // Prepare and execute a query to fetch orders based on the status
    $sql = "SELECT * FROM invoice WHERE status = ? ORDER BY invoice_id DESC"; // เรียงลำดับ invoice_id จากมากไปหาน้อย
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $status);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are any orders found
    if ($result->num_rows > 0) {
        // Start generating the HTML table
        $html = '<table>';
        $html .= '<thead><tr><th>Order ID</th><th>วันที่เบิก</th><th>สถานะ</th><th></th></tr></thead>';
        $html .= '<tbody>';

        // Loop through the results and add rows to the table
        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>';
            $html .= '<td>A' . date('dmY', strtotime($row['date'])) . str_pad($row['invoice_id'], 3, '0', STR_PAD_LEFT) . '</td>';
            // $html .= '<td>' . $row['order_number'] . '</td>';
            $html .= '<td>' . date("d/m/Y", strtotime($row['date'])) . '</td>';

            // Check the status and display corresponding text
            if ($row['status'] == 'w') {
                // Display 'รออนุมัติ' in one column
                $html .= '<td>รออนุมัติ</td>';
                // Add two columns for approve and reject buttons
                $html .= '<td><button class="btn btn-success" onclick="approveOrder(\'' . $row['invoice_id'] . '\')">อนุมัติ</button></td>';
                $html .= '<td><button class="btn btn-danger" onclick="rejectOrder(\'' . $row['invoice_id'] . '\')">ไม่อนุมัติ</button></td>';
                
            } elseif ($row['status'] == 'a') {
                $html .= '<td>อนุมัติแล้ว</td>';
            } elseif ($row['status'] == 'r') {
                $html .= '<td>ไม่อนุมัติ</td>';
            }

            // Add view button
            // $html .= '<td><button class="btn btn-primary" onclick="viewOrder(' . $row['invoice_id'] . ')">ดูรายละเอียด</button></td>';

            $html .= '</tr>';
        }

        $html .= '</tbody></table>';
    } else {
        // No orders found for the given status
        $html = '<p>No orders found for the selected status.</p>';
    }

    // Return the HTML table or message
    echo $html;

    // Close the database connection
    $stmt->close();
} else {
    // If status parameter is not set, return error message
    echo "<p>Error: Status parameter is missing.</p>";
}

$conn->close();

?>

<script>
    // Function to view order details
    function viewOrder(orderId) {
        // You can implement the logic to view order details here
        alert("View order details for Order ID: " + orderId);
    }

    function approveOrder(invoiceId) {
        // ส่งคำขอ AJAX เพื่ออัปเดตสถานะเป็น 'a'
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // อัปเดต DOM หรือประมวลผลใด ๆ ที่ต้องการหลังจากอัปเดตสถานะเรียบร้อย
                console.log("Order approved!");
            }
        };
        xhttp.open("GET", "update_status.php?invoice_id=" + invoiceId + "&status=a", true);
        xhttp.send();
    }

    function rejectOrder(invoiceId) {
        // ส่งคำขอ AJAX เพื่ออัปเดตสถานะเป็น 'r'
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // อัปเดต DOM หรือประมวลผลใด ๆ ที่ต้องการหลังจากอัปเดตสถานะเรียบร้อย
                console.log("Order rejected!");
            }
        };
        xhttp.open("GET", "update_status.php?invoice_id=" + invoiceId + "&status=r", true);
        xhttp.send();
    }


</script>