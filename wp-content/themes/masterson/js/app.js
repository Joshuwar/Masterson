/* home page image rotation */
var HOME_IMAGE_ROTATION_PAUSE = 3000,
	home_image_count,
	nextImageCount = function() {
		if(!home_image_count) {
			home_image_count = parseInt($('#imagecount').text(),10);
		}
		if(!nextImageCount.count) {
			nextImageCount.count = 0;
		}
		nextImageCount.count = (nextImageCount.count + 1) % home_image_count;
		return nextImageCount.count;
	},
	changeHomeImage = function() {
		if(!$('img.home').length) {
			return false;
		}
		var $images = $('.imagebox img'),
			i = nextImageCount();
		$images.filter(":visible").eq(0).fadeOut(function() {
			window.setTimeout(function() { // adding a pause so IE6 can get its act together
				$images.eq(i).fadeIn(function() {
					window.setTimeout(changeHomeImage, HOME_IMAGE_ROTATION_PAUSE);
				});
			},10);
		});
	},
	ANIMATION_DURATION = 400,
	createWordFlow = function(selector) {
		/*
			get the words, split them into three lines
			make each line into a carousel
				assign different speeds to the three carousels
		
		*/
		var words = [],
			$words = $(selector).hide(),
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
			wordsToSize = function($word) {
				var words = $word.text(),
					count = words.split(" ").length,
					size;
				if(count===1) {
					size = 2;
				} else if(count < 8) {
					size = 1.5;
				} else {
					size = 1;
				}
				return size += 'em';
			},
			animateLine = function(i,j) {
				var line = lines[i],
					$word = $words.find('span.sentence').eq(i).html(line[j]),
					wordWidth = $word.width();
				$word.css({
					left: lineWidth,
					fontSize: wordsToSize($word)
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
					}, 1500);
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
			$words.empty().html(html).show();
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
		$subMenu.slideToggle(ANIMATION_DURATION);
		$('.content').stop().fadeTo(ANIMATION_DURATION, 0.5);
		return false;
	}, function(e) {
		$subMenu = $(this).children('ul');
		$subMenu.slideToggle(ANIMATION_DURATION);
		$('.content').stop().fadeTo(ANIMATION_DURATION, 1);
		return false;
	}).click(function(e) {
		var href = $(e.target).attr('href');
		if(!href) {
			return false;
		}
	});
	
	createWordFlow('#words');
	
	if($(window).height()<$(document).height()) {
		$('#scrollAlert').show();
	}
});

$(window).bind("load", function() {
	/* homepage image rotation start */
	window.setTimeout(changeHomeImage, HOME_IMAGE_ROTATION_PAUSE);
});
