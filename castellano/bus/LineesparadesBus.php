<!DOCTYPE html> 
<html> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-title" content="Seu electrònica">
	<title>Recorrido línea</title>
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
	

</head>

<body>

<div data-role="page">
		
		<div data-role="header">
			<a href="javascript:history.back(1)" data-icon="back">Volver</a>
				<h1>Paradas Bus</h1>
		</div>
		<div><img src="../../images/escudoajv_verde.png" width="100%" / ></div>
			   <?php
				
				$codiLinia = $_GET['codiLinia'];
				
				
				$link = mysql_connect("129.200.9.67","root","Vilade840");
				$parametre = mysql_query("SET NAMES 'utf8'",$link);
				$bbdd = mysql_select_db("guia",$link);

				$sentencia = "select guia.poi.id, guia.poi.nom, guia.poi.adreca ";			
				$sentencia = $sentencia . "from guia.poi ";
				$sentencia = $sentencia . "where (guia.poi.tipus='g') AND ";
				$sentencia = $sentencia . "(guia.poi.line3 LIKE '%" . $codiLinia . "%') order by guia.poi.nom";

				
				
				
				$qry = mysql_query($sentencia,$link);
				
		   ?>
				<div data-role="content">
				<h3 style="color:#007755" align="justify">Paradas de autob&uacute;s por donde pasa la l&iacute;nea <?php echo $codiLinia?></h3>
				<hr/>
				</div>
				<div class="choice_list"> 
	
					<ul data-role="listview" data-inset="true" data-filter="false"  >
					<?php 
						while($row = mysql_fetch_array($qry))
						{	
							$web="http://guia.viladecans.cat/catala/bus/parada.php?idParadaBus=" .$row['id'];
							
					?>
							
							<li><a href="<?php echo $web;?> "><h3 style="white-space:normal;">Parada:&nbsp;<?php echo $row['nom']; ?><br/><?php echo $row['adreca']; ?></h3></a></li>						
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