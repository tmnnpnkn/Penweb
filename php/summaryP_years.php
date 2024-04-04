<?php
// session_start();
include 'connectdb.php';
include ('../headtotoe/headee.php');
include ('../headtotoe/nav.php');

// ตรวจสอบว่ามีการส่งค่าปีมาหรือไม่ ถ้าไม่มีใช้ปีปัจจุบัน
$selected_year = isset($_GET['year']) ? $_GET['year'] : date("Y");

// ดึงข้อมูลการขายสินค้าตามปี
$sql_yearly_product_sales = "SELECT p_name, MONTH(delivery_date) AS month, DAY(delivery_date) AS day, SUM(od.orderQty) AS total_quantity 
                              FROM order_details od 
                              INNER JOIN product p ON od.p_id = p.p_id 
                              INNER JOIN invoice i ON od.orderID = i.invoice_id 
                              WHERE i.order_status = 3 AND YEAR(delivery_date) = $selected_year
                              GROUP BY p.p_id, MONTH(delivery_date), DAY(delivery_date)";

$result_yearly_product_sales = mysqli_query($conn, $sql_yearly_product_sales);

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สรุปการขายสินค้าตามปี</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/owl.carousel.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/tooplate-style.css">
    <style>
        /* body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        } */

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">สรุปการขายสินค้าตามปี</h2>

                <!-- เลือกปี -->
                <form method="get">
                    <label for="year">เลือกปี:</label>
                    <select name="year" id="year">
                        <?php
                        // สร้างตัวเลือกปีจากฐานข้อมูล
                        $sql_years = "SELECT DISTINCT YEAR(delivery_date) AS year FROM invoice ORDER BY YEAR(delivery_date) DESC";
                        $result_years = mysqli_query($conn, $sql_years);
                        while ($row = mysqli_fetch_assoc($result_years)) {
                            $selected = ($row['year'] == $selected_year) ? "selected" : "";
                            echo "<option value='{$row['year']}' $selected>{$row['year']}</option>";
                        }
                        ?>
                    </select>
                    <button type="submit">เลือก</button>
                </form>

                <canvas id="yearlyProductSalesChart" width="800" height="400"></canvas>
                <table class="table">
                    <thead>
                        <tr>
                            <th>สินค้า</th>
                            <th>เดือน</th>
                            <th>จำนวนที่ขาย (ชิ้น)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $yearly_product_sales_data = [];
                        while ($row = mysqli_fetch_assoc($result_yearly_product_sales)) {
                            echo "<tr>";
                            echo "<td>" . $row['p_name'] . "</td>";
                            echo "<td>" . $row['month'] . "</td>";
                            echo "<td>" . $row['total_quantity'] . "</td>";
                            echo "</tr>";
                            $yearly_product_sales_data[] = $row;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    // Prepare labels array containing year, month, and day
    var labels = <?php echo json_encode(array_map(function($row) {
        return $row['month'] . '-' . $row['day'];
    }, $yearly_product_sales_data)); ?>;
    
    // สร้างกราฟการขายสินค้าตามปี
    var ctxYearlyProductSales = document.getElementById('yearlyProductSalesChart').getContext('2d');
    var yearlyProductSalesChart = new Chart(ctxYearlyProductSales, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'จำนวนที่ขาย (ชิ้น)',
                data: <?php echo json_encode(array_column($yearly_product_sales_data, 'total_quantity')); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

</body>

</div>
</div>

<body>

</html>
<?php

include ('../headtotoe/footer.php');
?>
