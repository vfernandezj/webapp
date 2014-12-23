<!doctype html>
<html>
   <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Guia Viladecans</title>
		<link rel="stylesheet"  href="./css/jquery.mobile.min.css">
		<link rel="stylesheet"  href="./themes/viladecans.css">
		<link rel="stylesheet"  href="./css/ajv.css">
		<script src="./js/jquery.js"></script>
		<script src="./js/jquery.mobile.min.js"></script>
        <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3&sensor=true&language=es"></script>
		<?php
		$latitud = $_GET['lat'];
		$longitud = $_GET['long'];
		echo "<SCRIPT> var latitud = " . $latitud . "; </SCRIPT>";
		echo "<SCRIPT> var longitud = " . $longitud . "; </SCRIPT>";
		?>
        <script type="text/javascript">
		

            var map,
                currentPosition,
                directionsDisplay, 
                directionsService;
            //    destinationLatitude = 59.3426606750,
            //    destinationLongitude = 18.0736160278;

            function initializeMapAndCalculateRoute(lat, lon)
            {
                directionsDisplay = new google.maps.DirectionsRenderer(); 
                directionsService = new google.maps.DirectionsService();

                currentPosition = new google.maps.LatLng(lat, lon);

                map = new google.maps.Map(document.getElementById('map_canvas'), {
                   zoom: 15,
                   center: currentPosition,
                   mapTypeId: google.maps.MapTypeId.ROADMAP
                 });

                directionsDisplay.setMap(map);

                 var currentPositionMarker = new google.maps.Marker({
                    position: currentPosition,
                    map: map,
                    title: "Current position"
                });

                // current position marker info
                /*
                var infowindow = new google.maps.InfoWindow();
                google.maps.event.addListener(currentPositionMarker, 'click', function() {
                    infowindow.setContent("Posici&oacute;n: latitud: " + lat +" longitud: " + lon);
                    infowindow.open(map, currentPositionMarker);
                });
                */

                // calculate Route
                calculateRoute();
            }

            function locError(error) {
               // the current position could not be located
            }

            function locSuccess(position) {
                // initialize map with current position and calculate the route
                initializeMapAndCalculateRoute(position.coords.latitude, position.coords.longitude);
            }

            function calculateRoute() {

                var targetDestination =  new google.maps.LatLng(latitud,longitud);
                if (currentPosition != '' && targetDestination != '') {

                    var request = {
                        origin: currentPosition, 
                        destination: targetDestination,
                        travelMode: google.maps.DirectionsTravelMode["WALKING"]
                    };

                    directionsService.route(request, function(response, status) {
                        if (status == google.maps.DirectionsStatus.OK) {
                            directionsDisplay.setPanel(document.getElementById("directions"));
                            directionsDisplay.setDirections(response); 

                            /*
                                var myRoute = response.routes[0].legs[0];
                                for (var i = 0; i < myRoute.steps.length; i++) {
                                    alert(myRoute.steps[i].instructions);
                                }
                            */
                            $("#results").show();
                        }
                        else {
                            $("#results").hide();
                        }
                    });
                }
                else {
                    $("#results").hide();
                }
            }

            $(document).live("pagebeforeshow", "#map_page", function() {
                // find current position and on success initialize map and calculate the route
                navigator.geolocation.getCurrentPosition(locSuccess, locError);
            });

        </script>
    </head>
    <body>
		<div data-role="page" id="Inici">
			
			<div data-role="header" data-theme="a">
				<a href="javascript:history.back(1)" data-icon="back" data-theme="b" data-theme="b">Tornar</a>
				<h1>Mapa</h1>
				
			</div>	
            <div data-role="content">   
               <!-- <div class="ui-bar-c ui-corner-all ui-shadow" style="padding:1em;">-->
                    <div id="map_canvas" style="height:350px;width:100%;"></div>
                <!--</div>-->
                <div id="results" style="display:none;">
                    <div id="directions"></div>
                </div>
            </div>
        </div>      
    </body>
</html>