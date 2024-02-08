<?php 
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle updating profile picture
    if (isset($_FILES["profile-photo"])) {
        $target_dir = "user_profiles/";
        $target_file = $target_dir . basename($_FILES["profile-photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["profile-photo"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check file size
        if ($_FILES["profile-photo"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["profile-photo"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["profile-photo"]["name"])). " has been uploaded.";
                // Update profile photo path in the database
                $user_profile_path = $target_file;
                $query = "UPDATE users SET user_profile = '$user_profile_path' WHERE id = " . $user_data['id'];
                mysqli_query($con, $query);
                // Redirect to the profile page after updating the profile photo
                header("Location: account-settings.php");
                exit();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    
    $user_id = $_SESSION['user_id']; // Assuming you store the user's ID in the session

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Update name
        if (isset($_POST["new_name"])) {
            $new_name = $_POST["new_name"];
            list($first_name, $last_name) = explode(' ', $new_name, 2); // Split full name into first and last name
            $query = "UPDATE users SET f_name = '$first_name', l_name = '$last_name' WHERE id = $user_id";
            mysqli_query($con, $query);
            // Redirect or display success message
            header("Location: account-settings.php"); // Redirect to account settings page
            exit();
        }
    
        // Update email
        if (isset($_POST["new_email"])) {
            $new_email = $_POST["new_email"];
            $query = "UPDATE users SET email = '$new_email' WHERE id = $user_id";
            mysqli_query($con, $query);
            // Redirect or display success message
            header("Location: account-settings.php"); // Redirect to account settings page
            exit();
        }
    
        // Update password
        if (isset($_POST["new_password"]) && isset($_POST["current_password"])) {
            $new_password = $_POST["new_password"];
            $current_password = $_POST["current_password"];
            // Validate current password before updating
            $query = "SELECT password FROM users WHERE id = $user_id";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            if (password_verify($current_password, $row['password'])) {
                // Current password is correct, proceed with updating password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $query = "UPDATE users SET password = '$hashed_password' WHERE id = $user_id";
                mysqli_query($con, $query);
                // Redirect or display success message
                header("Location: account-settings.php"); // Redirect to account settings page
                exit();
            } else {
                // Current password is incorrect, display error message or handle as needed
            }
        }
    }
    
    

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CASHMATE | User Profile</title>
    <link rel="icon" href="Images/CASHMATE.png" type="image/x-icon" width="50px" height="50px">
    <link type= "text/css" rel="stylesheet" href="CashMate.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500&display=swap">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>  
    <style>
    
    body {
        font-family: 'Lexend', sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        border: 0;
        padding: 15px;
    }

    .section1, .section2 {
        border: 2px groove #ccc;
        background-color: #fff;
        border-radius: 10px;
        margin: 10px;
    }

    .section2 {
        width: 100%;
        padding: 10px;
    }

    hr {
        width: 100%;
        border-top: 2px solid #000;
        margin: auto;
        margin-top: 2%;
    }

    .account-settings-links, .list-group-item, .form-gl input[type="file"] {
        border: none;
        border-top: none;
    }

    .list-group-item {
        cursor: pointer;
    }

    .list-group-item.active {
        background-color: #6ABA8C;
        color: #fff;
    }

    .label-upload-photo {
        background-color: #6ABA8C;
        color: #fff;
        padding: 8px 16px;
        border-radius: 30px;
        cursor: pointer;
        display: inline-block;
    }

    .label-upload-photo:hover {
        background-color: #5e9665;
    }

    button {
        background-color: #6ABA8C;
        color: #fff;
        width: 100%;
        max-width: 15%;
        height: 10%;
        border: none;
        border-radius: 5%;
        cursor: pointer;
    }

    .username-info-description, .username-pic {
        display: flex;
    }

    .username-pic {
        align-items: center;
        
    }

    .user {
        margin-left: 5%;
    }

    .username-info {
        padding: 12px;
    }

    .username-label {
        font-size: 18px;
        font-weight: 500;
    }

    .form-gl button {
        float: right;
    }

    .form-gl {
        padding: 1%;
    }

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

    .form-group1{
        position: absolute;
        border: #6ABA8C;
        transform: scale(2);
        opacity: 0;
    }

    .form-group {
        border-top: none;
    }

    .delete-account-btn {
        display: inline-block;
        padding: 8px 16px;
        background-color: #6ABA8C;
        color: white;
        text-align: center;
        text-decoration: none;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .delete-account-btn:hover {
        background-color: #6ABA8C;
        text-decoration: none;
        align-items: center;
        color: white;
    }

    .popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 15px;
        background: #fff;
        width: 500px;
        max-height: auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        z-index: 1000;
        cursor: pointer;
        margin-top:20px; 
        margin-bottom:25px; 
    }
    .pop-up label
    {
        font-size:16px;
    }
    #openPopupBtn {
        background-color: #8DBC71;
        border: none;
        cursor: pointer;
    }
    .form-container {
        max-width: 500px; 
        padding:0 5 0 5;
        background-color: white;
        height:auto;
    }

    .form-container h3 {
        color: white;
        background-color: #8DBC71;
        padding: 10px;
        margin-top:10px;
        margin-bottom: 15px;
        text-align: center; 
    }

    .form-container input[type=text], 
    .form-container input[type=category],
    .form-container input[type=date],
    .form-container input[type=number] {
        width: 100%;
        padding: 10px;
        margin: 5px 0 10px 0;
        border: none;
        background: #f1f1f1;
    }

    .btn-submit { 
        color: black;
        font-size: 15px;
        padding: 8px 12px;
        border: 5px solid #6ABA8C;
        border-radius: 20px;
        cursor: pointer;
        width: 100%;
        margin-bottom:5px;
        opacity: 0.8; 
    }
    
    .btn-cancel {
        background-color: white;
        color: black;
        font-size: 15px;
        padding: 8px 12px;
        border: 3px solid red;
        border-radius: 20px;
        cursor: pointer;
        width: 100%;
        margin-bottom:5px;
        opacity: 0.8; 
    }

    .btn-submit:hover, 
    .btn-cancel:hover {
        opacity: 1;
    }


    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg "id="NavBar">
		<div class="container-fluid" id="cf">
			<div class="row" id="head">
				<div class="col-md-3">
					<div class="navbar-preheader">
						<h1 class="text-fluid"><img class="img-fluid" src="Images/CASHMATE.png"  alt="CashMate logo"><b> CASHMATE</b> </h1>
					  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#drop-img">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
					  </button> 
					</div>
				</div>
				<div class="col-md-9 collapse navbar-collapse navbar-right"id="drop-img">
					<ul class="nav navbar-nav "  >
						<li ><a href="Dashboard.php" class="link">Dashboard</a></li>
						<li><a href="Income-page.php" class="link">Income</a></li>
						<li><a href="Spendings.php" class="link">Spendings</a></li>
						<li ><a href="Planner.php" class="link">Planner</a></li> 
						<li ><a href="get-help.php" class="link"><img src="Images/question.png"></a></li> 
						<li ><a href="account-settings.php" class="link"><img src="Images/settings.png"></a></li> 
						<li ><a class="dropdown" data-toggle="dropdown"><img src="Images/male-user.png"></a>  
						  <ul class="dropdown-menu" style="background-color:rgb(140,195,126);">
							<li>
                                <?php
                                    $profile_photo_path = $user_data['user_profile'];
                                    if (!empty($profile_photo_path)) {
                                        echo '<img src="' . $profile_photo_path . '" style="width:50px;height:50px;margin-right:10px;">';
                                    } else {
                                        echo '<img src="Images/profile photo icon.png" style="width:50px;height:50px;margin-right:10px;">';
                                    }
                                ?>
                            </li>  
							<p style="margin-left:60;margin-right:60;"><?php echo $user_data['user_name'] ?></p>
							<p><?php echo $user_data['email'] ?></p>
							<p style="margin-left:60;margin-right:60;" ><a href="logout.php" onclick="signOut()">Sign-out</a></p>
						  </ul>
						</li> 
					</ul>
				</div>
            </div>
		</div>
	</nav>

    <div class="container">
        <div class="section1">
            <div class="username-info">
                <div class="username-pic">
                    <input type="file" name="profile-photo" class="form-group1">
                    <?php
                        $profile_photo_path = $user_data['user_profile'];
                        if (!empty($profile_photo_path)) {
                            echo '<img src="' . $profile_photo_path . '" height="70" width="70">';
                        } else {
                            echo '<img src="Images/profile photo icon.png" height="70" width="70">';
                        }
                    ?>
                    <div class="user">
                        <span class="username-label"><b><?php echo $user_data['user_name'] ?></b></span>
                        <label id="email"><b><?php echo $user_data['email'] ?></b></label>
                    </div>
                </div>
            </div>
            <div class="list-group list-group-flush account-settings-links">
                <a class="list-group-item list-group-item-action active" data-toggle="list"
                    href="account-settings.php">Account Settings</a>
                <a class="list-group-item list-group-item-action" data-toggle="list"
                    href="get-help.php">Get Help</a>
                <a class="list-group-item list-group-item-action" data-toggle="list"
                    href="privacy-policy.php">Privacy Policy</a>
                <a class="list-group-item list-group-item-action" data-toggle="modal"
                    href="#notificationSettings">Notification Settings</a>
                <a class="list-group-item list-group-item-action" data-toggle="list"
                    href="logout.php">Sign out</a>
            </div>
        </div>

        

        <div class="section2">
            <div class="tab-content">
                <form method="post" action="account-settings.php" enctype="multipart/form-data">
                    <button type="submit">Upload Profile Photo</button>
                </form>
                </div>
                    <button id="openBtn" class="button" onclick="openForm()">Behhhh</button>
                    <hr>
                    <div class="card-body">
                        <div class="form-gl">
                            <label class="form-group">Name</label>
                            <p id="user-name"><b><?php echo $user_data['f_name'] . ' ' . $user_data['l_name']; ?></b></p>
                        </div>

                        <div class="form-gl">
                            <label class="form-group">E-mail Address</label>
                            <p id="email"><b><?php echo $user_data['email'] ?></b></p>
                        </div>
                        <div class="form-gl">
                            <label class="form-group">Password</label>
                            <p><b>********</b></p>
                        </div>
                        <div class="form-gl">
                            <label class="form-group">Delete Account?</label>
                            <a href="delete-account.php" class="delete-account-btn">DELETE</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    
    <div id="nameForm" class="popup">
        <form class="form-container" method="POST">
            <h3>Update Account Settings</h3>
            <label for="name">First Name:</label><br>
            <input type="text" placeholder="Enter First Name" name="f_name" >
            
            <label for="name">Last Name:</label><br>
            <input type="text" placeholder="Enter Last Name" name="l_name" >

            <label for="email">Email:</label><br>
            <input type="text" placeholder="Change Email" name="email" ><br>

            <label for="cpass">Current Password:</label><br>
            <input type="password" placeholder="Current Password" name="cpass" ><br>            

            <label for="npass">New Password:</label><br>
            <input type="password" placeholder="New Password" name="npass" ><br>

            <button type="submit" class="btn-submit">Submit</button>
            <button type="button" class="btn-cancel" id="closeBtn" onclick="closeForm()">Close</button>
        </form>
    </div>   
<script>
document.getElementById('openBtn').addEventListener('click', function() {
    document.getElementById('nameForm').style.display = 'block';
});

document.getElementById('closeBtn').addEventListener('click', function() {
    document.getElementById('nameForm').style.display = 'none';
});
</script>


    <div class="modal fade" id="notificationSettings" tabindex="-1" role="dialog" aria-labelledby="notificationSettingsLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationSettingsLabel">CashMate - Notification Settings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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

                        <button type="submit">Save Settings</button>
                    </form>
                </div>
            </div>
        </div>
    </div>







    <script>
        // Update Profile Photo
        document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.querySelector('input[name="profile-photo"]');
        const labelUploadPhoto = document.querySelector('.label-upload-photo');
        const profilePhoto = document.querySelector('.username-pic img');

        fileInput.addEventListener('change', function (event) {
            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    profilePhoto.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);

                labelUploadPhoto.textContent = 'Change Profile Photo';
            }
        });

        fileInput.addEventListener('click', function () {
            this.value = null;
            labelUploadPhoto.textContent = 'Update Profile Photo';
        });

        document.addEventListener('DOMContentLoaded', function () {
            const editNameBtn = document.getElementById('edit-name-btn');
            const userNameText = document.getElementById('user-name');
            const editNameInput = document.getElementById('edit-name-input');

            editNameBtn.addEventListener('click', function () {
                // Toggle visibility of elements
                userNameText.style.display = 'none';
                editNameInput.style.display = 'block';

                // Set value of input field to current name
                editNameInput.value = userNameText.textContent.trim();
            });
        });

    
        });
    </script>
    

    
</body>

<footer >
	<div class="container-fluid">
		<div class="row" id="footer">
			<div class="col-md-8">
				<div class="footer-clmn1">
				<h1>CashMate</h1>
				<p>Navigate Your Finances with Confidence</p>
			</div>
			</div>
			<div class="col-md-4">
				<div class="footer-clmn2">
				<p> STAY CONNECTED WITH</p>
				<a href="group-profile.html"><img src="Images/BlancCapybara.png" height="50"alt="Description of the image"></a>
			</div>
		</div>
	</div>
	<div class="row" id="footer-b">
		<div class="col-md-6">
			<div class="footer-2clmn1">
				<p> Copyright 2023 © CashMate. All rights reserved.</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="footer-2clmn2">
				<p><a href="terms-conditions.php">Terms of Use </a>|<a href="privacy-policy.php"> Privacy Policy </a>|<a href="sitemap.php"> Site Map </a>|</p>
			</div>
		</div>
	</div>
</footer>

</html>
