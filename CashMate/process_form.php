<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

 
// Establish database connection (replace with your actual database credentials)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "your_database";

// Create connection
$con=mysqli_connect("localhost","root","","login_cashmate_db"); 

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$amount = $_POST['amount'];
$start_date = $_POST['start_date'];
$expense_type = $_POST['expense_type'];
$expense_type_columns = array(
    "Transportation" => "Transportation",
    "Clothing" => "Clothing",
    "Shopping" => "Shopping",
    "House" => "House",
    "HealthCare" => "HealthCare",
    "Entertainment" => "Entertainment",
    "Food" => "Food",
    "Pet" => "Pet"
);


// Validate and sanitize user input
$amount = filter_var($amount, FILTER_VALIDATE_FLOAT);
$start_date = date('Y-m-d', strtotime($start_date)); // Validate and format date

// Check if expense type exists in the mapping array
if (array_key_exists($expense_type, $expense_type_columns)) {
    $column_name = $expense_type_columns[$expense_type];

    // Prepare SQL statement to check if the column already has a value
    $check_sql = "SELECT $column_name FROM dashchart WHERE user_name = ? AND start_date = ?";
    
    // Assuming $mysqli is your mysqli connection object
    $check_stmt = $con->prepare($check_sql);
    
    if ($check_stmt) {
        // Bind parameters and execute the statement
        $check_stmt->bind_param("ss", $user_data['user_name'], $start_date);
        $check_stmt->execute();
        $check_stmt->bind_result($existing_value);
        $check_stmt->fetch();
        $check_stmt->close();
		$existing_value = (float) $existing_value;
        // Calculate new value
        $new_value = $existing_value + $amount;

        // Prepare SQL statement to insert or update data
        $sql = "INSERT INTO dashchart (user_name, start_date, $column_name) VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE $column_name = ?";
        
        $stmt = $con->prepare($sql);
        
        if ($stmt) {
            // Bind parameters and execute the statement
            $stmt->bind_param("ssdd", $user_data['user_name'], $start_date, $new_value, $new_value);
            $stmt->execute();

             
    } else {
        echo "Error: Unable to prepare statement to check existing value.";
    }
} else {
    echo "Error: Invalid expense type.";
}
}

 

// Close database connection
$con->close();
 
// Process form data...

// Redirect back to previous page
echo '<script>window.history.back();</script>'; // or use header("Location: {$_SERVER['HTTP_REFERER']}"); for PHP redirect
exit();
?>
 
