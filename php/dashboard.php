<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: ../login.html');
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
</head>
<body>
  <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
  <p>This is your dashboard.</p>

  <br>
  <p><a href="logout.php">Log out</strong></a></p>
</body>
</html>
