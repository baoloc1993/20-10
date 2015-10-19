<?php
include("security.php");	// For authentification
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body> 

<div class="container">
  <h2>Admin</h2>
  <a href="femaleparticipant.php?pw=<?php echo $pw; ?>"><div class="well">Manage list of female participants</div></a>
  <a href="maleparticipant.php?pw=<?php echo $pw; ?>"><div class="well">Manage list of male participants</div></a>
  <a href="job.php?pw=<?php echo $pw; ?>"><div class="well">Manage list of jobs</div></a>
  <a href="result.php?pw=<?php echo $pw; ?>"><div class="well">Manage list of result</div></a>
  <a href="blacklist.php?pw=<?php echo $pw; ?>"><div class="well">Manage blacklist</div></a>
</div>

</body>
</html>
