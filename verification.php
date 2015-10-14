<?php
if (isset($_GET['code'])) {
	$actcode = $_GET["code"];
} else {
	$actcode = "";
}
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
<br><br><br>
<form class="form-horizontal" role="form">
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-7">
		<div class="form-group">
			<label class="control-label col-sm-3">Verification Code</label>
			<div class="col-sm-9">
				<div class="input-group">
					<input type="text" style="text-transform: uppercase" class="form-control name-char" id="actcode" name="actcode" placeholder="Enter your verification code here">
					<span class="input-group-btn">
						<button class="btn btn-success" id="submit" type="button">Submit</button>
					</span>
				</div>
				<br>
				<div class="alert alert-danger" id="alert">
					<a class="close" id="closealert">&times;</a>
					<strong>Unsuccessful!</strong> The code you have just entered is incorrect, please check again!
				</div>
			</div>
		</div>
    </div>
    <div class="col-sm-3"></div>
  </div>
</form>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Where is your verification code?</h4>
      </div>
      <div class="modal-body">
        <p>Check your inbox! An email containing the verification code has been sent to you.</p>
		<br>
		<a href="portal.html">Not yet got your email?</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
	$("#alert").hide();

	if ("<?php echo $actcode ?>".length != 23) {
		$('#myModal').modal('show');
	} else {
		$('#actcode').val('<?php echo $actcode ?>');
	}
	
	$("#closealert").click(function() {
		$("#alert").fadeOut("slow");
	});

	$('#submit').click(function(){
		$.get("Functions/verifyCode.php?code=" + $("#actcode").val(), function(data, status){
			if (data == -1) {
				$("#alert").fadeIn("slow");
			} else {
				window.location.replace('spin.php?code=' + $('#actcode').val());
			}
		});
	});

});
</script>


</body>
</html>
