<!DOCTYPE html> 
<html> 
<head>
	<meta charset="UTF-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-title" content="Seu electrònica">
	<title>Parades bus</title>
	<link rel="shortcut icon" href="../favicon.ico">
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
	@media all and (max-width: 35em) {
	.my-breakpoint .ui-block-a,
	.my-breakpoint .ui-block-b,
	.my-breakpoint .ui-block-c,
	.my-breakpoint .ui-block-d,
	.my-breakpoint .ui-block-e {
	width: 100%;
	float:none;
	}
	}
	.imgcapt{
		font-size:large;
		color:#ffffff;
		margin-top:-30px;
		margin-left: 10px;
		}
	.ui-grid-solo img {
		float: center;
		width : 97%;
		margin : 5px;
		}
    .ui-grid-a img {
		float: center;
		width : 97%;
		margin : 5px;
		}
	img.displayed {
	display: block;
	margin-left: auto;
	margin-right: auto 
	}
	.ui-page { background: black;}

	</style>
</head>

<body>

<div data-role="page">
		<div data-role="header">
			<a href="javascript:history.back(1)" data-icon="back">Tornar</a>
				<h1>Parades Bus</h1>
		</div>
		<div><img src="../../images/escudoajv.png" width="100%" / ></div>
			   <?php
				
				$lat = $_GET['lat'];
				$lon = $_GET['lon'];
				
				$link = mysql_connect("129.200.9.67","root","Vilade840");
				$parametre = mysql_query("SET NAMES 'utf8'",$link);
				$bbdd = mysql_select_db("guia",$link);

				$sentencia = "select guia.poi.id, guia.poi.adreca, ";
				$sentencia = $sentencia . "FORMAT((acos(sin(radians(" . $lat . ")) * sin(radians(guia.poi.lat)) + cos(radians(";
				$sentencia = $sentencia . $lat . ")) * cos(radians(guia.poi.lat)) * ";
				$sentencia = $sentencia . "cos(radians(" . $lon .") - radians(guia.poi.lon))) * 6378),3) `distancia` ";				
				$sentencia = $sentencia . "from guia.poi ";
				$sentencia = $sentencia . "where (guia.poi.tipus='g') AND ";
				$sentencia = $sentencia . "(acos(sin(radians(" . $lat . ")) * sin(radians(guia.poi.lat)) + cos(radians(";
				$sentencia = $sentencia . $lat . ")) * cos(radians(guia.poi.lat)) * ";
				$sentencia = $sentencia . "cos(radians(" . $lon .") - radians(guia.poi.lon))) * 6378) < 8 ";
				$sentencia = $sentencia . "ORDER BY distancia ";
				
				
				
				$qry = mysql_query($sentencia,$link);
				
		   ?>
			
	

				<div class="choice_list"> 
	
					<ul data-role="listview" data-inset="true" data-filter="true"  >
					<?php 
						while($row = mysql_fetch_array($qry))
						{	
							$web="http://guia.viladecans.cat/catala/bus/parada.php?idParadaBus=" .$row['id'];
							
					?>
							
							<li><a href=<?php echo $web;?> data-ajax="false" ><h3><?php echo $row['adreca']; ?></h3><font color="#007755"><?php echo $row['distancia']; ?> Km</font></a></li>						
					<?php
						}
					?>
					</ul>	

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