<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>
<?php
$sql = "SELECT * FROM dashchart WHERE user_name = '" . $user_data['user_name'] . "' ORDER BY DATE_FORMAT(start_date, '%Y-%m')";
$result = $con->query($sql);

if (!$result) {
    die("Error executing query: " . $con->error);
}

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
	<div class="container" style="margin-top:5%;">
		<div class="col-md-4 Available-balance" style="margin:10px; height:auto;">
			<div class="Spend text-center" >
			<h1>Spendings </h1>
			 <div  >
       <form class="form-container" method="POST" action="process_form.php">
    <h3><img class="back-arrow" src="Images/back-arrow.png" id="closePopupBtn" onclick="closeForm()">New Expense</h3>
    <label for="amount">Enter the Amount:</label><br>
    <input name="amount" type="text" class="calculator-screen" id="amount"><br>
    <label for="start_date">Start Date:</label><br>
    <input type="date" name="start_date" id="start_date" required><br>
    <label for="expense_type">Expense Type:</label><br>
    <select name="expense_type" id="expense_type" class="expense-type-dropdown">
        <option value="Shopping">Shopping</option>
        <option value="Transportation">Transportation</option>
        <option value="HealthCare">HealthCare</option>
        <option value="Pet">Pet</option>
        <option value="House">House</option>
        <option value="Entertainment">Entertainment</option> 
        <option value="Food">Food</option>
    </select>
    <!-- Hidden input field to store the selected expense type -->
    <input type="hidden" name="selected_expense_type" id="selected_expense_type">
    <button type="submit" class="btn-cancel">Submit</button>
</form>
</div>
			</div>
		</div>
		<div class="col-md-7 Available-balance" style="margin:10px; height:auto;">
		<h1> Spending History </h1>
		 <?php if ($result->num_rows > 0): ?>
        <table class="table table-responsive-md table-borderless  " >
            <tr>
                <th>Column Name</th>
                <th>Value</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <?php foreach ($row as $key => $value): ?>
                        <?php if ($key !== 'user_name' && $key !== 'id' && $key !== 'start_date' && !empty($value)): ?>
                            <td><?php echo $key; ?></td>
                            <td><?php echo $value; ?></td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <!-- Display start_date in a separate column without the column name -->
                    <td><?php echo $row['start_date']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <?php else: ?>
        <p>No results found.</p>
        <?php endif; ?>
		</div>
	</div>
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

 
