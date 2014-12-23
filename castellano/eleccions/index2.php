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


	
	
	
	
</head>
<body> 
	<div data-role="page">
		
		<div data-role="header">
			<a href="javascript:history.back(1)" data-icon="back">Tornar</a>
				<h1>Eleccions</h1>
		</div>
		<div align="center"><img src="../../images/elecciones.png"></div>	
		 
		   
		<div data-role="content">

				<h3>Consulta col.legi electoral</h3>
				<form action="./index2.php">
					<input type="text" name="NIF" pattern="^[0-9]{8}[a-zA-Z]{1}$" placeHolder="Escrigui el seu NIF" title="Format de NIF incorrecte">
					<!-- <input type="hidden" name="mostrar" value="1">-->
					<input type="submit" name="btn" value="enviar" >
					<?php
					
						$url = substr($_SERVER["REQUEST_URI"],-3);
						if ($url != 'php')
						{
								$NIF = $_GET['NIF'];
								
								$link = mysql_connect("129.200.9.67","root","Vilade840");
								$parametre = mysql_query("SET NAMES 'utf8'",$link);
								$bbdd = mysql_select_db("guia",$link);
								
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
										<iframe width="100%" height="250px" frameborder="0" src="https://maps.google.com/maps?q=<?php echo $rowColegi['lat']; ?>,<?php echo $rowColegi['lon']; ?>&amp;num=1&amp;ie=UTF8&amp;t=m&amp;z=16&amp;ll=<?php echo $rowColegi['lat']; ?>,<?php echo $rowColegi['lon']; ?>&amp;output=embed"></iframe>
										<p></p>
										<!-- <div data-role="navbar">
											<ul>
												<li><a href="tel:<?php echo $rowColegi['line4']; ?>" data-icon="phone">Trucar</a></li>
												<li><a href="http://guia.viladecans.cat/mapa.php?lat=<?php echo $rowColegi['lat']; ?>&long=<?php echo $rowColegi['lon']; ?>" data-icon="location">Ubicació</a> </li> 
											</ul>
										</div>-->
					<?php
									}
								}		
						}
					?>

					</div>
				</form>
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