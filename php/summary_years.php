<?php
// session_start();
include 'connectdb.php';
include('../headtotoe/headee.php');
include('../headtotoe/nav.php');
// เรียกข้อมูลของปีล่าสุด
$sql_latest_year_sales = "SELECT YEAR(delivery_date) AS year, SUM(total_vat) AS total_vat
                          FROM invoice
                          WHERE order_status = 3
                          GROUP BY YEAR(delivery_date)
                          ORDER BY YEAR(delivery_date) DESC
                          LIMIT 1";
$result_latest_year_sales = mysqli_query($conn, $sql_latest_year_sales);
$latest_year_sales = mysqli_fetch_assoc($result_latest_year_sales);

$selected_year = isset($_GET['year']) ? $_GET['year'] : $latest_year_sales['year'];

$sql_yearly_sales = "SELECT YEAR(delivery_date) AS year, MONTH(delivery_date) AS month, SUM(total_vat) AS total_vat
                     FROM invoice
                     WHERE order_status = 3 AND YEAR(delivery_date) = $selected_year
                     GROUP BY YEAR(delivery_date), MONTH(delivery_date)
                     ORDER BY YEAR(delivery_date) DESC, MONTH(delivery_date)";
$result_yearly_sales = mysqli_query($conn, $sql_yearly_sales);

// Fetch ข้อมูลรายปีและเดือน
$yearly_sales_data = mysqli_fetch_all($result_yearly_sales, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สรุปยอดขายรายปี</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h2>สรุปยอดขายรายปี</h2>

        <!-- เลือกปี -->
        <form method="get">
            <label for="year">เลือกปี:</label>
            <select name="year" id="year">
                <?php
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

        <canvas id="yearlySalesChart" width="800" height="400"></canvas>
        
        <table>
            <thead>
                <tr>
                    <th>ปี</th>
                    <th>เดือน</th>
                    <th>ยอดขาย (บาท)</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($yearly_sales_data as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['year'] . "</td>";
                    // แปลงเดือนให้เป็นภาษาไทย
                    $thai_month = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                    echo "<td>" . $thai_month[$row['month'] - 1] . "</td>";
                    echo "<td>" . number_format($row['total_vat'], 2) . "</td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
    <script>
    var ctxYearlySales = document.getElementById('yearlySalesChart').getContext('2d');
    var yearlySalesChart = new Chart(ctxYearlySales, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(array_map(function($row) { 
                // แปลงเดือนให้เป็นภาษาไทย
                $thai_month = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                return $thai_month[$row['month'] - 1];
            }, $yearly_sales_data)); ?>,
            datasets: [{
                label: 'ยอดขาย (บาท)',
                data: <?php echo json_encode(array_column($yearly_sales_data, 'total_vat')); ?>,
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