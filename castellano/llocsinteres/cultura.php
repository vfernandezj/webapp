<!DOCTYPE html> 
<html> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
</head>
 
<body> 
	<div data-role="page">
		
		<div data-role="header">
			<a href="javascript:history.back(1)" data-icon="back">Volver</a>
				<h1>Cultura</h1>
		</div>
		<div data-role="content">				
				<?php
					$cultura = $_GET['idCultura'];
					
					$link = mysql_connect("129.200.9.67","root","Vilade840");
					$parametre = mysql_query("SET NAMES 'utf8'",$link);
					$bbdd = mysql_select_db("guia",$link);
					
					
					
					$sentencia = "select guia.poi.*,action1.uri web, action2.uri email, action3.uri telefon, guia.poi.lat lat, guia.poi.lon lon ";
					$sentencia = $sentencia . "from guia.poi ";
					$sentencia = $sentencia . "inner join guia.action action1 on guia.poi.id=action1.poiId ";
					$sentencia = $sentencia . "inner join guia.action action2 on guia.poi.id=action2.poiId ";
					$sentencia = $sentencia . "inner join guia.action action3 on guia.poi.id=action3.poiId ";
					$sentencia = $sentencia . "where action1.label='Web' and action2.label='email' and action3.label='telefon' and guia.poi.id=" .$cultura;
	
					//$sentencia = "select * from guia.poi inner join guia.action on guia.poi.id=guia.action.poiId where guia.poi.id=" .$cultura;
					$qry = mysql_query($sentencia,$link);
					$rowCultura = mysql_fetch_assoc($qry);
				
					
				
				?>
				
				<h3><?php echo $rowCultura['nom']; ?></h3>
				<p align="center"><img width="100%" src="<?php echo $rowCultura['imageWebURL']; ?>" /></p>
				<p align="justify"><?php echo $rowCultura['DescripcioCAST']; ?></p>					
				
				<div>	
					<p>Estamos en <?php echo $rowCultura['adreca']; ?></p>
						
				</div>
			
				<div data-role="navbar">
	            	<ul>
						<li><a href="<?php echo $rowCultura['web']; ?>" class='ui-btn-active' data-icon="home">Web</a></li>
						<li><a href="<?php echo $rowCultura['telefon']; ?>"  data-icon="phone">Telf</a></li>
						<li><a href="<?php echo $rowCultura['email']; ?>"  data-icon="mail">Mail</a></li>
						<li><a href="../../mapa.php?lat=<?php echo $rowCultura['lat']; ?>&long=<?php echo $rowCultura['lon']; ?> " data-icon="location" data-ajax="false" />Donde</a></li>
					</ul>
	       		 </div>

		</div> <!-- Fi content	-->



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