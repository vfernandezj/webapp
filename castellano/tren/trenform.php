<!DOCTYPE html> 
<html> 
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Horarios tren Viladecans</title>
	<link rel="shortcut icon" href="../../favicon.ico">
	<link rel="stylesheet"  href="../../css/jquery.mobile.min.css">
	<link rel="stylesheet"  href="../../themes/viladecans.css">
	<link rel="stylesheet"  href="../../css/ajv.css">
	<link rel="stylesheet" href="../../css/jquery.mobile.datepicker.css" />
	<script src="../../js/jquery.js"></script>
	<script src="../../js/jquery.mobile.min.js"></script>
	<script src="../../js/jquery.ui.datepicker.js"></script>
    <script id="mobile-datepicker" src="../../js/jquery.mobile.datepicker.js"></script>
	<style>
	th{
		border-bottom: 1px solid #d6d6d6;
	}

	tr:nth-child(even){
		background:#e9e9e9;
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
		<div data-role="page">
		
			<div data-role="header">
				<a href="javascript:history.back(1)" data-icon="back">Volver</a>
				<h1>Horarios tren</h1>
			</div>
			<img src="../../images/rodalies400.png" width="100%">
			<div data-role="content">
			<?php
				
				$desti = $_GET['destino'];
				$data = $_GET['fecha'];
				$hora = $_GET['Entre'];
		
				/* update your path accordingly */
				include_once '../../simplehtmldom/simple_html_dom.php';
				$url = "http://horarios.renfe.com/cer/hjcer310.jsp?&nucleo=50&o=71709&d=" . $desti. "&tc=DIA&td=D&df=" . $data. "&th=1&ho=" . $hora. "&i=s&cp=NO&TXTInfo=";
				
				$html = file_get_html($url);
			?>
				<table class="ui-shadow">
					<thead>
						
						<th align="left">Salidas</th>
						<th align="left">Llegadas</th>
						<th align="left">Duración viaje</th>
					</thead>
					<tbody>
						<tr>
			<?php	
				$celdas = 0;

				foreach($html->find('.color1, .color2') as $story)
				{
					echo '<td>' . $story->plaintext . '</td>' ;
	
					$celdas = $celdas + 1;
					if ($celdas == 3)
					{
						echo "</tr>";
						echo "<tr>";

						$celdas = 0;
						
					}
				}
				
			?>
				</tr>
				</table>
			</div><!--fi content-->
		</div><!--fi page-->
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