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
	$id = $row["id"];

	// Check whether chi em has spinned
	$guy_name = "";
	$guy_task = "";
	$sql2 = "SELECT * FROM result WHERE femaleid='".$id."'";
	$result2 = $conn->query($sql2);
	if ($result2->num_rows > 0) {
		// if chi em has spinned, get the boy's name and task's for display

		// Task name
		$row2 = $result2->fetch_assoc();
		$sql3 = "SELECT * FROM job WHERE id='".$row2["jobid"]."'";
		$result3 = $conn->query($sql3);
		if ($result3->num_rows >0) {
			$row3 = $result3->fetch_assoc();
			$guy_task = $row3["descr"];		
		}

		// guy name
		$sql_get_name = "SELECT * FROM male_participant WHERE id='".$row2["maleid"]."'";
		$result_get_name = $conn->query($sql_get_name);
		if ($result_get_name->num_rows > 0) {
			$row_get_name = $result_get_name->fetch_assoc();
			$guy_name =  $row_get_name["name"];
		}

		$result = "-2";
	}
} else {
	// in case email has not existed yet
    // insert new record to database
	echo $result = "-1";
}
?>