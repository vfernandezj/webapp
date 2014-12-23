<!DOCTYPE html> 
<html> 
<head>
	<meta charset="UTF-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-title" content="Guia Viladecans">
	<title>Farmàcies</title>
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
	<style>
	.ui-page { background: #fceded;}
	</style>
</head>
<body> 
	<div data-role="page">
		
		<div data-role="header">
			<a href="javascript:history.back(1)" data-icon="back">Tornar</a>
				<h1>Farmàcies</h1>
		</div>
			
		 
		   <?php
				
				
				$link = mysql_connect("129.200.9.67","root","Vilade840");
				$parametre = mysql_query("SET NAMES 'utf8'",$link);
				$bbdd = mysql_select_db("guia",$link);

				$sentencia = "select guia.poi.*,guia.action.uri from guia.poi inner join guia.action on guia.poi.id=guia.action.poiid where guia.poi.tipus='a' and guia.action.label='Telefon'";
				
				$qry = mysql_query($sentencia,$link);
				
		   ?>
		<div data-role="content">
			<div><img src="../../images/farmaciaguardia.png" width="100%" / ></div>
				
				<?php 
					
					$sentenciaGuardia = "select guia.poi.mapaGoogle, guia.poi.adreca, guia.Guardia.Farmacia, guia.poi.title, guia.poi.line2, guia.action.uri from guia.Guardia ";
					$sentenciaGuardia = $sentenciaGuardia . "inner join guia.poi on guia.poi.id = guia.Guardia.Farmacia ";
					$sentenciaGuardia = $sentenciaGuardia . "inner join guia.action on guia.action.poiId = guia.poi.id ";
					$sentenciaGuardia = $sentenciaGuardia . "where DATE_FORMAT(guia.Guardia.Data,'%Y') = DATE_FORMAT(CURDATE(),'%Y') ";
					$sentenciaGuardia = $sentenciaGuardia . "AND DATE_FORMAT(guia.Guardia.Data,'%c') = DATE_FORMAT(CURDATE(),'%c') ";
					$sentenciaGuardia = $sentenciaGuardia . "AND DATE_FORMAT(guia.Guardia.Data,'%e') = DATE_FORMAT(CURDATE(),'%e')";
					$qryGuardia = mysql_query($sentenciaGuardia,$link);
					
						while($rowGuardia = mysql_fetch_array($qryGuardia))
						{	
							
				?>
					
					<p><font><b><?php echo $rowGuardia['line2']; ?></b></font></p>
					<p><font><?php echo $rowGuardia['adreca']; ?></font></p>
					<!--<div id="contact_buttons">-->
					<div data-role="navbar">
						<ul>
							<li><a href="<?php echo $rowGuardia['uri']; ?>"  data-icon="phone">Trucar</a></li>
							<li><a href="<?php echo $rowGuardia['mapaGoogle']; ?>" data-icon="location">Ubicació</a></li> 	
						</ul>
					</div>	
					<?php
						}
					?>
					
			<!--</div>-->
			<hr/>
			<div data-role="collapsible" data-theme="c" data-collapsed-icon="arrow-r" data-expanded-icon="arrow-d">
				<h4>Llistat Farm&agrave;cies</h4>
				<ul data-role="listview" data-inset="true" data-filter="true">
					<?php 
						while($row = mysql_fetch_array($qry))
							{	
								$web="http://vilasig.viladecans.cat/guia/catala/farmacies/farmacia.php?idFarmacia=" .$row['id'];
					?>
							
					<div data-role="collapsible" data-theme="c" data-content-theme="d" data-collapsed-icon="arrow-r" data-expanded-icon="arrow-d">
						<h4><?php echo $row['nom']; ?></h4>
						<p><font><b><?php echo $row['adreca']; ?></b></font></p>
						<div data-role="navbar">
							<ul>
								<li><a href="<?php echo $row['uri']; ?>" data-icon="phone">Trucar</a></li>
								<li><a href="<?php echo $row['mapaGoogle']; ?>" data-icon="location">Ubicació</a> </li>
							</ul>
						</div>

					</div>
							
					<?php
						}
					?>
				</ul>
			</div><!-- /collapsible -->
	
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