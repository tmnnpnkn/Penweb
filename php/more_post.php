<?php
include('connectdb.php');
// include('../headtotoe/counter.php')
// include('../headtotoe/header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Toyota Kaennakorn</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Tooplate">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/owl.carousel.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">

    <script type="text/javascript" src="js/calendar.js"></script>

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="../css/tooplate-style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->

</head>

<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50" style="background: #285430;">

    <div class="container" style="background: #ffffff;">



        <!-- HEADER -->
        <header>
            <div class="container">
                <div class="row">

                    <div class="col-md-12 col-sm-12 text-align-center">
                        <h22>TOYOTA</h22>
                        <h21>KAENNAKORN</h21>
                    </div>

                </div>
            </div>
        </header>
        <!-- MENU -->
        <section class="navbar navbar-default navbar-static-top" role="navigation" style="width:auto">
            <div class="container">

                <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon icon-bar"></span>
                        <span class="icon icon-bar"></span>
                        <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="../index.php">
                        <img src="../images/Logo.png" class="img-responsive" alt="Image" height="50" width="120"></a>
                </div>

                <!-- MENU LINKS -->
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../index.php" class="smoothScroll">Home</a></li>
                        <li><a href="#about" class="smoothScroll">About</a></li>
                        <li><a href="../team.html" class="smoothScroll">Team</a></li>
                        <li><a href="php/more_news.php" class="smoothScroll">ข่าว</a></li>
                        <li><a href="../sawasdikarn.html" class="smoothScroll">สวัสดิการ</a></li>
                        <li><a href="../promotions.html" class="smoothScroll">Promotions</a></li>
                        <!--<li class="appointment-btn"><a href="login.html">login</a></li>-->

                        <div class="dropdown">

                            <o>Menu</o>
                            <div class="dropdown-content">
                                <a href="https://repairit.tkn.co.th/">แจ้งซ่อมIT</a>
                                <a href="https://booking.tkn.co.th/">จองห้องประชุม</a>
                                <a href="https://bookingcar.tkn.co.th/">จองรถใช้งาน</a>
                            </div>
                        </div>

                    </ul>
                </div>

            </div>
        </section>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <!-- <div class="card-header py-6">
                <h2 class="m-0 font-weight-bold text-primary" style="background: #f9f9f9;"> Post </h2>
            </div> -->
            <div class="card-body">
                <?php

                if (isset($_POST['more_id'])) {
                    $id = $_POST['more_id'];

                    $sql = "SELECT * FROM articles WHERE a_id='$id' ";
                    $result = mysqli_query($conn, $sql);

                    $sqlUpdate = "UPDATE articles SET view_count = view_count + 1 WHERE a_id = '$id'";
                    $resultUpdate = mysqli_query($conn, $sqlUpdate);

                    if ($resultUpdate) {
                        // View count updated successfully
                
                        // Retrieve the article with the updated view count
                        $sql = "SELECT * FROM articles WHERE a_id = '$id'";
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $viewCount = $row['view_count'];

                            // Display the view count
                            // echo "View Count: " . $viewCount;

                            foreach ($result as $row) {
                                ?>

                                <form action="code.php" method="POST" style="padding:0px">

                                    <input type="hidden" name="more_id" value="<?php echo $row['a_id'] ?>">
                                    <div class="form-group">
                                        <!-- <label> Title </label><br> -->
                                        <h2>
                                            <?php echo $row['title'] ?>
                                        </h2>
                                        <img src="../images/<?php echo $row['img']; ?> " class="img-responsive" alt="Image"
                                            height="auto" width="1000">

                                    </div>
                                    <div class="form-group">
                                        <!-- <label>ข้อความ</label> -->
                                        <?php echo $row['txtMessage'] ?>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label>ข้อความ</label> -->


                                    </div>

                                    <br>
                                    <a href="javascript:history.back()" class="btn btn-danger"> Back </a>
                                    <!-- <button type="submit" name="update_pbtn" class="btn btn-primary"> Back </button> -->

                                </form>
                                <?php
                            }
                        } else {
                            echo "Error updating view count: " . mysqli_error($conn);
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>

    </div>
    <script src="../js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>