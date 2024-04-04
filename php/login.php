<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

        <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/owl.theme.default.min.css">
        <link rel="stylesheet" href="css/tooplate-style.css">

    </head>
<?php

include "connectdb.php";


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    session_start();

    $sql = "SELECT * FROM user WHERE Username = '" . $username . "' AND Password = '" . $password . "' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // เพิ่มเงื่อนไขในการตรวจสอบ status ว่าเป็น 'a' หรือไม่
        if ($row["Role"] == 'a' && $row["status"] == 'a') {
            $_SESSION['name'] = $row["Name"];
            $_SESSION["role"] = $row["Role"];
            $_SESSION["status"] = $row["status"];
            $_SESSION["id"] = $row["id"];
            header("Location: ../adminpanel.php");
        } elseif (($row["Role"] == 'n' || $row["Role"] == 'm') && $row["status"] == 'a') {
            $_SESSION['name'] = $row["Name"];
            $_SESSION["role"] = $row["Role"];
            $_SESSION["status"] = $row["status"];
            $_SESSION["id"] = $row["id"];
            header("Location: ../homeuser/homeuser.php");
        } else {
            echo '<script>
    setTimeout(function() {
     swal({
         title: "เกิดข้อผิดพลาด",
          text: "ไม่มีสิทธิ์เข้าใช้ กรุณาเข้าสู่ระบบ",
         type: "warning"
     }, function() {
         window.location = "../loginn.php"; //หน้าที่ต้องการให้กระโดดไป
     });
   }, 500);
</script>';
        }
    } else {
        echo "<script>";
        echo "alert(\"Username หรือ Password ไม่ถูกต้อง\");";
        echo "window.history.back()";
        echo "</script>";
    }
}
?>