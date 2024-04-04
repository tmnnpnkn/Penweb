<?php
//เรียกไฟล์เชื่อมต่อฐานข้อมูล
require_once 'connectdb.php';
if (isset($_GET['type_id']) & isset($_GET['name'])) {
    //คิวรี่ข้อมูลสินค้าตามประเภท
    $stmt = $conn->prepare("SELECT* FROM product WHERE type_id=?");
    // $stmt->execute([$_GET['type_id']]);
    // $stmt->execute();
    // $result = $stmt->fetchAll();



    $stmt->bind_param('i', $type_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo $row['type_id'] . '  ' . $row['p_name'] . '<br>';
    }
} else {
    //คิวรี่ข้อมูลสินค้าทุกรายการ
    $stmt = $conn->prepare("SELECT* FROM product");
    $stmt->execute();
    // $result = $stmt->fetchAll();
    $resultSet = $stmt->get_result();
    $result = $resultSet->fetch_all(MYSQLI_ASSOC);
}
//คิวรี่ข้อมูลประเภทสินค้า
$stmPrdType = $conn->prepare("SELECT* FROM tbl_product_type");
$stmPrdType->execute();
// $resultPrdType = $stmPrdType->fetchAll();
$resPrdType = $stmPrdType->get_result();
$resultPrdType = $resPrdType->fetch_all(MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Basic PHP PDO แสดงสินค้าแยกตามหมวดหมู่-ประเภท by devbanban.com 2021</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary" role="alert">
                    <b> รายการสินค้า :: แสดงสินค้าแยกตามหมวดหมู่-ประเภท </b>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="product.php" class="list-group-item list-group-item-action active" aria-current="true">
                        หมวดสินค้า/ประเภทสินค้า
                    </a>
                    <?php foreach ($resultPrdType as $rowPrdType) { ?>
                        <a href="product.php?type_id=<?= $rowPrdType['type_id']; ?>&name=<?= $rowPrdType['type_name']; ?>"
                            class="list-group-item list-group-item-action"> <?= $rowPrdType['type_name']; ?></a>
                        
                    <?php } ?>

                </div>
            </div>
            <div class="col-md-9">
                <div class="row">

                    <?php
                    //ถ้ามีการคลิกเลือกประเภทสินค้า 
                    if (isset($_GET['name'])) {
                        echo '<h4 style="color:red"> หมวดสินค้า ' . $_GET['name'] . '</h4>';
                    }
                    //loop
                    
                    foreach ($result as $row) { ?>

                        <div class="col-sm-3" style="margin-bottom:50px;">
                            <!-- <img src="upload/?= $row['product_img']; ?>" width="100%"><br> -->
                            <?= $row['p_name']; ?> <br>
                            จำนวน
                            <?= $row['p_num']; ?> ชิ้น <br>

                            ราคา
                            <?= number_format($row['p_price'], 2); ?>
                            บาท <br>
                            <?php if ($row['p_num'] > 0) {
                                echo '<a href="#" style="width:100%" class="btn btn-success btn-sm">สั่งซื้อ</a>';
                            } else {
                                echo '<a href="#" style="width:100%" class="btn btn-danger btn-sm disabled" > สินค้าหมด !!</a>';
                            }
                            ?>


                        </div> <!-- //col -->

                    <?php } ?>
                    <br><br>
                </div>
            </div>
            <center>P E N Intertrade 
            <br>
        </div>
    </div>
</body>

</html>