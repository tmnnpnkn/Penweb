<!DOCTYPE html>
<html lang="en">

<?php


require_once 'connectdb.php';
include('../headtotoe/headee.php');
include('../headtotoe/nav.php');
$stmPrdType = $conn->prepare("SELECT* FROM tbl_product_type");
$stmPrdType->execute();
// $resultPrdType = $stmPrdType->fetchAll();
$resPrdType = $stmPrdType->get_result();
$resultPrdType = $resPrdType->fetch_all(MYSQLI_ASSOC);
?>

<!-- <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Basic PHP PDO Form add product by devbanban.com 2021</title>
    <!-- sweet alert  -->
<!-- SweetAlert -->
<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<!-- Add these script tags to include Bootstrap and jQuery -->
<!-- Add these script tags to include Bootstrap and jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script> -->


</head>

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


<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12"> <br>
                <h3> เพิ่มสินค้าในคลัง </h3> <br>
                <?php
                //ถ้ามีการส่งพารามิเตอร์ method get และ  method get ชือ act = add จะแสดงฟอร์มเพิ่มข้อมูล
                
                ?>

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
                            <th width="20%" class="text-center">เพิ่ม</th>
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

                                <!-- <td>
                                    <center>
                                        <?= $row['p_num']; ?> ชิ้น
                                </td> -->
                                <!-- <td>
                                    <center>
                                        </?= $row['p_in']; ?>
                                </td>
                                <td>
                                    <center>
                                        </?= $row['p_out']; ?>
                                </td> -->
                                <!-- <td><a href="formAddProduct.php?act=edit" class="btn btn-success btn-sm">+</a>
                             -->
                                <!-- <td><a href="#" class="btn btn-success btn-sm" onclick="addQuantity(<?= $row['p_id']; ?>)">+</a></td> -->
                                <!-- <td><a href="#" class="btn btn-success btn-sm"
                                        onclick="openQuantityModal(<?= $row['p_id']; ?>)">+</a></td>

                                </td> -->
                                <td>
                                    <center>
                                        <span id="quantity_<?= $row['p_id']; ?>">
                                            <?= $row['p_num']; ?>
                                        </span> ชิ้น
                                    </center>
                                </td>
                                <!-- <td>
                                    <a href="#" class="btn btn-success btn-sm"
                                        onclick="openQuantityModal(<?= $row['p_id']; ?>)">+</a>
                                </td> -->
                                <td>
                                    <button type="button" class="btn btn-success ms-auto" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">+</button>
                                </td>

                                <!-- <td><a href="formAddProduct.php?act=delete" class="btn btn-danger btn-sm">-</a></td> -->
                            <?php } ?>
                            <!-- Modal for Quantity Input -->



                    </tbody>
                </table>
                <br>
<!-- Modal for Quantity Input -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เพิ่มจำนวนสินค้า</h5>
                <!-- Close button -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <!-- Selected product name -->
                <div class="mb-3">
                    <label for="selectedProductName" class="form-label">ชื่อสินค้า:</label>
                    <p id="selectedProductName" class="fs-5 fw-bold text-primary"></p>
                </div>
                <!-- Form to submit quantity -->
                <form action="code.php" method="POST">
                    <!-- Hidden input for product ID -->
                    <input type="hidden" name="edit_pid" id="edit_pid" value="">
                    <!-- Input field for quantity -->
                    <div class="mb-3">
                        <label for="quantityInput" class="form-label">จำนวน:</label>
                        <input type="number" id="quantityInput" name="quantity" class="form-control"
                            placeholder="ใส่จำนวน" required>
                    </div>
                    <!-- Cancel button -->
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">ยกเลิก</button>
                    <!-- Submit button -->
                    <button type="submit" name="addQuantity" class="btn btn-primary">เพิ่ม</button>
                </form>
            </div>
        </div>
    </div>
</div>





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


if (isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['product_type']) && isset($_POST['product_price']) && isset($_POST['product_num'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_type = $_POST['product_type'];
    $product_price = $_POST['product_price'];
    $product_num = $_POST['product_num'];

    $stmt = $conn->prepare("INSERT INTO product (p_id, p_name, type_id, p_num, p_price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddd", $product_id, $product_name, $product_type, $product_num, $product_price);

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




<!-- ตรงนี้ -->

<script>
    // เมื่อคลิกปุ่มเพิ่มจำนวนสินค้า
    $('.btn-success').click(function () {
        // ดึงค่า ID ของสินค้าจากแถวปัจจุบัน
        var productId = $(this).closest('tr').find('td:first-child').text().trim();

        // แสดง Modal เพื่อให้ผู้ใช้กรอกจำนวนสินค้าที่ต้องการเพิ่ม
        $('#exampleModal').modal('show');

        // กำหนดค่า ID สินค้าลงใน input hidden ใน Modal
        $('#edit_pid').val(productId);
    });

    // เมื่อคลิกปุ่มเพิ่มจำนวนสินค้าใน Modal
    $('#addQuantityBtn').click(function () {
        // ดึงค่าจำนวนสินค้าที่ต้องการเพิ่มจากฟิลด์ input
        var quantity = $('#quantityInput').val();
        // ดึงค่า ID สินค้าที่ต้องการเพิ่มจาก input hidden ใน Modal
        var productId = $('#edit_pid').val();

        // ส่งข้อมูลผ่าน AJAX ไปยัง code.php เพื่อทำการอัปเดตจำนวนสินค้า
        $.ajax({
            url: 'code.php', // ตั้งค่า URL ของ code.php ที่มีการจัดการการอัปเดตจำนวนสินค้า
            method: 'POST',
            data: { quantity: quantity, edit_pid: productId },
            success: function (response) {
                // หลังจากที่รับคำตอบจาก code.php แสดงข้อความหรือทำการปรับปรุง UI ตามต้องการ
                console.log(response); // สามารถแสดงข้อความตอบกลับจาก code.php ได้เพื่อทดสอบ
                // ตัวอย่างการแสดงข้อความ
                alert('จำนวนสินค้าถูกเพิ่มแล้ว');
                // หรือสามารถโหลดหน้าเว็บใหม่เพื่อปรับปรุงข้อมูล
                window.location.reload();
            },
            error: function (xhr, status, error) {
                // ในกรณีที่เกิดข้อผิดพลาดในการส่งข้อมูลหรือการทำงานของ code.php
                console.error(error); // แสดงข้อความ error ใน console เพื่อ debug
                alert('เกิดข้อผิดพลาดในการเพิ่มจำนวนสินค้า');
            }
        });
    });
</script>


<script>
    // When the modal is shown
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var productName = button.closest('tr').find('td:eq(1)').text(); // Extract product name from the clicked row
        var modal = $(this);
        modal.find('.modal-body #selectedProductName').text(productName); // Display selected product name in the modal
    });
</script>
</div>
</div>

<body>

</html>
<?php

include ('../headtotoe/footer.php');
?>