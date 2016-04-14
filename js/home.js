// JSA Home

(function($) {

	jQuery.fn.openSplash = function() {

		$('body').addClass('haslightbox');

		var wpadminbar = 0; 
		if ($('#wpadminbar').length != 0) {
			wpadminbar = $('#wpadminbar').outerHeight();
		}

		$('.splash').css({
		    'top': wpadminbar + "px",
		});

		if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {

			myScrollTop = $('body').scrollTop();

			thisOffset = myScrollTop - wpadminbar;
			offsetString = "-" + thisOffset + "px";

			$('.content-area').css({
			    'top': offsetString,
			    'position':'fixed'
			});

		}

	}

	jQuery.fn.closeSplash = function() {

		if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {

			$('.content-area').css({
			    'top': "auto",
			    'position':'static'
			});

			$( "body" ).scrollTop( myScrollTop );
			myScrollTop = 0;

		}

		$('body').removeClass('haslightbox');

		$(this).slideUp(1000, function() {
			// Complete
			if ( !homeIsMobile() ) { 
				window.history.replaceState("", "Home", "/home/");
			}
		});

	}

	jQuery.fn.removeSplash = function() {

		if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {

			$('.content-area').css({
			    'top': "auto",
			    'position':'static'
			});

		}

		$('body').removeClass('haslightbox');

		$(this).hide();

	}


	function setHomeHeights() {

		var windowheight = window.innerHeight;
		
		var wpadminbar = 0; 
		if ($('#wpadminbar').length != 0) {
			wpadminbar = $('#wpadminbar').outerHeight();
		}
		
		var splashheight = windowheight - wpadminbar; 
		
		$('.splashinner').css({'height': splashheight + 'px'});
		
		if ( homeIsMobile() ) { 
				
			$('.splash').removeSplash();
			$('.carousel-cell a').css({'height': 'auto'});
		
		} else {
		
			var topTitle = 0
			topTitle = $('.topheadermargin').outerHeight();
		
			$('#mission').css({'top': '-' + topTitle + 'px'});
		
			var carouselheight = windowheight - wpadminbar - topTitle;
		
			$('.carousel-cell a').css({'height': carouselheight + 'px'});
		
		
		}

	}

	function homeIsMobile() {
		if ( $(".responsivecue").css("float") == "right" ) { 
			return false;
		} else {
			return true;
		}
	}

	function splashTimer() {
		$('.splash').closeSplash();
	}

	function handleHomeScroll() {

		if ( homeIsMobile() ) {

			$('.carousel-cell').css({
			    'left': 'auto',
			});

		}

		setHomeHeights();

	}

	$(document).ready( function() {

		$(".scroll").openSplash();

		setHomeHeights();

		$('.carousel').flickity({
			cellSelector: '.carousel-cell',
			cellAlign: 'left',
			wrapAround: true,
			imagesLoaded: true,
			pageDots: true,
			prevNextButtons: false,
			autoPlay: 3500,
			watchCSS: true,
			pauseAutoPlayOnHover: false
		});

		$('.splash').on('click', function() {
			$('.splash').closeSplash();
		});

		setTimeout(splashTimer, 9000); // Timer


	});

	$(window).load(function(){
		$('.splash').removeClass('loading');
		setHomeHeights();
	});

	$(window).resize(function(){
		handleHomeScroll();
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