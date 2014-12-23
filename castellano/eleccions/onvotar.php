<!DOCTYPE html> 
<html> 
<head>
	<meta charset="UTF-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-title" content="Seu electrònica">
	<title>Guia Viladecans</title>
	<link rel="shortcut icon" href="../../favicon.ico">
	<link rel="stylesheet"  href="../../css/jquery.mobile.min.css">
	<link rel="stylesheet"  href="../../themes/viladecans.css">
	<link rel="stylesheet"  href="../../css/ajv.css">
	<script src="../../js/jquery.js"></script>
	<script src="../../js/jquery.mobile.min.js"></script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-37591053-2', 'guia.viladecans.cat');
		ga('send', 'pageview');
	</script>
	<!--
	<style>
	.ui-page { background: #fceded;}
	</style>
	-->
</head>
<body> 
	<div data-role="page">
		
		<div data-role="header">
			<a href="javascript:history.back(1)" data-icon="back">Volver</a>
				<h1>Elecciones</h1>
		</div>
		<div align="center"><img src="../../images/elecciones.png"></div>
		 
		   
		<div data-role="content">
			
				<?php
				
				
					$link = mysql_connect("129.200.9.67","root","Vilade840");
					$parametre = mysql_query("SET NAMES 'utf8'",$link);
					$bbdd = mysql_select_db("guia",$link);

					$NIF = $_GET['NIF'];
					
					$sentenciaCens = "select CONCAT(guia.cens.DIST,guia.cens.SECC,guia.cens.MESA) votacio FROM guia.cens WHERE guia.cens.NIF='" . $NIF . "'";
					$qryCens = mysql_query($sentenciaCens,$link);
					
					while ($rowCens = mysql_fetch_array($qryCens))
					{
						$sentenciaColegi = "select guia.poi.nom colegi, guia.poi.adreca adreca, guia.poi.lat, guia.poi.lon, guia.poi.line4 from guia.poi where guia.poi.descripcio like '%" . $rowCens['votacio'] . "%'";
						$qryColegi = mysql_query($sentenciaColegi,$link);
						while ($rowColegi = mysql_fetch_array($qryColegi))
						{
							echo "Mesa:</BR><B>" . $rowCens['votacio'] . "</B></BR>";
							echo "Col.legi</BR><B>" . $rowColegi['colegi'] . "</B></BR>";
							echo "Adre&ccedil;a:</BR><B>" . $rowColegi['adreca'] . "</B></BR>";
				?>
				
							<div data-role="navbar">
								<ul>
									<li><a href="tel:<?php echo $rowColegi['line4']; ?>" data-icon="phone">Llamar</a></li>
									<li><a href="http://guia.viladecans.cat/mapa.php?lat=<?php echo $rowColegi['lat']; ?>&long=<?php echo $rowColegi['lon']; ?>" data-ajax="false" data-icon="location">Ubicación</a> </li> 
								</ul>
							</div>
				<?php
						}
				?>		
				
				<?php
					}
				?>
				
				
				
				
					
	
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