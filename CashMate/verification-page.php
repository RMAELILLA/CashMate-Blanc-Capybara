<?php
session_start();

include("connection.php");
include("functions.php");

$errors = array();

if(isset($_POST['check-reset-otp'])){
  $_SESSION['info'] = "";
  $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
  $check_code = "SELECT * FROM users WHERE code = $otp_code";
  $code_res = mysqli_query($con, $check_code);
  if(mysqli_num_rows($code_res) > 0){
      $fetch_data = mysqli_fetch_assoc($code_res);
      $email = $fetch_data['email'];
      $_SESSION['email'] = $email;
      $info = "Please create a new password that you don't use on any other site.";
      $_SESSION['info'] = $info;
      header('location: reset-password.php');
      exit();
  }else{
      $errors['otp-error'] = "You've entered incorrect code!";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CASHMATE | Verification</title>
    <link rel="icon" href="Images/CASHMATE.png" type="image/x-icon" width="50px" height="50px">
    <link type="text/css" rel="stylesheet" href="CashMate.css"/>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
</head>
<body id="reset-container">
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default" id="form-holder">
                <div class="panel-body">
                    <div class="text-center">
                        <h2 class="text-center">Verification Code</h2>
                        <p>Enter the verification code sent to your email</p>
                        <?php if (isset($errors['otp-error'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $errors['otp-error']; ?>
                            </div>
                        <?php endif; ?>
                        <form method="post" action="verification-page.php">
                            <div class="form-group">
                                <input class="form-control" type="number" name="otp" placeholder="Enter verification code" required>
                            </div>
                            <div class="form-group frgot-password">
                                <input class="btn btn-block" type="submit" name="check-reset-otp" id="reset-button" value="Verify Code">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
