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
<div class="container">
<br>
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
		<div class="well">
			<div class="jumbotron"><h3>Xin chào bạn <?php echo $row["name"]; ?> :)</h3></div>
			<br><br>
			<div style="height:360px;" class="text-center">
				<img id="visual_man" src="images/default.png">
				<h3 id="txt1" style="display:none"><kbd id="name">[name]</kbd></h3>
				<br>
				<h5 id="txt2" style="display:none"><mark>sẽ</mark></h5>
				<br>
				<h4 id="txt3" style="display:none"><code id="job">[job]</code></h4>
			</div>
			<input type="button" class="btn btn-primary btn-block" id="spin" name="spin" value="Bắt đầu cuộc chơi!!!">
		</div>
		</div>
		<div class="col-sm-3"></div>
	</div>
</div>

<script>
$(document).ready(function(){
    $("#spin").click(function(){
		$.get("Functions/play.php?code=<?php echo $actcode; ?>", function(data, status){
			var result = data.split(",");
			$("#name").text(result[0]);
			$("#job").text(result[1]);
		});
        $("#visual_man").fadeOut(3000, function() {
			$("#txt1").fadeIn(2000, function() {
				$("#txt2").fadeIn(1000, function() {
					$("#txt3").fadeIn(1000);
				});
			});
		});
    });
});
</script>

</body>
</html>
