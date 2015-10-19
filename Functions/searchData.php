<?php
/**
 * SEARCH data from a table
 * count the number of existance of the given data
 */
function searchData($data, $table, $column) {
	include("../Functions/db_connect.php");	// Open connection to database
	$sql = "SELECT * FROM " . $table . " WHERE " . $column . "=" . $data;	// SQL query
	$result = $conn->query($sql);	// Execute SQL query

	$count = 0;	// Initial the variable to count
	if ($result->num_rows > 0) {	// If data exist
		while($row = $result->fetch_assoc()) {
			$count ++;	// Update count
		}
	}
	
	return $count;
}
?>