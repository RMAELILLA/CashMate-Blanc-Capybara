<?php
$con = new mysqli('127.0.0.1', 'cashmate', 'BlancCapybara', 'login_cashmate_db');
if ($con->connect_error) {
    die('Failed to connect to MySQL: ' . $con->connect_error);
} else {
    echo 'Connected successfully!';
}
?>
