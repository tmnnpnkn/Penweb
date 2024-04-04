
<?php 
include('connectdb.php');
include('../headtotoe/headee.php');
include('../headtotoe/nav.php');
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

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product List</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <style>
    /* Custom CSS for table */
    #productTable {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    #productTable th,
    #productTable td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center;
    }

    #productTable th {
      background-color: #f2f2f2;
      font-weight: bold;
      font-size: 16px;
    }

    #productTable tr:nth-child(even) {
      background-color: #f8f9fa;
    }

    #productTable tr:hover {
      background-color: #e9ecef;
    }

    /* CSS for search input */
    #searchInput {
      margin-bottom: 20px;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ced4da;
      width: 100%;
      max-width: 400px;
    }

    #searchInput:focus {
      outline: none;
      border-color: #4dabf7;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Button style */
    .btn-custom {
      padding: 8px 16px;
      font-size: 14px;
      border-radius: 5px;
    }

    .btn-custom-success {
      background-color: #28a745;
      color: #fff;
      border: 1px solid #28a745;
    }

    .btn-custom-success:hover {
      background-color: #218838;
      border-color: #1e7e34;
    }
  </style>
  <script>
    function searchTable() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("searchInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("productTable");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0]; // Change index to match the column you want to search
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
  </script>
</head>


<body>

  <div class="container">
  <input type="text" id="searchInput" oninput="searchTable()" class="form-control" placeholder="ค้นหาสินค้า...">

    <?php
    include 'connectdb.php';

    // กำหนดจำนวนรายการสินค้าที่ต้องการแสดงในแต่ละหน้า
    $itemsPerPage = 10;

    // ตรวจสอบหมายเลขหน้าที่รับมาจากการกำหนดหรือการกดลิงก์หน้า
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // คำนวณ offset สำหรับแต่ละหน้า
    $offset = ($page - 1) * $itemsPerPage;

    // ดึงข้อมูลสินค้าจากฐานข้อมูลโดยใช้ LIMIT และ OFFSET
    $sql = "SELECT product.p_id, product.p_name, product.p_detail, product.sell_price, product.p_num, tbl_product_type.type_name
        FROM product
        INNER JOIN tbl_product_type ON product.type_id = tbl_product_type.type_id
        LIMIT $offset, $itemsPerPage";
    $result = mysqli_query($conn, $sql);
    
    // แสดงผลข้อมูลในตาราง HTML
    echo '<table id="productTable" class="table table-striped">';
    echo '<thead><tr>';
    echo '<th>ชื่อสินค้า</th>';
    echo '<th>ประเภทสินค้า</th>';
    echo '<th>รายละเอียด</th>';
    echo '<th>ราคาขาย(บาท)</th>';
    echo '<th>จำนวน</th>';

    echo '</tr></thead>';
    echo '<tbody>';

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['p_name'] . '</td>';
        echo '<td>' . $row['type_name'] . '</td>';
        echo '<td>' . $row['p_detail'] . '</td>';
        echo '<td>' . $row['sell_price'] . '</td>';
        echo '<td>' . $row['p_num'] . '</td>';

        echo '</tr>';
      }
    } else {
      echo '<tr><td colspan="6">ไม่พบสินค้า</td></tr>';
    }

    echo '</tbody></table>';

    // สร้างลิงก์หน้าสำหรับการเปลี่ยนหน้า
    $totalItemsQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM product");
    $totalItems = mysqli_fetch_assoc($totalItemsQuery)['total'];
    $totalPages = ceil($totalItems / $itemsPerPage);

    echo '<div class="pagination">';
    for ($i = 1; $i <= $totalPages; $i++) {
      echo '<a href="?page=' . $i . '" class="page-link">' . $i . '</a>';
    }
    echo '</div>';


    mysqli_close($conn);
    ?>

  </div>
  <script>
function searchTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("productTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0]; // Change index to match the column you want to search
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

  
</script>
</body>

</div>
</div>

<body>

</html>
<?php

include ('../headtotoe/footer.php');
?>