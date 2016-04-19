// JSA Project

(function($) {

	jQuery.fn.hoverClass = function() {
		if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
			// Don't do
		} else {
			$(this).hover(function() {
			    $(this).addClass('hover');
			}, function() {
			    $(this).removeClass('hover');
			});
		}
	}

	jQuery.fn.playYoutube = function() {
		var slide = this.parents('.slide');
		slide.find('iframe')[0].src += "&autoplay=1";
		this.delay(300).fadeOut('slow');
	}

	jQuery.fn.setSlideHeight = function(contentheight) {

		if ( projectIsLarge() ) {

			$(this).css({
				'height': contentheight +'px',
			});

			$(this).find('.slideinner').css({
				'max-height': contentheight +'px',
			});

			$(this).find('img').css({
				'max-height': contentheight +'px',
			});

		} else {

			$(this).css({
				'height': 'auto',
			});

			$(this).find('.slideinner').css({
				'max-height': 'auto',
			});

			$(this).find('img').css({
				'max-height': 'auto',
			});

		}

	}

	function projectIsLarge() {
		if ( $(".projectcue").css("float") == "right" ) { 
			return true;
		} else {
			return false;
		}
	}


	function setupDescription() {

		paragraphs = $('.projectdescription p').length;

		if ( paragraphs > 1) {

			$('.projectdescription p').first().append(' <a class="readtoggle readmore">Read More</a>');
			$('.projectdescription p').last().append(' <a class="readtoggle readless">Read Less</a>');
			readLess();

		}

	}

	function readMore() {
		$('.projectdescription .readmore').hide();
		$('.projectdescription p').show();
	}

	function readLess() {
		$('.projectdescription p').hide();
		$('.projectdescription p').first().show();
		$('.projectdescription .readmore').show();
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

	$(document).ready(function() {

		setupDescription();

		setHeights();

		$('.readmore').on('click', function() {
			readMore();
		});

		$('.readless').on('click', function() {
			readLess();
		});

		$('.covercontainer').on('click', function(e) {
			$(this).playYoutube();
			e.preventDefault();
		});

		$('.playbutton').hoverClass();

		$('a.nextslide').click(function(e) {

			if ( projectIsLarge() ) {

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

			} else {

				e.preventDefault();

			}

		});



	});

	$(window).resize(function() {
	  setHeights();
	});

})(jQuery);

