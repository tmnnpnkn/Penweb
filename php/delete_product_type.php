<?php
// เชื่อมต่อฐานข้อมูล
include 'connectdb.php';

// ตรวจสอบว่ามีค่า parameter 'id' ที่ส่งมาจาก URL หรือไม่
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // รับค่า id จาก URL
    $productTypeId = $_GET['id'];

    // สร้างคำสั่ง SQL สำหรับลบประเภทสินค้า
    $sql = "DELETE FROM tbl_product_type WHERE type_id = $productTypeId";

    // ทำการลบประเภทสินค้า
    if(mysqli_query($conn, $sql)) {
        // ถ้าสำเร็จให้ redirect กลับไปยังหน้าเดิม
        header("Location: add_product_type.php");
        exit();
    } else {
        // หากเกิดข้อผิดพลาดในการลบให้แสดงข้อความแจ้งเตือน
        echo "เกิดข้อผิดพลาดในการลบประเภทสินค้า: " . mysqli_error($conn);
    }
} else {
    // หากไม่มีค่า id ที่ส่งมาจาก URL ให้แสดงข้อความแจ้งเตือน
    echo "ไม่พบรหัสประเภทสินค้าที่ต้องการลบ";
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>
