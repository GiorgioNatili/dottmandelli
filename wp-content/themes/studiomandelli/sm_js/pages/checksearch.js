;(function ($,exports) {
	$(document).ready(function(){
$("#searchsubmit").click(function(){
        
        var hasError = false;
        
        var searchVal = $("#s").val();
        if(searchVal == '' || searchVal == 'Cerca') {
            hasError = true;
        } 

        if(hasError == true) {return false;}
    });
})
})(jQuery,window);