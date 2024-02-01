<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['deposit-form'])) {

    $plan_name = mysqli_real_escape_string($con, $_POST['plan_name']);
    $amount = mysqli_real_escape_string($con, $_POST['amount']);
    $date = mysqli_real_escape_string($con, $_POST['date']);

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
  
} else {
    echo "Invalid form submission.";
}
?>
