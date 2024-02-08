<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>


<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> CASHMATE | Site Map</title>
    <link rel="icon" href="Images/CASHMATE.png" type="image/x-icon" width="50px" height="50px">
    <link type="text/css" rel="stylesheet" href="CashMate.css" />
    <link type="text/css" rel="stylesheet" href="sitemap.css" />


    <!-- Bootstrapped Link-->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- Bootstrapped Link-->


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
    <div class="container Site-Map">
      <div class="sitemap-title" style="text-align: center;">CASHMATE SITEMAP</div>
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <!-- Content for first column goes here -->
              <h5 class="card-title">Your Account</h5>
              <ul class="sitemap-ul">
                <li class="sitemap-li"><a href="account-settings.html">Account Settings</a></li>
                <li class="sitemap-li"><a href="account-settings.html">Get Help</a></li>
                <li class="sitemap-li"><a href="account-settings.html">Privacy Policy</a></li>
              </ul>
            </div>
          </div>
        </div>


        <div class="col-md-4">
          <div class="card">
            <div class="card-body card-sitemap">
              <h5 class="card-title">Dashboard</h5>
              <ul class="sitemap-ul">
                <li class="sitemap-li"><a href="DashBoard.php">Available Balance</a></li>
                <li class="sitemap-li"><a href="DashBoard.php">Your Goal</a></li>
                <li class="sitemap-li"><a href="DashBoard.php">Planner</a></li>
                <li class="sitemap-li"><a href="DashBoard.php">Spendings</a></li>
              </ul>
            </div>
            <div class="card-body">
              <h5 class="card-title">Planner</h5>
              <ul class="sitemap-ul">
                <li class="sitemap-li"><a href="Planner.php">Deposit History</a></li>
                <li class="sitemap-li"><a href="Planner.php">Deposit Now</a></li>
                <li class="sitemap-li"><a href="Planner.php">Retirement</a></li>
                <li class="sitemap-li"><a href="Planner.php">Vehicle</a></li>
                <li class="sitemap-li"><a href="Planner.php">House and Lot</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body card-sitemap">
              <h5 class="card-title ">Income</h5>
              <ul class="sitemap-ul">
                <li class="sitemap-li"><a href="Income-page.php">Add Income</a></li>
                <li class="sitemap-li"><a href="Income-page.php">Computed Income</a></li>
                <li class="sitemap-li"><a href="Income-page.php">View Income</a></li>
                <li class="sitemap-li"><a href="Income-page.php">View Income Table</a></li>
              </ul>
            </div>
            <div class="card-body">
              <h5 class="card-title">Spendings</h5>
              <ul class="sitemap-ul">
                <li class="sitemap-li"><a href="spendings.php">Add Spendings</a></li>
                <li class="sitemap-li"><a href="spendings.php">Computed Spendings</a></li>
                <li class="sitemap-li"><a href="spendings.php">View Spendings</a></li>
                <li class="sitemap-li"><a href="spendings.php">View Income Table</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

			
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
</body>
</html>
