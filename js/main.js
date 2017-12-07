$(function(){
    'use strict'

	// find all youtube iframes and make them responsive
	$('iframe[src*=youtube]').wrap('<div class="embed-responsive embed-responsive-16by9"></div>');

	// mobile nav trigger
	var mobileNav = $('.mobile-nav');
	// mobile nav open
	$('.navbar-toggle').on('click', function(){
		mobileNav.animate({right: 0},250);
		return false;
	});
	// mobile nav close
	$('.mobile-nav .close a').on('click', function(){
		mobileNav.animate({right: '-'+mobileNav.outerWidth()},250);
		return false;
	});

}); // end jQuery