<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['new-planner'])) {
        // New planner form 
        $plan_name = mysqli_real_escape_string($con, $_POST['plan_name']);
        $goal = mysqli_real_escape_string($con, $_POST['goal']);
        $start_date = mysqli_real_escape_string($con, $_POST['start_date']);
        $end_date = mysqli_real_escape_string($con, $_POST['end_date']);
        $suggested = mysqli_real_escape_string($con, $_POST['suggested']);

        //prepared statement
        $insert = $con->prepare("INSERT INTO planner (user_name, plan_name, goal, start_date, end_date, suggested) VALUES (?, ?, ?, ?, ?, ?)");
        $insert->bind_param("ssssss", $user_data['user_name'], $plan_name, $goal, $start_date, $end_date, $suggested);

        if ($insert->execute()) {
            // to avoid resubmission
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();
        } else {
            echo "Error: " . $insert->error;
        }

        $insert->close();
    }

		if ($con) {
				if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['deposit-form'])) {
						$amount = mysqli_real_escape_string($con, $_POST['amount']);
						$date = mysqli_real_escape_string($con, $_POST['date']);
						$plan_name = mysqli_real_escape_string($con, $_POST['plan_name']); // Include this line to fetch plan_name
		
						$insertDeposit = $con->prepare("INSERT INTO deposit (user_name, plan_name, amount, date) VALUES (?, ?, ?, ?)");
						$insertDeposit->bind_param("ssds", $user_data['user_name'], $plan_name, $amount, $date);
		
						if ($insertDeposit->execute()) {
							echo '<script>';
							echo 'window.location.href = "planner.php?plan_name=' . urlencode($plan_name) . '";';							
							echo '</script>';
							exit();
					} else {
							echo "Error: " . $insertDeposit->error;
					}
					
					$insertDeposit->close();
				}
		} else {
				echo "Failed to connect to the database.";
		}
}
?>



<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> CASHMATE | Planner</title> 
		<link rel="icon" href="Images/CASHMATE.png" type="image/x-icon" width="50px" height="50px">
		<link type= "text/css" rel="stylesheet" href="CashMate.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
		<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<script src="income-page-js.js"></script>

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
				//sign-out
				function signOut() {
					alert('Signing out...');
				}
			</script>
			<div class="container-fluid">
				<div class="row" id="Planner"> 
					<h1>Save for the Future!</h1> 
					<div class="col-md-12">
				<div class="planner-nav">
						<ul>
								<?php
								// Fetch planner data from the database
								$plannerSql = "SELECT DISTINCT plan_name FROM planner WHERE user_name = '" . $user_data['user_name'] . "'";
								$plannerResult = mysqli_query($con, $plannerSql);

								// Display planner names
								while ($planner = mysqli_fetch_assoc($plannerResult)) {
									echo '<li><a href="#" data-planner="' . $planner['plan_name'] . '">' . $planner['plan_name'] . '</a></li>';
								}
								?>
								<li><button id="openPopupBtn" style="height:0;"><a href="#">+ add new </a></button></li>
						</ul>
				</div>
		</div>

		</script>
		<!--CARD SECTION-->
			<div class="container" style="margin-bottom:20px; margin-top:60px;" >
				<div class="col-md-4 retirement">
					<h1 style="padding:15;"> <img src="Images/retirement-icon.png" alt="Retirement Icon">&nbsp;&nbsp;Select Planner</h1>
					<p>No Available Data</b></p> 
					<div class="progress-bar-container">
										<div class="progress">
												<div class="progress-bar-fill"></div>
										</div>
								</div>
					<div>
							<p><b>Monthly Deposit:</b>N/A</p> 
							<p><b>Target Year:</b>N/A</p>
					</div>
			</div>
					<!-- DEPOSIT HISTORY SECTION -->
				<div class="col-md-7 retirement">
			
					<div class="deposit-history">
							<?php
							// Fetch deposit history 
							echo '<script>';
							echo 'document.addEventListener("DOMContentLoaded", function() {';
							echo '    const plannerLinks = document.querySelectorAll(".planner-nav a");';
							echo '    let selectedPlanner = "";';
							echo '';
							echo '    plannerLinks.forEach(function(link) {';
							echo '        link.addEventListener("click", function(event) {';
							echo '            event.preventDefault();';
							echo '            selectedPlanner = this.getAttribute("data-planner");';
							echo '            fetchData(selectedPlanner);';
							echo '        });';
							echo '    });';
							echo '';
							echo '    function fetchData(selectedPlanner) {';
							echo '        $.ajax({';
							echo '            type: "POST",';
							echo '            url: "deposit-data.php",';
							echo '            data: { planner: selectedPlanner },';
							echo '            success: function(response) {';
							echo '                $(".deposit-history").html(response);';
							echo '            },';
							echo '            error: function(error) {';
							echo '                console.error("Error fetching data:", error);';
							echo '            }';
							echo '        });';
							echo '    }';
							echo '});';
							echo '</script>';
							?>
					</div>
				</div>	


				<div>
					<div class="deposit-btn text-center">
						<button onclick="deposit()" id="openDepoBtn">Deposit Now</button>
					</div>
				</div>	


			<!--ADD NEW PLANNER FORM-->
			<div id="popupForm" class="popup">
				<form class="planner-container" method="POST" name="new-planner">
						<h3>New Planner</h3>
						<label for="source">Planner Name:</label><br>
						<input type="text" placeholder="What do you want to save up for?" name="plan_name" required><br>

						<label for="category">Target Amount:</label><br>
						<input type="number" placeholder="Amount Goal" name="goal" id="goal" required><br>

						<label for="start_date">Start Date:</label><br>
						<input type="date" placeholder="January 21" name="start_date" id="start_date" required><br>

						<label for="date">Target year to accomplish:</label><br>
						<input type="date" placeholder="February 8" name="end_date" id="end_date" required><br>

						<button type="button" onclick="updateSuggested()" class="btn-calculate" style="height:5%; border:3px solid #6ABA8C; border: radius 20px;">Calculate</button>

						<label for="amount">Suggested Monthly Deposit:</label><br>
						<input type="text" class="suggested">
						<input type="hidden" class="suggested-hidden" name="suggested">


						<button type="submit" class="btn-submit" name="new-planner">Submit</button>
						<button type="button" class="btn-cancel" id="closePopupBtn" onclick="closeForm()">Close</button>
				</form>
			</div>

		<script type="text/javascript">
				const monthly = {
						displayValue: '0'
				};
				let monthlysuggested = 0;

				function updateSuggested() {
				var goal = document.getElementById("goal").value;
				var start_date = new Date(document.getElementById("start_date").value);
				var end_date = new Date(document.getElementById("end_date").value);

				if (end_date <= start_date) {
						alert("End date must be later than start date");
						return;
				}

				// Calculate months
				var remainingMonths = (end_date.getFullYear() - start_date.getFullYear()) * 12 + end_date.getMonth() - start_date.getMonth();

				var monthlysuggested = Math.ceil(goal / remainingMonths);

				// Display the suggested amount
				document.querySelector('.suggested').value = "P" + monthlysuggested.toFixed(2);

				const hiddenInput = document.querySelector('.suggested-hidden');
				hiddenInput.value = monthlysuggested.toFixed(2);
				}

				function updateDisplay() {
						const display = document.querySelector('.suggested');
						display.value = "P" + monthlysuggested.toFixed(2);
				}

				updateDisplay();

				function validateForm() {
						return true;
				}
		</script>
		<script>
			document.getElementById('openPopupBtn').addEventListener('click', function() {
					document.getElementById('popupForm').style.display = 'block';
			});

			document.getElementById('closePopupBtn').addEventListener('click', function() {
					document.getElementById('popupForm').style.display = 'none';
			});
		</script>

		<!--DEPOSIT FORM-->
		<div id="depositForm" class="popup" name="deposit-form">
				<form class="planner-container" method="POST">
						<h3>Deposit Now</h3>

						<label for="plan_name">Select Planner:</label><br>
						<div class="deposit-dropdown">
							<select name="plan_name" id="depositPlanName" required>
									<!--fetch planner names for dropdown-->
									<?php
									$planNamesSql = "SELECT DISTINCT plan_name FROM planner WHERE user_name = '" . $user_data['user_name'] . "'";
									$planNamesResult = mysqli_query($con, $planNamesSql);

									while ($plan = mysqli_fetch_assoc($planNamesResult)) {
											echo '<option value="' . $plan['plan_name'] . '">' . $plan['plan_name'] . '</option>';
									}
									?>
							</select>
						</div><br>

						<label for="category">Amount to Deposit:</label><br>
						<input type="number" placeholder="Deposit Amount" name="amount" id="amount" required><br>

						<label for="start_date">Date:</label><br>
						<input type="date" placeholder="January 21" name="date" id="date" required><br>

						<button type="submit" class="btn-submit" name="deposit-form">Submit</button>
						<button type="button" class="btn-cancel" id="closeDepoBtn" onclick="closeForm()">Close</button>
				</form>
			</div>

		<!--ajax for deposit-->
		<script>

			
				document.addEventListener('DOMContentLoaded', function () {
						const plannerLinks = document.querySelectorAll('.planner-nav a');
						let selectedPlanner = "";

						plannerLinks.forEach(function (link) {
								link.addEventListener('click', function (event) {
										event.preventDefault();
										selectedPlanner = this.getAttribute('data-planner');
										fetchData(selectedPlanner);
								});
						});

						document.getElementById('openDepoBtn').addEventListener('click', function () {
								if (selectedPlanner) {
										openDepositForm(selectedPlanner); 
								} else {
										alert('Please select a planner first.');
								}
						});

						document.getElementById('closeDepoBtn').addEventListener('click', function () {
								closeForm();
						});
				});

				function fetchData(selectedPlanner) {
						$.ajax({
								type: 'POST',
								url: 'fetch_planner_data.php',
								data: { planner: selectedPlanner },
								success: function (response) {
										$('.col-md-4.retirement').html(response);
								},
								error: function (error) {
										console.error('Error fetching data:', error);
								}
						});
				}

				function openDepositForm(selectedPlanner) {
					document.querySelector('[name="plan_name"]').value = selectedPlanner;
					document.getElementById('depositForm').style.display = 'block';

				}


				function closeForm() {
						document.getElementById('depositForm').style.display = 'none';
				}
		</script>
		</div>

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
	</body>
</html>