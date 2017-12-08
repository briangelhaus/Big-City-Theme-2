$(function(){
    'use strict'

	// find all youtube iframes and make them responsive
	$('iframe[src*=youtube]').wrap('<div class="embed-responsive embed-responsive-16by9"></div>');

	// mobile nav trigger
	var mobileNav = $('.mobile-nav');
	
	// mobile nav open
	$('.navbar-toggler').on('click', function(){
		mobileNav.show();
		mobileNav.animate({right: 0},250);
		return false;
	});
	// mobile nav close
	$('.mobile-nav a.mobile-close').on('click', function(){
		mobileNav.animate({right: '-100%'},250);
		return false;
	});

}); // end jQuery