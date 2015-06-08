(function($) {

	jQuery.fn.setSlideHeight = function(contentheight) {

		$(this).css({
			'height': contentheight +'px',
		});

		$(this).find('.slideinner').css({
			'max-height': contentheight +'px',
		});

		$(this).find('img').css({
			'max-height': contentheight +'px',
		});

		console.log('hi');

	}

	function toggleInfoLink() {
		if ( $('#infolink').hasClass('active') ) {
			$('#infolink').removeClass('active');			
			$('#infolink').html('Info');
			$('.slides').show();
		} else {
			$('#infolink').addClass('active');
			$('#infolink').html('Close Info');
			$('.slides').hide();
		}

        $('html,body').scrollTop(0);

	}

	function setHeights() {

		var wpadminbar = 0;

		if ($('#wpadminbar').length != 0) {
			wpadminbar =+ $('#wpadminbar').outerHeight();
		} 

		var topHeaderHeight = 0;

		if ($('.topheader').length != 0) {
			topHeaderHeight = $('.topheader').outerHeight();
		}

		var contentheight = $(window).height();
		contentheight = contentheight - topHeaderHeight;

		$('.slideanchor').css('top','-' + ( topHeaderHeight - wpadminbar ) + 'px');

		$('.slide').not('.slide-bleed').setSlideHeight(contentheight);

		var galleryheight = $('.slides').outerHeight();

	}

	$(window).resize(function() {
	  setHeights();
	});

	$(document).ready(function() {

		setHeights();

		$('#infolink').on('click', function( event ) {
			event.preventDefault();
			toggleInfoLink();
		});

	});


	$(function() {

	  $('a[href*=#]:not([href=#])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {

			var wpadminbar = 0;

			if ($('#wpadminbar').length != 0) {
				wpadminbar =+ $('#wpadminbar').outerHeight();
			}

			var targetoffset = target.offset().top - wpadminbar;

	        $('html,body').animate({
	          scrollTop: targetoffset
	        }, 250);
	        return false;
	      }
	    }
	  });
	});

})(jQuery);

