<div style="display:none">
<?php include("Functions/verifyCode.php");	// verify the code ?>
<?php include("Functions/searchData.php");	// verify the code ?>
</div>
<?php
echo $result;
if ($result == -1) {
	function Redirect($url, $permanent = false)	{
		header('Location: ' . $url, true, $permanent ? 301 : 302); exit();
	}
	Redirect('verification.php', false);	// Redirect to verification page
}
?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>20/10 VNNTU</title>
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style_spin.css">
      <link rel="stylesheet" href="css/spin.css">
      <link href='https://fonts.googleapis.com/css?family=Arizonia' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Playfair+Display' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=EB+Garamond' rel='stylesheet' type='text/css'>
  </head>

  <body>
  	<div id="name" style="display:none"></div>
	<div id="job" style="display:none"></div>
	<div id="signal" style="display:none">0</div>
    <div id="bg">
      <img src="images/background.jpg" alt="">
    </div>
    <div class="overlay"> </div>
    <div class="container">
      <h1>20<span> </span><span class="glyphicon glyphicon-heart" aria-hidden="true"></span><span> </span>10</h1>
      <h3>from</h3>
      <h2>CON <span>TRAI</span> VNNTU</h2>
      <div id="sm">
        <div class="group">
          <div class="reel" id ="guy-name"></div> 
          <div class="reel" id ="guy-task"></div>
        </div>
        <div id="equation" class="done">
          <div id="shoulder"><div id="arm"></div></div>
        </div>
      </div>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script>

	/*
		requestAnimationFrame polyfill
	*/
	(function(w){
		var lastTime = 0,
			vendors = ['webkit', /*'moz',*/ 'o', 'ms'];
		for (var i = 0; i < vendors.length && !w.requestAnimationFrame; ++i){
			w.requestAnimationFrame = w[vendors[i] + 'RequestAnimationFrame'];
			w.cancelAnimationFrame = w[vendors[i] + 'CancelAnimationFrame']
				|| w[vendors[i] + 'CancelRequestAnimationFrame'];
		}
		if (!w.requestAnimationFrame)
			w.requestAnimationFrame = function(callback, element){
				var currTime = +new Date(),
					timeToCall = Math.max(0, 16 - (currTime - lastTime)),
					id = w.setTimeout(function(){ callback(currTime + timeToCall) }, timeToCall);
				lastTime = currTime + timeToCall;
				return id;
			};
		if (!w.cancelAnimationFrame)
			w.cancelAnimationFrame = function(id){
			clearTimeout(id);
		};
	})(this);
		
	/*
		Slot Machine
	*/
	var sm = (function(undefined){
		var tMax = 5000, // animation time, ms
			height = 210,
			speeds = [],
			r = [],
			reels = [
				['Phan Huy',   'Tên bạn nam',   '<Printed value>', 'Ngô Lê Bảo Lộc', 'Thái Nguyễn Hưng', 'Nhật đại gia'],
				['Nhay du',  'Tên nhiệm vụ', '<Printed value>', 'Task 3', 'Task 4', 'Task 5']
			],
			$reels, $msg,
			start;

		function init(){
			// HERE TO PASS PARAMETER FROM ANH HUNG
			reels[0][2] = $("#name").text(),
			reels[1][2] = $("#job").text(),
			$reels = $('.reel').each(function(i, el){
				el.innerHTML = '<div><p>' + reels[i].join('</p><p>') + '</p></div><div><p>' + reels[i].join('</p><p>') + '</p></div>'
			});
			$msg = $('.msg');
			$('#arm').click(function(e) {
				var arm = $(this).addClass('clicked'),
					delay = setTimeout(function() { arm.removeClass('clicked') }, 500);
				e.preventDefault();
				action();
			});

		}

		function action(){
			if (start !== undefined) return;
			for (var i = 0; i < 2; ++i) {
				speeds[i] = Math.random() + 5.5;	
				r[i] = height / 3;
			}
			animate();
		}

		function animate(now){
			if (!start) start = now;
			var t = now - start || 0;
			for (var i = 0; i < 2; ++i)
				$reels[i].scrollTop = (speeds[i] / tMax / 2 * (tMax - t) * (tMax - t) + r[i]) % height | 0;
			if (t < tMax)
				requestAnimationFrame(animate);
			else {
				start = undefined;
				$("#signal").text("ok");
				emailAndHide();
			}
		}
		return {init: init}
	})();

	/*
		get random result from play.php
	*/

	function getRandomResult( callback) {
		$.get("Functions/play.php?code=<?php echo $actcode; ?>", function(data){
			var result = data.split(",");
			$("#name").text(result[0]);
			$("#job").text(result[1]);
			//console.log("getRandomResult");
			callback();
		});	
	};

	/*
		set result that is already available
	*/

	function setResult(callback) {
		$("#name").text(<?php echo "'".$guy_name."'"?>);
		$("#job").text(<?php echo "'".$guy_task."'"?>);
		//console.log("setResult");
		callback();
	};

	/* 
		email result and hide the handler
	*/
	function emailAndHide(){
		if($("#signal").text() == "ok") {	
			$.get("Functions/sendMailResult.php?name="+$("#name").text()+"&job="+$("#job").text()+"&email=<?php echo $email ?>", function(data){
				//
				$("#shoulder").hide();
				//console.log("emailAndHide");
			});
		}
	};

	/*
		start up the slot machine
	*/
	function startUpSlotMachine() {
		$(sm.init).ready(function(){
			//console.log("startUp");
		});

	};

$(document).ready(function(){
	<?php
	if ($result != -2) { ?>
		console.log("result != -2");
		getRandomResult(startUpSlotMachine);
	<?php 
		}
	else { ?>
		setResult(startUpSlotMachine)
	<?php 
		}
	?>
});
</script>

  </body>
</html>
