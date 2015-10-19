<?php
include("db_connect.php");
include("activationCodeGenerator.php");
include("sendMail.php");

// Get submission data
$name = $_POST["name"];
$email = $_POST["email"] . "@e.ntu.edu.sg";

// Check if email is in blacklist
$sql_bl = "SELECT email FROM blacklist WHERE email='". $email ."'";
$result = $conn->query($sql_bl);
if ($result->num_rows > 0) {
    // in case email already existed
	// redirect back to portal.html
	Redirect('../portal.html', false);	// Redirect to portal page
}

// Check if email is already in database
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
	$sql = "INSERT INTO ladies (name, email, actcode, spin) VALUES ('" . $name . "', '" . $email . "', '" . $actcode . "', 0)";
	if ($conn->query($sql) === TRUE) {
		// Success
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

// Initial email content
$subject = "Chúc mừng ngày phụ nữ Việt Nam 20-10";
$body = "Hi " . $name . "!<br><br>";
$body .= "Bạn đã đăng ký tham gia chương trình chào mừng <em>ngày phụ nữ Việt Nam 20-10</em>&nbsp;của hội con trai VNNTU.<br><br>";
$body .= "Verification code của bạn là <b>" . $actcode . "</b>.<br><br>";
$body .= "Bạn có thể vào <em>http://www.vnntu.com/20_10/verification.php</em> để kích hoạt.<br><br>";
$body .= "Chúc bạn một ngày phụ nữ Việt Nam vui vẻ!<br>";
$body .= "From hội con trai VNNTU with love.";
$altbody = "Hi " . $name ."! Bạn đã đăng ký tham gia chương trình chào mừng ngày phụ nữ Việt Nam 20-10 của hội con trai VNNTU. ";
$altbody .= "Verification code của bạn là " . $actcode . ". Chúc bạn một ngày phụ nữ Việt Nam vui vẻ! From hội con trai VNNTU with love.";

echo sendMail($email, $name, $subject, $body, $altbody);	// Send email

$conn->close();

// Function to redirect to new page
function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);
    exit();
}
Redirect('../verification.php', false);	// Redirect to verification page
?>