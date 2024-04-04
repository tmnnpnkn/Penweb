<?php

include ("connectdb.php");
// include("php/login.php");
// include('../headtotoe/headee.php');
// session_start();

?>
<!DOCTYPE html>
<html lang="en">
<?php
// include ('headtotoe/navbar.php');
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
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
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
                        echo '<span class="text-white ms-2">' . $_SESSION['name'] . '</span>';
                    } else {
                        echo "0 results";
                    }
                    ?>
                </div>

        </div>
    </div>
    <!-- Right elements -->
    
    <!-- Container wrapper -->
</nav>

<body class="sb-nav-fixed">
    <div class="container-fluid">
        <div class="d-flex flex-nowrap">
            <div class="col-auto col-md-2 col-xl-2 px-sm-2 px-0 bg-dark">

                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">

                    <a href="#"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-4 d-none d-sm-inline">เมนู</span>
                    </a>
                    <ul class="nav flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="homeuser.php" class="nav-link align-middle px-0">
                                <i class="bi bi-house"></i>
                                <span class="fs-6 xl-3 d-none d-sm-inline">หน้าหลัก</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="show_product.php" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i>
                                <span class="fs-6 ms-1 d-none d-sm-inline">สินค้า</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="cart.php" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i>
                                <span class="fs-6 ms-1 d-none d-sm-inline">เบิกสินค้า</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="view_invoice1.php" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i>
                                <span class="fs-6 ms-1 d-none d-sm-inline">ประวัติการเบิก</span>
                            </a>
                        </li>
                        <li class="nav-item">
                                <a href="../php/logout.php" class="nav-link align-middle px-0">
                                    <i class="fs-4 bi-door-closed"></i>
                                    <span class="ms-1 d-none d-sm-inline">ออกจากระบบ</span>
                                </a>
                            </li>
                    </ul>
                    <hr>
                </div>
            </div>