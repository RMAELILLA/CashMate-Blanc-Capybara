<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>


<!DOCTYPE html>
<html>

<head>
    <title>CashMate | Get Help</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> CASHMATE | Get Help</title> 
	<link rel="icon" href="Images/CASHMATE.png" type="image/x-icon" width="50px" height="50px">
	<link type= "text/css" rel="stylesheet" href="CashMate.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: 'Lexend', sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        .container {
            padding: 5%;
        }

        h1, h2 {
            color: #6ABA8C;
            font-weight: bold;
        }

        .intro h1 {
            text-align: center;
            color: #6ABA8C;
            font-weight: bolder;
        }
        
        input[type=text],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        input[type=submit] {
            background-color:#45a049;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #04AA6D;
        }

        .contact-form {
            padding: 20px;
        }

        .button {
            background-color: #04AA6D;
            border: none;
            color: rgb(202, 195, 195);
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

        .button1 {
            padding: 10px 24px;
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
							<li> <img src="Images/male-user.png" style="width:300px;height:300px;margin-left:60;margin-right:60;"></li>  
							<p style="margin-left:60;margin-right:60;"><?php echo $user_data['user_name'] ?></p>
							<p ><?php echo $user_data['email'] ?></p>
							<p style="margin-left:60;margin-right:60;" ><a href="logout.php" onclick="signOut()">Sign-out</a></p>
						  </ul>
						</li> 
					 </ul> 
				</div>
		</div>
	</nav>
    <section>
        <div class="container">
            <div class="intro">
                <h1>CashMate: Navigate Your Finances with Confidence</h1>
                <h2>Welcome to CashMate</h2>
                <p>Welcome to CashMate, your trusted platform for effective financial management. This user manual is designed to walk you through the various features and functionalities to ensure a seamless user experience.</p>
            
                <h2>About CashMate</h2>
                <p><b>CashMate</b> is a comprehensive online platform meticulously crafted to assist individuals in managing their finances with confidence and precision. Whether you are aiming to track your expenses, set savings goals, or gain insights into your spending patterns, CashMate offers a user-friendly and feature-rich experience tailored to your financial needs.</p>
            </div>
            <hr>
            <div class="help">
                <h1>How can we Help You?</h1>
                <div class="get-start">
                    <h2>Getting Started</h2>

                    <h3>Creating an Account</h3>
                    <p>To initiate CashMate journey, click the <a href="create-account.php" class="link">"Sign Up"</a> button.<br>
                    Fill in the required details, such as your name, email, and password, to create your account</p>
                    
                    <h3>Logging In</h3>
                    <p>Returning users can click the <a href="login-page.php" class="link">"Log In"</a>button.</p>

                    <h3>Navigating the Dashboard</h3>
                    <p>Upon login, you'll land on your dashboard. Here, discover different sections/categories. Use the headbar menu to explore specific areas of interest.</p>
                </div>
                <div class="features">
                    <h2>Features Overview</h2>

                    <h3>Profile Management</h3>
                    <h3>Edit Profile:</h3>
                    <p>Navigate to the <a href="account-settings.php" class="link">Profile</a> section to update personal information, change profile pictures, etc.</p>

                    <h3>Account Settings:</h3>
                    <p>Manage account, preferences, privacy settings, and notifications</p>

                    <h3>About Website</h3>
                    <h3>Introduction:</h3>
                    <p><a href="get-help.php" class="link">Learn more</a> about are website and its core functionalities</p>
                </div>
                <div class="faqs">
                    <h2>Frequently Asked Questions (FAQs)</h2>

                    <h3>What is CashMate</h3>
                    <p>CashMate is an online platform design or effective financial management, helping individuals track expenses and facilitate savings.</p>

                    <h3>How does CashMate work?</h3>
                    <p>CashMate allows users to link their bank accounts and credit cards, categorizing transactions, providing spending limits, and assisting in setting and monitoring savings goals.</p>

                    <h3>Is CashMate secure?</h3>
                    <p>Yes, CashMate prioritizes security. Robust encryption and strict security measures are in place to safeguard users financial information</p>

                    <h3>Can I create personalized budget with CashMate?</h3>
                    <p>Absolutely! CashMate offers customizable budgeting tools for creating budgets tailored to individual needs and goals.Absolutely! CashMate offers customizable budgeting tools for creating budgets tailored to individual needs and goals.</p>
                
                    <h3>Does CashMate provide real-time updates?</h3>
                    <p>Yes, CashMate provides real-time updates on transactions and expenses, ensuring users have the most current financial information.</p>

                    <h3>How can I get started with CashMate?</h3>
                    <p>To begin using CashMate, <a href="create-account.php" class="link">"Sign Up"</a> on our website, link your financial accounts, and start tracking expenses and savings today!</p>
                </div>
                <div class="troubleshoot">
                    <h2>Troubleshooting</h2>
                    
                    <h3>If you encounter issues, consider the following:</h3>
                    <ul>
                        <li>Clear your browser cache and cookies.</li>
                        <li>Ensure a stable internet connection.</li>
                        <li>Contact our support team (details in the next section).</li>
                    </ul>
                </div>
                <div class="contact">

                </div>
            </div>
            <div class="feedback-section">
                <h2>We would love your Feedback</h2>

                <!-- Website Feedback -->
                <p>Website Feedback:</p>
                <form>
                <input type="radio" id="html1" name="website_feedback" value="Poor">
                <label for="html1">Poor</label><br>
                <input type="radio" id="css1" name="website_feedback" value="Somewhat Bad">
                <label for="css1">Somewhat Bad</label><br>
                <input type="radio" id="javascript1" name="website_feedback" value="Neutral">
                <label for="javascript1">Neutral</label><br>
                <input type="radio" id="javascript2" name="website_feedback" value="Somewhat Good">
                <label for="javascript2">Somewhat Good</label><br>
                <input type="radio" id="javascript3" name="website_feedback" value="Excellent">
                <label for="javascript3">Excellent</label><br>
                </form>

                <!-- Service Feedback -->
                <p>Service Feedback:</p>
                <form>
                <input type="radio" id="html2" name="service_feedback" value="Poor">
                <label for="html2">Poor</label><br>
                <input type="radio" id="css2" name="service_feedback" value="Somewhat Bad">
                <label for="css2">Somewhat Bad</label><br>
                <input type="radio" id="javascript4" name="service_feedback" value="Neutral">
                <label for="javascript4">Neutral</label><br>
                <input type="radio" id="javascript5" name="service_feedback" value="Somewhat Good">
                <label for="javascript5">Somewhat Good</label><br>
                <input type="radio" id="javascript6" name="service_feedback" value="Excellent">
                <label for="javascript6">Excellent</label><br>
                </form>

                <!-- Other Feedback -->
                <p>Other Feedback:</p>
                <form>
                <input type="radio" id="html3" name="other_feedback" value="Poor">
                <label for="html3">Poor</label><br>
                <input type="radio" id="css3" name="other_feedback" value="Somewhat Bad">
                <label for="css3">Somewhat Bad</label><br>
                <input type="radio" id="javascript7" name="other_feedback" value="Neutral">
                <label for="javascript7">Neutral</label><br>
                <input type="radio" id="javascript8" name="other_feedback" value="Somewhat Good">
                <label for="javascript8">Somewhat Good</label><br>
                <input type="radio" id="javascript9" name="other_feedback" value="Excellent">
                <label for="javascript9">Excellent</label><br>
                </form>
            </div>

            <div class="contact-section">
                <!-- Contact Form -->
                <h3>Contact Form</h3>
                <div class="contact-form">
                <form action="/action_page.php">
                    <label for="fname">Name</label>
                    <input type="text" id="fname" name="firstname" placeholder="Your name..">

                    <label for="lname">Email</label>
                    <input type="text" id="lname" name="email" placeholder="Your Email">

                    <label for="issue">What was the Problem?</label>
                    <select id="issue" name="issue">
                    <option value="Website">Website</option>
                    <option value="Services">Services</option>
                    <option value="Other">Other</option>
                    </select>

                    <label for="subject">Subject</label>
                    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </section>
    </body>
    <footer>
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
                    <p> STAY CONNECTED </p>
                    <a href="#"><i class="fa fa-facebook fa-2x" style="color: white"></i></a>
                    <a href="#"><i class="fa fa-twitter fa-2x" style="color: white"></i></a>
                    <a href="#"><i class="fa fa-linkedin fa-2x" style="color: white"></i></a>
                    <a href="#"><i class="fa fa-youtube fa-2x" style="color: white"></i></a>
                    <a href="#"><i class="fa fa-envelope fa-2x" style="color: white"></i></a>
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
