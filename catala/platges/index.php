<!DOCTYPE html> 
<html> 
<head> 
  <meta charset="UTF-8">	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-title" content="Guia Viladecans">
	<title>Estat platges Viladecans</title>
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
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-37591053-2', 'guia.viladecans.cat');
		ga('send', 'pageview');
	</script>
	
</head> 
<body> 
<div data-role="page" id="home" data-theme="a">

			<div data-role="header">
			
				<a href="javascript:history.back(1)" data-icon="back">Tornar</a>
				<div align="right">
				
				</div>
				<h1>Platges</h1>
			</div>
			<div data-role="content">
				<p align="justify">En temporada de bany aneu a platges vigilades, consulteu els rètols informatius i localitzeu el personal de vigilància. És molt important que consulteu l'estat de la bandera abans de ficar-vos a l'aigua. </p>
			
			<ul data-role="listview" data-inset="true" >
				<li><a href="./platges.php" data-transition="slide" data-ajax="false">Estat platges Viladecans</a></li>
				<li><a href="./mapaplatges.php" data-transition="slide" data-ajax="false"><font style="white-space:normal;">Mapa i estat platges de l'entorn</font></a></li>
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