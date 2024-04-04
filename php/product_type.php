<?php
include 'connectdb.php';
include('../headtotoe/headee.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tbl_product_type";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing the query: " . $conn->error);
}
?>

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

<!DOCTYPE html>
<html lang="th">

<head>
    <!-- โค้ดอื่น ๆ ที่เป็นส่วนหัวของหน้าเว็บ -->
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Product Type</a>
            <!-- เพิ่มแบบฟอร์มค้นหาสินค้า -->
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                    id="search-input">
                <button class="btn btn-outline-success" type="button" onclick="searchProduct()">Search</button>
            </form>
        </div>
    </nav>

    <!-- โค้ดของ Navbar และส่วนอื่น ๆ ของหน้าเว็บ -->
    <?php
    if (isset($_GET['act']) && $_GET['act'] == 'add') {
        ?>
        <h3> เพิ่มประเภทสินค้า </h3>
        <form method="post" enctype="multipart/form-data">
            ประเภทสินค้า
            <textarea name="product_name" required class="form-control" placeholder="ประเภทสินค้า"></textarea>
            <div class="row"><br>
                <div class="d-grid gap-2 col-sm-6">
                    <button type="submit" class="btn btn-primary">เพิ่มประเภทสินค้า</button>
                </div>
                <div class="d-grid gap-2 col-sm-6">
                    <a href="product_type.php" class="btn btn-warning">ยกเลิก</a>
                </div>
            </div>
            <br>
        </form>
    <?php } ?>
    
    <div class="container mt-4">
        <form action="product_type.php" method="POST">
            <table class="table">
                <thead>
                    <tr>
                        <th>รหัส</th>

                        <th>ประเภทสินค้า</th>

                    </tr>
                </thead>
                <tbody id="product-list">
                    <!-- โค้ด PHP เพื่อแสดงข้อมูลสินค้าจากฐานข้อมูล -->
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";

                            echo "<td>" . $row['type_id'] . "</td>";
                            echo "<th>" . $row['type_name'] . "</th>";

                            //   echo "<td><input type='checkbox' name='selected_products[]' value='" . $row['type_id'] . "'></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>ไม่พบสินค้า</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- ปุ่มตกลงและยกเลิก -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <!-- <button class="btn btn-primary me-md-2" type="submit">เพิ่ม</button> -->
                <a href="product_type.php?act=add" class="btn btn-info btn-sm">+ประเภทสินค้า</a>
                <!-- <button class="btn btn-secondary" type="button" onclick="cancelSelection()">ยกเลิก</button> -->
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript สำหรับค้นหาข้อมูลสินค้า
        function searchProduct() {
            let input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search-input");
            filter = input.value.toUpperCase();
            table = document.getElementById("product-type");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // เลือก column ที่ 2 (ชื่อสินค้า)
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

  <!-- โค้ด JavaScript และส่วนท้ายของหน้าเว็บ -->
<?php 
include "../headtotoe/footer.php";
?>
</body >

</html >

            <?php
            $conn->close();
            
            ?>