<?php 
session_start();
?>
<link href="../css/styles.css" rel="stylesheet" />
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Admin</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <!-- <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script> -->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
        <link href="css/popup.css rel" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="css/count.css">
        <!-- Add this just before </body> or in the <head> section -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </head>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-blue">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand" href="#">
                P.E.N INTERTRADE
            </a>

            <!-- Right elements -->
            <div class="ms-auto d-flex align-items-center"> <!-- ใช้คลาส ms-auto เพื่อชิดขอบขวา -->
                <?php
                // echo '<div>ยินดีต้อนรับ, ' . $_SESSION['name'] . '</div>';
                // สร้างคำสั่ง SQL เพื่อดึงชื่อผู้ใช้
                $sql = "SELECT name FROM user WHERE id = id"; // แทนที่รหัสผู้ใช้ด้วยรหัสของผู้ใช้ที่เข้าสู่ระบบ
                $result = mysqli_query($conn, $sql);

                // ตรวจสอบว่ามีข้อมูลหรือไม่
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $userName = $row['name'];

                    // แสดงรูปโปรไฟล์
                    echo '<img src="../images/user.png" class="rounded-circle" height="25" alt="' . $userName . '" loading="lazy" />';
                    // แสดงชื่อผู้ใช้
                    echo '<span class="text-white ms-2">' . $_SESSION['name']. '</span>';
                } else {
                    echo "0 results";
                }
                ?>
            </div>
            <!-- Right elements -->
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->
