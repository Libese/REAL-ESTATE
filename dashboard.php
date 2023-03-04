<!DOCTYPE html>
<?php
session_start();
?>

<html>
  <head>
    <title>Admin Dashboard</title>
  </head>
  <body>
  
    <?php
      if (isset($_SESSION['username'])) {
        echo "<h1>Welcome, " . $_SESSION['username'] . "</h1>";
      } else {
        echo "<h1>Welcome</h1>";
      }
    ?>
    
    

<head>
	<title>Create Agents Account</title>
	<style>
		form {
			display: flex;
			flex-direction: column;
			align-items: center;
			margin: 50px auto;
			padding: 20px;
			border: 1px solid #ddd;
			border-radius: 5px;
			max-width: 600px;
		}
		label, input {
			margin: 10px 0;
			font-size: 18px;
		}
		input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			border: none;
			padding: 10px 20px;
			border-radius: 5px;
			font-size: 18px;
			cursor: pointer;
		}
		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
	</style>

	<form method="post" action="create_agents.php">
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" required>

		<label for="email">Email Address:</label>
		<input type="email" id="email" name="email" required>

	

		<label for="phone">Phone Number:</label>
		<input type="tel" id="phone" name="phone" required>

		<label for="password">Default Password:</label>
		<input type="password" id="password" name="password" required>

		<input type="submit" value="Create Account">
	</form>


    <a href="logout.php">Logout</a>
  </body>
</html>

