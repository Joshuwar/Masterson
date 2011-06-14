var ANIMATION_DURATION = 400,
	createWordFlow = function(selector) {
		/*
			get the words, split them into three lines
			make each line into a carousel
				assign different speeds to the three carousels
		
		*/
		var words = [],
			$words = $(selector),
			$word,
			i = 0,
			lines = [[],[],[]],
			width,
			html = '<div class="line"><span class="sentence"></span></div>' + 
				'<div class="line"><span class="sentence"></span></div>' +
				'<div class="line"><span class="sentence"></span></div>',
			lineWidth,
			randomRange = function(min,max) {
				return Math.random()*(max-min)+min;
			},
			animateLine = function(i,j) {
				var line = lines[i],
					$word = $words.find('span.sentence').eq(i).html(line[j]),
					wordWidth = $word.width();
				$word.css({
					left: lineWidth,
					fontSize: randomRange(1,2)+'em'
				}).animate({
					left: 0
				}, 500, function() {
					window.setTimeout(function() {
						$word.animate({
							left: -lineWidth
						}, 500, function() {
							j = (j+1) % line.length;
							window.setTimeout(function() {
								animateLine(i,j);
							}, randomRange(300,700));
						});
					}, 1000);
				});
			};
		if($words.length) {
			$words.find('p').each(function() {
				words.push($(this).html());
			});
			while(words.length) {
				lines[i].push(words.pop())
				i = (i+1) % 3;
			}
			$words.empty().html(html);
			/*
				fill each sentence span with a sentence, animate for 2 seconds, remove
			*/
			lineWidth = $words.find('span.sentence').eq(0).parent().width();
			window.setTimeout(function() {
				animateLine(0,0);
			}, randomRange(300,700));
			animateLine(1,0);
			window.setTimeout(function() {
				animateLine(2,0);
			}, randomRange(300,700));
		}
	};

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
	
	createWordFlow('#words');
});

