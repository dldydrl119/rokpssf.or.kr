$(window).scroll(function() {
	var scroll = $(window).scrollTop();

	if (scroll >= 10) {
		$("header").addClass("scroll");
	} else {
		$("header").removeClass("scroll");
	}
});

$(document).ready(function(){
	$(".gov-carousel").owlCarousel({
		autoplay: true,
		autoplayTimeout: 1000,
		autoplayHoverPause: true,
		dots: true,
		items: 7,
		loop: true,
		smartSpeed: 500
	});
});