<?php
include("security.php");	// For authentification
include("../Functions/db_connect.php");	// Open connection to database
include("../Functions/selectData.php");	// Include function to select a specific id from a table

/**
 * SELECT data from result to display
 */
$sql_sel = "SELECT * FROM result";	// SQL query
$result = $conn->query($sql_sel);	// Execute SQL query

$output = "";	// To store the list of blacklist emails in order to display
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $output .= "<tr><td>" . selectData($row['femaleid'], "ladies", "name") . "</td><td>" . selectData($row['maleid'], "male_participant", "name") . "</td><td>";
		$output .= selectData($row['jobid'], "job", "job") . "</td></tr>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<br>
<div class="row">
	<table class="table table-striped">
		<thead>
		  <tr>
			<th>Girl</th>
			<th>Guy</th>
			<th>Job</th>
		  </tr>
		</thead>
		<tbody>
		  <?php echo $output; ?>
		</tbody>
  </table>

</div>

</div>

</body>
</html>