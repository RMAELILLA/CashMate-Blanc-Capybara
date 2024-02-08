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
$sql = "SELECT * FROM dashchart WHERE user_name='" . $user_data['user_name'] . "'";
if ($result = mysqli_query($con, $sql)) {
    $dataPoints = array(); // Initialize array to store data points

    // Initialize arrays to aggregate values for each label
    $labels = array("Transportation", "Clothing", "Shopping", "House", "HealthCare", "Entertainment", "Food", "Pet");
    $aggregatedValues = array_fill_keys($labels, 0);

    while ($row = mysqli_fetch_assoc($result)) {
        // Aggregate values for each label
        foreach ($labels as $label) {
            // Convert fetched values to integers before adding
            $aggregatedValues[$label] += (int)$row[$label];
        }
    }

    // Push aggregated values into the $dataPoints array
    foreach ($aggregatedValues as $label => $value) {
        $dataPoints[] = array(
            "label" => $label,
            "y" => $value
        );
    }

    // Encode the $dataPoints array into JSON format
    $json_data = json_encode($dataPoints);
    // Pass $json_data to your JavaScript for use with Chart.js
}
?>
<?php
$sql = "SELECT * FROM dashchart WHERE user_name = '" . $user_data['user_name'] . "' ORDER BY DATE_FORMAT(start_date, '%Y-%m')";
$result = $con->query($sql);

if (!$result) {
    die("Error executing query: " . $con->error);
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
								<p style="font-size:14px;">"Saving little by little creates the foundation for monumental achievements. 
								Each small step forward is a testament to the power of persistence and the belief that every effort, no matter how small, contributes to a greater success."</p>
								

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
				<div style="display:none;">
				<h1 style="padding:15;"> <img style="height:50px;width:50px" src="Images/retirement-icon.png" alt="Retirement Icon">&nbsp;&nbsp;House and Lot </h1>
					<p>No Available Data</b></p> 
					<div class="progress-bar-container planner-cont"  >
						<div class="progress">
							<div class="progress-bar-fill"> </div>
						</div>
					</div>
					<div>
							<p><b>Monthly Deposit:</b>N/A</p> 
							<p><b>Target Year:</b>N/A</p>
					</div>		
				</div>
					 
			</div>
			
			 <?php


				// Fetch planner data for all planners
				$allPlannersSql = "SELECT DISTINCT plan_name FROM planner WHERE user_name = '" . $user_data['user_name'] . "'";
				$allPlannersResult = mysqli_query($con, $allPlannersSql);

				$plannerNames = array();
				while ($plannerData = mysqli_fetch_assoc($allPlannersResult)) {
					$plannerNames[] = $plannerData['plan_name'];
				}

				// Encode the planner names array as JSON
				$plannerNamesJSON = json_encode($plannerNames);

				// Close the database connection
				mysqli_close($con);

				// Output the JSON data
				echo "<script>var plannerNamesJSON = $plannerNamesJSON;</script>";
				?>

				<script>
				// Function to fetch and display planner data for a specific planner
				function fetchData(selectedPlanner) {
					$.ajax({
						type: 'POST',
						url: 'fetch_planner_data.php',
						data: { planner: selectedPlanner },
						success: function (response) {
							// Append the response content for the current planner
							$('.col-md-6.Available-balance').append(response);
						},
						error: function (error) {
							console.error('Error fetching data:', error);
						}
					});
				}

				// Use plannerNamesJSON to access the planner names fetched from the database
				var plannerNames = plannerNamesJSON;

				// Loop through the plannerNames array and call fetchData for each planner
				for (var i = 0; i < plannerNames.length; i++) {
					fetchData(plannerNames[i]);
				}
				</script>

			<div class="col-md-5 Available-balance" style="margin-left:10px;margin-bottom:10px"  >
				<div class="deposit-history">
				<h1> Spendings </h1>
			</div>
 

			<div class="deposit-record">
  <?php if ($result->num_rows > 0): ?>
        <table class="table table-responsive-md table-borderless  ">
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
		text: "Dashboard of Expenses"
	},
	data: [{
		type: "pie",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
	
});

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
		<option value="Clothing">Clothing</option>
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
<script>
    // JavaScript to set the value of the hidden input field when a new expense type is selected
    document.getElementById("expense_type").addEventListener("change", function() {
        document.getElementById("selected_expense_type").value = this.value;
    });
</script>


 

			</div>        
		</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const datePickerBtn = document.getElementById('datePickerBtn');
        const selectedDateInput = document.getElementById('selectedDate');

        // Function to open date picker
        datePickerBtn.addEventListener('click', function() {
            const selectedDate = prompt('Please select a date (YYYY-MM-DD):');
            if (selectedDate) {
                selectedDateInput.value = selectedDate;
            }
        });
    });
</script>


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

