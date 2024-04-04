<?php
include('connectdb.php');
include('../headtotoe/header.php');
include('../headtotoe/headee.php');
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
                    <h4 class="m-0 font-weight-bold text-primary"> แก้ไขผู้ใช้งาน </h4>
                </div>
                <div class="card-body">
                    <?php

                    if (isset($_POST['edit_btn'])) {
                        $id = $_POST['edit_id'];

                        $query = "SELECT * FROM user WHERE id='$id' ";
                        $query_run = mysqli_query($conn, $query);


                        foreach ($query_run as $row) {
                            ?>

                            <form action="code.php" method="POST">

                                <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">

                                <!-- <div class="form-group">
                                    <br>
                                    <label> ชื่อ </label>
                                    <input type="text" name="edit_Name" value="<?php echo $row['Name'] ?>" class="form-control"
                                        placeholder="กรอกชื่อ">
                                </div>
                                <div class="form-group">
                                    <label> นามสกุล </label>
                                    <input type="text" name="edit_Lastname" value="<?php echo $row['Lastname'] ?>"
                                        class="form-control" placeholder="กรอกนามสกุล">
                                </div> -->
                                <div class="row mb-3">
                                    <div class="col">
                                        ชื่อ
                                        <input type="text" name="edit_Name" value="<?php echo $row['Name'] ?>"
                                            class="form-control" placeholder="กรอกชื่อ">
                                    </div>
                                    <div class="col">
                                        นามสกุล
                                        <input type="text" name="edit_Lastname" value="<?php echo $row['Lastname'] ?>"
                                            class="form-control" placeholder="กรอกนามสกุล">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        ชื่อผู้ใช้
                                        <input type="text" name="edit_username" value="<?php echo $row['Username']; ?>" class="form-control" placeholder="กรอกชื่อผู้ใช้" readonly>

                                    </div>
                                    <div class="col">
                                        รหัสผ่าน
                                        <input name="edit_password" value="<?php echo $row['Password'] ?>" class="form-control"
                                            placeholder="รหัสผ่าน">
                                    </div>
                                </div>
                                
                                <br>
                                <!-- <div class="form-group">
                                    <label> ชื่อผู้ใช้ </label>
                                    <input type="text" name="edit_username" value="<?php echo $row['Username'] ?>"
                                        class="form-control" placeholder="กรอกชื่อผู้ใช้">
                                </div> -->


                                <!-- <div class="form-group">
                                    <label>เบอร์โทร</label>
                                    <input type="text" name="edit_tel" value="<?php echo $row['Tel'] ?>" class="form-control"
                                        placeholder="เบอร์โทรศัพท์">
                                </div> -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="edit_tel">เบอร์โทร</label>
                                            <input type="text" name="edit_tel" id="edit_tel" value="<?php echo $row['Tel']; ?>"
                                                class="form-control" placeholder="เบอร์โทรศัพท์">
                                        </div>
                                    </div>
                                </div>


                                <!-- <div class="form-group">
                                    <label>รหัสผ่าน</label>
                                    <input name="edit_password" value="<?php echo $row['Password'] ?>" class="form-control"
                                        placeholder="รหัสผ่าน">
                                </div> -->




                                <!-- <div class="from-group">
                                    <label for="">บทบาท</label>
                                    <select name="edit_role" class="form-control">
                                        <?php if ($row['Role'] === 'a') { ?>
                                            <option value="a" selected>แอดมิน</option>
                                            <option value="m">พนักงานขาย</option>
                                        <?php } elseif ($row['Role'] === 'm') { ?>
                                            <option value="a">แอดมิน</option>
                                            <option value="m" selected>พนักงานขาย</option>
                                        <?php } else { ?>
                                            <option value="a">แอดมิน</option>
                                            <option value="m">พนักงานขาย</option>
                                        <?php } ?>
                                    </select>
                                </div> -->
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">บทบาท</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="edit_role" id="edit_role_admin"
                                                value="a" <?php echo ($row['Role'] === 'a') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="edit_role_admin">
                                                แอดมิน
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="edit_role" id="edit_role_sales"
                                                value="n" <?php echo ($row['Role'] === 'n') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="edit_role_sales">
                                                พนักงานขาย
                                            </label>
                                        </div>
                                        <?php
                                        // Debugging: Output the value of $row['Role']
                                        // echo "Value of \$row['Role']: " . $row['Role'];
                                        // Debugging: Output the result of the condition
                                        // echo ($row['Role'] === 'm') ? 'Condition Met' : 'Condition Not Met';
                                        ?>
                                    </div>
                                </fieldset>



                                <!-- <div class="from-group">
                                    <label for="">สถานะ</label>
                                    <select name="edit_status" class="form-control">
                                        <option value="a" <?php echo ($row['status'] == 'a') ? 'selected' : ''; ?>>ใช้งานอยู่
                                        </option>
                                        <option value="n" <?php echo ($row['status'] == 'n') ? 'selected' : ''; ?>>ไม่ใช้งาน
                                        </option>
                                    </select>
                                </div> -->
                                <br>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">สถานะ</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="edit_status" id="edit_status_a"
                                                value="a" <?php echo ($row['status'] == 'a') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="edit_status_a">
                                                ใช้งานอยู่
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="edit_status" id="edit_status_n"
                                                value="n" <?php echo ($row['status'] == 'n') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="edit_status_n">
                                                ไม่ใช้งาน
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <br>
                                <a href="register.php" class="btn btn-danger"> ยกเลิก </a>
                                <button type="submit" name="updatebtn" class="btn btn-primary"> แก้ไข </button>

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
        include('../headtotoe/footer.php');
        ?>