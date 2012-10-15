;(function ($,exports) {
	$(document).ready(function(){
    

    
    if ($('#block_home-add-toggle').length >0){
    var $testo_originale00=$('#block_home-add-toggle').text().trim();
    }
    
    if ($('.form-wrap h3').length >0){
    var $testo_originale01=$('.form-wrap h3').text();
    }
    if($('#block_templates-add-toggle').length >0){
    var $testo_originale02=$('#block_templates-add-toggle').text().trim();
    }
    
    if ($('#submit').length >0){
    var $testo_originale04=$('#submit').val().trim();
    }    
    
    if ($testo_originale00 && $testo_originale00=='+ Aggiungi una nuova categoria'){
      $('#block_home-add-toggle').text('+ Aggiungi un nuovo blocco');
    }
    
    if ($testo_originale01 && $testo_originale01=='Aggiungi una nuova categoria'){
      $('.form-wrap h3').text('Aggiungi un nuovo blocco');
    }
    
    if ($testo_originale02 && $testo_originale02=='+ Aggiungi una nuova categoria'){
      $('#block_templates-add-toggle').text('+ Aggiungi un nuovo blocco');
    }
    
    if ($testo_originale04 && $testo_originale04=='Aggiungi una nuova categoria'){
      $('#submit').val('Aggiungi un nuovo blocco');
    }    
	});
})(jQuery,window);