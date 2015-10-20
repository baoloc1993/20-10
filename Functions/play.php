<?php
define("JOB_THRESHOLD", 4);

/**
 * Module to randomly match a male participant and a job
 * corresponding to a female participant
 * return -1 if incorrect, otherwise return name of male particiant and name of job
 * in the form of "Male Name", "Job Name"
 */
function startRandom() {
	include("db_connect.php");	// Connect to database
	include("searchData.php");	// Include function to select a specific record of a given id
	//mysql_query("SET NAMES 'utf8'");
	if (isset($_GET["code"])) {	// Get the verification code from GET method
		$actcode = $_GET["code"];
	} else {
		$actcode = "";
	}
	$actcode = strtoupper($actcode);	// Uppercase the code


	//
	// Get the id of the female participant
	//
	$femaleid = 0;
	$sql = "SELECT * FROM ladies WHERE actcode='". $actcode ."'";
	$result = $conn->query($sql);	// Execute the SQL
	if ($result->num_rows > 0) {
		// in case the code already existed
		$row = $result->fetch_assoc();
		$femaleid = $row["id"];
	} else {
		// in case email has not existed yet
		// output -1
		$femaleid = "-1";
	}


	//
	// Get all of the available ids and names of the male participants
	//
	$sql = "SELECT * FROM male_participant";
	$result = $conn->query($sql);	// Execute the SQL
	if ($result->num_rows > 0) {
		// in case there are some male name available
		// get the names and the ids
		$i = 0;
		while($row = $result->fetch_assoc()) {
			if (searchData($row["id"], "result", "maleid") == 0) {
				$maleid[$i]  = $row["id"];
				$malename[$i] = $row["name"];
				$i ++;
			}			
		}
		$result = $conn->query($sql);	// Execute the SQL again
		$i = 0;
		if (!isset($maleid)) {
			while($row = $result->fetch_assoc()) {
				if (searchData($row["id"], "result", "maleid") == 1) {
					$maleid[$i]  = $row["id"];
					$malename[$i] = $row["name"];
					$i ++;
				}
			}
		}
	} else {
		// in case there is no male participant in database
		return "-1";
	}
	
	
	//
	// Get all of the available ids and description of the jobs
	//
	$sql = "SELECT * FROM job";
	$result = $conn->query($sql);	// Execute the SQL
	if ($result->num_rows > 0) {
		// in case there are some jobs available
		// get the descriptions and the ids
		$i = 0;
		while($row = $result->fetch_assoc()) {
			if (searchData($row["id"], "result", "jobid") < JOB_THRESHOLD) {
				$jobid[$i] = $row["id"];
				$jobdescr[$i] = $row["descr"];
				$i ++;
			}
		}
	} else {
		// in case there is no job in database
		return "-1";
	}
	
	//
	// Randomly pick a male participant and a job
	//
	$index_selected_maleid = rand (0, count($maleid)-1);	// Randomly pick an index in the array containing male id
	$index_selected_jobid = rand (0, count($jobid)-1);	// Randomly pick an index in the array containing job id
	$selected_maleid = $maleid[ $index_selected_maleid ];
	$selected_jobid = $jobid[ $index_selected_jobid ];
	
	//
	// Save new data to database
	//
	$sql_add = "INSERT INTO result (femaleid, maleid, jobid) VALUES ('" . $femaleid . "','" . $selected_maleid . "','" . $selected_jobid . "')";
	if ($conn->query($sql_add) === TRUE) {
		// Success
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	//
	// Output text: name of selected male participant and job
	//
	echo $malename[ $index_selected_maleid ] . "," . $jobdescr[ $index_selected_jobid ];
	
	$conn->close();
}

startRandom();
?>