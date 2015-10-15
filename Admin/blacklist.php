<?php
include("security.php");	// For authentification
include("../Functions/db_connect.php");	// Open connection to database

if (isset($_GET['email']) && isset($_GET['method'])) {	// Get email and method to handle
	$email = $_GET["email"];
	$method = $_GET["method"];
} else {
	$actcode = "";
	$method = "";
}

/**
 * DELETE data from blacklist
 */
if ($method == "del") {
	$sql_del = "DELETE FROM blacklist WHERE email='" . $email . "'";
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
	$sql_add = "INSERT INTO blacklist (email) VALUES ('" . $email . "')";
	if ($conn->query($sql_add) === TRUE) {
		// Success
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}


/**
 * SELECT data from blacklist to display
 */
$sql_sel = "SELECT * FROM blacklist";	// SQL query
$result = $conn->query($sql_sel);	// Execute SQL query

$output = "";	// To store the list of blacklist emails in order to display
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $output .= "&nbsp;<span class='dbl-del' id='" . $row["id"] . "'>&nbsp;" . $row["email"] . "</span>&nbsp;&nbsp;&nbsp; - &nbsp;";
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
		<div class="col-sm-12">
			<div class="input-group">
				<input type="text" class="form-control" id="pw" name="pw" value="c0ntr@1/vnNtu" style="display:none">
				<input type="text" class="form-control" id="email" name="email" placeholder="Enter email" required>
				<span class="input-group-addon">@e.ntu.edu.sg</span>
				<span class="input-group-btn">
					<input class="btn btn-success btn-block" id="submit" type="submit" value="Add">
				</span>
			</div>
		</div>
	</div>
  </form>
</div>

<br><br><br>
<div class="row text-center">
	<h3>List of all blacklisted emails: (double click to delete from blacklist)</h3>
	<br><br>
	<?php echo $output ?>
</div>

</div>

<script>
$(document).ready(function(){
	$('#email').focus();
	
	$('#submit').click(function(){
		window.location.replace('blacklist.php?method=add&email=' + $('#email').val() + "@e.ntu.edu.sg&pw=c0ntr@1/vnNtu");
	});
	
	$(".dbl-del").dblclick(function() {
		window.location.replace('blacklist.php?method=del&email=' + $(this).text().trim() + "&pw=c0ntr@1/vnNtu");
	});
	
});
</script>
</body>
</html>