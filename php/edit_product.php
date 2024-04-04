<?php
include ('connectdb.php');
include ('../headtotoe/header.php');
include ('../headtotoe/headee.php');
?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/owl.carousel.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/tooplate-style.css">
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->

    <head>
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary"> แก้ไขสินค้า </h4>
                </div>
                <div class="card-body">
                    <?php



                    if (isset($_POST['edit_btn'])) {
                        $id = $_POST['edit_id'];

                        $query = "SELECT product.*, tbl_product_type.type_name 
          FROM product 
          JOIN tbl_product_type ON product.type_id = tbl_product_type.type_id
          WHERE product.p_id ='$id' ";

                        $query_run = mysqli_query($conn, $query);
                        foreach ($query_run as $row) {
                            $stmtType = $conn->prepare("SELECT type_id FROM tbl_product_type WHERE type_name = ?");
                            $stmtType->bind_param("s", $type_name);
                            $stmtType->execute();
                            $resultType = $stmtType->get_result();
                            $rowType = $resultType->fetch_assoc();
                            // $type_id = $rowType['type_id'];
                            $type_name = $row['type_name'];
                            ?>

                            <form action="code.php" method="POST">

                                <input type="hidden" name="edit_id" value="<?php echo $row['p_id'] ?>">

                                <!-- <div class="form-group">
                                    <br>
                                    <label> ชื่อ </label>
                                    <input type="text" name="edit_Name" value="<?php echo $row['p_name'] ?>" class="form-control"
                                        placeholder="กรอกชื่อ">
                                </div>
                                <div class="form-group">
                                    <label> นามสกุล </label>
                                    <input type="text" name="edit_Lastname" value="<?php echo $row['p_detail'] ?>"
                                        class="form-control" placeholder="กรอกนามสกุล">
                                </div> -->

                                <div class="row mb-3">
                                    <div class="col">
                                        ไอดี
                                        <input type="text" name="edit_pid" value="<?php echo $row['p_id']; ?>"
                                            class="form-control" placeholder="กรอกชื่อ" readonly>

                                    </div>
                                    <div class="col">
                                        ชื่อ
                                        <input type="text" name="edit_pname" value="<?php echo $row['p_name']; ?>"
                                            class="form-control" placeholder="กรอกชื่อ" readonly>

                                    </div>
                                    <div class="col">
                                        ประเภท
                                        <select name="edit_Type" class="form-control">
                                            <?php
                                            // Debugging: Output the value of $_POST['edit_Type']
                                            echo "Edit Type: " . $_POST['edit_Type'] . "<br>";

                                            // Query to retrieve all product types
                                            $query_types = "SELECT type_id, type_name FROM tbl_product_type";
                                            $result_types = mysqli_query($conn, $query_types);

                                            // Loop through each product type
                                            while ($row_type = mysqli_fetch_assoc($result_types)) {
                                                $type_id = $row_type['type_id'];
                                                $type_name = $row_type['type_name'];

                                                // Debugging: Output each type name fetched from the database
                                                echo "Type Name from Database: " . $type_name . "<br>";

                                                // Check if the current type matches this option
                                                $selected = ($type_name == $_POST['edit_Type']) ? 'selected' : '';

                                                // Display the option
                                                echo "<option value='$type_id' $selected>$type_name</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>



                                    <div class="col">
                                        รายละเอียด
                                        <input type="text" name="edit_detail" value="<?php echo $row['p_detail'] ?>"
                                            class="form-control" placeholder="กรอกรายละเอียด" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        ราคาซื้อ
                                        <input type="number" name="edit_bp" value="<?php echo $row['buy_price'] ?>"
                                            class="form-control" placeholder="กรอกราคาซื้อ" required min="0" step="0.01">
                                </div>

                                <div class="col">
                                    ราคาขาย
                                    <input type="number" name="edit_sp" value="<?php echo $row['sell_price'] ?>"
                                        class="form-control" placeholder="กรอกราคาขาย" required min="0" step="0.01">
                                </div>


                                <br>
                                <br>
                                <br>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">สถานะ</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="edit_status" id="edit_status_a"
                                                value="a" <?php echo ($row['status'] == 'a') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="edit_status_a">
                                                ขายอยู่
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="edit_status" id="edit_status_n"
                                                value="n" <?php echo ($row['status'] == 'n') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="edit_status_n">
                                                เลิกขาย
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <br>
                                <a href="product_edit.php" class="btn btn-danger"> ยกเลิก </a>
                                <button type="submit" name="update_pdbtn" class="btn btn-primary"> แก้ไข </button>

                            </form>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        </div>

        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.js"></script>
        <?php
        include ('../headtotoe/footer.php');
        ?>