;(function ($,exports) {
	$(document).ready(function(){
		var $galleryContainer = $("#t2-gallery"),
			$slidesContainer = $galleryContainer.find(".slide-container"),
			$arrowNavContainer = $('<nav class="arrow-nav"></nav>'),
			$prevArrow = $('<a class="prev ir" href="#">Previous</a>'),
			$nextArrow = $('<a class="next ir" href="#">Next</a>'),
			$dotsNavContainer = $('<nav class="dots-nav"></nav>');
			/*<a class="dots ir" href="#">slide</a>*/
			$arrowNavContainer
				.append($prevArrow)
				.append($nextArrow);
			$galleryContainer
				.append($arrowNavContainer)
				.append($dotsNavContainer);
			
			$slidesContainer.cycle({
				fx: 'fade',
				speed: 500,
				timeout: 4000,
				prev : $prevArrow,
				next : $nextArrow,
				pager:  $dotsNavContainer,
				pagerAnchorBuilder: function(i, slide){
					return '<a class="dot ir" href="#">'+i+' slide</a>';
				}
			});

	});
})(jQuery,window);