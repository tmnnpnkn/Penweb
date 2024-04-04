<?php
include('connectdb.php');
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


}





if (isset($_POST['update_pdbtn'])) {
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
                      title: "อัปเดตข้อมูลสำเร็จ!",
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
                      title: "อัปเดตข้อมูลไม่สำเร็จ!",
                      text: "จะหายไปใน 2 วินาที.",
                      type: "warning",
                      timer: 2000,
                      showConfirmButton: false
                  }, function() {
                      window.location.href = "Addnumproduct.php";
                  });
              });
          </script>
      ';
  }
}




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


// Check if the quantity field is set and not empty
if (isset($_POST['quantity']) && isset($_POST['edit_pid'])) {
  $quantityToAdd = $_POST['quantity']; // Get the quantity value
  $product_id = $_POST['edit_pid']; // Get the product ID

  // Check if the quantity value is valid (numeric and greater than 0)
  if (!is_numeric($quantityToAdd) || $quantityToAdd <= 0) {
      echo "Invalid quantity.";
      exit;
  }

  // Proceed with updating the product quantity
  // Your code to update the product quantity goes here...
} else {
  // If the quantity field is not set or empty, display an error message
  echo '
      <script>
          setTimeout(function() {
              swal({
                  title: "กรุณากรอกจำนวนสินค้าที่ต้องการเพิ่ม!",
                  text: "จะหายไปใน 2 วินาที.",
                  type: "error",
                  timer: 2000,
                  showConfirmButton: false
              }, function() {
                  window.location.href = "Addnumproduct.php";
              });
          });
      </script>
  ';
  exit; // Stop further execution of the code after displaying the message
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



?>