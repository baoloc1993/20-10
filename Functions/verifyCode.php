<?php
/**
 * Module to check whether a verification code is correct
 * return -1 if incorrect, otherwise return name of particiant
 */

include("db_connect.php");	// Connect to database

if (isset($_GET["code"])) {	// Get the verification code from GET method
	$actcode = $_GET["code"];
} else {
	$actcode = "";
}
$actcode = strtoupper($actcode);	// Uppercase the code

$sql = "SELECT * FROM ladies WHERE actcode='". $actcode ."'";

$result = $conn->query($sql);	// Execute the SQL

if ($result->num_rows > 0) {
    // in case the code already existed
	// get the name in order to output a hello sentence
    $row = $result->fetch_assoc();
    echo $result = $row["name"];
	$email = $row["email"];
} else {
	// in case email has not existed yet
    // insert new record to database
	echo $result = "-1";
}
?>