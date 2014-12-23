<!DOCTYPE html> 
<html> 
<head>
	<meta charset="UTF-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-title" content="Seu electrÃ²nica">
	<title>Parada bus</title>
	<link rel="shortcut icon" href="favicon.ico">
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
	<style>
	.ui-page { background: white;}
	</style>
</head>

<body>

<div data-role="page">
		<div><img src="../../images/escudoajv_verde.png" width="100%" / ></div>
		<div data-role="header">
			<a href="javascript:history.back(1)" data-icon="back">Tornar</a>
				<h1>Parada</h1>
		</div>
			
			<div data-role="content">
						
				<?php
					$parada = $_GET['idParadaBus'];
					
					$link = mysql_connect("129.200.9.67","root","Vilade840");
					$parametre = mysql_query("SET NAMES 'utf8'",$link);
					$bbdd = mysql_select_db("guia",$link);
					
					

					$sentencia = "select guia.poi.*,guia.action.uri web, guia.poi.lat lat, guia.poi.lon lon, guia.poi.nom nom ";
					$sentencia = $sentencia . "from guia.poi ";
					$sentencia = $sentencia . "inner join guia.action on guia.poi.id=guia.action.poiId ";
					$sentencia = $sentencia . "where guia.poi.id=" .$parada;
				
			
					$qry = mysql_query($sentencia,$link);
					$rowParada = mysql_fetch_assoc($qry);
				
					
				
				?>
				<img class="article" src="./paradabus.png" height="85px">
				<h3 style="color:#007755" align="justify"><b>Num parada&nbsp;<?php echo $rowParada['nom']; ?></b></h3>
				<p align="justify"><b><?php echo $rowParada['adreca']; ?></b></p>
				
				<table style="width: 100%;" border="0" align="center">
					<tbody>
						<tr>
							<td style="background-color: #007755; text-align: center;"><font style="color:white">Línies que tenen parada</font></td>
						</tr>
						<tr>
							<td align="center"><font style="color:#007755;"><b><?php echo $rowParada['line3']; ?></b></font></td>
						</tr>
						<tr>
						
						</tr>
					</tbody>
		</table>
	
				<p></p>
				
			
				<div data-role="navbar">
	            	<ul>
						<!--<li><a href="<?php echo $rowParada['web']; ?>" class='ui-btn-active' data-icon="info">Próxim bus</a></li>-->
						<li><a href="./tempsbus.php?codi=?<?php echo $rowParada['nom']; ?>" class='ui-btn-active' data-ajax="false" data-icon="info">Próxim bus</a></li>

						<li><a href="../../mapa.php?lat=<?php echo $rowParada['lat']; ?>&long=<?php echo $rowParada['lon']; ?> " data-icon="location" data-ajax="false" />Ubicació</a></li>					
					</ul>
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