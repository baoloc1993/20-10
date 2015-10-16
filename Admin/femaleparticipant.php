<?php
include("security.php");	// For authentification
include("../Functions/db_connect.php");	// Open connection to database

if (isset($_GET['id']) && isset($_GET['method'])) {	// Get email and method to handle
	$id = $_GET["id"];
	$method = $_GET["method"];
} else {
	$id = "";
	$method = "";
}

/**
 * DELETE data from ladies
 */
if ($method == "del") {
	$sql_del = "DELETE FROM ladies WHERE id='" . $id . "'";
	if ($conn->query($sql_del) === TRUE) {
		// Success
	} else {
		echo "Error deleting record: " . $conn->error;
	}
}

/**
 * SELECT data from ladies to display
 */
$sql_sel = "SELECT * FROM ladies";	// SQL query
$result = $conn->query($sql_sel);	// Execute SQL query

$output = "";	// To store the list of female participant info in order to display
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $output .= "<tr><td>" . $row['id'] . "</td><td>" . $row['name'] . "</td><td>";
		$output .= $row['email'] . "</td><td>" . $row['actcode'] . "</td><td>" . $row['spin'] . "</td><td>";
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
	<table class="table table-striped">
		<thead>
		  <tr>
			<th>ID</th>
			<th>Name</th>
			<th>Email</th>
			<th>Verification Code</th>
			<th>Number of spins</th>
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
		window.location.replace('femaleparticipant.php?method=del&id=' + $(this).attr('id').trim() + "&pw=c0ntr@1/vnNtu");
	});
	
});
</script>

</body>
</html>