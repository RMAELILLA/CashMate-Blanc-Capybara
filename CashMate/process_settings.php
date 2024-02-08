<?php
// Start the session
session_start();

// Include the database connection file
include('connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user_id is set in the session
    if(isset($_SESSION['user_id'])) {
        // Define your variables to store the settings
        $user_id = $_SESSION['user_id'];
        $emailNotifications = isset($_POST["emailNotifications"]) ? 1 : 0;
        $pushNotifications = isset($_POST["pushNotifications"]) ? 1 : 0;
        $transactionAlerts = isset($_POST["transactionAlerts"]) ? 1 : 0;
        $weeklySummary = isset($_POST["weeklySummary"]) ? 1 : 0;
        $specialOffers = isset($_POST["specialOffers"]) ? 1 : 0;

        // Prepare and execute SQL statement to update settings
        $stmt = $con->prepare("UPDATE notification_settings SET email_notifications=?, push_notifications=?, transaction_alerts=?, weekly_summary=?, special_offers=? WHERE user_id=?");
        
        if ($stmt === false) {
            die("Error preparing statement: " . $con->error);
        }

        $bindResult = $stmt->bind_param("iiiiii", $emailNotifications, $pushNotifications, $transactionAlerts, $weeklySummary, $specialOffers, $user_id);

        if ($bindResult === false) {
            die("Error binding parameters: " . $stmt->error);
        }

        $executeResult = $stmt->execute();

        if ($executeResult === false) {
            die("Error executing statement: " . $stmt->error);
        }

        $stmt->close();

        // Redirect user to the success page
        header("Location: account-settings.php");
        exit();
    } else {
        // Handle the case where user_id is not set in the session
        echo "User ID is not set in the session.";
    }
}
?>
