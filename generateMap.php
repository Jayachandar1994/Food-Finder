<?php

function generateMap($addressCityLatsAndLongs, $title) {
    $page = <<<EOPAGE
    	
    	<p id="demo"></p>
    	<div id="map" style="width: 1000px; height: 720px;"></div>

    	<script type="text/javascript">

			var x = document.getElementById("demo");
			var latitude = 99.9018;
			var longitude = 41.4925; 

		    var locations = [
		    	$addressCityLatsAndLongs
		    ];

			function initMap() {

			    var map = new google.maps.Map(document.getElementById('map'), {
			      zoom: 6,
			      center: new google.maps.LatLng(latitude, longitude),
			      mapTypeId: google.maps.MapTypeId.ROADMAP
			    });

			    if (navigator.geolocation) {
			    	navigator.geolocation.getCurrentPosition(function(position){
			    		initialLocation=new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			    		map.setCenter(initialLocation);
			    	});
			    }

			    var infowindow = new google.maps.InfoWindow();

			    var marker, i;

			    for (i = 0; i < locations.length; i++) {  
			      marker = new google.maps.Marker({
			        position: new google.maps.LatLng(locations[i][2], locations[i][3]),
			        map: map
			   		});
			    
			    if( locations[i][4] != null ) {
			    	setMarker(locations[i][4], marker);
			    }

		        google.maps.event.addListener(marker, 'click', (function(marker, i) {
		          return function() {
		            infowindow.setContent(locations[i][4] + "<br>" + locations[i][0] + "<br>" + locations[i][1]);
		            infowindow.open(map, marker);
		          }
		        })(marker, i));
		    	}
		    }
  		</script>

  		<script type="text/javascript" src="setMarker.js"> </script>

  		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJy1nYrVK8hM-E_A40HahHo3LeABngIrY&callback=initMap" type="text/javascript"></script>
  		
EOPAGE;

    return $page;
}
?>