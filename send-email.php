<?php
// Load Composer's autoloader (if using Composer)
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $datetime = $_POST['datetime'];
    $people = $_POST['people'];
    $orders = $_POST['orders'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings for Gmail SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com';  // Replace with your Gmail address
        $mail->Password = 'your-email-password';   // Replace with your Gmail password or app password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

         // Recipients
         $mail->setFrom('your-email@gmail.com', 'Booking System');
         $mail->addAddress($email);  // Recipient's email (user-provided)
         $mail->addReplyTo('your-email@gmail.com', 'Booking System');
 
         // Content
         $mail->isHTML(true);
         $mail->Subject = 'Table Booking Confirmation';
         $mail->Body    = "
             <h2>Booking Confirmation</h2>
             <p><strong>Name:</strong> $name</p>
             <p><strong>Date & Time:</strong> $datetime</p>
             <p><strong>No. of People:</strong> $people</p>
             <p><strong>Expected Orders:</strong> $orders</p>
         ";
         $mail->AltBody = "Booking Confirmation\n\nName: $name\nDate & Time: $datetime\nNo. of People: $people\nExpected Orders: $orders";
 
         // Send the email
         $mail->send();
         echo "Booking email sent successfully!";
     } catch (Exception $e) {
         echo "Error: {$mail->ErrorInfo}";
     }
 } else {
     echo "Invalid request";
 }
 ?>
