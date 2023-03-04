<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_ALL);
ini_set('display_errors', 1);


// Include PHPMailer autoloader
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';


// Get the form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Create a new PHPMailer object
$mail = new PHPMailer();

// Set up the SMTP configuration
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server address
$mail->SMTPAuth = true;
$mail->Username = 'talexrealtorsltd@gmail.com'; // Replace with your SMTP username
$mail->Password = '0707986844'; // Replace with your SMTP password
$mail->SMTPSecure = 'ssl'; // If your server uses SSL, set this to 'ssl'
$mail->Port = 587; // Replace with your SMTP server port number

// Set up the email message
$mail->setFrom($email, $name);
$mail->addAddress('talexrealtorsltd@gmail.com');
$mail->Subject = 'New Message from '.$name;
$mail->Body = 'Name: '.$name."\r\n"
            .'Email: '.$email."\r\n"
            .'Message: '.$message;

// Send the email
if($mail->send()) {
  echo "<script>alert('Thank you for your message!');</script>";
  header('Location: thank_you.html');
} else {
  echo "<script>alert('Error sending message. Please try again.');</script>";
}
?>

