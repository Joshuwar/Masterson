var ANIMATION_DURATION = 400;

$(document).ready(function() {

	var $navLinks = $('#nav > li'),
		$subMenu;

	$navLinks.hoverIntent(function(e){
		$subMenu = $(this).children('ul');
		if(!$subMenu.is(":animated")) {
			$subMenu.slideDown(ANIMATION_DURATION);
			$('.content').fadeTo(ANIMATION_DURATION, 0.5);
		}
		return false;
	}, function(e) {
		$subMenu = $(this).children('ul');
		if(!$subMenu.is(":animated")) {
			$subMenu.slideUp(ANIMATION_DURATION);
			$('.content').fadeTo(ANIMATION_DURATION, 1);
		}
		return false;
	}).click(function(e) {
		if($navLinks.children().index(e.target)!==-1) {
			return false;
		}
	});
	
});

