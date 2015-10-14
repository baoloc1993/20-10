<?php
require 'PHPMailer/PHPMailerAutoload.php';	// Can be edited to the location of PHPMailer Library

/**
 * Function to send an email to a specific email address
 * with provided receiver name as well as all the content
 * of the email
 * Use the PHPMailer library
 * return error message on failure
 *
 * $addr is the receiver email address
 * $name is the receiver name
 * $subject is the Subject of the email
 * $body is the main content of the email in HTML format
 * $altbody is the alternate content of the email, use in
 * case receiver's browser doesn't support HTML email
 */

function sendMail($addr, $name, $subject, $body, $altbody) {

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;	// Enable verbose debug output

	$mail->isSMTP();	// Set mailer to use SMTP
	$mail->Host = 'smtp.office365.com';	// Specify main and backup SMTP servers
	$mail->SMTPAuth = true;	// Enable SMTP authentication
	$mail->Username = 'nguyenhu002@e.ntu.edu.sg';	// SMTP username
	$mail->Password = 'HjZact$7';	// SMTP password
	$mail->SMTPSecure = 'tls';	// Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;	// TCP port to connect to

	$mail->setFrom('nguyenhu002@e.ntu.edu.sg', 'Hoi con trai VNNTU');
	$mail->addAddress($addr, $name);

	$mail->isHTML(true);	// Set email format to HTML

	$mail->Subject = $subject;	// Set email subject
	$mail->Body    = $body;	// Set email body
	$mail->AltBody = $altbody;	// Set email alternate body

	// Output error message in case of failure
	if(!$mail->send()) {
		return $mail->ErrorInfo;
	}
}

?>
