<link href="css/styles.css" rel="stylesheet" />

<head>
    <!-- <meta charset="utf-8" />
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



<body class="sb-nav-fixed">
    <div class="container-fluid">
        <div class="d-flex flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="../adminpanel.php"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">เมนู</span>
                    </a>
                    <ul class="nav flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="../adminpanel.php" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i>
                                <span class="ms-1 d-none d-sm-inline">หน้าหลัก</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="../php/register.php" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i>
                                <span class="ms-1 d-none d-sm-inline" style="white-space: nowrap;">จัดการผู้ใช้</span>
                            </a>
                        </li>

                        <li>
                            <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-house"></i>
                                <span class="ms-1 d-none d-sm-inline">จัดการสินค้า</span>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu4" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="../php/formAddProduct.php" class="nav-link px-0">
                                        <span class="d-none d-sm-inline text-white">เพิ่มสินค้าใหม่</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../php/AddnumProduct.php" class="nav-link px-0">
                                        <span class="d-none d-sm-inline text-white">เพิ่มสินค้าในคลัง</span>
                                    </a>
                                </li>
                                <li class="w-100">
                                    <a href="../php/product_edit.php" class="nav-link px-0">
                                        <span class="d-none d-sm-inline text-white">แก้ไขสินค้า</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="../php/show_product.php" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i>
                                <span class="ms-1 d-none d-sm-inline" style="white-space: nowrap;">ค้นหาสินค้า</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../php/add_product_type.php" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i>
                                <span class="ms-1 d-none d-sm-inline"
                                    style="white-space: nowrap;">จัดการประเภทสินค้า</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../php/confirm_order.php" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i>
                                <span class="ms-1 d-none d-sm-inline"
                                    style="white-space: nowrap;">จัดการเบิกสินค้า</span>
                            </a>
                        </li>
                        <li>
                            <a href="#submenu5" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-house"></i>
                                <span class="ms-1 d-none d-sm-inline">จัดการรายงาน</span>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu5" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="../php/view_bai.php" class="nav-link px-0">
                                        <span class="d-none d-sm-inline text-white">สรุปรายการเบิก-จ่าย</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="../php/summary_month.php" class="nav-link px-0">
                                        <span class="d-none d-sm-inline text-white">สรุปยอดขายรายเดือน</span>
                                    </a>
                                </li>
                                <li class="w-100">
                                    <a href="../php/summary_years.php" class="nav-link px-0">
                                        <span class="d-none d-sm-inline text-white">สรุปยอดขายรายปี</span>
                                    </a>
                                </li>
                                <li class="w-100">
                                    <a href="../php/summaryP_month.php" class="nav-link px-0">
                                        <span class="d-none d-sm-inline text-white">สรุปยอดขายสินค้าตามเดือน</span>
                                    </a>
                                </li>
                                <li class="w-100">
                                    <a href="../php/summaryP_years.php" class="nav-link px-0">
                                        <span class="d-none d-sm-inline text-white">สรุปยอดขายสินค้าตามปี</span>
                                    </a>
                                </li>
                            </ul>
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
       

          