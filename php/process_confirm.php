<?php
session_start();
include 'connectdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["order_id"])) {
    $orderId = $_POST["order_id"];

    // ตรวจสอบว่ามีการยืนยันหรือจัดส่งสำเร็จ
    if (isset($_POST["confirm"])) {
        // อัปเดตสถานะการสั่งซื้อเป็น 1 (ยืนยัน)
        $sql_update_status = "UPDATE invoice SET order_status = '1' WHERE invoice_id = '$orderId'";
        $action = "ยืนยัน";

        // ดำเนินการอัปเดตสถานะ
        if (!empty($sql_update_status) && mysqli_query($conn, $sql_update_status)) {
            // อัปเดตสถานะสำเร็จ
            // ทำสิ่งที่คุณต้องการหลังจากการยืนยันการสั่งซื้อ เช่น ส่งอีเมลยืนยัน หรือแสดงข้อความสำเร็จ
            echo "การยืนยันการสั่งซื้อเรียบร้อยแล้ว";
        } else {
            // มีข้อผิดพลาดในการอัปเดตสถานะ
            echo "เกิดข้อผิดพลาดในการอัปเดตสถานะ: " . mysqli_error($conn);
        }
    } elseif (isset($_POST["delivery"])) {
        // อัปเดตสถานะการสั่งซื้อเป็น 3 (จัดส่งสำเร็จ)
        $sql_update_status = "UPDATE invoice SET order_status = '3' WHERE invoice_id = '$orderId'";

        // ดำเนินการอัปเดตสถานะ
        if (!empty($sql_update_status) && mysqli_query($conn, $sql_update_status)) {
            // อัปเดตสถานะสำเร็จ
            // ทำสิ่งที่คุณต้องการหลังจากการจัดส่งสำเร็จ เช่น ส่งอีเมลยืนยัน หรือแสดงข้อความสำเร็จ
            echo "การจัดส่งสำเร็จ";
        } else {
            // มีข้อผิดพลาดในการอัปเดตสถานะ
            echo "เกิดข้อผิดพลาดในการอัปเดตสถานะ: " . mysqli_error($conn);
        }
    }
} else {
    // หากไม่มีข้อมูลที่จำเป็นส่งมา
    echo "ไม่มีข้อมูลการยืนยันการสั่งซื้อหรือการจัดส่ง";
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>
