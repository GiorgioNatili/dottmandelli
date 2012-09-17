;(function ($,exports) {
	$(document).ready(function(){

    var $testo_originale00=$('#submit').val().trim();
   
    var $testo_originale01=$('.form-wrap h3').text();
    
    var $testo_originale02=$('#block_templates-add-toggle').text().trim();

    if ($testo_originale01=='Aggiungi una nuova categoria'){
      $('.form-wrap h3').text('Aggiungi un nuovo blocco');
    }
    if ($testo_originale02=='+ Aggiungi una nuova categoria'){
      $('#block_templates-add-toggle').text('+ Aggiungi un nuovo blocco');
    }
    if ($testo_originale00=='Aggiungi una nuova categoria'){
      $('#submit').val('Aggiungi un nuovo blocco');
    }
	});
})(jQuery,window);