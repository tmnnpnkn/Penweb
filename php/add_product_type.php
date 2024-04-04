<!DOCTYPE html>
<html lang="en">

<head>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css"> -->


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/animate.css">
  <link rel="stylesheet" href="../css/owl.carousel.css">
  <link rel="stylesheet" href="../css/owl.theme.default.min.css">
  <link rel="stylesheet" href="../css/tooplate-style.css">
</head>
    <title>เพิ่มประเภทสินค้าใหม่</title>
    <style>
        /* body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        } */
        .container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .product-types {
            margin-top: 30px;
        }
        .product-types ul {
            list-style-type: none;
            padding: 0;
        }
        .product-types ul li {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 5px;
            position: relative; /* เพิ่มเพื่อให้สามารถจัดตำแหน่งปุ่มลบได้ */
        }
        .delete-btn {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            background-color: #dc3545;
            border: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<?php 
include('connectdb.php');
include('../headtotoe/headee.php');
include('../headtotoe/nav.php');
?>
<body>
    <div class="container">
        <h2>เพิ่มประเภทสินค้าใหม่</h2>
        <form action="insert_product_type.php" method="post">
            <label for="type_name">ชื่อประเภทสินค้า:</label>
            <input type="text" id="type_name" name="type_name">
            <input type="submit" value="เพิ่มประเภทสินค้า">
        </form>
        
        <div class="product-types">
            <h2>รายการประเภทสินค้า</h2>
            <ul>
                <?php
                // เชื่อมต่อกับฐานข้อมูล
                include 'connectdb.php'; // แก้ไขตามการตั้งค่าการเชื่อมต่อฐานข้อมูลของคุณ
                
                // ดึงข้อมูลประเภทสินค้าจากฐานข้อมูล
                $sql = "SELECT * FROM tbl_product_type";
                $result = mysqli_query($conn, $sql);
                
                // แสดงรายการประเภทสินค้า
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<li>" . $row['type_name'] . "<button class='delete-btn' onclick='deleteProductType(" . $row['type_id'] . ")'>ลบ</button></li>";
                    }
                } else {
                    echo "<li>ไม่พบรายการประเภทสินค้า</li>";
                }
                
                // ปิดการเชื่อมต่อฐานข้อมูล
                mysqli_close($conn);
                ?>
                
            </ul>
        </div>
    </div>

    <!-- JavaScript เพื่อลบรายการสินค้า -->
    <script>
        function deleteProductType(productTypeId) {
            if (confirm('คุณต้องการลบประเภทสินค้านี้ใช่หรือไม่?')) {
                // ส่งคำร้องขอลบรายการสินค้าไปยังหน้า PHP ที่รับคำร้องขอลบ
                window.location = 'delete_product_type.php?id=' + productTypeId;
            }
        }
    </script>
</body>
</div>
</div>

<body>

</html>
<?php

include ('../headtotoe/footer.php');
?>
