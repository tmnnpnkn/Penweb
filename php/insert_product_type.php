<?php
// ตรวจสอบว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อกับฐานข้อมูล
    include 'connectdb.php'; // แก้ไขตามการตั้งค่าการเชื่อมต่อฐานข้อมูลของคุณ
    
    // รับข้อมูลจากฟอร์ม
    $type_name = $_POST['type_name'];
    
    // เตรียมคำสั่ง SQL สำหรับแทรกข้อมูล
    $sql = "INSERT INTO tbl_product_type (type_name) VALUES ('$type_name')";
    
    // ทำการแทรกข้อมูล
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('เพิ่มประเภทสินค้าใหม่เรียบร้อยแล้ว');</script>";
        echo "<script>window.location = 'add_product_type.php';</script>"; // ให้กลับไปยังหน้าเดิม
    } else {
        echo "เกิดข้อผิดพลาดในการเพิ่มประเภทสินค้า: " . mysqli_error($conn);
    }
    
    // แสดงรายการประเภทสินค้า
    $sql_select = "SELECT * FROM tbl_product_type";
    $result = mysqli_query($conn, $sql_select);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<h2>รายการประเภทสินค้า</h2>";
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>" . $row["type_name"] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "ไม่พบรายการประเภทสินค้า";
    }
    
    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_close($conn);
} else {
    // ถ้าไม่มีการส่งข้อมูลมาจากฟอร์ม
    echo "ไม่สามารถเข้าถึงหน้านี้โดยตรง";
}
?>
