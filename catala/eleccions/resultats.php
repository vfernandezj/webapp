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
				<h1>Resultats</h1>
		</div>
		<div align="center"><img src="../../images/elecciones.png"></div>	
	
			
		<div data-role="content">
			<?php	
				
				$server = '129.200.9.40\VIDALA';
				$uid = 'ecom';
				$pwd = 'Vilade840';
				$connectionInfo = array ("UID" => $uid, "PWD" => $pwd, "Database" => "ecomicios1");
				
				$conn = sqlsrv_connect($server, $connectionInfo);
					if ($conn == false)
						{
						echo "Unable to connect.</br>";
						die( print_r( sqlsrv_errors(), true));
						}
			
				$tsqlResultats = "SELECT ecom.JORNADA.FECHA, ecom.MESA.INECODIGO, ecom.CANDIDATURA.NOMBRE, ecom.RESULTADOMESA.NUMVOTOS, LEFT(ecom.MESA.INECODIGO, 2) AS Districte";
				$tsqlResultats = $tsqlResultats . "FROM ecom.JORNADA";
				$tsqlResultats = $tsqlResultats . "INNER JOIN ecom.MESA ON ecom.JORNADA.DBOID = ecom.MESA.JORNADA_ID";
				$tsqlResultats = $tsqlResultats . "INNER JOIN ecom.RESULTADOMESA ON ecom.MESA.DBOID = ecom.RESULTADOMESA.MESA_ID";
				$tsqlResultats = $tsqlResultats . "INNER JOIN ecom.CANDIDATURA ON ecom.RESULTADOMESA.CANDIDATURA_ID = ecom.CANDIDATURA.DBOID";
				$tsqlResultats = $tsqlResultats . "WHERE (ecom.JORNADA.FECHA = CONVERT(DATETIME, '2012-11-25 00:00:00', 102))";

				$stmtServei = sqlsrv_query($conn, $tsqlServei);
                    if ($stmtServei == false)
                        {
                           die( print_r(sqlsrv_errors(),true));
                         }
			?>
			
			<div>
				<table data-role="table" id="table-column-toggle" data-mode="columntoggle" class="ui-responsive table-stroke">
					<thead>
						<tr>
							<th data-priority="2">Partit</th>
							<th>Taula</th>
							<th>Resultat</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th></th>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>

		</div><!-- /content -->

	</div><!-- /page -->

</body>
</html>