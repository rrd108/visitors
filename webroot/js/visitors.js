$(document).foundation();

$(document).ready(function () {
	$('input').blur(function(){
		$('.fi-arrow-down').click(function() {
			$('div.step_1').show();
			$('html, body').animate({
				scrollTop: $("div.step_1").offset().top
			}, 1000)
		});
	});
});