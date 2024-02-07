<?php
session_start();

include("connection.php");
include("functions.php");

    // Get user data using check_login function
$user_data = check_login($con);


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $source = mysqli_real_escape_string($con, $_POST['source']);
    $categ = mysqli_real_escape_string($con, $_POST['category']);
    $amount = mysqli_real_escape_string($con, $_POST['amount']);
    $date = mysqli_real_escape_string($con, $_POST['date']);

    // Use prepared statement to prevent SQL injection
    $insert = $con->prepare("INSERT INTO income (user_name, source, categ, amount, date) VALUES (?, ?, ?, ?, ?)");
    $insert->bind_param("sssss", $user_data['user_name'], $source, $categ, $amount, $date);

		if ($insert->execute()) {
			// Record inserted successfully, now redirect to avoid form resubmission
			header("Location: " . $_SERVER['REQUEST_URI']);
			exit();
		} else {
			echo "Error: " . $insert->error;
		}

	$insert->close();
}

$sql = "SELECT * FROM income WHERE user_name = '" . $user_data['user_name'] . "' ORDER BY date DESC LIMIT 8";
$result = mysqli_query($con, $sql);
	
	// Store the results in an array
$incomeData = [];
while ($row = mysqli_fetch_assoc($result)) {
		$incomeData[] = $row;
}
?>





<html lang="en">
  <head>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> CASHMATE | Income</title> 
	<link rel="icon" href="Images/CASHMATE.png" type="image/x-icon" width="50px" height="50px">
	<link type= "text/css" rel="stylesheet" href="CashMate.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
	<script>
    function signOut() {
      alert('Signing out...');
    }
  </script>
	<div class="container-fluid">
		<div class="row" id="username-greetings"> 
			<h1>Manage The Money Coming In.</h1> 
		</div>
		<div class="container " style="margin-top:-25px; margin-bottom:20px;">
			<div class="col-md-7 Income" style="margin-bottom:10px;">
				<div class="row">
					<div class="col-md-2">
						<h1>Income</h1>
					</div>
					<div class="col-md-1">
						<button id="openPopupBtn"><img class="s2--add-button" src="Images/add-button.png" alt="Open Form"></button> 
					</div>
				</div>
				<?php foreach ($incomeData as $income) : ?>
        <div class="row section2--rect" style="margin:10px;">
            <div class="col-md-1 s2--income-img">
                <img src="Images/income-bag.png" alt="income-bag">
            </div>
            <div class="col-md-10">
                <div class="col-md-9 text-left">
                    <p class="s2--desc-title"><?php echo $income['source']; ?></p>
                    <p class="s2--desc-categ"><?php echo $income['categ']; ?></p>
                </div>
                <div class="col-md-3 text-left">
                    <p class="s2--desc-date"><?php echo $income['date']; ?></p>
                    <p class="s2--desc-amount"><?php echo "P" .number_format($income['amount'],); ?></p>
                </div>
            </div>
        </div>
   	 		<?php endforeach; ?>

			</div>
			<div class="col-md-4 Computed-Income text-center" style="margin-left:50px;">
				<h1>Computed Income</h1> 
				<div class="section3 text-center">
        	<h1>P <?php echo number_format(get_total_income($con, $user_data['user_name']), 2); ?></h1>
					<p >Updated approximately<br>every 7 days.<br>Record shows only the past<br>4 weeks.</p>
					<button><a href="income-history.php" style="color:#000000;font-family: 'Lexend', sans-serif;">Display Income History</a></button>
				</div>
			</div>
			
		</div>
		<div id="popupForm" class="popup">
            <form class="form-container" method="POST">
              <h3>New Income</h3>
                <label for="source">Income Source:</label><br>
                <input type="text" placeholder="Enter Company/Business Name" name="source" required><br>
    
                <label for="category">Income Category:</label><br>
                <input type="text" placeholder="Employment, Business, Etc." name="category" required><br>

                <label for="date">Date:</label><br>
                <input type="date" placeholder="January 12" name="date" required><br>

                <label for="amount">Amount:</label><br>
                <input type="number" placeholder="50000" name="amount" required><br>
    
                <button type="submit" class="btn-submit">Submit</button>
                <button type="button" class="btn-cancel" id="closePopupBtn" onclick="closeForm()">Close</button>
            </form>
        </div>        
	</div>
	<script src="income-page-js.js"></script>
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