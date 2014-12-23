

<!DOCTYPE html>
<html>
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Guia Viladecans</title>
	<link rel="shortcut icon" href="./favicon.ico">
	<link rel="stylesheet"  href="./css/jquery.mobile.min.css">
	<link rel="stylesheet"  href="./themes/viladecans.css">
	<link rel="stylesheet"  href="./css/ajv.css">
	<script src="./js/jquery.js"></script>
	<script src="./js/jquery.mobile.min.js"></script>
    <style>
      html, body, #map-canvas {
		width: 100%;
        height: 400px;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=weather"></script>
    <script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
		function initialize() {

	<?php
		$latitud = $_GET['lat'];
		$longitud = $_GET['long'];
	?>
			var myLatlng = new google.maps.LatLng(<?php echo $latitud; ?>,<?php echo $longitud; ?>);
			var mapOptions = {
			zoom: 16,
			center: myLatlng
			}
			var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

			var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			title: ''
			});
}

google.maps.event.addDomListener(window, 'load', initialize);


    </script>
	<script>
			$(document).ready(function() {
			
			var startingLocation;
			var destination = "<?php echo $latitud; ?>,<?php echo $longitud; ?>"; // replace this with any destination
			
			$('a.get-directions').click(function (e) {
				e.preventDefault();				
				
				// check if browser supports geolocation
				if (navigator.geolocation) { 
					
					// get user's current position
					navigator.geolocation.getCurrentPosition(function (position) {   
						
						// get latitude and longitude
						var latitude = position.coords.latitude;
						var longitude = position.coords.longitude;
						startingLocation = latitude + "," + longitude;
						
						// send starting location and destination to goToGoogleMaps function
						goToGoogleMaps(startingLocation, destination);
						
					});
				}
				
				// fallback for browsers without geolocation
				else {
					
					// get manually entered postcode
					startingLocation = $('.manual-location').val();
					
					// if user has entered a starting location, send starting location and destination to goToGoogleMaps function
					if (startingLocation != '') {
						goToGoogleMaps(startingLocation, destination);
					}
					// else fade in the manual postcode field
					else {
						$('.no-geolocation').fadeIn();
					}
					
				}
								
				// go to Google Maps function - takes a starting location and destination and sends the query to Google Maps
				function goToGoogleMaps(startingLocation, destination) {
					window.location = "https://maps.google.co.uk/maps?saddr=" + startingLocation + "&daddr=" + destination;
				}
					
			});
			
		});
		</script>
  </head>
  <body>
		<div data-role="page" id="Inici">
			<div data-role="header" data-theme="a">
				<a href="javascript:history.back(1)" data-icon="back" data-theme="b" data-theme="b">Tornar</a>
				<h1>Mapa</h1>
				<a href="../directions.php?lat=<?php echo $latitud; ?>&long=<?php echo $longitud; ?> " data-icon="location" data-ajax="false" />Com arribar</a>
			</div>	
	
		
			<div id="map-canvas"></div>
				
		</div>

  </body>
</html>

