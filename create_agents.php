<?php
// establish connection to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // retrieve form data
  $username = $_POST["username"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $password = $_POST["password"];

  // prepare and bind SQL statement
  $stmt = $conn->prepare("INSERT INTO agents (username, email, phone, password) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $username, $email, $phone, $password);

  // execute SQL statement and check for success
  if ($stmt->execute()) {
    echo "Agent account created successfully.";
  } else {
    echo "Error creating agent account: " . $conn->error;
  }

  // close statement
  $stmt->close();
}

// close connection
$conn->close();
?>
