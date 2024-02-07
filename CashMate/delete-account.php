<?php
session_start();
include 'connection.php'; // Include your database connection file

if(isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];

    // Check if the connection to the database is established
    if ($conn) {
        // Delete user from the database
        $sql = "DELETE FROM `users` WHERE id = $userID";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // If deletion is successful, redirect the user to the logout page
            header("Location: logout.php");
            exit();
        } else {
            // If deletion fails, display an error message
            echo "Error: " . mysqli_error($conn);
        }
    } 
    else {
        // If the connection to the database is not established, display an error message
        echo "Error: Database connection failed.";
    }
}
?>
