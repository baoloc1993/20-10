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
  <link href='https://fonts.googleapis.com/css?family=Arizonia' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=EB+Garamond' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="bg">
    	<img src="images/background.jpg" alt="">
    </div>
	<div class="overlay"> </div>
<div class="container">
	<h1>20<span> </span><span class="glyphicon glyphicon-heart" aria-hidden="true"></span><span> </span>10</h1>
	<h3>from</h3>
	<h2>CON <span>TRAI</span> VNNTU</h2>
<form class="form-horizontal" role="form">
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-7">
		<div class="form-group">
			<label class="control-label col-sm-3">Mã xác nhận</label>
			<div class="col-sm-9">
				<div class="input-group">
					<input type="text" style="text-transform: uppercase" class="form-control name-char" id="actcode" name="actcode" placeholder="Nhập mã xác nhận mà bạn nhận được qua email nha">
					<span class="input-group-btn">
						<button class="btn btn-success" id="submit" type="button">Xác nhận!</button>
					</span>
				</div>
				<br>
				<div class="alert alert-danger" id="alert">
					<a class="close" id="closealert">&times;</a>
					<strong>Unsuccessful!</strong> Mã xác nhận bạn vừa nhập không khớp với mã của email mà bạn đăng ký! Hãy kiểm tra lại thông tin và thử lại xem sao!
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
         <h4 class="modal-title">Làm sao tìm được mã xác nhận?</h4>
      </div>
      <div class="modal-body">
        <p>Kiểm tra hộp thư đi nào (mail trường ấy)! Ngay sau khi đăng ký, bọn mình đã gửi một email chứa mã xác nhận cho bạn.</p>
		<br>
		<a href="portal.html">Bạn chưa nhận được email?</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng lại</button>
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
