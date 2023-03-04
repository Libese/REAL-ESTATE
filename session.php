<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$dbname = "users";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
  $_SESSION['username'] = $username;
  header('location: dashboard.php');
} else {
  echo "Invalid username or password";
}

mysqli_close($conn);
?>
