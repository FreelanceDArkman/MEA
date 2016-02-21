var ContactPage = function () {

    return {
        
    	//Basic Map
        initMap: function () {
			var map;
			$(document).ready(function(){
			  map = new GMaps({
				div: '#map',
				scrollwheel: false,				
				lat: 13.744586,
				lng: 100.543547
			  });
			  
			  var marker = map.addMarker({
				  lat: 13.744586,
				  lng: 100.543547,
	            title: 'Company, Inc.'
		       });
			});
        },

        //Panorama Map
        initPanorama: function () {
		    var panorama;
		    $(document).ready(function(){
		      panorama = GMaps.createPanorama({
		        el: '#panorama',
				  lat: 13.744586,
				  lng: 100.543547
		      });
		    });
		}        

    };
}();