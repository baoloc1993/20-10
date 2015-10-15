<div style="display:none">
<?php include("Functions/verifyCode.php");	// verify the code ?>
</div>
<?php
if ($result == -1) {
	function Redirect($url, $permanent = false)	{
		header('Location: ' . $url, true, $permanent ? 301 : 302); exit();
	}
	Redirect('verification.php', false);	// Redirect to verification page
};
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

</body>
</html>
