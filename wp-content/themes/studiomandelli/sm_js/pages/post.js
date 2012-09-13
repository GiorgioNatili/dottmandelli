;(function ($,exports) {
	$(document).ready(function(){
		var $galleryContainer = $("#post-gallery"),
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
      $('.0th').click(function() { 
          $('.slide-container').cycle(0); 
          $('.goto').removeClass('attivo');
          $(this).addClass('attivo');
          return false; 
      }); 
       
       $('.1th').click(function() { 
          $('.slide-container').cycle(1); 
          $('.goto').removeClass('attivo');
          $(this).addClass('attivo');
          return false; 
      }); 
      
      $('.2th').click(function() { 
          $('.slide-container').cycle(2); 
          $('.goto').removeClass('attivo');
          $(this).addClass('attivo');
          return false; 
      }); 
      
      $('.3th').click(function() { 
          $('.slide-container').cycle(3); 
          $('.goto').removeClass('attivo');
          $(this).addClass('attivo');
          return false; 
      }); 
      
      $('.4th').click(function() { 
          $('.slide-container').cycle(4); 
          $('.goto').removeClass('attivo');
          $(this).addClass('attivo');
          return false; 
      }); 
      
      $('.5th').click(function() { 
          $('.slide-container').cycle(5); 
          $('.goto').removeClass('attivo');
          $(this).addClass('attivo');
          return false; 
      }); 
	});
})(jQuery,window);