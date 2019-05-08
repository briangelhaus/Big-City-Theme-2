$(function(){
    'use strict'
	
	// mobile menu functionality
	var mobileNav = function(){
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
	}
	mobileNav();

}); // end jQuery