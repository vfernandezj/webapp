<!DOCTYPE html> 
<html> 
<head> 
	<meta charset="UTF-8">	
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Guia de Viladecans</title>
	
	<link rel="stylesheet" href="../../jqm132/jquery.mobile.theme-1.3.2.css">
	<link rel="stylesheet" href="../../jqm132/jquery.mobile.structure-1.3.2.min.css" />
	<link rel="stylesheet" href="../../jqm132/jquery.mobile-1.3.2.css">
	<link rel="stylesheet" href="../../jqm132/ajv.css">
	<link rel="stylesheet" href="../../jqm132/jqm-icon-pack-2.0-original.css">
	<script src="../../jqm132/jquery-1.8.2.min.js"></script>
	<script src="../../jqm132/jquery.mobile-1.2.0.min.js"></script>
	
	<!--<link rel="stylesheet" href="../../jquery.mobile.theme-1.3.1.css">
	<link rel="stylesheet" href="../../jquery.mobile.structure-1.3.1.css">
	<link rel="stylesheet" href="../../jquery.mobile-1.3.1.css">
	<link rel="stylesheet" href="../../ajv.css">
	<link rel="stylesheet" href="../../jqm-icon-pack-2.0-original.css">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile.structure-1.2.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>-->

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
<div data-role="page" id="home" data-theme="c" data-position="fixed">
			<div data-role="header">
			
				<a href="javascript:history.back(1)" data-icon="back">Tornar</a>
				<div align="right">
				<img " src="http://vilasig.viladecans.cat/guia/images/bannerblanc60.png" style="align:right" />
				</div>
				
			</div>
	
			<div data-role="content">
						
				<?php
					$Farmacia = $_GET['idFarmacia'];
					
					$link = mysql_connect("129.200.9.67","root","Vilade840");
					$parametre = mysql_query("SET NAMES 'utf8'",$link);
					$bbdd = mysql_select_db("guia",$link);
					
					
					
					$sentencia = "select guia.poi.*, action3.uri telefon ";
					$sentencia = $sentencia . "from guia.poi ";
					$sentencia = $sentencia . "inner join guia.action action3 on guia.poi.id=action3.poiId ";
					$sentencia = $sentencia . "where action3.label='telefon' and guia.poi.id=" .$Farmacia;
	
					//$sentencia = "select * from guia.poi inner join guia.action on guia.poi.id=guia.action.poiId where guia.poi.id=" .$Farmacia;
					$qry = mysql_query($sentencia,$link);
					$rowFarmacia = mysql_fetch_assoc($qry);
				
					
				
				?>
				
				<h2><?php echo $rowFarmacia['title']; ?></h2>
				<p align="center"><img src="<?php echo $rowFarmacia['imageWebURL']; ?>" /></p>
				<p align="justify"><?php echo $rowFarmacia['Descripcio']; ?></p>					
				
				<div>	
					<p>Estem a <?php echo $rowFarmacia['line2']; ?></p>
						
				</div>
				<div id="contact_buttons">
					<!--<a href="<?php echo $rowFarmacia['web']; ?>" rel="external" data-role="button" data-icon="link">P&agrave;gina web</a>-->
					<!--<a href="http://maps.google.es/maps?q=cal+mingo&hl=es&ll=41.323604,2.031012&spn=0.01178,0.01929&fb=1&gl=es&hq=cal+mingo&hnear=0x12a49cef3b1b21c3:0xb3863a6db796d9e5,Viladecans&cid=0,0,12396936664961027078&t=m&z=16" data-role="button" data-icon="mappin">Cerca a Google Maps </a> -->	
					<a href="<?php echo $rowFarmacia['telefon']; ?>"  data-role="button" data-icon="phone">Tel&egrave;fon</a>
					<!--<a href="<?php echo $rowFarmacia['email']; ?>"  data-role="button" data-icon="email">e-mail</a>-->
				</div>	
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