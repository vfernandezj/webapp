<!DOCTYPE html> 
<html> 
<head> 
  <meta charset="UTF-8">	
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Farmacia de guardia</title>
	
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
<div data-role="page" id="home" data-theme="c">

			<div data-role="header">
				<a href="javascript:history.back(1)" data-icon="back">Tornar</a>
					<div align="right">
						<img " src="http://vilasig.viladecans.cat/guia/images/bannerblanc60.png" style="align:right" />
					</div>
				<!--<h1>Guia Viladecans</h1>-->
			</div>
			<div data-role="content">
		<p align="left"><img width="100%" src="../../images/fmgran.jpg"></p>	
		 
		 
		 
		   <?php			
								
				$link = mysql_connect("129.200.9.67","root","Vilade840");
				$parametre = mysql_query("SET NAMES 'utf8'",$link);
				$bbdd = mysql_select_db("guia",$link);

				
				$sentencia = "select guia.Guardia.Farmacia, guia.poi.title from guia.Guardia ";
				$sentencia = $sentencia . "inner join guia.poi on guia.poi.id = guia.Guardia.Farmacia ";
				$sentencia = $sentencia . "inner join guia.poi on guia.poi.id = guia.Guardia.Farmacia ";
				$sentencia = $sentencia . "where DATE_FORMAT(guia.Guardia.Data,'%Y') = DATE_FORMAT(CURDATE(),'%Y') ";
				$sentencia = $sentencia . "AND DATE_FORMAT(guia.Guardia.Data,'%c') = DATE_FORMAT(CURDATE(),'%c') ";
				$sentencia = $sentencia . "AND DATE_FORMAT(guia.Guardia.Data,'%e') = DATE_FORMAT(CURDATE(),'%e')";
				
				
				$qry = mysql_query($sentencia,$link);
				
				//$row = mysql_fetch_assoc($qry);			
				
				//mysql_close($link);
		   ?>
		 <table data-role="table" id="movie-table" class="ui-responsive table-stroke">
			<thead>
				<tr>
					<th></th>
				</tr>
			</thead>
			<tbody>
			
			<?php echo $sentencia; ?>
			<?php
			
			
				while($row = mysql_fetch_array($qry))
				{		
					$hora = date("H");
					$minuts = date("i");
					
					$horaInicial = $row['HoraInici'];
					$minutsInicial = $row['MinutsInici'];
					$horaFinal = $row['HoraFinal'];
					$minutsFinal = $row['MinutsFinal'];
					

			?>
				<tr>
					<td style="background-color:white"><font color="#5ac4ec">Hora: <?php echo $row['Hora']; ?></font></td>
					<td style="background-color:white" colspan="3"><font color="#5ac4ec"><b><?php echo $row['TitolActeCAT']; ?></font></b></td>
				</tr>
				<tr>
					<td><?php echo $row['DuradaActe']." min"; ?></td>
					<td colspan="3">Nom de la companyia</td>
				</tr>


			<?php
				}	
			?>
			</tbody>
		</table>	
	

		
			
	
	

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