<?php
session_start();

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Required files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


include("connection.php");
include("functions.php");

if (isset($_POST["send"])) {
    $email = mysqli_real_escape_string($con, $_POST['recipient_email']);
    $check_email = "SELECT * FROM users WHERE email='$email'";
    $run_sql = mysqli_query($con, $check_email);

    if (mysqli_num_rows($run_sql) > 0) {
        // Email exists, proceed with sending verification code

        $verificationCode = mt_rand(100000, 999999);
        $timestamp = time(); // Get the current timestamp

        // Store email, verification code, and timestamp in the session
        $_SESSION['email'] = $email;
        $_SESSION['verification_code'] = $verificationCode;
        $_SESSION['verification_timestamp'] = $timestamp;

        // Store code and timestamp in the database
        $insert_code = "UPDATE users SET code = $verificationCode, code_timestamp = $timestamp WHERE email = '$email'";
        $run_query =  mysqli_query($con, $insert_code);

        $mail = new PHPMailer(true);

        // Server settings
        $mail->isSMTP();                             // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';        // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                    // Enable SMTP authentication
        $mail->Username   = 'cashmate.blanccapybara@gmail.com';  // SMTP write your email
        $mail->Password   = 'jeeqslpfetarruso';      // SMTP password
        $mail->SMTPSecure = 'ssl';                   // Enable implicit SSL encryption
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('cashmate.blanccapybara@gmail.com');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Forgot Password Verification Code";
        $mail->Body = "
        <p>Hello,</p>
        <p>We received a request to reset your password. Please use the verification code below to proceed:</p>
        <p style='font-size: 18px; font-weight: bold; margin: 20px 0;'>Your Verification Code: <span style='color: #ff0000;'>$verificationCode</span></p>
        <p>If you didn't request this, you can safely ignore this email.</p>
        <p>Thank you!</p>
        ";

        // Success sent message alert
        $mail->send();
        echo "
        <script>
        alert('Message was sent successfully!');
        document.location.href = 'verification-page.php';
        </script>
        ";
    } else {
        // Email does not exist, show error message
        echo "
        <script>
        alert('Email does not exist. Please enter a valid email.');
        document.location.href = 'forgot-password.php';
        </script>
        ";
    }
}
?>
