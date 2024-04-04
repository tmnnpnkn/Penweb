<?php
include('connectdb.php');
// include('../headtotoe/header.php');

?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/owl.carousel.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/tooplate-style.css">

</head>

        <div class="container-fluid">

            <div class="card shadow my-4">
                <div class="card-header py-3 d-flex">
                    <h6 class="m-2 font-weight-bold text-primary ">Notice Management</h6>
                    <a href="notice.php"><button type="button" class="btn btn-primary ms-auto" name="addpost">Add Notice</button></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php
                        $query = "SELECT * FROM prakad ORDER BY time DESC limit {$start},{$perpage}";
                        $query_run = mysqli_query($conn, $query);
                        ?>
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Title </th>
                                    <th> txtMessage </th>
                                    <!-- <th> img </th> -->
                                    <!-- <th>m_username </th> -->
                                    <th>Date</th>
                                    
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['pk_id']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['title']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['txtmssge']; ?>
                                            </td>
                                            
                                            <td>
                                                <?php echo $row['time']; ?>
                                            </td>
                                           
                                            <td>
                                                <form action="notice_edit.php" method="post">
                                                    <input type="hidden" name="edit_pkid" value="<?php echo $row['pk_id']; ?>">
                                                    <button type="submit" name="edit_pkbtn" class="btn btn-warning"> EDIT</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="code.php" method="post">
                                                    <input type="hidden" name="delete_pkid" value="<?php echo $row['pk_id']; ?>">
                                                    <button type="submit" name="delete_pkbtn" class="btn btn-danger">
                                                        DELETE</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "No Record Found";
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                            $sql2 = "select * from prakad ";
                            $query2 = mysqli_query($conn, $sql2);
                            $total_record = mysqli_num_rows($query2);
                            $total_page = ceil($total_record / $perpage);
                            ?>
                            
                            <nav>
                            <ul class="pagination " >
                            <li>
                            <a href="notice_manage.php?page=1" aria-label="Previous">
                            <span aria-hidden="true">&NestedLessLess;</span>
                            </a>
                            </li>
                            <?php for($i=1;$i<=$total_page;$i++){ ?>
                            <li><a href="notice_manage.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php } ?>
                            <li>
                            <a href="notice_manage.php?page=<?php echo $total_page;?>" aria-label="Next">
                            <span aria-hidden="true">&NestedGreaterGreater;</span>
                            </a>
                            </li>
                            </ul>
                            </nav>
                    </div>
                </div>
            </div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<?php

?>