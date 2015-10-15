<?php
if (isset($_GET['pw'])) {	// Get password
	$pw = $_GET["pw"];
} else {
	$pw = "";
}
$pw_en = "eae99578ea729cfd28272686e1f1f492d3a6241a";
if(sha1($pw)!=$pw_en) {
	function Redirect($url, $permanent = false)
	{
		header('Location: ' . $url, true, $permanent ? 301 : 302);
		exit();
	}
	Redirect('404.html', false);	// Redirect to 404 page
}
?>