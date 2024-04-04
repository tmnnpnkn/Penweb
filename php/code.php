<?php
include('connectdb.php');
include('../headtotoe/header.php');

session_start();
if (isset($_POST['updatebtn'])) {
  $edit_id = $_POST['edit_id'];
  $edit_Name = $_POST['edit_Name'];
  $edit_Lastname = $_POST['edit_Lastname'];
  $edit_username = $_POST['edit_username'];
  $edit_tel = $_POST['edit_tel'];
  $edit_password = $_POST['edit_password'];
  $edit_role = $_POST['edit_role'];
  $edit_status = $_POST['edit_status'];

  $query = "UPDATE user SET Name='$edit_Name', Lastname='$edit_Lastname', Username='$edit_username', Tel='$edit_tel', Password='$edit_password', Role='$edit_role', status='$edit_status' WHERE id='$edit_id'";

  $query_run = mysqli_query($conn, $query);

  if ($query_run) {
    echo '
        <script>
          setTimeout(function() {
            swal({
              title: "อัปเดทข้อมูลสำเร็จ!",
              text: "จะหายไปใน 2 วินาที.",
              type: "success",
              timer: 2000,
              showConfirmButton: false
            }, function() {
              window.location.href = "register.php";
            });
          });
        </script>
        ';

    // $_SESSION['status'] = "Your Data is Updated";
    // $_SESSION['status_code'] = "success";
    //  header('Location: register.php');
  } else {
    $_SESSION['status'] = "Your Data is NOT Updated";
    $_SESSION['status_code'] = "error";
    header('Location: register.php');
  }
}

if (isset($_POST['update_pdbtn'])) {
  $id = $_POST['edit_pid'];
  $name = $_POST['edit_pname'];
  // $type_name = $_POST['edit_Type']; // Assuming type_name is provided
  $detail = $_POST['edit_detail'];
  $bprice = $_POST['edit_bp'];
  $sprice = $_POST['edit_sp'];
  $status = $_POST['edit_status'];

  // Retrieve type_id based on type_name
  // $queryType = "SELECT type_id FROM tbl_product_type WHERE type_name = '$type_name'";
  // $resultType = mysqli_query($conn, $queryType);

  // if ($resultType && mysqli_num_rows($resultType) > 0) {
  //     $rowType = mysqli_fetch_assoc($resultType);
  //     $type_id = $rowType['type_id'];

  // Update product table
  $query = "UPDATE product SET p_name ='$name',  p_detail='$detail', buy_price='$bprice', sell_price='$sprice', status='$status' WHERE p_id='$id'";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {
    echo '
              <script>
              setTimeout(function() {
                  swal({
                  title: "อัปเดทข้อมูลสำเร็จ!",
                  text: "จะหายไปใน 2 วินาที.",
                  type: "success",
                  timer: 2000,
                  showConfirmButton: false
                  }, function() {
                  window.location.href = "product_edit.php";
                  });
              });
              </script>
          ';
  } else {
    echo '
              <script>
              setTimeout(function() {
                  swal({
                  title: "อัปเดทข้อมูลไม่สำเร็จ!",
                  text: "จะหายไปใน 2 วินาที.",
                  type: "warning",
                  timer: 100000,
                  showConfirmButton: false
                  }, function() {
                  window.location.href = "product_edit.php";
                  });
              });
              </script>
          ';
  }
  // } else {
//   // Handle case where type_name doesn't exist
//   echo "Type name not found";
}
// }



if (isset($_POST['update_pbtn'])) {
  // Retrieve form data
  $id = $_POST['edit_pid'];
  $name = $_POST['edit_pname'];
  $type_id = $_POST['edit_Type'];
  $detail = $_POST['edit_detail'];
  $bprice = $_POST['edit_bp'];
  $sprice = $_POST['edit_sp'];
  $status = $_POST['edit_status'];

  // Prepare and execute the SQL query using prepared statements
  $query = "UPDATE product SET p_name=?, type_id=?, p_detail=?, buy_price=?, sell_price=?, status=? WHERE p_id=?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, 'sisddsi', $name, $type_id, $detail, $bprice, $sprice, $status, $id);
  $query_run = mysqli_stmt_execute($stmt);

  if ($query_run) {
    echo '
        <script>
          setTimeout(function() {
            swal({
              title: "อัปเดทข้อมูลสำเร็จ!",
              text: "จะหายไปใน 2 วินาที.",
              type: "success",
              timer: 2000,
              showConfirmButton: false
            }, function() {
              window.location.href = "Addnumproduct.php";
            });
          });
        </script>
        ';

    // $_SESSION['status'] = "Your Data is Updated";
    // $_SESSION['status_code'] = "success";
    //  header('Location: register.php');
  } else {
    echo '
        <script>
          setTimeout(function() {
            swal({
              title: "อัปเดทข้อมูลไม่สำเร็จ!",
              text: "จะหายไปใน 2 วินาที.",
              type: "warning",
              timer: 100000,
              showConfirmButton: false
            }, function() {
              window.location.href = "Addnumproduct.php";
            });
          });
        </script>
        ';
  }
}


// ตรงนี้
if (isset($_POST['quantity']) && isset($_POST['edit_pid'])) {
  $quantityToAdd = $_POST['quantity']; // รับค่าจำนวนที่ต้องการเพิ่ม
  $product_id = $_POST['edit_pid']; // รับค่า ID สินค้า

  // ตรวจสอบค่าที่รับมา
  if (!is_numeric($quantityToAdd) || $quantityToAdd <= 0) {
    echo "Invalid quantity.";
    exit;
  }

  // ดึงข้อมูลจำนวนสินค้าปัจจุบัน
  $sql = "SELECT p_num FROM product WHERE p_id = '$product_id'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $currentQuantity = $row['p_num'];

    // คำนวณและอัปเดตจำนวนสินค้าใหม่
    $newQuantity = $currentQuantity + $quantityToAdd;

    // อัปเดตจำนวนสินค้าในฐานข้อมูล
    $sql = "UPDATE product SET p_num = '$newQuantity' WHERE p_id = '$product_id'";
    if (mysqli_query($conn, $sql)) {
      echo '
        <script>
          setTimeout(function() {
            swal({
              title: "เพิ่มสินค้าสำเร็จ!",
              text: "จะหายไปใน 2 วินาที.",
              type: "success",
              timer: 2000,
              showConfirmButton: false
            }, function() {
              window.location.href = "Addnumproduct.php";
            });
          });
        </script>
      ';
    } else {
      echo '
        <script>
          setTimeout(function() {
            swal({
              title: "เกิดข้อผิดพลาดในการเพิ่มสินค้า!",
              text: "กรุณาลองใหม่อีกครั้ง.",
              type: "error",
              timer: 10000,
              showConfirmButton: false
            }, function() {
              window.location.href = "Addnumproduct.php";
            });
          });
        </script>
      ';
    }
  } else {
    echo '
      <script>
        setTimeout(function() {
          swal({
            title: "ไม่พบข้อมูลสินค้า!",
            text: "กรุณาลองใหม่อีกครั้ง.",
            type: "error",
            timer: 10000,
            showConfirmButton: false
          }, function() {
            window.location.href = "Addnumproduct.php";
          });
        });
      </script>
    ';
  }
} 


if (isset($_POST['delete_pbtn'])) {
  $id = $_POST['delete_pid'];

  $query = "DELETE FROM articles WHERE a_id='$id' ";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {
    echo '<script>
             setTimeout(function() {
              swal({
                  title: "ลบข้อมูลสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "post_manage.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';


    // $_SESSION['status'] = "Your Data is Deleted";
    // $_SESSION['status_code'] = "success";
    // header('Location: register.php'); 
  } else {
    echo '<script>
             setTimeout(function() {
              swal({
                  title: "ลบข้อมูลไม่สำเร็จ",
                  type: "error"
              }, function() {
                  window.location = "post_manage.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
  }
}
if (isset($_POST['delete_pkbtn'])) {
  $id = $_POST['delete_pkid'];

  $query = "DELETE FROM prakad WHERE pk_id='$id' ";
  $query_run = mysqli_query($conn, $query);

  if ($query_run) {
    echo '<script>
             setTimeout(function() {
              swal({
                  title: "ลบข้อมูลสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "notice_manage.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';


    // $_SESSION['status'] = "Your Data is Deleted";
    // $_SESSION['status_code'] = "success";
    // header('Location: register.php'); 
  } else {
    echo '<script>
             setTimeout(function() {
              swal({
                  title: "ลบข้อมูลไม่สำเร็จ",
                  type: "error"
              }, function() {
                  window.location = "notice_manage.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
  }
}
if (isset($_POST['registerbtn'])) {
  $name = $_POST['name'];
  $lastname = $_POST['lastname'];
  $username = $_POST['username'];
  $tel = $_POST['tel'];
  $password = $_POST['password'];
  $cpassword = $_POST['confirmpassword'];
  $role = $_POST['role'];

  if (empty($name)) {
    echo "<script>alert('กรุณาใส่ชื่อ...'); window.history.back();</script>";
  }
  if (empty($lastname)) {
    echo "<script>alert('กรุณาใส่นามสกุล...'); window.history.back();</script>";
  }
  if (empty($username)) {
    echo "<script>alert('กรุณาใส่username...'); window.history.back();</script>";
  }
  if (empty($tel)) {
    echo "<script>alert('กรุณาใส่เบอร์โทร...'); window.history.back();</script>";
  }
  if (empty($password)) {
    echo "<script>alert('กรุณาใส่password...'); window.history.back();</script>";
  } else {

    $eu_query = "SELECT * FROM user WHERE Username ='$username' OR Tel='$tel' ";
    $eu_query_run = mysqli_query($conn, $eu_query);
    if (mysqli_num_rows($eu_query_run) > 0) {
      // $_SESSION['status'] = "Username or Email Already Taken. Please Try Another one.";
      echo "<script>alert( 'Username or Email Already Taken. Please Try Another one...'); window.history.back();</script>";
      // $_SESSION['status_code'] = "error";
      // header('Location: register.php');
    } else {
      if ($password == $cpassword) {
        $query = "INSERT INTO user (Name,Lastname,Username,Tel,Password,Role) VALUES ('$name','$lastname','$username','$tel','$password','$role')";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
          // echo "Saved";
          echo '<script>
             setTimeout(function() {
              swal({
                  title: "เพิ่มผู้ใช้สำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "register.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
          // $_SESSION['status'] = "User Profile Added";
          // $_SESSION['status_code'] = "success";
          // header('Location: register.php');
        } else {
          //echo "<script>alert('User Profile Not Added...'); window.history.back();</script>";
          // $_SESSION['status'] = "User Profile Not Added";
          // $_SESSION['status_code'] = "error";
          // header('Location: register.php');
          echo '<script>
             setTimeout(function() {
              swal({
                  title: "เพิ่มผู้ใช้ไม่สำเร็จ",
                  type: "error"
              }, function() {
                  window.location = "register.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
        }
      } else {
        echo "<script>alert('Password and Confirm Password Does Not Match...'); window.history.back();</script>";
        // $_SESSION['status'] = "Password and Confirm Password Does Not Match";
        // $_SESSION['status_code'] = "warning";
        // header('Location: register.php');
      }
    }

  }
}
?>