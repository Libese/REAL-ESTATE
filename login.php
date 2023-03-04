<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "users";

$mysqli = new mysqli($host, $user, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the login form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database for the user with the given username and password in admin table
    $query = "SELECT * FROM admin WHERE username = ? AND password = ?";
    $stmt = $mysqli->prepare($query);

    if (!$stmt) {
        die("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
    }

    if (!$stmt->bind_param("ss", $username, $password)) {
        die("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
    }

    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }

    $result = $stmt->get_result();

    if ($result !== false && $result->num_rows == 1) {
        // The user has entered the correct login credentials as admin
        $user = $result->fetch_assoc();

        // Set the session variable to indicate that the user is logged in
        $_SESSION['logged_in'] = true;

        // Redirect to the appropriate dashboard for admin
        header("Location: dashboard.php");
        exit();
    } else {
        // Query the database for the user with the given username and password in agents table
        $query = "SELECT * FROM agents WHERE username = ? AND password = ?";
        $stmt = $mysqli->prepare($query);

        if (!$stmt) {
            die("Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error);
        }

        if (!$stmt->bind_param("ss", $username, $password)) {
            die("Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error);
        }

        if (!$stmt->execute()) {
            die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result !== false && $result->num_rows == 1) {
            // The user has entered the correct login credentials as agent
            $user = $result->fetch_assoc();

            // Set the session variable to indicate that the user is logged in
            $_SESSION['logged_in'] = true;

            // Redirect to the appropriate dashboard for agent
            header("Location: agentdashboard.html");
            exit();
        } else {
            // The user has entered the incorrect login credentials
            echo "Incorrect username or password";
        }
    }
}
?>