<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($con);

// Fetch income data
$sql = "SELECT * FROM income WHERE user_name = '" . $user_data['user_name'] . "' ORDER BY date DESC";
$result = mysqli_query($con, $sql);

// to store results
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
    <title> CASHMATE | Income History</title> 
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
					<ul class="nav navbar-nav ">
						<li ><a href="Dashboard.php" class="link">Dashboard</a></li>
						<li><a href="Income-page.php" class="link">Income</a></li>
						<li><a href="Spendings.html" class="link">Spendings</a></li>
						<li ><a href="Planner.php" class="link">Planner</a></li> 
						<li ><a href="get-help.html" class="link"><img src="Images/question.png"></a></li> 
						<li ><a href="account-settings.html" class="link"><img src="Images/settings.png"></a></li> 
						<li ><a class="dropdown" data-toggle="dropdown"><img src="Images/male-user.png"></a>  
						  <ul class="dropdown-menu" style="background-color:rgb(140,195,126);">
							<li> <img src="Images/male-user.png" style="width:300px;height:300px;margin-left:60;margin-right:60;"></li>  
							<p style="margin-left:60;margin-right:60;">Username</p>
							<p >Username@example.com</p>
							<p style="margin-left:60;margin-right:60;" ><a href="login-page.php" onclick="signOut()">Sign-out</a></p>
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
			<h1>Your Income History</h1> 
		</div>
        <div class="container" style="margin-top: -25px; margin-bottom: 20px;">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered" style="background-color: white;">
                        <thead>
                            <tr>
                                <th>Source</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($incomeData as $income) : ?>
                                <tr>
                                    <td><?php echo $income['source']; ?></td>
                                    <td><?php echo $income['categ']; ?></td>
                                    <td><?php echo $income['date']; ?></td>
                                    <td><?php echo "P" . $income['amount']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="Income-page.php" class="btn btn-primary" style="background-color: #4CAF50; font-family: 'Lexend', sans-serif; transform: scale(1); transition: transform 0.5s;">Go Back</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
