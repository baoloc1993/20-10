<?php
include("security.php");	// For authentification
include("../Functions/db_connect.php");	// Open connection to database

if (isset($_GET['id'])) {	// Get id to handle
	$id = $_GET["id"];
} else {
	$id = "";
}

if (isset($_GET['method'])) {	// Get method to handle
	$method = $_GET["method"];
} else {
	$method = "";
}

if (isset($_GET['job']) && isset($_GET['descr'])) {	// Get job and description to handle
	$job = $_GET["job"];
	$descr = $_GET["descr"];
} else {
	$job = "";
	$descr = "";
}

/**
 * DELETE data from ladies
 */
if ($method == "del") {
	$sql_del = "DELETE FROM job WHERE id='" . $id . "'";
	if ($conn->query($sql_del) === TRUE) {
		// Success
	} else {
		echo "Error deleting record: " . $conn->error;
	}
}

/**
 * ADD data to blacklist
 */
if ($method == "add") {
	$sql_add = "INSERT INTO job (job, descr) VALUES ('" . $job . "','" . $descr . "')";
	if ($conn->query($sql_add) === TRUE) {
		// Success
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

/**
 * SELECT data from ladies to display
 */
$sql_sel = "SELECT * FROM job";	// SQL query
$result = $conn->query($sql_sel);	// Execute SQL query

$output = "";	// To store the list of blacklist emails in order to display
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $output .= "<tr><td>" . $row['id'] . "</td><td>" . $row['job'] . "</td><td>";
		$output .= $row['descr'] . "</td><td>";
		$output .= "<button type='button' id='" . $row['id'] . "' class='btn btn-danger btn-sm dbl-del'><span class='glyphicon glyphicon-remove-sign'></span> Remove</button></td></tr>";
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
  <form>
	<div class="form-group">
		<div class="col-sm-5">
			<input type="text" class="form-control" id="job" name="job" placeholder="Enter job" required>
		</div>
		<div class="col-sm-7">
			<div class="input-group">
				<input type="text" class="form-control" id="pw" name="pw" value="c0ntr@1/vnNtu" style="display:none">
				<input type="text" class="form-control" id="method" name="method" value="add" style="display:none">
				<input type="text" class="form-control" id="descr" name="descr" placeholder="Enter job description" required>
				<span class="input-group-btn">
					<input class="btn btn-success btn-block" id="submit" type="submit" value="Add">
				</span>
			</div>
		</div>
	</div>
  </form>
</div>
<br>
<div class="row">
	<table class="table table-striped">
		<thead>
		  <tr>
			<th>ID</th>
			<th>Job</th>
			<th>Description</th>
			<th>Remove?</th>
		  </tr>
		</thead>
		<tbody>
		  <?php echo $output; ?>
		</tbody>
  </table>

</div>

</div>

<script>
$(document).ready(function(){

	$(".dbl-del").click(function() {
		window.location.replace('job.php?method=del&id=' + $(this).attr('id').trim() + "&pw=c0ntr@1/vnNtu");
	});
	
});
</script>

</body>
</html>