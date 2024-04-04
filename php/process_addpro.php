<?php
include('connectdb.php');
include('../headtotoe/header.php');

session_start();

if (isset($_POST['add_product'])) {
    // รับค่าจากฟอร์ม
    $name = $_POST['product_name'];
    $type_id = $_POST['product_type'];
    $detail = $_POST['product_detail'];
    $buy_price = $_POST['buy_price'];
    $sell_price = $_POST['sell_price'];
    $status = $_POST['status'];

    // เพิ่มสินค้าใหม่ลงในฐานข้อมูล
    $query = "INSERT INTO product (p_name, type_id, p_detail, buy_price, sell_price, status) 
              VALUES ('$name', '$type_id', '$detail', '$buy_price', '$sell_price', '$status')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        echo '
            <script>
                setTimeout(function() {
                    swal({
                        title: "เพิ่มสินค้าสำเร็จ!",
                        text: "จะหายไปใน 2 วินาที.",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    }, function() {
                        window.location.href = "Addnumproduct.php";
                    });
                });
            </script>
        ';
    } else {
        echo '
            <script>
                setTimeout(function() {
                    swal({
                        title: "เกิดข้อผิดพลาดในการเพิ่มสินค้า!",
                        text: "กรุณาลองใหม่อีกครั้ง.",
                        type: "error",
                        timer: 10000,
                        showConfirmButton: false
                    }, function() {
                        window.location.href = "Addnumproduct.php";
                    });
                });
            </script>
        ';
    }
}
?>
