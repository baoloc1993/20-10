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
		reels[0][2] = 'Night Walker',
		reels[1][2] = 'Di dao dem',

		$reels = $('.reel').each(function(i, el){
			el.innerHTML = '<div><p>' + reels[i].join('</p><p>') + '</p></div><div><p>' + reels[i].join('</p><p>') + '</p></div>'
		});

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
	}

	return {init: init}

})();

$(sm.init);
