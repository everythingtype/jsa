// Joel Sanders Architect

(function($) {

	var toplinkVisible = false;
	var scrollTimer = null;
	var resizeTimer = null;
	var menuopen = false;
	var wasDesktop = true;

	function showToplink() {
		if ( toplinkVisible == false ) {
			toplinkVisible = true;
			$(".toplink").stop().fadeIn("fast");
		}
	}

	function hideToplink() {
		if ( toplinkVisible == true ) {
			toplinkVisible = false;
			$(".toplink").stop().fadeOut("fast");
		}
	}

	function setNavMarkup() {

		$('html').addClass('js');

		// Desktop Nav
		$('.current-post-ancestor').parents('li').addClass('current-menu-ancestor');
		$('.nav .current-menu-ancestor .sub-menu').appendTo('.nav').addClass('menu').show();
		$('.nav .current-menu-item .sub-menu').appendTo('.nav').addClass('menu').show();

		// Mobile Nav
		$('.mobilenav li ul').hide().parent().prepend('<span class="navarrow opensubs">&darr;</span>');

	}

	function isMobile() {
		if ( $(".responsivecue").css("float") == "right" ) { 
			return false;
		} else {
			return true;
		}
	}

	function openNav() {
		$('.menutoggle').addClass('active');
		$("#navlightbox").openLightbox();
	}

	function closeNav() {
		$('.menutoggle').removeClass('active');
		$("#navlightbox").closeLightbox();
	}

	function resetNav() {
		$('.menutoggle').removeClass('active');
		$("#navlightbox").resetLightbox();
	}

	jQuery.fn.openSubs = function() {
		$(this).html('&uarr;');
		var target = $(this).parent();
		target.addClass('active').children('ul').stop().slideDown("fast", function(){
			// Animation complete
		});
	}

	jQuery.fn.closeSubs = function() {
		$(this).html('&darr;');
		var target = $(this).parent();
		target.children('ul').stop().slideUp("fast", function(){
			// Animation complete
			target.removeClass('active');
		});
	}

	jQuery.fn.openLightbox = function() {

		menuopen = true;

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
		$(this).stop().slideDown("fast");
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
		$(this).stop().slideUp("fast");
	}

	jQuery.fn.resetLightbox = function() {

		if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {

			$('.content-area').css({
			    'top': "auto",
			    'position':'static'
			});

			$( "body" ).scrollTop( myScrollTop );
			myScrollTop = 0;

		}

		$('body').removeClass('haslightbox');
		$(this).stop().hide();
	}

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

		if ( wasDesktop == true ) {

			menuopen = false;

			if ( isMobile() ) {

				wasDesktop = false;


			} else {


			}

		} else {
			if( !isMobile() ) {

				wasDesktop = true;
				resetNav();


			}
		}


	}

	function handleScroll() {
	    scrollTimer = null;

		var viewportHeight = $(window).height();
		var scrolltop = $(window).scrollTop();

		if ( scrolltop > viewportHeight * 0.5 ) {
			showToplink();
		} else {
			hideToplink();
		}

		if ( $(".topheader").css("position") == "fixed" ) {
			$('.topheader').setScrollClass();
		}

	}

	function setMargin() {

		var topTitle = 0
		var headertop = 0;

		if ($('#wpadminbar').length != 0) {

			headertop =+ $('#wpadminbar').outerHeight();

			$('.wpadminbarspacer').css({'height': headertop + 'px'});

		}

		topTitle = $('.topheadermargin').outerHeight();


		$('.headerspacer').css({'height': topTitle + 'px'});

		var lightboxTop = headertop + topTitle;
		$('.lightbox').css({'top': lightboxTop + 'px'});

	}


	$(document).ready( function() {

		setNavMarkup();

		$('.thumbnaillink').hoverPattern();

		handleResize();


		$('.menutoggle').on("click", function(event) {
			event.preventDefault();

			if ( $(this).hasClass('active') ) {
				closeNav();
			} else {
				openNav();
			}
		});

		$('.navarrow').on("click", function(event) {
			event.preventDefault();

			if ( $(this).parent().hasClass('active') ) {
				$(this).closeSubs();
			} else {
				$(this).openSubs();
			}
		});

		// Top link

		$(".toplink").hide();

		$('.toplink').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 200);
			return false;
		});


	});

	$(window).load(function(){
		handleResize();
	});

	$(window).resize(function(){
		// Resize actions are in handleResize()
	    if (resizeTimer) {
	        clearTimeout(resizeTimer);   // clear any previous pending timer
	    }
	    resizeTimer = setTimeout(handleResize, 25);   // set new timer

	});

	$(window).scroll(function(){
		// Resize actions are in handleScroll()

	    if (scrollTimer) {
	        clearTimeout(scrollTimer);   // clear any previous pending timer
	    }
	    scrollTimer = setTimeout(handleScroll, 1);   // set new timer

	});

})(jQuery);