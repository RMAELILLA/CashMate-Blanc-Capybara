<?php
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $f_name = mysqli_real_escape_string($con, $_POST['f_name']);
    $l_name = mysqli_real_escape_string($con, $_POST['l_name']);
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);

    if (!empty($user_name) && !empty($password) && !empty($f_name) && !empty($l_name) && !empty($email) && !empty($cpass) && !is_numeric($user_name)) {

        // Check if the passwords match
        if ($password == $cpass) {

            // save to database
            $user_id = random_num(20);
            $query = "INSERT INTO users (user_id, f_name, l_name, user_name, email, password) VALUES ('$user_id', '$f_name', '$l_name', '$user_name', '$email', '$password')";

            mysqli_query($con, $query);

            header("Location: login-page.php");
            die;
        } else {
            echo "Passwords do not match!";
        }
    } else {
        echo "Please enter valid information in all fields!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> CASHMATE | Navigate Your Finances with Confidence</title> 
	<link rel="icon" href="Images/CASHMATE.png" type="image/x-icon" width="50px" height="50px">
	<link type= "text/css" rel="stylesheet" href="CashMate.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
	<style>
		.notification-popup {
			display: none;
			position: fixed;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			padding: 20px;
			background-color: #fff;
			border: 1px solid #ddd;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			z-index: 1000;
		}

		.overlay {
			display: none;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(0, 0, 0, 0.5);
			z-index: 999;
		}

		label {
			display: block;
			margin-bottom: 10px;
		}

		button {
			background-color: #4CAF50;
			color: white;
			border: none;
			padding: 10px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			cursor: pointer;
			border-radius: 5px;
		}
	</style>
  </head>
<body>
	<div class="container" id="CreateAccount">
    <div class="row">
        <div class="col-md-4 d-flex" id="left-side">
            <img src="Images/cashmate.jpg" alt="CashMate"/>
        </div>
        <div class="col-md-8" id="right-side">
            <form method="POST"> 
                <div class="container-fluid" id="SignIn">
                    <h1>Sign up to CashMate</h1>
                    <div class="row" id="line-one">
                        <div class="col-md-6">
                            <label for="first-name">First Name</label>
                            <input type="text" name="f_name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="last-name">Last Name</label>
                            <input type="text" name="l_name" required>
                        </div>
                    </div>
                    <div class="row" id="line-one">
                        <div class="col-md-12">
                            <label for="username">Username</label>
                            <input type="text" name="user_name" required>
                        </div>
                    </div>
                    <div class="row" id="line-one">
                        <div class="col-md-12">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" required>
                        </div>
                    </div>
                    <div class="row" id="line-one">
                        <div class="col-md-12">
                            <label for="password">Password</label>
                            <input type="password" name="password" required>
                        </div>
                    </div>
                    <div class="row" id="line-one">
                        <div class="col-md-12">
                            <label for="cpassword">Confirm Password</label>
                            <input type="password" name="cpassword" required>
                        </div>
                    </div>
                    <div class="row" id="line-one">
                        <div class="col-md-1" style="padding-top:2%;">
                            <input type="checkbox" name="term" required>
                        </div>
                        <div class="col-md-11" id="terms">
                            <label>Creating an account means you're okay with our
                                <a href="terms-conditions.html">Terms of Services</a>,
                                <a href="privacy-policy.html">Privacy Policy</a> and our default
                                <a href="#" onclick="showNotificationPopup()">Notification Settings</a>.
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-center">
                            <input type="submit" id="create-acc-button" value="Create Account">
                        </div>
                        <div class="text-center" id="old-acc">
                            <p>Already a member? <a href="login-page.php">Sign in</a></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
	</div>

	<!-- Notification Settings Popup -->
	<div class="overlay" id="overlay" onclick="hideNotificationPopup()"></div>
	<div class="notification-popup" id="notificationPopup">
		<h2>CashMate - Notification Settings</h2>

		<form action="process_settings.php" method="post">
			<label>
				<input type="checkbox" name="emailNotifications" checked>
				Receive Email Notifications
			</label>

			<label>
				<input type="checkbox" name="pushNotifications" checked>
				Receive Push Notifications
			</label>

			<label>
				<input type="checkbox" name="transactionAlerts" checked>
				Receive Transaction Alerts
				<span style="font-size: 12px; color: #666;">(Get notified for important transactions)</span>
			</label>

			<label>
				<input type="checkbox" name="weeklySummary">
				Receive Weekly Spending Summary
				<span style="font-size: 12px; color: #666;">(A summary of your weekly expenses)</span>
			</label>

			<label>
				<input type="checkbox" name="specialOffers">
				Receive Special Offers
				<span style="font-size: 12px; color: #666;">(Exclusive promotions and discounts)</span>
			</label>

			<!-- Add more options as needed -->

			<button type="submit">Save Settings</button>
		</form>
	</div>

	<script>
		function showNotificationPopup() {
			document.getElementById("notificationPopup").style.display = "block";
			document.getElementById("overlay").style.display = "block";
		}

		function hideNotificationPopup() {
			document.getElementById("notificationPopup").style.display = "none";
			document.getElementById("overlay").style.display = "none";
		}
	</script>

  </body>
</html>
 
