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
                <form action="post.php" method="POST" enctype="multipart/form-data" name="addform"
                    class="form-horizontal" id="addform">
                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <b> เพิ่มข่าว : TKN</b>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2" align="right"> หัวข้อข่าว : </div>
                        <div class="col-sm-8" align="left">
                            <input name="title" id="title" type="text" required class="form-control"
                                placeholder="หัวข้อข่าว" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2" align="right">รายละเอียด</div>
                        <div class="col-sm-8" align="left">
                            <textarea name="txtMessage" id="txtMessage" class="ckeditor" cols="69" rows="5"></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-2" align="right">ไฟล์ประกอบ</div>
                        <div class="col-sm-7" align="left">
                            <input type="file" name="img" id="img" required>
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
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

// require_once('Connections/condb.php');

//Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
date_default_timezone_set('Asia/Bangkok');
//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด
$date1 = date("Ymd_His");
//สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
$numrand = (mt_rand());

//รับชื่อไฟล์จากฟอร์ม 
$title = $_POST['title'];
$txtMessage = $_POST['txtMessage'];
// $m_username = $_POST['m_username'];
$img = (isset($_POST['img']) ? $_POST['img'] : '');

$upload = $_FILES['img'];
if ($upload <> '') {

    //โฟลเดอร์ที่เก็บไฟล์
    $path = "C:/xampp/htdocs/TKNPRO/images/";
    //ตัวขื่อกับนามสกุลภาพออกจากกัน
    $type = strrchr($_FILES['img']['name'], ".");
    //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
    $newname =  $date1 . $type;

    $path_copy = $path . $newname;
    $path_link = "img/" . $newname;
    //คัดลอกไฟล์ไปยังโฟลเดอร์
    move_uploaded_file($_FILES['img']['tmp_name'], $path_copy);

}
$sql = "INSERT INTO articles (title, txtMessage,img) VALUES('$title','$txtMessage',	'$newname')";
$result = mysqli_query($conn, $sql) or die("Error in query: $sql " .mysqli_error($conn));
mysqli_close($conn);



if ($result) {

    echo "<script type='text/javascript'>";
    echo "alert('เพิ่มข่าวเรียบร้อย');";
    echo "window.location='post_manage.php';";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    echo "alert('Error!');";
    echo "window.location='post_manage.php';";
    echo "</script>";
}
}



?>