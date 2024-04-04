<?php

include "connectdb.php";

session_start();

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = "SELECT * FROM adminlogin WHERE username = '" . $user . "' AND password = '" . $pass . "'";
    // $stmt->bind_param("ss", $user, $pass);
    // $stmt->execute();
    // $result = $stmt->get_result();
    $result = mysqli_query($conn, $stmt);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $user;
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Invalid username or password";
    }
} else {
    echo "0 results";
}

?>