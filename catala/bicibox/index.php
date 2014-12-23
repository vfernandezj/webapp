<!DOCTYPE html> 
<html> 
	<head>
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bicibox</title>
	<link rel="shortcut icon" href="../../favicon.ico">
	<link rel="stylesheet"  href="../../css/jquery.mobile.min.css">
	<link rel="stylesheet"  href="../../themes/viladecans.css">
	<link rel="stylesheet"  href="../../css/ajv.css">
	<script src="../../js/jquery.js"></script>
	<script src="../../js/jquery.mobile.min.js"></script>
	<script>
		$('a').buttonMarkup({ corners: false });
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
<table id="movie-table" class="ui-responsive table-stroke" bgcolor="#000000">
	<tr>
		<td align="left"/><a href="javascript:history.back(1)"><img src="../../images/back.png"width="30px"></a></td>
		<td align="center"/><font color="white"><h4>Bicibox</h4></font></td>
		<td align="right"/><img src="../../images/escudoajv_noletras.png" width="30px"></td>
	</tr>
</table>
<div data-role="llistat">
<?php
//header('Content-Type: text/html; charset=UTF-8'); 
$data = file_get_contents("http://www.bicibox.cat/DesktopModules/BiciboxSVC/Bicibox.svc/station/list");
//$data = utf8_encode($data);
$dades = json_decode($data, true);

?>
		<ul data-role="listview" data-inset="true">
<?php
	foreach ($dades['result'] as $row1) {
			$hora = $row1;
				
			}
?>

<?php			
    foreach ($dades['stations'] as $row) {
			
			if ('Viladecans' == $row['municipi']){
?>
			<li ><a href="./fitxabici.php?nom=<?php echo $row['nom'];?>"><?php echo $row['nom'];?><span class="ui-li-count"><?php echo 'Buits:&nbsp;'.$row['buits'];?></span></li>
			</a></li>	
<?php				
				}
			
			}

?>
		</ul>
	</div><!--content-->
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