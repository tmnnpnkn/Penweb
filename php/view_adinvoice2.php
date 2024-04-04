<?php
session_start();
include 'connectdb.php';

// Check if invoice_id is set in the URL parameter
if (isset($_GET["invoice_id"]) && !empty($_GET["invoice_id"])) {
    $invoiceId = $_GET["invoice_id"];

    // Query database to retrieve invoice details based on invoice_id
    $sql = "SELECT * FROM invoice WHERE invoice_id = '$invoiceId'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Fetch data and display invoice details
        $invoice = mysqli_fetch_assoc($result);
        // Display invoice details here
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>รายละเอียดใบเบิก</title>
            <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <script src="bootstrap/js/bootstrap.bundle.min.js"></script>


            <style>
       <style>
    body {
        font-family: 'sarabun', sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .alert-primary {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
        border-radius: 5px;
        padding: 10px;
        text-align: center;
    }

    .table {
        margin-top: 20px;
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        text-align: center;
        vertical-align: middle !important;
        padding: 12px;
    }

    th {
        background-color: #007bff;
        color: #fff;
    }

    tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .btn-back {
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        background-color: #28a745;
        color: #fff;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .btn-back:hover {
        background-color: #218838;
    }
</style>

        </head>
        <body>
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="alert alert-primary h4 text-center mt-4" role="alert">
                        รายละเอียดใบเบิก
                    </div>

                    <p>ชื่อบริษัท: <?= $invoice['company_name'] ?></p>
                    <p>ที่อยู่: <?= $invoice['company_address'] ?></p>
                    <p>วันที่ส่งสินค้า: <?= $invoice['delivery_date'] ?></p>
                    <p>ผู้ติดต่อ: <?= $invoice['contact_person'] ?></p>
                    <p>เลขที่ใบสั่งซื้อ: <?= $invoice['order_number'] ?></p>
           


                    

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ชื่อสินค้า</th>
                                <th>ราคา</th>
                                <th>จำนวน</th>
                                <th>ราคารวม</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_order_details = "SELECT od.*, p.p_name, p.sell_price FROM order_details od JOIN product p ON od.p_id = p.p_id WHERE od.orderID = '$invoiceId'";
                            $result_order_details = mysqli_query($conn, $sql_order_details);
                           
                            $totalPriceWithoutVAT = 0;
                            while ($row = mysqli_fetch_assoc($result_order_details)) {
                                // Check if key exists before accessing its value
                                if (isset($row['p_name']) && isset($row['sell_price']) && isset($row['Total'])) {
                                    $productName = $row['p_name'];
                                    $price = $row['sell_price'];
                                    $quantity = $row['orderQty'];
                                    $total = $row['Total'];
                                    $totalPriceWithoutVAT += $total;
                                ?>
                                    <tr>
                                        <td><?= $productName ?></td>
                                        <td><?= $price ?></td>
                                        <td><?= $quantity ?></td>
                                        <td><?= $total ?></td>
                                    </tr>
                                <?php 
                                }
                            } 
                            ?>
                        </tbody>
                    </table>

                    <?php
                    $vat = $totalPriceWithoutVAT * 0.07;
                    $totalPriceWithVAT = $totalPriceWithoutVAT + $vat;
                    ?>

                    <h6>รวมเป็นเงิน (ไม่รวม VAT): <?= number_format($totalPriceWithoutVAT, 2) ?> บาท</h6>
                    <h6>VAT (7%): <?= number_format($vat, 2) ?> บาท</h6>
                    <h6>รวมเป็นเงิน (รวม VAT): <?= number_format($totalPriceWithVAT, 2) ?> บาท</h6>

                    <a href="view_bai.php" class="btn btn-back btn-primary">กลับ</a>
                </div>
            </div>
        </div>
        </body>
        </html>

        <?php
    } else {
        // If no data found for the specified invoice_id
        echo "ไม่พบข้อมูลใบเบิกที่ระบุ";
    }
} else {
    // If invoice_id is not set in the URL parameter
    echo "ไม่พบรหัสใบเบิก";
}
?>
