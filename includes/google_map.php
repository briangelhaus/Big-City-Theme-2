<?php if(is_page('contact')): ?>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJjebtTKWcmwAPiMqG9ZpaQr5sqINgYxU"></script>
<script type="text/javascript">
    // When the window has finished loading create our google map below
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
	    var latitude = 39.103118;
	    var longitude = -84.512020;
        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions = {
            zoom: 10,
            scrollwheel: false,
            mapTypeControl: false,

            // The latitude and longitude to center the map (always required)
            center: new google.maps.LatLng(latitude, longitude),

            // This is where you would paste any style found on Snazzy Maps.
            // https://snazzymaps.com/
            //styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}]
        };

        // Get the HTML DOM element that will contain your map
        // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('map');

        // Create the Google Map using our element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);

        // add a popup
        var contentString = 'Title';
        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

        // add a marker
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(latitude, longitude),
            map: map,
            title: 'Title'
        });

		// show popup
		infowindow.open(map, marker);

        window.addEventListener("resize", function(){
	        map.setCenter(new google.maps.LatLng(latitude, longitude));
        })
    }
</script>

<?php endif; ?>