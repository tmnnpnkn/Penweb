<?php
session_start();
session_destroy();
echo "<script>alert('ยืนยันการออกจากระบบ...'); window.location ='../loginn.php';</script>";
// header("Location: ../logad.html ");

?>