<?php
// session_start();
include 'connectdb.php';
include ('../headtotoe/headee.php');
include ('../headtotoe/nav.php');

// หาเดือนและปีล่าสุด
$sql_latest_month_year = "SELECT MAX(delivery_date) AS latest_date FROM invoice";
$result_latest_month_year = mysqli_query($conn, $sql_latest_month_year);
$row_latest_month_year = mysqli_fetch_assoc($result_latest_month_year);
$latest_month = date('m', strtotime($row_latest_month_year['latest_date']));
$latest_year = date('Y', strtotime($row_latest_month_year['latest_date']));

// ถ้าไม่มีการส่งค่าปีและเดือนผ่าน URL ให้ใช้ค่าปีและเดือนล่าสุด
if (!isset($_GET['year']) || !isset($_GET['month'])) {
    $_GET['year'] = $latest_year;
    $_GET['month'] = $latest_month;
}

$sql_daily_sales = "SELECT 
                        CASE MONTH(delivery_date)
                            WHEN 1 THEN 'มกราคม'
                            WHEN 2 THEN 'กุมภาพันธ์'
                            WHEN 3 THEN 'มีนาคม'
                            WHEN 4 THEN 'เมษายน'
                            WHEN 5 THEN 'พฤษภาคม'
                            WHEN 6 THEN 'มิถุนายน'
                            WHEN 7 THEN 'กรกฎาคม'
                            WHEN 8 THEN 'สิงหาคม'
                            WHEN 9 THEN 'กันยายน'
                            WHEN 10 THEN 'ตุลาคม'
                            WHEN 11 THEN 'พฤศจิกายน'
                            ELSE 'ธันวาคม'
                        END AS month,
                        DAY(delivery_date) AS day,
                        p.p_name,
                        SUM(od.orderQty) AS total_quantity 
                    FROM invoice i
                    INNER JOIN order_details od ON i.invoice_id = od.orderID
                    INNER JOIN product p ON od.p_id = p.p_id
                    WHERE YEAR(i.delivery_date) = ? 
                        AND MONTH(i.delivery_date) = ?
                        AND i.order_status = 3
                    GROUP BY DAY(delivery_date), p.p_name";
$stmt = mysqli_prepare($conn, $sql_daily_sales);
mysqli_stmt_bind_param($stmt, "ss", $_GET['year'], $_GET['month']);
mysqli_stmt_execute($stmt);
$result_daily_sales = mysqli_stmt_get_result($stmt);

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
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        } */

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        canvas {
            margin: 0 auto;
            display: block;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>สรุปการขายสินค้าตามเดือน</h2>
        <form action="" method="GET" class="form-group">
        <div style="display: flex; align-items: center;">
                <label for="month">เลือกเดือน: </label>
                <select name="month" id="month" class="form-select" style="width: 120px; margin-left: 10px;">
                    <?php
                    // สร้างตัวเลือกสำหรับเดือน
                    $months = [
                        1 => 'มกราคม',
                        2 => 'กุมภาพันธ์',
                        3 => 'มีนาคม',
                        4 => 'เมษายน',
                        5 => 'พฤษภาคม',
                        6 => 'มิถุนายน',
                        7 => 'กรกฎาคม',
                        8 => 'สิงหาคม',
                        9 => 'กันยายน',
                        10 => 'ตุลาคม',
                        11 => 'พฤศจิกายน',
                        12 => 'ธันวาคม'
                    ];

                    // เริ่มต้นดึงข้อมูลปีจากปีปัจจุบัน
                    $current_year = date("Y");
                    // ถ้ามีการส่งค่าปีผ่าน URL ให้ใช้ค่าปีนั้น ไม่งั้นใช้ค่าปีปัจจุบัน
                    $selected_month = isset($_GET['month']) ? $_GET['month'] : $latest_month;
                    // สร้างตัวเลือกสำหรับเดือน
                    foreach ($months as $month_num => $month_name) {
                        $selected = ($month_num == $selected_month) ? "selected" : "";
                        echo "<option value='$month_num' $selected>$month_name</option>";
                    }
                    ?>
                </select>

                <label for="year" style="margin-left: 10px;">เลือกปี:</label>
                <select name="year" id="year" class="form-select" style="width: 120px; margin-left: 10px;">
                    <?php
                    // ถ้ามีการส่งค่าปีผ่าน URL ให้ใช้ค่าปีนั้น ไม่งั้นใช้ค่าปีปัจจุบัน
                    $selected_year = isset($_GET['year']) ? $_GET['year'] : $latest_year;
                    // สร้างตัวเลือกสำหรับปีจากปีปัจจุบันถึง 5 ปีที่ผ่านมา
                    for ($i = $current_year; $i >= $current_year - 5; $i--) {
                        $selected = ($i == $selected_year) ? "selected" : "";
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>
             <button type="submit" class="btn btn-primary">ดูข้อมูล</button>   
            </div>
            
        </form>

        <canvas id="monthlySalesChart" width="800" height="400"></canvas>
        <table>
            <thead>
                <tr>
                    <th>เดือน</th>
                    <th>วันที่</th>
                    <th>สินค้า</th>
                    <th>จำนวนที่ขาย (ชิ้น)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $daily_sales_data = [];
                while ($row = mysqli_fetch_assoc($result_daily_sales)) {
                    echo "<tr>";
                    echo "<td>" . $row['month'] . "</td>";
                    echo "<td>" . $row['day'] . "</td>";
                    echo "<td>" . $row['p_name'] . "</td>";
                    echo "<td>" . $row['total_quantity'] . "</td>";
                    echo "</tr>";
                    $daily_sales_data[] = $row;
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        var ctxMonthlySales = document.getElementById('monthlySalesChart').getContext('2d');
        var monthlySalesChart = new Chart(ctxMonthlySales, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column($daily_sales_data, 'day')); ?>,
                datasets: [
                    <?php
                    $products = array_unique(array_column($daily_sales_data, 'p_name'));
                    foreach ($products as $product) {
                        $filtered_data = array_filter($daily_sales_data, function($item) use ($product) {
                            return $item['p_name'] === $product;
                        });
                        ?>
                        {
                            label: '<?php echo $product; ?>',
                            data: <?php echo json_encode(array_column($filtered_data, 'total_quantity')); ?>,
                            backgroundColor: 'rgba(<?php echo rand(0,255); ?>, <?php echo rand(0,255); ?>, <?php echo rand(0,255); ?>, 0.2)',
                            borderColor: 'rgba(<?php echo rand(0,255); ?>, <?php echo rand(0,255); ?>, <?php echo rand(0,255); ?>, 1)',
                            borderWidth: 1
                        },
                    <?php } ?>
                ]
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
