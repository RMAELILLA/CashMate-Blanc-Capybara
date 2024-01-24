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
						<li ><a href="Dashboard.html" class="link">Dashboard</a></li>
						<li><a href="Income page.html" class="link">Income</a></li>
						<li><a href="Spendings.html" class="link">Spendings</a></li>
						<li ><a href="Cards.html">Cards</a></li>
						<li ><a href="Planner.html" class="link">Planner</a></li> 
						<li ><a href="get-help.html" class="link"><img src="Images/question.png"></a></li> 
						<li ><a href="account-settings.html" class="link"><img src="Images/settings.png"></a></li> 
						<li ><a class="dropdown" data-toggle="dropdown"><img src="Images/male-user.png"></a>  
						  <ul class="dropdown-menu" style="background-color:rgb(140,195,126);">
							<li> <img src="Images/male-user.png" style="width:300px;height:300px;margin-left:60;margin-right:60;"></li>  
							<p style="margin-left:60;margin-right:60;">Username</p>
							<p >Username@example.com</p>
							<p style="margin-left:60;margin-right:60;" ><a href="create-account.html" onclick="signOut()">Sign-out</a></p>
						  </ul>
						</li> 
					 </ul>
					 
				</div>
		</div>
	</nav>
	<script>
    // JavaScript for handling sign-out
    function signOut() {
      // You can add additional logic here, such as clearing user session
      alert('Signing out...');
    }
  </script>
	
	<div class="container-fluid">
		<div class="row" id="username-greetings"> 
			<h1>Welcome Back, <span><?php echo $user_data['user_name'] ?>!</span></h1> 
		</div>
		<div class="container" style="margin-top:-25px;margin-bottom:20px;">
			<div class="row gx-1" >
				<div class="col-md-6" style="margin-bottom:10px;">
					<div class="col-md-12 bordered text-center"  >
						<h1>Dashboard</h1>
						<canvas id="dashboard" style="width:100%;max-width:600px;height:70%;"></canvas> 
						 
					</div>
				</div>
				<div class="col-md-6" >
					<div class="row">
						<div class="col-md-6  " style="margin-bottom:10px;">
							<div class="col-md-12 Available-balance text-center">
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
								<h2><b>P30,000.00</b></h2>
								<button class="goal-button text-center ">For retirement | Switch Planner</button>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top:15px;">
						<div class="col-md-12 spending-limit">
							<h1>Spending Limit</h1>
							<h2><b>P 10,594.00</b> used from <b>P100,000.00</b></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
			var xValues = ['House','healthcare','Clothing','Entertainment','Food','Grocery','Pet','Transportation'];
			var yValues = [50,50,50,50,50,50,50,50,];
			var barColors = ['yellow','orange','red','blue','violet','green','pink','gray'];

			new Chart("dashboard", {
			  type: "doughnut",
			  data: {
				labels: xValues,
				datasets: [{
				  backgroundColor: barColors,
				  data: yValues
				}]
			  },
			  options: {
				title: {
				  display: true,
				  text: ""
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
  <script>

    var usernameElement = document.getElementById('username-greetings')

    const totalAvailableBalanceElement = document.getElementById("total-available-balance");
    const totalIncomeElement = document.getElementById("total-income");
    const totalSpendingsElement = document.getElementById("total-spendings");
    const totalGoalElement = document.getElementById("total-goal");
    const totalSpendingLimitElement = document.getElementById("spending-limit");

    const retirementProgressBar = document.getElementById('planner-retirement-progress-bar');
    const plannerRetirementDepositedElement = document.getElementById('planner-retirement-deposited')
    const plannerRetirementTargetElement = document.getElementById('planner-retirement-target');
    const vehicleProgressBar = document.getElementById('planner-vehicle-progress-bar');
    const plannerVehicleDepositedElement = document.getElementById('planner-vehicle-deposited')
    const plannerVehicleTargetElement = document.getElementById('planner-vehicle-target');
    const houseAndLotProgressBar = document.getElementById('planner-house-and-lot-progress-bar')
    const plannerHouseAndLotDepositedElement = document.getElementById('planner-house-and-lot-deposited');
    const plannerHouseAndLotTargetElement = document.getElementById('planner-house-and-lot-target');

    const spendingsHouseElement = document.getElementById('spendings-house');
    const spendingsTransportationElement = document.getElementById('spendings-transportation');
    const spendingsEntertainmentElement = document.getElementById('spendings-entertainment');
    const spendingsGroceryElement = document.getElementById('spendings-grocery');
    const spendingsFoodElement = document.getElementById('spendings-food');
    const spendingsPetElement = document.getElementById('spendings-pet');
    const spendingsHealthcareElement = document.getElementById('spendings-healthcare')
    const spendingsClothingElement = document.getElementById('spendings-clothing');

    var username = "Username";

    var totalIncome = 100000.00;
    var totalSpendings = 10594.00;
    var totalAvailableBalance = totalIncome - totalSpendings;
    var totalGoal = 30000.00;

    var spendingLimitSolution = parseFloat(Math.round((totalSpendings / totalIncome) * 100));
    var spendingLimitTotal = spendingLimitSolution;
    UpdatedSpendingLimitProgressBar(spendingLimitTotal);


    var plannerRetirementTarget = 30000000;
    var plannerRetirementDeposited = 2000000;
    var plannerRetirementSolution = parseFloat(Math.round((plannerRetirementDeposited / plannerRetirementTarget) * 100));
    var plannerRetirementTotal = plannerRetirementSolution;
    UpdatedPlannerRetirementProgressBar(plannerRetirementTotal);

    var plannerVehicleTarget = 3000000;
    var plannerVehicleDeposited = 1500000;
    var plannerVehicleSolution = parseFloat(Math.round((plannerVehicleDeposited / plannerVehicleTarget) * 100));
    var plannerVehicleTotal = plannerVehicleSolution;
    UpdatedPlannerVehicleProgressBar(plannerVehicleTotal);

    var plannerHouseAndLotTarget = 10000000;
    var plannerHouseAndLotDeposited = 2500000;
    var plannerHouseAndLotSolution = parseFloat(Math.round((plannerHouseAndLotDeposited / plannerHouseAndLotTarget) * 100));
    var plannerHouseAndLotTotal = plannerHouseAndLotSolution;
    UpdatedPlannerHouseAndLotProgressBar(plannerHouseAndLotTotal);

    var spendingsHouse = 2000;
    var spendingsTransportation = 2000;
    var spendingsEntertainment = 2000;
    var spendingsGrocery = 2000;
    var spendingsFood = 2000;
    var spendingsPet = 2000;
    var spendingsHealthcare = 2000;
    var spendingsClothing = 2000;

    var formattedTotalIncome = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(totalIncome);

    var formattedTotalSpendings = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(totalSpendings);

    var formattedTotalAvailableBalance = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(totalAvailableBalance);

    var formattedTotalGoal = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(totalGoal);

    var formattedPlannerRetirementDeposited = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(plannerRetirementDeposited);

    var formattedPlannerRetirementTarget = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(plannerRetirementTarget);

    var formattedPlannerRetirementTarget = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(plannerRetirementTarget);

    var spendingsTotal = ((totalSpendings / totalIncome)) * 100;
    var spendingLimitElement = document.getElementById("progress");
    spendingLimitElement.style.width = spendingsTotal + "%";

    function PlannerRetirementProgressBar(retirement) {
      retirementProgressBar.style.width = retirement + '%';
      retirementProgressBar.innerHTML = "";
    }

    function UpdatedPlannerRetirementProgressBar(plannerRetirement) {
      if (plannerRetirement >= 0 && plannerRetirement <= 100) {
        PlannerRetirementProgressBar(plannerRetirement);
      } else {
        console.error('Input value between 0 and 100.');
      }
    }

    var formattedPlannerVehicleDeposited = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(plannerVehicleDeposited);

    var formattedPlannerVehicleTarget = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(plannerVehicleTarget);

    var formattedSpendingsHouse = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(spendingsHouse);

    var formattedSpendingsTransportation = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(spendingsTransportation);

    var formattedSpendingsEntertainment = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(spendingsEntertainment);

    var formattedSpendingsGrocery = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(spendingsGrocery);

    var formattedSpendingsFood = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(spendingsFood);

    var formattedSpendingsPet = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(spendingsPet);

    var formattedSpendingsHealthcare = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(spendingsHealthcare);

    var formattedSpendingsClothing = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(spendingsClothing);

    function PlannerVehicleProgressBar(vehicle) {
      vehicleProgressBar.style.width = vehicle + '%';
      vehicleProgressBar.innerHTML = "";
    }

    function UpdatedPlannerVehicleProgressBar(plannerVehicle) {
      if (plannerVehicle >= 0 && plannerVehicle <= 100) {
        PlannerVehicleProgressBar(plannerVehicle);
      } else {
        console.error('Input value between 0 and 100.');
      }
    }

    var formattedPlannerHouseAndLotDeposited = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(plannerHouseAndLotDeposited);

    var formattedPlannerHouseAndLotTarget = new Intl.NumberFormat('fil-PH', {
      currency: 'PHP',
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    }).format(plannerHouseAndLotTarget);

    function PlannerHouseAndLotProgressBar(houseAndLot) {
      houseAndLotProgressBar.style.width = houseAndLot + '%';
      houseAndLotProgressBar.innerHTML = "";
    }

    function UpdatedPlannerHouseAndLotProgressBar(plannerHouseAndLot) {
      if (plannerHouseAndLot >= 0 && plannerHouseAndLot <= 100) {
        PlannerHouseAndLotProgressBar(plannerHouseAndLot);
      } else {
        console.error('Input value between 0 and 100.');
      }
    }

    function SpendingLimitProgressBar(spendingLimit) {
      houseAndLotProgressBar.style.width = spendingLimit + '%';
      houseAndLotProgressBar.innerHTML = "";
    }

    function UpdatedSpendingLimitProgressBar(spendingLimit) {
      if (spendingLimit >= 0 && spendingLimit <= 100) {
        SpendingLimitProgressBar(spendingLimit);
      } else {
        console.error('Input value between 0 and 100.');
      }
    }

    usernameElement.textContent = "Welcome Back, " + username + "!";

    totalIncomeElement.textContent = "P" + formattedTotalIncome;
    totalSpendingsElement.textContent = "P" + formattedTotalSpendings;
    totalGoalElement.textContent = "P" + formattedTotalGoal;
    totalAvailableBalanceElement.textContent = "P" + formattedTotalAvailableBalance;
    totalSpendingLimitElement.textContent = `P ${formattedTotalSpendings} used from P${formattedTotalIncome}`

    plannerRetirementDepositedElement.textContent = "P" + formattedPlannerRetirementDeposited;
    plannerRetirementTargetElement.textContent = "Target: P" + formattedPlannerRetirementTarget;

    plannerVehicleDepositedElement.textContent = "P" + formattedPlannerVehicleDeposited;
    plannerVehicleTargetElement.textContent = "Target: P" + formattedPlannerVehicleTarget;

    plannerHouseAndLotDepositedElement.textContent = "P" + formattedPlannerHouseAndLotDeposited;
    plannerHouseAndLotTargetElement.textContent = "Target: P" + formattedPlannerHouseAndLotTarget;

    spendingsHouseElement.textContent = "P" + formattedSpendingsHouse;
    spendingsTransportationElement.textContent = "P" + formattedSpendingsTransportation;
    spendingsEntertainmentElement.textContent = "P" + formattedSpendingsEntertainment;
    spendingsGroceryElement.textContent = "P" + formattedSpendingsGrocery;
    spendingsFoodElement.textContent = "P" + formattedSpendingsFood;
    spendingsPetElement.textContent = "P" + formattedSpendingsPet;
    spendingsHealthcareElement.textContent = "P" + formattedSpendingsHealthcare;
    spendingsClothingElement.textContent = "P" + formattedSpendingsClothing;

  </script>

    <div id="popupForm" class="popup">
        <form class="form-container">
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
				<p><a href="terms-conditions.html">Terms of Use </a>|<a href="privacy-policy.html"> Privacy Policy </a>|<a href="sitemap.html"> Site Map </a>|</p>
			</div>
		</div>
	</div>
  </footer>

</html> 

 
