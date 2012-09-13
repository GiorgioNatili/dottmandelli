if(!window.Modules){
    Modules = {};
}
;(function($,exports) {
	var footerFixed = function(){
		var winH = $(window).height(),
			bodyH = $("body").height();
		
		if(winH > bodyH){
			$("#fixed-nav").css({
				"position": "static",
				"margin": "16px 0 0"
			});
		}else{
			$("#fixed-nav").css({
				"position": "fixed",
				"margin": "0"
			});
		}
	}
	footerFixed();
	Modules.footerFixed = footerFixed;
})(jQuery, window);

$(window).resize(function(){
	Modules.footerFixed();
})