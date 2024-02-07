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
    <title> CASHMATE | Spendings</title> 
	<link rel="icon" href="Images/CASHMATE.png" type="image/x-icon" width="50px" height="50px">
	<link type= "text/css" rel="stylesheet" href="CashMate.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
	<div class="container-fluid">
		<div class="row" id="spendings"> 
			<h1>Spend Wise!</h1> 
		</div>
	</div>
	<div class="container">
		<div class="Spend">
		<h1>Spendings <button>+ Add Category</button></h1>
		</div>
		<table class="table table-responsive-md table-borderless spendings">
					<tbody>
						<tr>
						  <th scope="col"></th>
						  <th scope="col">October</th>
						  <th scope="col">September</th>
						  <th scope="col">August</th>
						  <th scope="col">July</th>
						</tr>
						<tr>
							<td scope="row"><b>House</b></td>
							<td>P10,000<p>10-08-23</p></td>
							<td>P10,000<p>09-08-23</p></td>
							<td>P10,000<p>08-08-23</p></td>
							<td>P10,000<p>07-08-23</p></td>
						</tr>
						<tr>
							<td scope="row"><b>Transporatation</b></td>
							<td>P3,000<p>10-08-23</p></td>
							<td>P3,000<p>09-08-23</p></td>
							<td>P3,000<p>08-08-23</p></td>
							<td>P3,000<p>07-08-23</p></td>
						</tr>
						<tr>
							<td scope="row"><b>Enterntainment</b></td>
							<td>P1,000<p>10-08-23</p></td>
							<td>P3,000<p>09-08-23</p></td>
							<td>P5,000<p>08-08-23</p></td>
							<td>P2,000<p>07-08-23</p></td>
						</tr>
						<tr>
							<td scope="row"><b>Pets</b></td>
							<td>P5,000<p>10-08-23</p></td>
							<td>P5,000<p>09-08-23</p></td>
							<td>P5,000<p>08-08-23</p></td>
							<td>P1,500<p>07-08-23</p></td>
						</tr>
						<tr>
							<td scope="row"><b>Healthcare</b></td>
							<td>P1,000<p>10-08-23</p></td>
							<td>P1,000<p>09-08-23</p></td>
							<td>P1,000<p>08-08-23</p></td>
							<td>P1,000<p>07-08-23</p></td>
						</tr>
						<tr>
							<td scope="row"><b>Foods</b></td>
							<td>P5,000<p>10-08-23</p></td>
							<td>P5,000<p>09-08-23</p></td>
							<td>P5,000<p>08-08-23</p></td>
							<td>P5,000<p>07-08-23</p></td>
						</tr>
						<tr>
							<td scope="row"><b>Shopping</b></td>
							<td>P1,500<p>10-08-23</p></td>
							<td>P1,500<p>09-08-23</p></td>
							<td>P1,500<p>08-08-23</p></td>
							<td>P3,500<p>07-08-23</p></td>
						</tr>
						<tr>
							<td scope="row"><b>Grocery</b></td>
							<td>P5,000<p>10-08-23</p></td>
							<td>P5,000<p>09-08-23</p></td>
							<td>P5,000<p>08-08-23</p></td>
							<td>P5,000<p>07-08-23</p></td>
						</tr>
						<tr>
							<td scope="row"><b>Total</b></td>
							<td>P31,500<p>10-08-23</p></td>
							<td>P33,500<p>09-08-23</p></td>
							<td>P35,000<p>08-08-23</p></td>
							<td>P30,00<p>07-08-23</p></td>
						</tr>
					</tbody>
				</table>
	</div>
	<div class="container" style="margin-bottom:20px;">
		<div class="col-md-7"> 
			<canvas id="Spendings-graph" style="width:100%;max-width:600px;height:70%;"></canvas> 
		</div>
		<div class="col-md-5 categories">
			<h1> Categories </h1>
			<button>House -10%</button>
			<button>Healthcare -15%</button>
			<button>Grocery-15%</button>
			<button>Food-15%</button>
			<button>Transporatation-5%</button>
			<button>Clothing-4%</button>
			<button>Enterntainment-4%</button>
			<button>Pets-3%</button> 
		</div>
	</div>
	</body>
	<script>
			var xValues = ['House','healthcare','Clothing','Entertainment','Food','Grocery','Pet','Transportation'];
			var yValues = [10,15,15,15,5,4,4,3,];
			var barColors = ['yellow','orange','red','blue','violet','green','pink','gray'];

			new Chart("Spendings-graph", {
			  type: "doughnut",
			  data: {
				labels: false,
				datasets: [{
				  backgroundColor: barColors,
				  data: yValues
				}]
			  },
			  options: {
				title: {
				  display: true,
				  text: "Spendings Graph"  
				},
				plugins: {
				  labels: {
					render: 'image',
					images: [
					  {
						src: 'Images/planner/house.png',
						width: 30,
						height: 30, 
					  },
					  {
						src: 'Images/planner/healthcare.png',
						width: 30,
						height: 30
					  },
					  {
						src: 'Images/planner/clothing.png',
						width: 30,
						height: 30, 
					  },
					  {
						src: 'Images/planner/entertainment.png',
						width: 30,
						height: 30, 
					  },
					  {
						src: 'Images/planner/food.png',
						width: 30,
						height: 30, 
					  },
					  {
						src: 'Images/planner/grocery.png',
						width: 30,
						height: 30, 
					  },
					  {
						src: 'Images/planner/pet.png',
						width: 30,
						height: 30, 
					  },
					  {
						src: 'Images/planner/transportation.png',
						width: 30,
						height: 30, 
					  },
					]
					}
					}
			  }
			});
	</script>
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
				<a href="group-profile.html"><img src="Images/BlancCapybara.png" height="80"alt="Description of the image"></a>
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

 