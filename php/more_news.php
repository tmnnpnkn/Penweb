<?php
include('connectdb.php');

// include('../headtotoe/header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>TOYOTA Kaennakorn</title>

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

<body id="top" data-spy="scroll" data-target=".navbar-collapse" style="background: #285430;">

    <div class="container" style="background: #ffffff;">

        <!-- PRE LOADER -->
        <!-- <section class="preloader">
        <div class="spinner">

            <span class="spinner-rotate"></span>

        </div>
    </section> -->


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
        <section class="navbar navbar-default navbar-static-top" role="navigation" style="width: 1200px">
            <div class="container">

                <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon icon-bar"></span>
                        <span class="icon icon-bar"></span>
                        <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="../index.php" class="navbar-brand">
                        <img src="../images/Logo.png" class="img-responsive" alt="Image" height="50" width="100" style="margin-top: -8px"></a>
                </div>

                <!-- MENU LINKS -->
                <div class="collapse navbar-collapse" >
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

                        <li><a href="logout.php" class="smoothScroll">ออกจากระบบ</a></li>

                    </ul>
                </div>
            </div>
        </section>

        <div class="container">
            <?php
            $query = " select * from articles ORDER BY datesave DESC ";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<hr>";
                ?>
             
                <div class="col-md-4 col-sm-9 theboxes" style="margin: 10px 0 10px">
                    <div class="col-md-5 col-sm-12 ">
                        <img src="../images/<?php echo $row['img']; ?> " class="img-thumbnail" alt="" style="width:300px;">
                    </div>
                         <!-- <strong>
                            ?php echo $row['datesave']; ?>
                        </strong>
                         -->
                    <div class="col-md-5 col-sm-12" style="margin-top:-7px">
                       

                        <form action="more_post.php" method="post">
                           <a href="javascript:;" onclick="parentNode.submit();"><h3><?php echo mb_strimwidth($row['title'], 0, 60, "..."); ?></h3></a>
                            <input type="hidden" name="more_id" value="<?php echo $row['a_id']; ?>"/>
                            <p><strong><?php echo mb_strimwidth($row['txtMessage'], 0, 100, "..."); ?></strong></p>
                        </form>
                    </div>
                    
                    
                </div>
                
                

               
                <?php
                
                echo "<hr>";
            }
            
            ?>
        </div>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.sticky.js"></script>
    <script src="../js/jquery.stellar.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script src="../js/smoothscroll.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/custom.js"></script>

</body>

</html>