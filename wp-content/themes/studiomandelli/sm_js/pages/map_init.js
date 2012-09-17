 ;(function ($,exports) { 
     var map;
     
  function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer();
    var roma = new google.maps.LatLng(45.5147, 9.3312);
    var mapOptions = {
      zoom: 19,
      scrollwheel:false,
      mapTypeId: google.maps.MapTypeId.SATELLITE,
      center: roma
    }
    
    
    map = new google.maps.Map(document.getElementById("mappaitin"), mapOptions);
  }
  /*Dimensioni infowindow*/
  var infowindow = new google.maps.InfoWindow({
     size: new google.maps.Size(150, 50)
  });
$(document).ready(function(){ 
    initialize();
  	});
})(jQuery,window);