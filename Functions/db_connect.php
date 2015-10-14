<?php

/**
 * Function to connect to database servername
 * return 1 on success
 */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "20_10";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
 if ($conn->connect_error) {
	 die("Connection failed: " . $conn->connect_error);
} 
?> 