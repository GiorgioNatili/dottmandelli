;(function ($,exports) {
	$(document).ready(function(){
  //Trasformo le thumbnail in scala digrigio e resetto la prima
  /*grayscale($('.goto'));
  grayscale.reset($('.attivo'));*/
  
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
//Gestisco il pager a thumbnail qui
      function beforepager(curr,next,opts){
      var indice=opts.currSlide+1;
      //grayscale($('.attivo'));
      $('.thumb-nav img:nth-child('+indice+')').removeClass('attivo');
      }
      function afterpager(curr,next,opts){
      var indice=opts.currSlide+1;
      $('.thumb-nav img:nth-child('+indice+')').addClass('attivo');
      //grayscale.reset($('.attivo'));
      }
      
			$slidesContainer.cycle({
				fx: 'fade',
				speed: 500,
				timeout: 4000,
				prev : $prevArrow,
				next : $nextArrow,
				pager:  $dotsNavContainer,
        before: beforepager,
        after: afterpager,
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