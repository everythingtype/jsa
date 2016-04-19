// JSA Postgallery

(function($) {

	function isGalleryMobile() {
		if ( $(".responsivecue").css("float") == "right" ) { 
			return false;
		} else {
			return true;
		}
	}

	function setupPostgallery() {

		if ( isGalleryMobile() ) {

			$('.postgallery').flickity({
				cellSelector: '.postimage',
				cellAlign: 'left',
				wrapAround: true,
				imagesLoaded: true,
				prevNextButtons: false,
				pageDots: true,
				autoPlay: 2000
			});

		} else {

			$('.postgallery').flickity({
				cellSelector: '.postimage',
				cellAlign: 'left',
				wrapAround: true,
				imagesLoaded: true,
				prevNextButtons: true,
				pageDots: true,
				autoPlay: 2000
			});

		}

	}

	$(document).ready( function() {

		setupPostgallery();

	});

})(jQuery);