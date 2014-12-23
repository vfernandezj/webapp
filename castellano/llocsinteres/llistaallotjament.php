<!DOCTYPE html> 
<html> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Guia Viladecans</title>
	<link rel="shortcut icon" href="./../../favicon.ico">
	<link rel="stylesheet"  href="./../../css/jquery.mobile.min.css">
	<link rel="stylesheet"  href="./../../themes/viladecans.css">
	<link rel="stylesheet"  href="./../../css/ajv.css">
	<script src="./../../js/jquery.js"></script>
	<script src="./../../js/jquery.mobile.min.js"></script>
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
		<!--<img width="100%" align="center" src="./../../images/fotos/cabecerarest.png">-->
		<div data-role="header">
			<a href="javascript:history.back(1)" data-icon="back">Volver</a>
				<h1>Alojamiento</h1>
		</div>
	
			<div data-role="content">
				<div class="choice_list"> 
					<ul data-role="listview" data-inset="true" data-filter="false"  >
						
						<li><a href=./llistahotels.php data-ajax="false"><img src="./../../images/poi/turismehotel75.png" ><h3>Hoteles</h3></a></li>	
						<li><a href=./llistapensions.php data-ajax="false""><img src="./../../images/poi/turismepensio75.png" ><h3>Pensiones y<br/>apartamentos</h3></a></li>		
					</ul>	
				</div>	
			
			
			</div><!--content-->

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