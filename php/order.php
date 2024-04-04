<?php

include("connectdb.php");
// include("php/login.php");
include("../headtotoe/headee.php");







    ?>
    <!DOCTYPE html>
    <html lang="en">
    <?php
    // include ('headtotoe/navbar.php');
    ?>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <!-- <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script> -->
        <link href="../css/sb-admin-2.min.css" rel="stylesheet">
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
        <link href="../css/popup.css rel" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="../css/count.css">
    </head>

    <body class="sb-nav-fixed">
        <div class="container-fluid">
            <div class="d-flex flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <a href="/"
                            class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline">Menu</span>
                        </a>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                            id="menu">
                            <li class="nav-item">
                                <a href="#" class="nav-link align-middle px-0">
                                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-speedometer2"></i> <span
                                        class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
                                <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                    <li class="w-100">
                                        <a href="register.php" class="nav-link px-0"> <span
                                                class="d-none d-sm-inline text-white">Manage User
                                                </span> </a>
                                    </li>
                                    <li>
                                        <a href="formAddProduct.php" class="nav-link px-0"> <span
                                                class="d-none d-sm-inline text-white">Manage Product</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0 align-middle">
                                    <i class="fs-4 bi-table">
                                        <a href="order.php" class="nav-link px-0">
                                    </i> <span class="ms-1 d-none d-sm-inline">Orders</span></a>
                            </li>
                            
                            
                            
                        </ul>
                        <hr>
                        <div class="dropdown pb-4">
                            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="images/profile.jpg" alt="hugenerd" width="30" height="30" class="rounded-circle">
                                <span class="d-none d-sm-inline mx-1">admin</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                <li><a class="dropdown-item" href="#">New project...</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="php/logout.php">Sign out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <div class="col-auto col-md-9 ">
                    <div id="layoutSidenav_content">
                        <main>
                            <div class="container-fluid">
                                <h1 class="mt-4">Sales</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>


                                <!-- <div class="row">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="card bg-primary text-white mb-4">
                                            <div class="card-body">User Management</div>
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <a class="small text-white stretched-link" href="php/register.php">View
                                                    Details</a>
                                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="card bg-warning text-white mb-4">
                                            <div class="card-body">Post</div>
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <a class="small text-white stretched-link" href="php/post_manage.php">View
                                                    Details</a>
                                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="card bg-success text-white mb-4">
                                            <div class="card-body">Notice</div>
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <a class="small text-white stretched-link" href="php/notice_manage.php">View
                                                    Details</a>
                                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                </div> -->


                                <?php
                                $sql2 = "select * from user ";
                                $query2 = mysqli_query($conn, $sql2);
                                $total_user = mysqli_num_rows($query2);


                                $sql3 = "select * from articles";
                                $query3 = mysqli_query($conn, $sql3);
                                $total_news = mysqli_num_rows($query3);

                                $sql4 = "select * from prakad";
                                $query4 = mysqli_query($conn, $sql4);
                                $total_notice = mysqli_num_rows($query4);

                                $sql5 = "select * from product";
                                $query5 = mysqli_query($conn, $sql5);
                                $total_product = mysqli_num_rows($query5);
                                
                                ?>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="order_q.php">
                                                <div class="card-counter info">
                                                    <i class="fa fa-list-alt"></i>
                                                    <span class="count-numbers">
                                                        
                                                    </span>
                                                    <span class="count-name">ใบเสนอราคา</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                        <a href="order_s.php">
                                            <div class="card-counter primary">
                                                <i class="fa fa-newspaper-o"></i>
                                                <span class="count-numbers">
                                                    
                                                </span>
                                                <span class="count-name">ใบสั่งขาย</span>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-3">
                                        <a href="product.php">
                                            <div class="card-counter danger">
                                                <i class="fa fa-cart-plus"></i>
                                                <span class="count-numbers">
                                                  
                                                </span>
                                                <span class="count-name">รายการสินค้า</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="register.php">
                                                <div class="card-counter success">
                                                    <i class="fa fa-money"></i>
                                                    <span class="count-numbers">
                                                        
                                                    </span>
                                                    <span class="count-name">ยอดขาย</span>
                                                </div>
                                            </a>
                                        </div> -->


                                    </div>
                                </div>

                                

                                   
                                </div>
                                
                            </div>
                        </main>
                    </div>
                    <!-- <footer class="py-4 bg-light mt-auto">
                        <div class="container-fluid px-12">
                            <div class="d-flex align-items-center justify-content-between small">
                                <div class="text-muted">Copyright &copy; Your Website 2023</div>
                                <div>
                                    <a href="#">Privacy Policy</a>
                                    &middot;
                                    <a href="#">Terms &amp; Conditions</a>
                                </div>
                            </div>
                        </div>
                    </footer> -->
                </div>
            </div>
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" -->
            <!-- crossorigin="anonymous"></script> -->
            <script src="js/scripts.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
                crossorigin="anonymous"></script>
            <script src="assets/demo/chart-area-demo.js"></script>
            <script src="assets/demo/chart-bar-demo.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
                crossorigin="anonymous"></script>
            <script src="js/datatables-simple-demo.js"></script>

    </body>

    </html>
    <?php

    //include('../headtotoe/footer.php');


?>