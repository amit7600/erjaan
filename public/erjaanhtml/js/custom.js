$(window).load(function () {
	$('.loader').fadeOut('slow');
});
$(document).ready(function () {
	new WOW().init();
	$('.qView .owl-carousel').owlCarousel({
		loop: false,
		margin: 0,
		nav: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1,
			},
			500: {
				items: 2,
			},
			880: {
				items: 3,
			},
			1200: {
				items: 4
			}
		}
	});



	$('.menuIcn').click(function () {
		$('body').addClass('openMenu');
	});
	$('.overlay,.closeIcnInr, header nav ul li a').click(function () {
		$('body').removeClass('openMenu');
	});
	/*$('.scrollTop a').click(function(event) {
		event.preventDefault();
		$('html, body').animate({scrollTop: 0}, 1500);
	});*/



	///////////////////////////////////////////////

	/*var sections = $('section'),
	nav = $('nav'),
	nav_height = nav.outerHeight();
	 
	$(window).on('scroll', function () {
	  var cur_pos = $(this).scrollTop();
	 
	  sections.each(function() {
	    var top = $(this).offset().top - nav_height,
	        bottom = top + $(this).outerHeight();
	 
	    if (cur_pos >= top && cur_pos <= bottom) {
	      nav.find('a').removeClass('active');
	      sections.removeClass('active');
	 
	      $(this).addClass('active');
	      nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('active');
	    }
	  });
	});*/

	///////////////////////////////////////////////
	var nav = $('header');
	var nav_height = nav.outerHeight();

	$('.scrollto').click(function () {
		$('html, body').animate({
			scrollTop: $(this.hash).offset().top - nav_height
		}, 1000);
		return false;
	});

	jQuery(window).scroll(function () {
		var scroll = jQuery(window).scrollTop();
		if (scroll >= 150) {
			jQuery("body").addClass("sticky");
		} else {
			jQuery("body").removeClass("sticky");
		}
	});

});