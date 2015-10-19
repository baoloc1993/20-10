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
<html >
  <head>
    <meta charset="UTF-8">
    <title>20/10 VNNTU</title>
        <link rel="stylesheet" href="slot-machine/css/style.css">
        <link rel="stylesheet" href="slot-machine/css/spin.css">
  </head>

  <body>
	<div id="name" style="display:none"></div>
	<div id="job" style="display:none"></div>
	<div id="signal" style="display:none">0</div>
    <div class="overlay"> 
	<div class="container">
    <h1>20-10</h1>
    <h2>CON TRAI VNNTU</h2>
    <div id="sm">
      <div class="group">
        <div class="reel" id ="guy-name"></div> 
        <div class="reel" id ="guy-task"></div>
      </div>
    </div>

    <div id="equation" class="done">
        <div id="shoulder"><div id="arm"></div></div>
      </div>
	</div>
    
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    </div>
	
<script>
$(document).ready(function(){
    $("#arm").click(function(){
		$.get("Functions/play.php?code=<?php echo $actcode; ?>", function(data){
			var result = data.split(",");
			$("#name").text(result[0]);
			$("#job").text(result[1]);
		
	
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
					['Huy',   'Ten ban nam',   '<Printed value>', 'Luis', 'Fabio', 'VV'],
					['Nhay du',  'Ten task', '<Printed value>', 'Task 3', 'Task 4', 'Task 5']
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

				//$('button').click(action);
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

				$msg.html('Spinning...');
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
				}
				result();
			}

			function result() {
				$msg.html('Ban da dc ... & ...');
			}
			return {init: init}

		})();
		
		$(sm.init);
		
	});
	
	if($("#signal").text() == "ok") {
	
		$.get("Functions/sendMailResult.php?name="+$("#name").text()+"&job="+$("#job").text()+"&email=<?php echo $email ?>", function(data){
			//
		});
		
		$("#shoulder").hide();
	}
	$("#signal").text("ok");

	});

});
</script>
  </body>
</html>
