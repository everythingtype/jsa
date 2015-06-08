(function($) {

	jQuery.fn.openLightbox = function() {

			if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {

				myScrollTop = $('body').scrollTop();

				var wpadminbar = 0; 
				if ($('#wpadminbar').length != 0) {
					wpadminbar = $('#wpadminbar').outerHeight();
				}

				thisOffset = myScrollTop - wpadminbar;
				offsetString = "-" + thisOffset + "px";

				$('.content-area').css({
				    'top': offsetString,
				    'position':'fixed'
				});

			}

			$('body').addClass('haslightbox');

	}

	jQuery.fn.closeLightbox = function() {

		if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {

			$('.content-area').css({
			    'top': "auto",
			    'position':'static'
			});

			$( "body" ).scrollTop( myScrollTop );
			myScrollTop = 0;

		}

		$('body').removeClass('haslightbox');

		$(this).fadeOut( 500, function() {
			// Complete
			window.history.replaceState("", "Home", "/home/");
		});


	}


	$(document).ready( function() {

		if ( $( ".splash" ).length ) {
			$(".scroll").openLightbox();
		}

		$('.carousel').flickity({
			cellSelector: '.carousel-cell',
			cellAlign: 'left',
			wrapAround: true,
			imagesLoaded: true,
			pageDots: false,
			autoPlay: 2000
		});

		$('.splash').on('click', function() {
			$(this).closeLightbox();
		});
		
	});

})(jQuery);