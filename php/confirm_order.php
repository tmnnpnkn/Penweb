<?php
// session_start();
include 'connectdb.php';
include ('../headtotoe/headee.php');
include ('../headtotoe/nav.php');
?>
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
<style>
    .container {
        margin-top: 50px;
    }

    /* h2 {
            margin-bottom: 30px;
        } */

    .invoice-details {
        margin-bottom: 20px;
    }

    .btn-confirm,
    .btn-cancel {
        padding: 10px 30px;
        font-size: 18px;
        border-radius: 5px;
        cursor: pointer;
        width: 100px;
        /* ปรับขนาดปุ่ม */
    }

    .btn-confirm:hover {
        background-color: #218838;
    }

    .btn-cancel:hover {
        background-color: #c82333;
    }
</style>
</head>

<?php
if (isset($_POST["delivery"])) {
    $orderId = $_POST["order_id"]; // ดึงรหัสการสั่งซื้อจากข้อมูลที่ส่งมา

    // อัปเดตสถานะการสั่งซื้อเป็น 3 (จัดส่งสำเร็จ)
    $sql_update_status = "UPDATE invoice SET order_status = '3' WHERE invoice_id = '$orderId'";

    // ดำเนินการอัปเดตสถานะ
    if (mysqli_query($conn, $sql_update_status)) {
        // ส่งการตอบกลับเป็น JSON ถ้าต้องการใช้งานเพิ่มเติม
        echo json_encode(array('success' => true));
        exit(); // หยุดการดำเนินการ PHP ต่อเพื่อป้องกันการแสดงผล HTML ที่ไม่จำเป็น
    } else {
        echo json_encode(array('success' => false, 'error' => mysqli_error($conn)));
        exit(); // หยุดการดำเนินการ PHP ต่อเพื่อป้องกันการแสดงผล HTML ที่ไม่จำเป็น
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
    if (isset($_POST["order_id"]) && !empty($_POST["order_id"])) {
        $orderId = $_POST["order_id"];

        // ตรวจสอบว่ามีการกระทำการยืนยันหรือยกเลิกการสั่งซื้อ
        if (isset($_POST["confirm"])) {
            // อัปเดตสถานะการสั่งซื้อเป็น 1 (ยืนยัน)
            $sql_update_status = "UPDATE invoice SET order_status = '1' WHERE invoice_id = '$orderId'";
            $action = "ยืนยัน";
            // Get order details to update product stock
            $sql_order_details = "SELECT od.p_id, od.orderQty FROM order_details od WHERE od.orderID = '$orderId'";
            $result_order_details = mysqli_query($conn, $sql_order_details);
            // ดำเนินการอัปเดตสถานะ
            if (!empty($sql_update_status) && mysqli_query($conn, $sql_update_status)) {
                // ดำเนินการเพิ่มเติมที่จำเป็น เช่น อัปเดตสต็อก เป็นต้น

                while ($row = mysqli_fetch_assoc($result_order_details)) {
                    $productId = $row['p_id'];
                    $orderQty = $row['orderQty'];

                    // Update product stock
                    $sql_update_stock = "UPDATE product SET p_num = p_num - $orderQty WHERE p_id = '$productId'";
                    if (mysqli_query($conn, $sql_update_stock)) {
                        // Product stock updated successfully
                        // You can add additional logic or messages here if needed
                    } else {
                        // Error updating product stock
                        echo "<script>alert('Error updating product stock for product ID: $productId - " . mysqli_error($conn) . "');</script>";
                    }
                }

                // กลับไปยังหน้าสำเร็จหรือแสดงข้อความสำเร็จ
                echo "<script>alert('การสั่งซื้อ $action เรียบร้อยแล้ว');</script>";
                echo "<script>window.location='confirm_order.php';</script>";
            } else {
                echo "<script>alert('ข้อผิดพลาดในการอัปเดตสถานะ: " . mysqli_error($conn) . "');</script>";
            }
        } elseif (isset($_POST["cancel"])) {
            // อัปเดตสถานะการสั่งซื้อเป็น 2 (ยกเลิก)
            $sql_update_status = "UPDATE invoice SET order_status = '2' WHERE invoice_id = '$orderId'";
            $action = "ยกเลิก";

            // ดำเนินการอัปเดตสถานะ
            if (!empty($sql_update_status) && mysqli_query($conn, $sql_update_status)) {
                // ดำเนินการเพิ่มเติมที่จำเป็น เช่น อัปเดตสต็อก เป็นต้น
                // กลับไปยังหน้าสำเร็จหรือแสดงข้อความสำเร็จ
                echo "<script>alert('การสั่งซื้อ $action เรียบร้อยแล้ว');</script>";
                echo "<script>window.location='confirm_order.php';</script>";
            } else {
                echo "<script>alert('ข้อผิดพลาดในการอัปเดตสถานะ: " . mysqli_error($conn) . "');</script>";
            }
        }
    } else {
        // ถ้าไม่ได้ตั้งค่า order_id หรือเป็นค่าว่าง
        echo "<script>alert('รหัสการสั่งซื้อไม่ถูกต้อง');</script>";
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_close($conn);

    // หยุดการดำเนินการ PHP เพื่อป้องกันการทำงานต่อไปหลังจากการเปลี่ยนเส้นทาง
    exit();
}

$sql = "SELECT invoice_id, company_name, company_address, delivery_date, contact_person, total_vat, order_status, created_by 
        FROM invoice";


$result = mysqli_query($conn, $sql);
?>



<body>
    <div class="container">
        <h2>การสั่งซื้อ</h2>
        <table id="invoiceTable" class="table table-striped">
            <thead>
                <tr>
                    <th>รหัสการสั่งซื้อ</th>
                    <th>ชื่อบริษัท</th>
                    <th>ที่อยู่</th>
                    <th>วันที่ส่งสินค้า</th>
                    <th>ผู้ติดต่อ</th>
                    <th>ราคารวม</th>
                    <th>สถานะ</th>
                    <th>ผู้ทำรายการ</th>
                    <th>ดูรายละเอียด</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['invoice_id'] . "</td>";
                        echo "<td>" . $row['company_name'] . "</td>";
                        echo "<td>" . $row['company_address'] . "</td>";
                        echo "<td>" . $row['delivery_date'] . "</td>";
                        echo "<td>" . $row['contact_person'] . "</td>";
                        echo "<td>" . $row['total_vat'] . "</td>";

                        echo "<td>";

                        switch ($row['order_status']) {
                            case 0:
                                echo "รอดำเนินการ";
                                break;
                            case 1:
                                echo "รอจัดส่ง";
                                break;
                            case 2:
                                echo "ปฏิเสธ";
                                break;
                            case 3:
                                echo "จัดส่งสำเร็จ";
                                break;
                            default:
                                echo "ไม่ทราบสถานะ";
                        }

                        echo "</td>";

                        // เพิ่มโค้ดเพื่อดึงชื่อผู้ทำรายการ
                        echo "<td>";
                        $createdBy = $row['created_by']; // ดึงค่า id ของผู้ใช้ที่ทำรายการ
                        $sql_username = "SELECT Name FROM user WHERE id = '$createdBy'"; // คิวรี่เพื่อดึงชื่อผู้ใช้
                        $result_username = mysqli_query($conn, $sql_username);
                        if (mysqli_num_rows($result_username) > 0) {
                            $row_username = mysqli_fetch_assoc($result_username);
                            echo $row_username['Name']; // แสดงชื่อผู้ใช้
                        } else {
                            echo "ไม่พบข้อมูลผู้ใช้";
                        }
                        echo "</td>";

                        echo "<td>";
                        echo "<a href='view_adinvoice.php?invoice_id=" . $row['invoice_id'] . "' class='btn btn-primary'>ดูรายละเอียด</a>";
                        echo "</td>";
                        echo "<td>";
                        ?>

                        <td>
                            <?php if ($row['order_status'] != 1 && $row['order_status'] != 3) { ?>
                                <form action="" method="post">
                                    <input type="hidden" name="order_id" value="<?php echo $row['invoice_id']; ?>">
                                    <?php if ($row['order_status'] != 2) { ?>
                                        <button type="submit" name="confirm" class="btn btn-success">ยืนยัน</button>
                                        <button type="submit" name="cancel" class="btn btn-danger">ยกเลิก</button>
                                    <?php } else { ?>
                                        <button class="btn btn-danger" disabled>ไม่สำเร็จ</button>
                                    <?php } ?>
                                </form>
                            <?php } elseif ($row['order_status'] == 1) { ?>
                                <form action="" method="post">
                                    <input type="hidden" name="order_id" value="<?php echo $row['invoice_id']; ?>">
                                    <button type="submit" name="delivery" class="btn btn-warning btn-delivery"
                                        data-order-id="<?php echo $row['invoice_id']; ?>">จัดส่งสินค้า</button>
                                </form>
                            <?php } else { ?>
                                <!-- แสดงปุ่มที่ปิดใช้งานเมื่อสถานะการสั่งซื้อเป็น 3 (จัดส่งสำเร็จ) -->
                                <button class="btn btn-secondary" disabled>สำเร็จ</button>
                            <?php } ?>
                        </td>


                        <?php


                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>ไม่พบข้อมูลการสั่งซื้อ</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div style="text-align: center;">
            <a onclick="window.history.back();" class="btn btn-back btn-primary">กลับ</a>
        </div>
        <br>
    </div>


</body>


<script>
    $(document).ready(function () {
        // เมื่อคลิกที่ปุ่ม "ส่งสินค้า"
        $(".btn-delivery").click(function (e) {
            e.preventDefault(); // ป้องกันการโหลดหน้าใหม่
            var orderId = $(this).data('order-id'); // รหัสการสั่งซื้อ

            $.ajax({
                url: 'confirm_order.php', // ไฟล์ PHP ที่จะดำเนินการอัปเดตสถานะ
                type: 'POST',
                data: {
                    order_id: orderId,
                    delivery: true // ตัวแปรเพิ่มเติมเพื่อแยกการดำเนินการจัดส่งสินค้า
                },
                success: function (response) {
                    // แสดงข้อความแจ้งเตือน
                    alert('การจัดส่งสินค้าเรียบร้อยแล้ว');
                    // อัปเดตสถานะของแถวในตาราง
                    $("#status-" + orderId).text("จัดส่งสำเร็จ"); // อัปเดตข้อความเป็น "จัดส่งสำเร็จ"
                    // อัปเดต order_status เป็น 3
                    $("#order-status-" + orderId).val("3");
                    // เปลี่ยนปุ่มจาก "ส่งสินค้า" เป็น "เสร็จสิ้น"
                    $(".btn-delivery[data-order-id='" + orderId + "']").removeClass('btn-warning').addClass('btn-secondary').text('เสร็จสิ้น').prop('disabled', true);

                    // รีโหลดหน้าเพื่อแสดงการอัปเดตทันที
                    location.reload();
                },
                error: function (xhr, status, error) {
                    // แสดงข้อความแจ้งเตือนเมื่อเกิดข้อผิดพลาด
                    alert('เกิดข้อผิดพลาดในการดำเนินการ: ' + error);
                }
            });
        });

        // เมื่อคลิกที่ปุ่ม "ยกเลิก"
        $(".btn-cancel").click(function (e) {
            e.preventDefault(); // ป้องกันการโหลดหน้าใหม่
            var orderId = $(this).closest('form').find('input[name="order_id"]').val(); // รหัสการสั่งซื้อ

            $.ajax({
                url: 'confirm_order.php', // ไฟล์ PHP ที่จะดำเนินการอัปเดตสถานะ
                type: 'POST',
                data: {
                    order_id: orderId,
                    cancel: true // ตัวแปรเพิ่มเติมเพื่อแยกการดำเนินการยกเลิก
                },
                success: function (response) {
                    // แสดงข้อความแจ้งเตือน
                    alert('การยกเลิกสั่งซื้อเรียบร้อยแล้ว');
                    // อัปเดตสถานะของปุ่ม "ยกเลิก"
                    $(".btn-cancel[data-order-id='" + orderId + "']").replaceWith('<button class="btn btn-danger btn-fail" disabled>ไม่สำเร็จ</button>');
                },
                error: function (xhr, status, error) {
                    // แสดงข้อความแจ้งเตือนเมื่อเกิดข้อผิดพลาด
                    alert('เกิดข้อผิดพลาดในการดำเนินการ: ' + error);
                }
            });
        });
    });





</script>



</div>
</div>

<body>

</html>
<?php

include ('../headtotoe/footer.php');
?>
       
<?php

mysqli_close($conn);
?>