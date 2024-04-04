<?php
include('connectdb.php');

session_start();

$type_name = $_POST['type_name'];

$sql ="INSERT INTO type_list
    
    (type_name) 

    VALUES 

    ('$type_name')";
    
    $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
    mysqli_close($conn);
    
    if($result){
      echo "<script>";
      echo "alert('สำเร็จ');";
      echo "window.location ='type_list.php'; ";
      echo "</script>";
    } else {
      
      echo "<script>";
      echo "alert('ERROR!');";
      echo "window.location ='type_list.php'; ";
      echo "</script>";
    }
?>