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
/*$conn = new mysqli($servername, $username, $password);
mysql_query("SET NAMES 'utf8'", $conn);
mysql_select_db($dbname);
*/
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

// Check connection
 if ($conn->connect_error) {
	 die("Connection failed: " . $conn->connect_error);
} 
?> 