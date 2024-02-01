<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($con) {
    if (isset($_POST['planner'])) {
        $selectedPlanner = mysqli_real_escape_string($con, $_POST['planner']);


        // Fetch deposit history
        $depositHistorySql = "SELECT * FROM deposit WHERE user_name = ? AND plan_name = ?";
        $depositHistoryStmt = $con->prepare($depositHistorySql);
        $depositHistoryStmt->bind_param("ss", $user_data['user_name'], $selectedPlanner);
        $depositHistoryStmt->execute();
        $depositHistoryResult = $depositHistoryStmt->get_result();

        // Output deposit history
        echo '<div class="deposit-history">';
        echo '<h1 style="text-align:center;"> Deposit History </h1>';
        echo '<table class="table table-responsive-md deposit">';
        echo '<tbody>';
        echo '<tr>';
        echo '<th scope="col" style="	text-align: center;">Date</th>';
        echo '<th scope="col" style="	text-align: center;">Amount</th>';
        echo '</tr>';

        while ($depositRow = mysqli_fetch_assoc($depositHistoryResult)) {
            echo '<tr>';
            echo '<td style="	text-align: center;">' . htmlspecialchars($depositRow['date']) . '</td>';
            echo '<td style="	text-align: center;">P ' . number_format($depositRow['amount'], 2) . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';

        $depositHistoryStmt->close();
    }
}
?>
