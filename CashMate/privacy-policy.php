<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>


<!DOCTYPE html>

<html lang="en">
  <head>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> CASHMATE | Privacy Policy</title> 
	<link rel="icon" href="Images/CASHMATE.png" type="image/x-icon" width="50px" height="50px">
	<link type= "text/css" rel="stylesheet" href="CashMate.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500&display=swap">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script> 
	
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
				<div class="col-md-9 collapse navbar-collapse navbar-right" id="drop-img">
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
							<p ><?php echo $user_data['email'] ?></p>
							<p style="margin-left:60;margin-right:60;" ><a href="logout.php" onclick="signOut()">Sign-out</a></p>
						  </ul>
						</li> 
					 </ul> 
				</div>
		</div>
	</nav>
	<script>
    function signOut() {
      alert('Signing out...');
    }
  </script>
	<section>
		<div class="container Privacy-Policy">
			<h1><b>CashMate Privacy Notice</b></h1>
			<div>
				<p><b>At CashMate, we approach data and privacy as we approach everything we do: we put people first.</b><p>
				<p>As part of our effort to protect your privacy and to comply with applicable privacy and data protection laws, we strive to consider all of our data governance practices through the lens of the recognized principles of data minimization, limited collection, and limited use, among other key areas addressed below. We do so to respect and maintain your trust. In other words, we believe that taking care of you includes taking care of your data and privacy. Grab a cup of coffee and learn more below.</p>
				<p>Last Revised: October 6, 2023</p>
			</div>
			<div>
				<h2>Overview</h2>
				<p>This CashMate Privacy Notice describes the types of personal information that Starbucks Corporation and its respective subsidiaries and affiliated companies (“CashMate,” “we,” and “us”) collect, how we use it, how and when it may be shared, and the rights and choices you have with respect to your information. It also explains how we communicate with you and how you can make requests or submit inquiries to us about your information. Our goal is to help you understand how we use your information to improve our products, services, marketing, and interactions with you, as part of our commitment to maintaining your trust. Thank you for taking the time to read and understand our data and privacy related practices.</p>
				<p>By continuing to use CashMate Services you acknowledge this Privacy Notice and agree to our Terms of Use and other important policies, all available on our Online Policies page.</p>
			</div>
			<div>
        <h3>1. Applicability and Scope</h3>
        <p>This Privacy Notice (“Notice”) applies to the websites located at (“CashMate Website”), and through any other website owned and operated by CashMate that direct the viewer or user to this Notice (“CashMate Services”). Our website may offer links to websites are operated by third parties and not by CashMate. If you visit one of these linked websites, you should read the website’s privacy notice, terms and conditions, and their other policies. We are not responsible for the policies and practices of third parties. Any information you give to those organizations is governed under their privacy notice, terms and conditions, and other policies.</p>
        <h3>2. Updates to this Privacy Notice</h3>
        <p>We may update this Notice from time to time. We will notify you of material changes to this Notice and will update the Last Revised date on this Notice. We encourage you to look for updates and changes to this Notice when you access our websites and mobile applications.</p>
        <h3>3. Information We Collect</h3>
        <ul>
            <li><b>Identifiers</b> – We may collect information that can be used to identify you, such as your first and last name, phone number, your address book, username and password, email address, postal address, IP address, day and month of your birthday, and demographic information (such as gender).</li>
            <li><b>Financial Information</b> – We may also collect information such as your credit card and debit card information, telephone number, and name.</li>
            <li><b>Geolocation Information</b> – We may collect information about your location of your device, such as information derived from your device (e.g., based on a browser or device’s IP address). We may also use location-based technology in our retail locations, to collect information about the presence of your device, if your Bluetooth is turned on and your device settings allow for this.</li>
            <li><b>Inferences</b> – We may also collect inferences drawn from the other information described above.</li>
        </ul>
        <p>We may aggregate or de-identify the information described above.  Aggregated or de-identified data that we do not attempt to reidentify is not subject to this Notice.</p>
        <p>Without this information, we may not be able to provide you with all the requested services.</p>
        <h3>4. Sources of Information</h3>
        <p>In addition to the information we receive from you, we may also receive the categories of information described above from other sources including from other users of CashMate Services, advertising partners, co-sponsors, internet service providers, data analytics providers, operating systems and platforms, social networks, and publicly available sources.  For example, if you access any social media or similar services through the CashMate Services to login or to share information about your experience CashMate Services with others.</p>
        <h3>5. How We Protect Your Information</h3>
        <p>CashMate uses reasonable technical, physical, and administrative security measures to reduce the risk of loss, misuse, unauthorized access, disclosure or modification of your information. However, no security system is perfect, and due to the inherent nature of the Internet, we cannot guarantee that data, including personal information, is absolutely safe from intrusion or other unauthorized access by others. You are responsible for protecting your password(s) and maintaining the security of your devices.</p>

        <h3>6. Retention</h3>
        <p>CashMate information as reasonably necessary and proportionate to accomplish the purposes identified in this Notice based on criteria such as the length of time we need to provide the services to you, and to meet legal requirements, including record retention, resolving disputes, and enforcing our agreements. Our retention of your information is governed by applicable law.</p>
        <p>The personal information that you provide us is stored and processed on servers owned by CashMate, processes your information and where it is processed, we will take steps to transfer and protect your information through appropriate safeguards in accordance with applicable data protection laws and this Notice.</p>
        <h3>7. Children’s Privacy</h3>
        <p>We do not intend for our websites or online services to be used by anyone under the age of 13. We do not knowingly collect, sell, or share information of consumers between the ages of 13 – 16.  If you are a parent or guardian and believe we may have collected information about your child, please contact us immediately as described in the “Contact Us” section of this Notice. For more information, please see our Terms of Use.</p>

    </div>
		</div>
		 
	</section>
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