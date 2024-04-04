<?php
include('../php/connectdb.php');
include('../headtotoe/headee.php');

// include('../headtotoe/nav.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Select Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/owl.carousel.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/tooplate-style.css">
    <style>
        /* Hide the product table initially */
        .product-table {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 9999;
        }

        /* Style for the close button */
        .close-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            /* สีพื้นหลัง */
            color: #333;
            /* สีข้อความ */
        }

        .container {
            background-color: #ffffff;
            /* สีพื้นหลังของตัวคอนเทนเนอร์ */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .number h2 {
            color: navy;
            /* สีข้อความหัวเรื่อง */
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }

        .form-section {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -10px;
            margin-left: -10px;
        }

        .col-md-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
            padding-right: 10px;
            padding-left: 10px;
        }

        .row .col-md-4:nth-child(odd) {
            margin-bottom: 10px;
        }

        .row .col-md-4:nth-child(even) {
            margin-bottom: 10px;
        }

        table {
            width: 84%;
            border-collapse: collapse;
            margin-inline: auto;
        }

        table th,
        table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        .product-table table {
            max-height: 400px;
            /* กำหนดความสูงสูงสุดของตารางสินค้า */
            overflow-y: auto;
            /* ทำให้เกิดการเลื่อนแถวเมื่อมีสินค้ามากเกินไป */
        }
    </style>


</head>

<body>

    <div class="container">
        <div class="number">
            <h3>รายการเบิก</h3><br>
            <button id="pendingBtn" class="btn btn-primary">รออนุมัติ</button>
            <button id="approvedBtn" class="btn btn-warning">อนุมัติแล้ว</button>
            <button id="rejectedBtn" class="btn btn-danger">ไม่อนุมัติ</button>
            <br>

            <br>
        </div>
    </div>

    </div>
    <div class="form-section">
        <div id="orderTableContainer"></div>
    </div>
    </div>

    <script>
        // Function to fetch and display the orders based on status

        // Sample data for demonstration
        // Make an AJAX request to retrieve data from the database
        // Function to fetch data from the database and display counts
        function fetchDataAndDisplayCounts() {
            // Make an AJAX request to retrieve data from the database
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Parse the JSON response
                    var data = JSON.parse(this.responseText);

                    // Initialize counters for each status
                    var pendingCount = 0;
                    var approvedCount = 0;
                    var rejectedCount = 0;

                    // Loop through the data and count each status
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].status === "pending") {
                            pendingCount++;
                        } else if (data[i].status === "approved") {
                            approvedCount++;
                        } else if (data[i].status === "rejected") {
                            rejectedCount++;
                        }
                    }

                    // Display counts
                    document.getElementById("pendingCount").innerText = "(" + pendingCount + ")";
                    document.getElementById("approvedCount").innerText = "(" + approvedCount + ")";
                    document.getElementById("rejectedCount").innerText = "(" + rejectedCount + ")";
                }
            };
            xhttp.open("GET", "get_data_from_database.php", true);
            xhttp.send();
        }

        // Call the function to fetch data and display counts when the page loads
        fetchDataAndDisplayCounts();

        function showOrders(status) {
            console.log("Status:", status); // Log the status parameter
            // Make an AJAX request to retrieve orders based on status
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("orderTableContainer").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "get_orders.php?status=" + status, true);
            xhttp.send();
        }


        // Event listeners for button clicks

        document.getElementById("pendingBtn").addEventListener("click", function () {
            showOrders('w'); // 'w' for pending status
        });

        document.getElementById("approvedBtn").addEventListener("click", function () {
            showOrders('a'); // 'c' for approved status
        });

        document.getElementById("rejectedBtn").addEventListener("click", function () {
            showOrders('r'); // 'n' for rejected status
        });

    </script>






    <!-- <div class="container-sm">
            <h3>รายการสินค้า</h3><br>
            <button id="showProductsBtn" class="btn btn-success">เลือกสินค้า</button>

            <!- Product table --
            <div id="productModal" class="product-table">
                <span class="close-btn" onclick="closeProductModal()">&times;</span>
                <form id="productForm" method="post" action="" style="size: 50%;">
                    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="ค้นหาสินค้า...">

                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>รหัสสินค้า</th>
                                <th>ชื่อสินค้า</th>
                                <th>รายละเอียด</th>
                                <th>ราคาขาย</th>
                                <th>จำนวน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Connect to your database (replace DB_USERNAME, DB_PASSWORD, DB_NAME with your actual database credentials)
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "tkndatabase";

                            // Create a connection to the database
                            $conn = mysqli_connect($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Retrieve data from the database
                            $sql = "SELECT * FROM product";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="selected_products[]"
                                                value="<?php echo $row['p_id']; ?>"></td>
                                        <td>
                                            <?php echo $row['p_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['p_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['p_detail']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['sell_price']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['p_num']; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='6'>0 results</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>

                    <button type="button" onclick="addSelectedProducts()">Add Selected Products</button>
                </form>
            </div> -->

    <!-- Container to display selected products -->
    <div id="selectedProductsContainer"></div>
    <!-- Add buttons -->
    <!-- Add buttons -->
    <!-- <div class="buttons">
                <br>
                <button type="button" onclick="saveProducts()" class="btn btn-primary">บันทึก</button>
                <!-- <button type="submit" name="registerbtn" class="btn btn-primary">Save</button> --
                <button type="button" onclick="cancel()" class="btn btn-danger">ยกเลิก</button>
            </div> -->

    <!-- </form> -->



    </div>
    <script>
        // Function to show the product modal
        function showProductModal() {
            document.getElementById("productModal").style.display = "block";
        }

        // Function to close the product modal
        function closeProductModal() {
            document.getElementById("productModal").style.display = "none";
        }

        // Function to add selected products
        function addSelectedProducts() {
            var form = document.getElementById("productForm");
            var selectedProducts = [];
            // Loop through the checkboxes to find selected products
            for (var i = 0; i < form.elements.length; i++) {
                if (form.elements[i].type === 'checkbox' && form.elements[i].checked) {
                    selectedProducts.push(form.elements[i].value);
                }
            }
            // Send the selected products to selected_products.php using AJAX
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Display the selected products returned from the PHP script
                    document.getElementById("selectedProductsContainer").innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "selected_products.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("selected_products=" + JSON.stringify(selectedProducts));
            // Close the product modal
            closeProductModal();
        }

        // Event listener for the button click to show the product modal
        document.getElementById("showProductsBtn").addEventListener("click", function () {
            showProductModal();
        });

        // Function to save products
        function saveProducts() {
            // ตรวจสอบว่าข้อมูลในฟอร์มถูกกรอกครบหรือไม่
            if (document.getElementById('company_name').value === '' ||
                document.getElementById('company_address').value === '' ||
                document.getElementById('delivery_date').value === '' ||
                document.getElementById('contact_person').value === '' ||
                document.getElementById('order_number').value === '' ||
                document.getElementById('delivery_period').value === '') {
                alert('โปรดกรอกข้อมูลให้ครบถ้วน');
                return;
            }

            // ส่งข้อมูลไปยังเซิร์ฟเวอร์เพื่อบันทึกข้อมูลในฐานข้อมูลด้วย AJAX
            // โดยคุณสามารถใช้ XMLHttpRequest หรือ Fetch API เพื่อทำการส่งข้อมูล

            // แสดงข้อความยืนยัน
            alert("บันทึกสินค้าสำเร็จ!");

            // ทำการ redirect ไปยังหน้าอื่น
            window.location.href = "fromsell_product.php";
        }

        // Function to cancel
        function cancel() {
            // ทำงานเมื่อกดปุ่มยกเลิก
            // คุณสามารถเพิ่มโค้ดเพื่อทำงานตามที่ต้องการเมื่อกดปุ่มยกเลิกได้ที่นี่
        }

        function searchTable() {
            // Get the input value for search
            var input = document.getElementById("searchInput");
            var filter = input.value.toUpperCase();

            // Select the product table
            var table = document.querySelector("#productModal table");
            var tr = table.getElementsByTagName("tr");

            // Loop through to hide/show rows based on search
            for (var i = 0; i < tr.length; i++) {
                var td = tr[i].getElementsByTagName("td")[2]; // Select product name (2nd column)

                if (td) {
                    var txtValue = td.textContent || td.innerText;
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

</html>