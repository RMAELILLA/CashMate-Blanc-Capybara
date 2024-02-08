<?php
 session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

        // servername => localhost
        // username => root
        // password => empty
        // database name => staff
        $con=mysqli_connect("localhost","root","","login_cashmate_db"); 
         
        // Check connection
        if($con === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
         
        // Taking all 5 values from the form data(input)
        $Retirement = $_REQUEST['Retirement'];
 
         
        // Performing insert query execution
        // here our table name is college
        $sql = "INSERT INTO planner WHERE user_name='" . $user_data['user_name'] . "'VALUES ('Retirement')";
        ?>