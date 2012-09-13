var slidejs = function() { 

    var velocita = 300,     // velocita fade immagini
        vfc = 150,          // velocita fade controlli
        immagini,           // collezione di immagini della galleria (object)
        controls,           // controlli prev-next
        thumbs,             // thumbnails
        galleria,
        primo_piano,
        attiva,
        attuale = 0; 
    
    // COSTRUTTORE
    var init = function(container) {
        // Aggiungo i nuovi elementi al DOM
        container.append('<div id="main_slide_container">' +
                            '<div id="spotlight"></div>' +
                            '<div id="active_slide"><span></span></div>' +
                            '<div id="controls">' +
                                '<a href="#" id="prev_slide">&nbsp;</a>' +
                                '<a href="#" id="next_slide">&nbsp;</a>' +
                            '</div>' +
                         '</div>');
        
        immagini =  $('li img', container);
        thumbs = $('#thumb_gallery');
        controls = new function() {
            this.jqControls = $('#prev_slide, #next_slide');
            this.prev = $(this.jqControls[0]); 
            this.next = $(this.jqControls[1]);
            // metodi proxy
            this.hide = function() { this.jqControls.hide() }
            this.fade = function(v) { this.jqControls.fadeOut(v) }
        }
        
        // inizializzazione pannelli galleria
        galleria = $('#main_slide_container', container);
        primo_piano = $('#spotlight', container);
        attiva = $('#active_slide', container);
        controls.hide();
        
        // posizionamento nuovi elementi
        galleria.css({position:'relative', overflow:'hidden'});
        primo_piano.css({position:'absolute', top:0, left:0, overflow:'hidden'});
        attiva.css({position:'absolute', top:0, left:0, overflow:'hidden'});

        $('#spaziatore').remove();

        setta_numero_thumb(0);
        
        vai_a_immagine(0);
        
        osservatore_pulsanti();
        osservatore_thumb();

        // nascondi il container principale
        // old_container = $('ul',container).css({height:0,width:0,overflow:'hidden'});
        $('ul',container).hide();
    }
    
    // controllo diretto sui pulsanti
    var osservatore_thumb = function() {
        $('li', thumbs).click(function() {
            pos = $(this).prevAll().size();
            vai_a_immagine(pos);
            if($(this).hasClass('active')) {
                $(this).removeClass('active');
            }
            $(this).addClass('active');
            return false;
        });
    }
    
    var controllo_video = function(numero_diapositiva) {
        return $('.video_slide', $(html_diapositiva(numero_diapositiva)).parent()).size() == true;
    }

    var controllore_mouse = function()
    {
        galleria.mousemove(function(e) {
            width = $(this).width();
            offsetleft = e.pageX - this.offsetLeft;
            offsettop = e.pageY - this.offsetTop;
            slideheight = get_slide_height(attuale);
            pos = offsettop - 20;
            
            if(pos < 15) {
                pos = 15;
            }
            // if(slideheight < pos + 20) {
            //     pos = slideheight - 20;
            // }
            //if(controllo_video(attuale) && slideheight < pos + 150) {
            if(slideheight < pos + 60) {
                pos = slideheight - 60;
            }
            
            controls.jqControls.css('top', pos);
            
            if(offsetleft < width/2 && !controls.prev.is(':visible')) {
                controls.next.fadeOut(vfc);
                controls.prev.fadeIn(vfc);
            } else if (offsetleft > width/2 && !controls.next.is(':visible')) {
                controls.prev.fadeOut(vfc);
                controls.next.fadeIn(vfc);
            }
        });
    
        galleria.hover(
            function(e) {},
            function(e) {
                controls.fade(vfc);
            })
    }
    
    var osservatore_pulsanti = function() {
        galleria.click( function(e) {
            width = $(this).width();
            offsetleft = e.pageX - this.offsetLeft;
            offsettop = e.pageY - this.offsetTop;
            slideheight = get_slide_height(attuale);
            //if (!(controllo_video(attuale) && (offsettop > slideheight-100)) && (offsetleft > width/2)) {
            if (!(offsettop > slideheight-100) && (offsetleft > width/2)) {
                e.preventDefault();
                vai_a_immagine_successiva();
            } else {
                e.preventDefault();
                vai_a_immagine_precedente();
            }
        })
    }
    
    var vai_a_immagine_successiva = function() {
        if(attuale+1 >= num_diapositive()) {
            vai_a_immagine(0);
        } else {
            vai_a_immagine(attuale+1);
        }
    }

    var vai_a_immagine_precedente = function() {
        if(attuale-1 < 0) {
            vai_a_immagine(num_diapositive()-1);
        } else {
            vai_a_immagine(attuale-1);
        }
    }

    var num_diapositive = function() {
        return immagini.length;
    }

    var setta_numero_thumb = function(numero_diapositiva) {
        numero_thumb = numero_diapositiva + 1;
        attuale_thumb = $('#thumb_gallery li.thumbs.active');
        attuale_thumb.removeClass('active');
        new_thumb = $('#thumb_gallery li:nth-child('+numero_thumb+')');
        new_thumb.addClass('active');
    }
    
    var vai_a_immagine = function(numero_diapositiva) {
        load_slide(primo_piano, numero_diapositiva);
        attuale_height = next_height = get_slide_height(numero_diapositiva);
        next_height = get_slide_height(numero_diapositiva);
        setta_numero_thumb(numero_diapositiva);
        if(attuale_height > next_height) {
            galleria.animate(
                {height:next_height}, 
                velocita, 
                function() {
                    attiva.css({height:next_height});
                    attiva.fadeOut(velocita,function() {
                        ripetitore(numero_diapositiva);
                        //caricamento_video(numero_diapositiva);
                    });
                });
        } else if (attuale_height != 16) {
            primo_piano.css({height:attuale_height});
            attiva.fadeOut(velocita, function() {
                primo_piano.css({height:next_height});
                galleria.animate(
                    {height:next_height},
                    velocita,
                    function() {
                        ripetitore(numero_diapositiva);
                        //caricamento_video(numero_diapositiva);
                    });
            });
        }
    
        attuale = numero_diapositiva;
    
        $('#visiona_lavoro:visible').fadeOut();
        controllore_mouse();
    }
        
    // TODO: Non implementata, da controllare.
    var caricamento_video = function(numero_diapositiva) {
        if(controllo_video(numero_diapositiva)) {
            indirizzo_video = $('#active_slide .vid_url').html();
            id = $('#active_slide .video_slide .flashcontent').attr('id');
            $('#active_slide .video_slide .flashcontent').flash({
                    swf:'/assets/swf/detail_player.swf',
                    width:'705',
                    height:'396',
                    params:{wmode:'transparent'},
                    data:'/assets/swf/detail_player.swf',
                    flashvars: { flvPath:indirizzo_video,
                                 imgPath: $('#active_slide img').attr('src')}
            });
        } else {
            return 0;
        }
    }
        
    var ripetitore = function(nd) {
        dh = get_slide_height(nd);
        load_slide(attiva, nd);
        attiva.show();
        attiva.css({height:dh});
        primo_piano.css({height:dh});
    }
    
    var get_slide_height = function(nd) {
        // Da riattivare quando verranno usati i video...
        // return (!controllo_video(nd)) ? immagini[nd].height : 395;
        return immagini[nd].height;
    }
    
    var load_slide = function(container, numero_diapositiva) {
        output = html_diapositiva(numero_diapositiva)
        container.html(output);
    }
    
    var html_diapositiva = function(nd) {
        return $(immagini[nd]).parent().html();
    }
    
    var ottieni_diapositiva = function(nd) {
        return $(immagini[nd]).parent().html();
    }
    
    return { init:init }
}
