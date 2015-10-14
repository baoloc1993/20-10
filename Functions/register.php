<?php
include("db_connect.php");
include("activationCodeGenerator.php");
include("sendMail.php");

// Get submission data
$name = $_POST["name"];
$email = $_POST["email"] . "@e.ntu.edu.sg";

$sql = "SELECT email, actcode FROM ladies WHERE email='". $email ."'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // in case email already existed
	// get the activation code in order to send email
    $row = $result->fetch_assoc();
    $actcode = $row["actcode"];
} else {
	// in case email has not existed yet
    // insert new record to database
	$actcode = activationCodeGenerate();
	$sql = "INSERT INTO ladies (name, email, actcode, actived) VALUES ('" . $name . "', '" . $email . "', '" . $actcode . "', 0)";
	if ($conn->query($sql) === TRUE) {
		// Success
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

// Initial email content
$subject = "Spinning mung ngay phu nu Viet Nam 20-10";
$body = "Hi " . $name . "!<br><br>";
$body .= "Ban da dang ky tham gia chuong trinh <em>Spinning mung ngay phu nu Viet Nam 20-10 </em>&nbsp; cua hoi con trai VNNTU.<br><br>";
$body .= "Verification code cua ban la <b>" . $actcode . "</b>.<br><br>";
$body .= "Chuc ban co mot ngay phu nu Viet Nam vui ve!<br>";
$body .= "Hoi con trai VNNTU.";
$altbody = "Hi " . $name ."! Ban da dang ky tham gia chuong trinh Spinning mung ngay phu nu Viet Nam 20-10 cua hoi con trai VNNTU. ";
$altbody .= "Verification code cua ban la " . $actcode . ". Chuc ban co mot ngay phu nu Viet Nam vui ve. Hoi con trai VNNTU.";

echo sendMail($email, $name, $subject, $body, $altbody);	// Send email

$conn->close();
?>