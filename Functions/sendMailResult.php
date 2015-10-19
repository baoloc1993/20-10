<?php
include("sendMail.php");	// Include function to send email
$email = $_GET["email"];
$name = $_GET["name"];
$job = $_GET["job"];

// Initial email content
$subject = "Chúc mừng ngày phụ nữ Việt Nam 20-10";
$body = "Hi " . $name . "!<br><br>";
$body .= "Bạn đã đăng ký tham gia chương trình chào mừng <em>ngày phụ nữ Việt Nam 20-10</em>&nbsp;của hội con trai VNNTU.<br><br>";
$body .= "Kết quả của bạn là: Bạn <b>" . $name . "</b> sẽ <b>" . $job . "</b>.<br><br>";
$body .= "Chúc bạn một ngày phụ nữ Việt Nam vui vẻ!<br>";
$body .= "From hội con trai VNNTU with love.";
$altbody = "Hi " . $name ."! Bạn đã đăng ký tham gia chương trình chào mừng ngày phụ nữ Việt Nam 20-10 của hội con trai VNNTU. ";
$altbody .= "Kết quả của bạn là: Bạn " . $name . " sẽ " . $job . ". Chúc bạn một ngày phụ nữ Việt Nam vui vẻ! From hội con trai VNNTU with love.";

sendMail($email, $name, $subject, $body, $altbody);	// Send email

?>