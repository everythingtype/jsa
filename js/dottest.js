(function($) {

	jQuery.fn.hoverPattern = function() {
		if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
			// Don't do
		} else {
			$(this).hover(function() {
			    $(this).parents('.item').addClass('hover');
			}, function() {
			    $(this).parents('.item').removeClass('hover');
			});
		}
	}

	jQuery.fn.hoverPatternInverse = function() {
		if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
			// Don't do
		} else {
			$(this).hover(function() {
			    $(this).parents('.item').siblings().addClass('hover');
			}, function() {
			    $(this).parents('.item').siblings().removeClass('hover');
			});
		}
	}

	$(document).ready( function() {

		$('.page-id-29 a').hoverPattern();
		$('.page-id-32 a').hoverPatternInverse();
		$('.page-id-34 a').hoverPattern();
		$('.page-id-36 a').hoverPatternInverse();
		$('.page-id-38 a').hoverPattern();
		$('.page-id-40 a').hoverPatternInverse();
		$('.page-id-42 a').hoverPattern();
		$('.page-id-44 a').hoverPatternInverse();

	});



})(jQuery);