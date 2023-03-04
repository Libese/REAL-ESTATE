<?php
session_start();

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['username'])) {
  header("Location: login.html");
  exit();
}

// Get the username
$username = $_SESSION['username'];

// Get the form data
$client_name = $_POST['client_name'];
$phone_number = $_POST['phone_number'];
$type = $_POST['type'];
$location = $_POST['location'];
$price = $_POST['price'];
$bedrooms = $_POST['bedrooms'];
$bathrooms = $_POST['bathrooms'];
$garage = $_POST['garage'];

// Connect to the database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'properties';

$conn = new mysqli($host, $user, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Insert the data into the houses table
$sql = "INSERT INTO houses (client_name, phone_number, type, location, price, bedrooms, bathrooms, garage) VALUES ('$client_name', '$phone_number', '$type', '$location', '$price', '$bedrooms', '$bathrooms', '$garage')";

if ($conn->query($sql) === TRUE) {
  echo "Property posted successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Link the agent to the property
$sql = "SELECT id FROM agents WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $agent_id = $row["id"];
  
  // Update the houses table to link the agent
  $sql = "UPDATE houses SET agent_id = $agent_id ORDER BY id DESC LIMIT 1";
  
  if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
} else {
  echo "No agent found for the username $username";
}

$conn->close();
?>
