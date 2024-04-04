<!DOCTYPE html>
<html lang="en">

<?php
// include('product.php');

require_once 'connectdb.php';
include('../headtotoe/headee.php');
include('../headtotoe/nav.php');
$stmPrdType = $conn->prepare("SELECT* FROM tbl_product_type");
$stmPrdType->execute();
// $resultPrdType = $stmPrdType->fetchAll();
$resPrdType = $stmPrdType->get_result();
$resultPrdType = $resPrdType->fetch_all(MYSQLI_ASSOC);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- <title>Basic PHP PDO Form add product by devbanban.com 2021</title> -->
    <!-- sweet alert  -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/owl.carousel.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/tooplate-style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12"> <br>
                <?php
                //ถ้ามีการส่งพารามิเตอร์ method get และ  method get ชือ act = add จะแสดงฟอร์มเพิ่มข้อมูล
                if (isset($_GET['act']) && $_GET['act'] == 'add') { ?>
                    <h3> ฟอร์มเพิ่มข้อมูลสินค้า </h3>
                    <form method="post" enctype="multipart/form-data">
                        ประเภทสินค้า
                        <select name="product_type" class="form-control">
                            <?php foreach ($resultPrdType as $rowPrdType) { ?>
                                <option value="<?= $rowPrdType['type_id']; ?>">
                                    <?= $rowPrdType['type_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                        รหัสสินค้า
                        <input type="text" name="product_id" required class="form-control"
                            placeholder="รหัสสินค้า ขั้นต่ำ 3 ตัว" minlength="3"> <br>

                        ชื่อสินค้า
                        <textarea name="product_name" required class="form-control" placeholder="ชื่อสินค้า"></textarea>
                        <br>
                        รายละเอียดสินค้า
                        <textarea name="product_detail" required class="form-control"
                            placeholder="รายละเอียดสินค้า"></textarea>
                        <br>
                        ราคาซื้อ
                        <input type="number" name="buy_price" required class="form-control" min="0"> <br>

                        ราคาขาย
                        <input type="number" name="sell_price" required class="form-control" min="0"> <br>

                        จำนวน
                        <input type="number" name="product_num" required class="form-control" min="0"> <br>
                        <!-- <font color="red">*อัพโหลดได้เฉพาะ .jpeg , .jpg , .png </font>
                        <input type="file" name="product_img" required class="form-control"
                            accept="image/jpeg, image/png, image/jpg"> <br> -->
                        <div class="row">
                            <div class="d-grid gap-2 col-sm-6">
                                <button type="submit" class="btn btn-primary">เพิ่มสินค้า</button>
                            </div>
                            <div class="d-grid gap-2 col-sm-6">
                                <a href="formAddProduct.php" class="btn btn-warning">ยกเลิก</a>
                            </div>
                        </div>
                        <br>
                    </form>
                <?php } ?>
                <h3>เพิ่มสินค้าใหม่
                    <a href="formAddProduct.php?act=add" class="btn btn-info btn-sm">+สินค้า</a>
                </h3>
                <table class="table table-striped  table-hover table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">รหัสสินค้า</th>
                            <th width="20%" class="text-center">ชื่อสินค้า</th>
                            <th width="10%">ประเภทสินค้า</th>
                            <th width="30%">รายละเอียดสินค้า</th>
                            <th width="10%" class="text-center">ราคาซื้อ(บาท)</th>
                            <th width="10%" class="text-center">ราคาขาย(บาท)</th>

                            <th width="20%" class="text-center">จำนวน</th>
                            <!-- <th width="10%" class="text-center">นำเข้า</th>
                            <th width="10%" class="text-center">นำออก</th> -->

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //เรียกไฟล์เชื่อมต่อฐานข้อมูล

                        //คิวรี่ข้อมูลมาแสดงในตาราง
                        $stmt = $conn->prepare("SELECT* FROM product");
                        // $stmt->execute();
                        // $result = $stmt->fetchAll();
                        $stmt->execute();
                        // $result = $stmt->fetchAll();
                        $resultSet = $stmt->get_result();
                        $result = $resultSet->fetch_all(MYSQLI_ASSOC);
                        foreach ($result as $row) {
                            ?>
                            <tr>
                                <td>
                                    <?= $row['p_id']; ?>
                                </td>
                                <!-- <td><img src="upload/<\?= $row['product_img']; ?>" width="70%"></td> -->
                                <td>
                                    <?= $row['p_name']; ?>
                                </td>
                                <td>
                                    <?php
                                    // ค้นหาชื่อประเภทสินค้าจาก $resultPrdType ที่มี id ตรงกับ type_id ของแถวนี้
                                    $type_id = $row['type_id'];
                                    foreach ($resultPrdType as $rowPrdType) {
                                        if ($rowPrdType['type_id'] == $type_id) {
                                            echo $rowPrdType['type_name'];
                                            break; // หยุด loop เมื่อเจอข้อมูลที่ตรงกันแล้ว
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?= $row['p_detail']; ?>
                                </td>
                                <td align="right">
                                    <?= number_format($row['buy_price'], 2); ?>
                                </td>
                                <td align="right">
                                    <?= number_format($row['sell_price'], 2); ?>
                                </td>
                                <td>
                                    <center>
                                        <?= $row['p_num']; ?> ชิ้น
                                </td>
                                <!-- <td>
                                    <center>
                                        </?= $row['p_in']; ?>
                                </td>
                                <td>
                                    <center>
                                        </?= $row['p_out']; ?>
                                </td> -->
                                <!-- <td>
                                    <button type="submit"  class="fa fa-pencil-square-o"></button>
                                </td> -->

                                <!-- <td>
                                    <form action="user_edit.php" method="post">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['p_id']; ?>">
                                        <button type="submit" name="edit_btn" class="fa fa-pencil-square-o"></button>
                                    </form>
                                </td> -->
                                <!-- <td><a href="formAddProduct.php?act=delete" class="btn btn-danger btn-sm">ลบสินค้า</a></td> -->
                            <?php } ?>
                    </tbody>
                </table>
                <br>
                <!-- <center>Basic PHP PDO Form add product by devbanban.com 2021</center> -->
            </div>
        </div>
    </div>
</body>

</html>

<?php

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit();



//ตรวจสอบตัวแปรที่ส่งมาจากฟอร์ม



require_once 'connectdb.php';

if (isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['product_detail']) && isset($_POST['product_type']) && isset($_POST['buy_price']) && isset($_POST['sell_price']) && isset($_POST['product_num'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_detail = $_POST['product_detail'];
    $product_type = $_POST['product_type'];
    $buy_price = $_POST['buy_price'];
    $sell_price = $_POST['sell_price'];
    $product_num = $_POST['product_num'];

    $stmt = $conn->prepare("INSERT INTO product (p_id, p_name, p_detail, type_id, p_num, buy_price, sell_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdddd", $product_id, $product_name, $product_detail, $product_type, $product_num, $buy_price, $sell_price);

    if ($stmt->execute()) {
        echo '<script>
            setTimeout(function() {
                swal({
                    title: "เพิ่มข้อมูลสำเร็จ",
                    type: "success"
                }, function() {
                    window.location = "formAddProduct.php";
                });
            }, 1000);
        </script>';
    } else {
        echo '<script>
            setTimeout(function() {
                swal({
                    title: "เกิดข้อผิดพลาด",
                    type: "error"
                }, function() {
                    window.location = "formAddProduct.php";
                });
            }, 1000);
        </script>';
    }

    $stmt->close();
    $conn->close();
}

// ตัวอย่างฟังก์ชัน deleteProduct// ตัวอย่างฟังก์ชัน deleteProduct
function deleteProduct($product_id)
{
    require_once 'connectdb.php'; // เชื่อมต่อฐานข้อมูล

    // เตรียมและ execute คำสั่ง SQL DELETE
    $stmt = $conn->prepare("DELETE FROM product WHERE p_id = :product_id");
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
    $result = $stmt->execute();

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn = null;

    return $result; // ส่งผลลัพธ์การลบกลับไปให้ฟังก์ชันเรียกใช้
}

if (isset($_GET['act']) && $_GET['act'] == 'delete') {
    if (isset($_GET['p_id'])) {
        $product_id_to_delete = $_GET['p_id'];

        $delete_result = deleteProduct($product_id_to_delete);

        if ($delete_result) {
            echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "ลบข้อมูลสำเร็จ",
                          type: "success"
                      }, function() {
                          window.location = "formAddProduct.php"; // รีเฟรชหน้าหลังจากลบเสร็จ
                      });
                    }, 1000);
                </script>';
        } else {
            echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เกิดข้อผิดพลาดในการลบข้อมูล",
                          type: "error"
                      }, function() {
                          window.location = "formAddProduct.php"; // รีเฟรชหน้าหลังจากลบเสร็จ
                      });
                    }, 1000);
                </script>';
        }
    }
}


// include('../headtotoe/footer.php');
?>
</div>
</div>

<body>

</html>
<?php

include ('../headtotoe/footer.php');
?>