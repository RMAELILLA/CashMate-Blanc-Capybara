<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$user_name = $_POST['user_name'];
		$password = md5($_POST['password']);

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: DashBoard.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
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
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
  </head>
  <body>
	<div class="container-fluid" id="Bg">
		<div class="row">
			<div class="col-md-4" id="logo">
				<div class="container" >
					<div class="d-flex justify-content-center">
						<img src="Images/CASHMATE.png" alt=""/>
						<div class="name">
							<h1> CASHMATE</h1>
					</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="container" id="form">
					<form method="post">
							<div class="d-flex justify-content-center">
									<h1><b>Login To Your Account</b></h1>
									<div class="md-3">
											<input type="text" class="form-control" id="form-control-input" name="user_name" placeholder="Username">
									</div>
									<div class="md-3">
											<input type="password" class="form-control" id="form-control-input" name="password" placeholder="Password">
									</div>
									<div class="md-3" id="forgot-password">
											<p><a href="forgot-password.html">Forgot Password</a></p>
									</div>
									<div class="md-3" id="text">
											<button type="submit" class="log">LOGIN</button>
									</div>
									<div class="md-3" id="message">
											<p>New To CASHMATE? <span style="margin-left: 12px;"><a href="create-account.php">Create An Account</a></span></p>
									</div>
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
 
  </body>
</html>