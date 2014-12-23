<!DOCTYPE html> 
<html> 
	<head>
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Temps bus</title>
	<link rel="shortcut icon" href="../../favicon.ico">
	<link rel="stylesheet"  href="../../css/jquery.mobile.min.css">
	<link rel="stylesheet"  href="../../themes/viladecans.css">
	<link rel="stylesheet"  href="../../css/ajv.css">
	<script src="../../js/jquery.js"></script>
	<script src="../../js/jquery.mobile.min.js"></script>
	<script>
	#table{
		-webkit-border-radius: 0px;
		-moz-border-radius: 0px;
		border-radius: 0px;
		}
	</script>
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
<table id="table" bgcolor="#000000">
	<tr>
		<td align="left"/><a href="javascript:history.back(1)"><img src="../../images/back.png"width="30px"></a></td>
		<td align="center"/><font color="white"><h4>Bicibox</h4></font></td>
		<td align="right"/><img src="../../images/escudoajv_noletras.png" width="30px"></td>
	</tr>
</table>
	<div data-role="content">
<?php
$nomestacio = $_GET['nom'];
$data = file_get_contents("http://www.bicibox.cat/DesktopModules/BiciboxSVC/Bicibox.svc/station/list");
//$data = utf8_encode($data);
$dades = json_decode($data, true);
			
    foreach ($dades['stations'] as $row) {
			
			if ($nomestacio == $row['nom']){
			$lat = $row['lat'];
			$long = $row['long'];
			$idestacio = $row['id'];
?>
		<table id="table" class="ui-responsive table-stroke">
			<tr>
				<td><b>Nom:</b></td>
				<td><?php echo $row['nom'];?></td>
			</tr>
				<td><b>Adreça:</b></td>
				<td><?php echo $row['direccio']; ?></td>
			</tr>
			<tr>
				<td bgcolor="#00CC00"><span style="color:white">Buits:</span></td>
		
				<td align="center" bgcolor="#00CC00"><span style="color:white"><?php echo $row['buits']; ?></span></td>
			</tr>

			</tr>
				<td bgcolor="#FE0002"><span style="color:white">Ocupats:</span></td>

				<td align="center" bgcolor="#FE0002"><span style="color:white"><?php echo $row['plens']; ?></span></td>
			</tr>
		</table>

<?php			
			}
		}
?>
		<img src="../../images/Bicibox/<?php echo $idestacio;?>.jpg" width="100%">
		<div data-role="footer" data-position="fixed">
			<div data-role="navbar">
	           	<ul>
					<li><a href="../../mapa.php?lat=<?php echo $lat; ?>&long=<?php echo $long; ?>" data-icon="location" data-ajax="false" />Com arribar</a></li>
				</ul>
	    	</div>
		</div>
	</div><!--content-->
</div><!--page-->
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