<?php
/**
 * SELECT data from id and table to display
 * the last parameter is optional, if it is 1, the function
 * will return the number of satisfying records
 */
function selectData($id, $table, $column, $returnNum = 0) {
	include("../Functions/db_connect.php");	// Open connection to database
	$sql = "SELECT * FROM " . $table . " WHERE id=" . $id;	// SQL query
	$result = $conn->query($sql);	// Execute SQL query

	if ($result->num_rows > 0) {
		// output data of each row
		$count = 0;
		while($row = $result->fetch_assoc()) {
			if ($returnNum == 0) {
				return $row[$column];
			} else {
				$count ++;
			}
		}
	} else {
		return "null";
	}
	if ($returnNum != 0) { return $count; }
}
?>