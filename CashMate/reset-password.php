<?php
session_start();

include("connection.php");
include("functions.php");

$errors = array();

if (isset($_POST['reset-password'])) {
    $_SESSION['info'] = "";

    // Sanitize user input
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpass = mysqli_real_escape_string($con, $_POST['cpass']);

    // Assuming the user email is stored in the session
    $email = $_SESSION['email'];

    if ($password !== $cpass) {
        $errors['password-error'] = "Passwords do not match!";
    } else {
        // Hash the new password using MD5 (for educational purposes only)
        $hashed_password = md5($password);

        // Update the password in the database
        $update_password_query = "UPDATE users SET password='$hashed_password' WHERE email='$email'";
        $update_password_result = mysqli_query($con, $update_password_query);

        if (!$update_password_result) {
            echo "Error: " . mysqli_error($con);
            exit(); // Exit if there's an error
        }

        // Clear session data
        unset($_SESSION['email']);
        unset($_SESSION['info']);

        // Set a success message
        $_SESSION['success'] = "Password updated successfully! You can now log in with your new password.";

        // Redirect the user to the login page
        header('location: login-page.php');
        exit();
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
                        <h2 class="text-center">New Password</h2>
                        <p>Enter the your new password</p>
                        <?php if (isset($errors['otp-error'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $errors['otp-error']; ?>
                            </div>
                        <?php endif; ?>
                        <!-- Your HTML form for updating the password -->
                        <form method="post" action="reset-password.php">
                            <!-- Display any errors -->
                            <?php if (isset($errors['password-error'])): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $errors['password-error']; ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" placeholder="New Password" required><br>
                                <input class="form-control" type="password" name="cpass" placeholder="Confirm Password" required>
                            </div>
                            <div class="form-group frgot-password">
                              <input class="btn btn-block" type="submit" name="reset-password" id="reset-button" value="Update Password">
                            </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
