<?php
include('connectdb.php');
include('../headtotoe/header.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ADD news TKN</title>
    <!--bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- ckeditor-->
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br><br><br>
                <form action="notice.php" method="POST" enctype="multipart/form-data" name="addform"
                    class="form-horizontal" id="addform">
                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <b> เพิ่มประาสัมพันธ์ : TKN</b>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2" align="right"> หัวข้อ : </div>
                        <div class="col-sm-8" align="left">
                            <input name="title" id="title" type="text" required class="form-control"
                                placeholder="หัวข้อข่าว" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2" align="right">รายละเอียด</div>
                        <div class="col-sm-8" align="left">
                            <textarea name="txtmssge" id="txtmssge" class="ckeditor" cols="69" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2"> </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary" id="btn" name="newbtn"> บันทึก
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<meta charset="UTF-8" />
<?php
if (isset($_POST['newbtn'])) {
    $title = $_POST['title'];
    $txtmssge = $_POST['txtmssge'];

$sql = "INSERT INTO prakad (title, txtmssge) VALUES('$title','$txtmssge')";
$result = mysqli_query($conn, $sql) or die("Error in query: $sql " .mysqli_error($conn));
mysqli_close($conn);
if ($result) {

    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มประชาสัมพันธ์เรียบร้อย');";
    echo "window.location='notice_manage.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('Error!');";
    echo "window.location='notice_manage.php';";
    echo "</script>";
}
}

?>