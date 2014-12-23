<!DOCTYPE html> 
<html> 
<head> 
  <meta charset="UTF-8">	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-title" content="Guia Viladecans">
	<title>Playas Viladecans</title>
	<link rel="shortcut icon" href="../../favicon.ico">
	<link rel="stylesheet"  href="../../css/jquery.mobile.min.css">
	<link rel="stylesheet"  href="../../themes/viladecans.css">
	<link rel="stylesheet"  href="../../css/ajv.css">
	<script src="../../js/jquery.js"></script>
	<script src="../../js/jquery.mobile.min.js"></script>
	<script src="../../js/jquery.applink.js"></script>

	<script>
	
		function getLocation()
		{
		  if (navigator.geolocation)
    		  {
		    navigator.geolocation.getCurrentPosition(showPosition);
		  }
  		}

		function showPosition(position)
		{
		    var URL;
		    var distancia;

		    distancia = $("#slider").val(); 

		    adreca = "./escenarisgeo.php?lat=" + position.coords.latitude + "&lon=" + position.coords.longitude;
  		    window.location=adreca;	
			    
		}
	</script>
	<script>
	$(document).ready(function () {
    $('a[data-applink]').applink();
		});
	</script>
	<style>
	.ui-icon-face {
    background: url("../../images/facebook.png") no-repeat rgba(0, 0, 0, 0.4) !important;
		}
	</style>

	
</head> 
<body> 
<div data-role="page" id="home" data-theme="a">

			<div data-role="header">
			
				<a href="javascript:history.back(1)" data-icon="back">Volver</a>
				<div align="right">
				
				</div>
				<h1>Playas</h1>
			</div>
			<div data-role="content">
				<p align="justify">En temporada de baño vaya a playas vigiladas, consulte los rótulos informativos y localice el personal de vigilancia. Es muy importante que consulte el estado de la bandera antes de meteros en el agua.</p>
			<ul data-role="listview" data-inset="true" >
				<li><a href="./platges.php" data-transition="slide" data-ajax="false">Estado playas Viladecans</a></li>
				<li><a href="./mapaplatges.php" data-transition="slide" data-ajax="false"><font style="white-space:normal;">Mapa y estado playas del entorno</font></a></li>
			</ul>	
			
			</div><!--content-->
			
</div><!-- /page -->
<script type="text/javascript">
 $('[data-role=page]').on('pageshow', function (event, ui) {
  try {
    _gaq.push( ['_trackPageview', event.target.id] );
    console.log(event.target.id);
  } catch(err) {
  }
});
</script>
</body>
</html>