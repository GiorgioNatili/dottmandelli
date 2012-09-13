if(!window.Modules){
    Modules = {};
}
$("#ft-message").attr("data-placeholder","Scrivi qui il tuo messaggio (richiesto)");
$("#ft-name").attr("data-placeholder","Il tuo nome (richiesto)");
$("#ft-email").attr("data-placeholder","La tua email (richiesto)");
;(function($,exports) {        
	
	var placeholders = function() {
		$("body").find('[data-placeholder]').each(function(){
			if ($(this).val() == ''){
            	$(this).val( $(this).attr('data-placeholder') );
			}
    	});

    	$('[data-placeholder]').focus(function(){
			if ($(this).val() == $(this).attr('data-placeholder')){
				$(this).val('');
            	$(this).removeClass('data-placeholder');
			}
		}).blur(function(){
        	if ($(this).val() == '' || $(this).val() == $(this).attr('data-placeholder')){
            	$(this).val($(this).attr('data-placeholder'));
            	$(this).addClass('data-placeholder');
			}
		});

    	$('[data-placeholder]').closest('form').submit(function(){
        	$(this).find('[data-placeholder]').each(function(){
            	if ($(this).val() == $(this).attr('data-placeholder')){
                	$(this).val('');
				}
			})
		});
        exports.Modules.placeholders = true;
	}

    var activateModule = function(){
        if(!window.Modules.placeholders){
            placeholders();
        }
    }
    
    var init = function() {
        activateModule();
    };

    $(init);
})(jQuery, window);