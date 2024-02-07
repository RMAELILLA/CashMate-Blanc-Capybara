<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>
<?php
$dataPoints = array( );
$Data=array();
$con=mysqli_connect("localhost","root","","login_cashmate_db"); 

if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql="SELECT * FROM dashchart WHERE user_name='" . $user_data['user_name'] . "'";
if ($result=mysqli_query($con,$sql)){	  
	foreach($result as $row){
		array_push($dataPoints, array( "label"=>"Transportation","y"=> $row["Transportation"]),
		array( "label"=>"Clothing","y"=> $row["Clothing"]),
		array( "label"=>"House","y"=> $row["House"]),
		array( "label"=>"HealthCare","y"=> $row["HealthCare"]),
		array("label"=>"Entertainment", "y"=> $row["Entertainment"]),
		array("label"=>"Food", "y"=> $row["Food"]),
		array( "label"=>"Pet","y"=> $row["Pet"]));
	}
}
/* 
$sql1="SELECT * FROM planner WHERE user_name='" . $user_data['user_name'] . "'";
if ($res=mysqli_query($con,$sql1)){	  
	foreach($res as $out){
		array_push($Data, array( "label"=>"Retirement","y"=> $out['Retirement']),
		array( "label"=>"HouseandLot","y"=> $out["HouseandLot"]),
		array( "label"=>"Vehicle","y"=> $out["Vehicle"]));
	}
}*/

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $Retirement = mysqli_real_escape_string($con, $_POST['Retirement']);
    $HouseandLot = mysqli_real_escape_string($con, $_POST['HouseandLot']);
    $Vehicle = mysqli_real_escape_string($con, $_POST['Vehicle']);
	$result = "SELECT * FROM planner WHERE user_name = '" . $user_data['user_name'] . "'";

$query = $con->query($result);

if ($query) {
    if (mysqli_num_rows($query) >0) {
       $sql = "UPDATE planner SET Retirement='$Retirement',HouseandLot='$HouseandLot', Vehicle='$Vehicle' WHERE user_name='" . $user_data['user_name'] . "'";
		if ($con->query($sql) === TRUE) {
		} else {
		  echo "Error updating record: " . $con->error;
		}
    } else {
         $insert = "INSERT INTO planner( user_name,Retirement, HouseandLot, Vehicle) VALUES ('" . $user_data['user_name'] . "','$Retirement','$HouseandLot','$Vehicle')";

            mysqli_query($con, $insert);
    }
} else {
    echo 'Error: ' . mysqli_error();
}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> CASHMATE | Dashboard</title> 
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
			<h1>Welcome Back, <span id="user_data"><?php echo $user_data['user_name'] ?>!</span></h1> 
		</div>
		<div class="container" style="margin-top:-25px;margin-bottom:20px;">
			<div class="row gx-1" >
				<div class="col-md-6" style="margin-bottom:10px;">
					<div class="col-md-12 bordered text-center"  >
						<div id="chartContainer" style="height: 370px; width: 100%; margin-top:5%;" ></div>
				
						 
					</div>
				</div>
				<div class="col-md-6" >
					<div class="row">
						<div class="col-md-6  " style="margin-bottom:10px;">
							<div class="col-md-12 Available-balance text-center"  >
								<h1>Available Balance</h1>
								<h2><b>P89,406.00</b></h2>
								<div class="d-flex text-center income-and-spendings-container">
									<button class="income-button text-center">
									  <img src="Images/planner/up-arrow.png" class="up-arrow" style="height: 36ox;">
									  <label class="income-lbl">Income</label>
									  <p>P100,000.00</p>
									  <h4 id="total-income"></h4>
									</button>
									<button class="spendings-button text-center" id="openPopupBtn" style="border: 4px solid #FF1F07;">
									  <img src="Images/planner/down-arrow.png" class="down-arrow">
									  <label class="spendings-lbl">Spendings</label>
									  <p>P10,594.00</p>
									  <h4 id="total-spendings"></h4>

									</button>
							  </div>
							</div>
						</div>
						<div class="col-md-6  " >
							<div class="col-md-12 Available-balance text-center " style="margin-bottom:10px;">
								<h1>Your Goal</h1>
								<h2 style="font-size:20px;"><b>Saving Little by Little</b></h2>
								<form  method="post">
									<input type="Planner" placeholder="For Retirement "name="Retirement" id="Retire">
									<input type="Planner" placeholder="For House & Lot "name="HouseandLot" >
									<input type="Planner" placeholder="For Vehicle "name="Vehicle" >
									<input type="submit"class="goal-button text-center " style="margin-bottom:15px; margin-top:8px; width:500px padding:5px;"  name="Submit"class="button" value="Submit" /> 

								</form>
								

							</div>
						</div>
						
					</div>
					<div class="row" style="margin-top:15px;">
						<div class="col-md-12 spending-limit" style="padding:5px; ">
							<h1 style="padding:5px; font-size:12px;">Spending Limit</h1>
							<h2><b>P 10,594.00</b> used from <b>P100,000.00</b></h2>
						</div>
		</div>
				</div>
				
			</div>
		</div>
		<div class="container">
			<div class="col-md-6 Available-balance"style="margin-bottom:10px"   >
				<h1>Planner</h1>
				<div id="chartCont" style="height: 370px; width: 100%; margin-top:5%;" ></div>

			</div>
			
			<div class="col-md-5 Available-balance" style="margin-left:10px;margin-bottom:10px"  >
				<div class="deposit-history">
				<h1> Spendings </h1>
			</div>
			<div class="deposit-record">
				<table class="table table-responsive-md deposit">
					<tbody>
						<tr>
						  <th scope="col">Type</th>
						  <th scope="col">Date</th>
						  <th scope="col">Amount</th>
						</tr>
						<tr>
							<td scope="row">House</td>
							<td>11-09-03</td>
							<td>P550.21</td> 
						</tr>
						<tr>
							<td scope="row">Transportation</td>
							<td>10-12-03</td>
							<td>P1500.00</td> 
						</tr>
						<tr>
							<td scope="row">Entertainment</td>
							<td>9-015-03</td>
							<td>P900.21</td> 
						</tr>
						<tr>
							<td scope="row">Food</td>
							<td>8-23-03</td>
							<td>P11000.00</td> 
						</tr>
						<tr>
							<td scope="row">Pet</td>
							<td>7-16-03</td>
							<td>P300.00</td> 
						</tr>
						<tr>
							<td scope="row">Clothing</td>
							<td>7-2-03</td>
							<td>P300.00</td> 
						</tr>
						<tr>
							<td scope="row">HealthCare</td>
							<td>7-30-03</td>
							<td>P500.00</td> 
						</tr>
					</tbody>
				</table>
			</div>
			</div>
		</div>
		
	</div>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
 <script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: false,
	theme: "light1", 
	title:{
		text: "Dashboard"
	},
	data: [{
		type: "pie",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
	
});
var charts = new CanvasJS.Chart("chartCont", {
	animationEnabled: true,
	exportEnabled: false,
	theme: "light2", 
	title:{
		text: "Planner"
	},
	data: [{
		type: "bar", 
		dataPoints: <?php echo json_encode($Data, JSON_NUMERIC_CHECK); ?>
	}]
	
});
charts.render();
chart.render();
 
}
</script>
   

	

	
	  
    <script src="jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
  

    <div id="popupForm" class="popup" >
        <form class="form-container" >
          <h3><img class="back-arrow" src="Images/back-arrow.png" id="closePopupBtn" onclick="closeForm()">New Expense</h3>
            <label for="source">Enter the Amount:</label><br>
            <input type="text" class="calculator-screen">


            <div class="calculator-keys">
               
              <button type="button" class="operator" value="+">+</button>
              <button type="button" class="operator" value="-">-</button>
              <button type="button" class="operator" value="*">&times;</button>
              <button type="button" class="operator" value="/">&divide;</button>

              <button type="button" value="7">7</button>
              <button type="button" value="8">8</button>
              <button type="button" value="9">9</button>

              <button type="button" value="4">4</button>
              <button type="button" value="5">5</button>
              <button type="button" value="6">6</button>

              <button type="button" value="1">1</button>
              <button type="button" value="2">2</button>
              <button type="button" value="3">3</button>

              <button type="button" value="0">0</button>
              <button type="button" class="decimal" value=".">.</button>
              <button type="button" class="all-clear" value="all-clear">AC</button>

              <button type="button" class="equal-sign operator" value="=">=</button>
            </div>

            <label for="expenseType">Expense Type:</label><br>
            <select id="expenseType" class="expense-type-dropdown">
                <option value="choice1">Shopping</option>
                <option value="choice2">Transportation</option>
                <option value="choice3">Healthcare</option>
                <option value="choice4">Pets</option>
                <option value="choice5">House</option>
                <option value="choice6">Entertainment</option>
                <option value="choice7">Grocery</option>
                <option value="choice8">Food</option>
            </select>

            <button type="submit" class="btn-cancel" id="closePopupBtn" onclick="closeForm()">Submit</button> <!--Fix for data submission-->
        </form>
    </div>        
</div>

<script type="text/javascript">
  const calculator = {
    displayValue: '0',
    firstOperand: null,
    waitingForSecondOperand: false,
    operator: null,
  };

  function inputDigit(digit) {
    const { displayValue, waitingForSecondOperand } = calculator;

    if (waitingForSecondOperand === true) {
      calculator.displayValue = digit;
      calculator.waitingForSecondOperand = false;
    } else {
      calculator.displayValue = displayValue === '0' ? digit : displayValue + digit;
    }
  }

  function inputDecimal(dot) {
    if (calculator.waitingForSecondOperand === true) {
      calculator.displayValue = "0."
      calculator.waitingForSecondOperand = false;
      return
    }

    if (!calculator.displayValue.includes(dot)) {
      calculator.displayValue += dot;
    }
  }

  function handleOperator(nextOperator) {
    const { firstOperand, displayValue, operator } = calculator
    const inputValue = parseFloat(displayValue);
   

    if (operator && calculator.waitingForSecondOperand) {
      calculator.operator = nextOperator;
      return;
    }

    if (firstOperand == null && !isNaN(inputValue)) {
      calculator.firstOperand = inputValue;
    } else if (operator) {
      const result = calculate(firstOperand, inputValue, operator);

      calculator.displayValue = `${parseFloat(result.toFixed(7))}`;
      calculator.firstOperand = result;
    }

    calculator.waitingForSecondOperand = true;
    calculator.operator = nextOperator;

    const expenseTypeDropdown = document.getElementById("expenseType");
    const selectedExpenseType = expenseTypeDropdown.value;
  }

    function calculate(firstOperand, secondOperand, operator) {
      if (operator === '+') {
        return firstOperand + secondOperand;
      } else if (operator === '-') {
        return firstOperand - secondOperand;
      } else if (operator === '*') {
        return firstOperand * secondOperand;
      } else if (operator === '/') {
        return firstOperand / secondOperand;
      }

      return secondOperand;
    }

    function resetCalculator() {
      calculator.displayValue = '0';
      calculator.firstOperand = null;
      calculator.waitingForSecondOperand = false;
      calculator.operator = null;
    }

    function updateDisplay() {
      const display = document.querySelector('.calculator-screen');
      display.value = calculator.displayValue;
    }

    updateDisplay();

    const keys = document.querySelector('.calculator-keys');
    keys.addEventListener('click', event => {
      const { target } = event;
      const { value } = target;
      if (!target.matches('button')) {
        return;
      }

    switch (value) {
      case '+':
      case '-':
      case '*':
      case '/':
      case '+':
      case '=':
        handleOperator(value);
        break;
      case '.':
        inputDecimal(value);
        break;
      case 'all-clear':
        resetCalculator();
        break;
      default:
        if (Number.isInteger(parseFloat(value))) {
          inputDigit(value);
        }
    }
    
    updateDisplay();
    });
</script>

<script>
document.getElementById('openPopupBtn').addEventListener('click', function() {
    document.getElementById('popupForm').style.display = 'block';
});

document.getElementById('closePopupBtn').addEventListener('click', function() {
    document.getElementById('popupForm').style.display = 'none';
});

document.getElementById('Planner').addEventListener('click', function() {
    document.getElementById('Planner').style.display = 'none';
	document.getElementById('Planner_Input').style.display = 'block';
});

document.getElementById('closePopupBtn').addEventListener('click', function() {
    document.getElementById('popupForm').style.display = 'none';
});
</script>


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

 
