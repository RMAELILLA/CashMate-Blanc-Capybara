<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($con) {
    if (isset($_POST['planner'])) {
        $selectedPlanner = mysqli_real_escape_string($con, $_POST['planner']);

        $plannerDataSql = "SELECT p.plan_name, p.goal, p.suggested, p.end_date, SUM(d.amount) as total_amount
                            FROM planner p
                            LEFT JOIN deposit d ON p.user_name = d.user_name AND p.plan_name = d.plan_name
                            WHERE p.user_name = ? AND p.plan_name = ?
                            GROUP BY p.plan_name";
        $plannerDataStmt = $con->prepare($plannerDataSql);
        $plannerDataStmt->bind_param("ss", $user_data['user_name'], $selectedPlanner);
        $plannerDataStmt->execute();
        $plannerDataResult = $plannerDataStmt->get_result();

        while ($row = mysqli_fetch_assoc($plannerDataResult)) {
            echo '<h1><img src="Images/retirement-icon.png" alt="Retirement Icon">&nbsp;&nbsp;' . htmlspecialchars($row['plan_name']) . '</h1>';
            echo '<p>P' . number_format($row['total_amount'], 2) . '&nbsp;&nbsp;|&nbsp;&nbsp;<b>Target: P' . number_format($row['goal'], 2) . '</b></p>';
            
            // Add the progress bar, target year, and monthly deposit
            $progress = ($row['goal'] != 0) ? ($row['total_amount'] / $row['goal']) * 100 : 0;
            
            echo '<div class="progress-bar-container">';
            echo '   <div class="progress">';
            echo '       <div class="progress-bar-fill" style="width: ' . $progress . '%;"></div>';
            echo '   </div>';
            echo '</div>';
        
            echo '<div>';
            echo '   <p><b>Monthly Deposit:</b> P' . number_format($row['suggested'], 2) . '</p>';
            echo '   <p><b>Target Year:</b> ' . date('Y', strtotime($row['end_date'])) . '</p>';
            echo '</div>';
        }
        

        $plannerDataStmt->close();

         
}
}

// Check if the plan_name parameter is set in the URL
if (isset($_GET['plan_name'])) {
    $plan_name = mysqli_real_escape_string($con, $_GET['plan_name']);

    // Fetch data based on the plan_name
    $plannerSql = "SELECT * FROM planner WHERE user_name = '" . $user_data['user_name'] . "' AND plan_name = '$plan_name'";
    $plannerResult = mysqli_query($con, $plannerSql);
} else {

}
?>
