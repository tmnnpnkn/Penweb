<?php
include('connectdb.php');
// include('../headtotoe/header.php');
?>

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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->

    <head>
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> EDIT Post </h6>
                </div>
                <div class="card-body">
                    <?php

                    if (isset($_POST['edit_pbtn'])) {
                        $id = $_POST['edit_pid'];

                        $query = "SELECT * FROM articles WHERE a_id='$id' ";
                        $query_run = mysqli_query($conn, $query);

                        foreach ($query_run as $row) {
                            $edit_text = $row['txtMessage'];
                            ?>
                            <form action="code.php" method="POST" enctype="multipart/form-data">

                                <input type="hidden" name="edit_pid" value="<?php echo $row['a_id'] ?>">

                                <div class="form-group">
                                    <label> Title </label>
                                    <input class="form-control" placeholder="Enter Username" type="text" name="edit_title" value="<?php echo $row['title'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>ข้อความ</label>
                                    <textarea class="form-control" style="height:150px" placeholder="Enter Text" name="edit_text"><?php echo htmlspecialchars($edit_text) ?></textarea>
                                </div>

                                <div class="form-group">
                                    <br>
                                    <img src="../images/<?php echo $row['img']; ?> " class="img-responsive" alt="Image"
                                        width="360">
                                    <br><label>Change Image </label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <br>
                                <a href="post_manage.php" class="btn btn-danger"> CANCEL </a>
                                <button type="submit" name="update_pbtn" class="btn btn-primary"> Update </button>

                            </form>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        </div>