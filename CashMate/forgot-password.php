
<!DOCTYPE html>
<html lang="en">
  <head>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> CASHMATE | Forgot? </title> 
	<link rel="icon" href="Images/CASHMATE.png" type="image/x-icon" width="50px" height="50px">
	<link type= "text/css" rel="stylesheet" href="CashMate.css"/>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
  </head>
  <body id="reset-container">
  <div class="container"  >
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default" id="form-holder">
				<div class="panel-body">
					<div class="text-center"> 
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">                  
                    <form id="register-form" class="form" action="Mail.php" method="post">
                              <div class="form-group">
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                    <fieldset><input name="recipient_email" placeholder="email address" class="form-control"  type="email" required></fieldset>
                                  </div>
                              </div>
                              <div class="form-group frgot-password">
                                  <fieldset><input name="send" class="btn btn-block" id="contact-submit" value="Reset Password" type="submit"></fieldset>
                              </div>
                    </form>
					<p class="message">Remember your password? <a href="login-page.php">Login here</a></p>
    
                  </div>
                </div>
				</div>
			</div>
		</div>
	</div>
  </div>
    <script src="jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>