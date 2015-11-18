(function($) {

	var scrollTimer = null;
	var resizeTimer = null;

	jQuery.fn.setScrollClass = function() {

		if ( $(window).scrollTop() > 40 ) {
			isScrolled = true;
		} else {
			isScrolled = false;
		}

		var hasScrolled = $(this).hasClass('scrolled');

		if ( hasScrolled == false ) {
			if ( isScrolled == true ) {
				$(this).addClass('scrolled');
			}
		} else if ( hasScrolled == true ) {
			if ( isScrolled == false ) {
				$(this).removeClass('scrolled');
			}
		}

	}

	jQuery.fn.hoverPattern = function() {
		if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
			// Don't do
		} else {
			$(this).hover(function() {
			    $(this).parents('.griditem').addClass('hover');
			}, function() {
			    $(this).parents('.griditem').removeClass('hover');
			});
		}
	}

	function handleResize() {
	    resizeTimer = null;

		setMargin();

	}

	function handleScroll() {
	    scrollTimer = null;

		if ( $(".topheader").css("position") == "fixed" ) {
			$('.topheader').setScrollClass();
		}
	}

	function setMargin() {

		var topTitle = 0

		if ( $(".topheader").css("position") == "fixed" ) {

			var headertop = 0;

			if ($('#wpadminbar').length != 0) {

				headertop =+ $('#wpadminbar').outerHeight();

				$('.wpadminbarspacer').css({'height': headertop + 'px'});

			}

			topTitle = $('.topheadermargin').outerHeight();
		}

		$('.headerspacer').css({'height': topTitle + 'px'});

	}


	$(document).ready( function() {
		$('html').addClass('js');

		$('.current-post-ancestor').parents('li').addClass('current-menu-ancestor');
		$('.current-menu-ancestor .sub-menu').appendTo('.nav').addClass('menu').show();
		$('.current-menu-item .sub-menu').appendTo('.nav').addClass('menu').show();

		$('.thumbnaillink').hoverPattern();

		setMargin();

	});

	$(window).load(function(){
		setMargin();
	});

	$(window).resize(function(){
		// Timer increases RAM effiency
		// Resize actions are in handleResize()
	    if (resizeTimer) {
	        clearTimeout(resizeTimer);   // clear any previous pending timer
	    }
	    resizeTimer = setTimeout(handleResize, 25);   // set new timer

	});

	$(window).scroll(function(){
		// Timer increases RAM effiency
		// Resize actions are in handleScroll()

	    if (scrollTimer) {
	        clearTimeout(scrollTimer);   // clear any previous pending timer
	    }
	    scrollTimer = setTimeout(handleScroll, 50);   // set new timer

	});

})(jQuery);