$(document).ready(function() {
	$('#arm').click(function(e) {
		var arm = $(this).addClass('clicked'),
			delay = setTimeout(function() { arm.removeClass('clicked') }, 500);
		e.preventDefault();
		spin();
	});
});
