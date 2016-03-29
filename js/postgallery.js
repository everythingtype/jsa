// JSA Postgallery

(function($) {

	$(document).ready( function() {

		$('.postgallery').flickity({
			cellSelector: '.postimage',
			cellAlign: 'left',
			wrapAround: true,
			imagesLoaded: true,
			prevNextButtons: true,
			pageDots: true,
			autoPlay: 2000
		});

	});

})(jQuery);