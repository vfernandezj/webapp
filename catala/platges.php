<!DOCTYPE html> 
<html> 
<head> 
  <meta charset="UTF-8">	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-title" content="Guia Viladecans">
	<title>Platges Viladecans</title>
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
				<div><b>Estat de les platges de Viladecans</b></div>
			<?php
 
			/* update your path accordingly */
			include_once '../simplehtmldom/simple_html_dom.php';
 
			$url = "http://www.intranet.pro-activa.es/ca/mapa/23/Viladecans";
 
			$html = file_get_html($url);
				foreach($html->find('img') as $element)
				{
					$cadena = strstr($element->src, 'flag');
					if (!(empty($cadena)))
					{
						echo '<b>Bandera</b> <img src="' . $element->src . '" height=25>';
					}
				}
			?>
			<table class="ui-shadow">
			
			<?php

			$i=0;
			$j=0;
			$celdas = 0;
			foreach($html->find('.estilcelda-fil0' ) as $story)
				{	
					$arrayIzq[$i] = $story->plaintext;
					$i = $i + 1;
					
				}

			foreach($html->find('.estilcelda' ) as $story)
				{	
					if ((strlen($story->plaintext)) < 1)
					{
						$arrayDer[$j] = "";
					}
					else
					{
						$arrayDer[$j] = $story->plaintext;
					}
					$j = $j + 1;
					
				}
			
			$index = 1;
			while ($index < $i)
			{
			?>
			
				<tr>
					<td><?php echo $arrayIzq[$index]; ?></td>
					<td><?php echo $arrayDer[$index + 1]; ?></td>
				</tr>
			<?php
				$index = $index + 1;
			}
			
			?>
						
				</table>
			</div>



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