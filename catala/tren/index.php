<!DOCTYPE html> 
<html> 
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Horaris tren</title>
		<link rel="shortcut icon" href="../../favicon.ico">
		<link rel="stylesheet"  href="../../css/jquery.mobile.min.css">
		<link rel="stylesheet"  href="../../themes/viladecans.css">
		<link rel="stylesheet"  href="../../css/ajv.css">
		<link rel="stylesheet" href="../../css/jquery.mobile.datepicker.css" />
		<script src="../../js/jquery.js"></script>
		<script src="../../js/jquery.mobile.min.js"></script>
		<script src="../../js/jquery.ui.datepicker.js"></script>
		<script id="mobile-datepicker" src="../../js/jquery.mobile.datepicker.js"></script>

		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-37591053-2', 'guia.viladecans.cat');
		ga('send', 'pageview');
		</script>
		<script>
		$(function() {
	     
		//Array para dar formato en català
		$.datepicker.regional['es'] =
		{
		closeText: 'Tancar',
		prevText: 'Previ',
		nextText: 'Pròxim',
	   
		monthNames: ['Gener','Febrer','Març','Abril','Maig','Juny','Juliol','Agost','Setembre','Octubre','Novembre','Decembre'],
		monthNamesShort: ['Gen','Feb','Mar','Abr','Mai','Jun','Jul','Ago','Sep','Oct','Nov','Dec'],
		monthStatus: 'Veure un altre mes', yearStatus: 'Veure un altre any',
		dayNames: ['Diumenge','Dilluns','Dimarts','Dimecres','Dijous','Divendres','Dissabte'],
		dayNamesShort: ['Dg','Dl','Dm','Dc','Dj','Dv','Ds'],
		dayNamesMin: ['Dg','Dl','Dm','Dc','Dj','Dv','Ds'],
		dateFormat: 'yymmdd', firstDay: 1,
		initStatus: 'Seleccioni la data', isRTL: false};
		$.datepicker.setDefaults($.datepicker.regional['es']);
	  
		//miDate: fecha de comienzo D=días | M=mes | Y=año
		//maxDate: fecha tope D=días | M=mes | Y=año
	    $( "#datepicker" ).datepicker({ minDate: "-1D", maxDate: "+1M +10D" });
		});
		</script>
	</head>
	<body> 
		<div data-role="page">
		
		<div data-role="header">
			<a href="javascript:history.back(1)" data-icon="back">Tornar</a>
				<h1>Horaris tren</h1>
		</div>
		<img src="../../images/rodalies400.png" width="100%">
		<div data-role="content">
			<p align="justify">Si us plau seleccioni el seu destí, la data i l'horari des de l'estació de Viladecans.</p>
		
		<div>
			<form action="./trenform.php" data-ajax="false">
				
				<label for="destino" class="select"><b>Estació de destí:</b></label> 
					<select name="destino" id="destino" data-native-menu="false">					
						<option selected value="?">-Seleccioni Estació-</option>
						<option value='79009'>Barcelona-El Clot-Aragó</option>
						<option value='79400'>Barcelona-Estació de França</option>
						<option value='71802'>Barcelona-Passeig de Gràcia</option>
						<option value='71801'>Barcelona-Sants</option>
						<option value='71708'>Bellvitge</option>
						<option value='71601'>Calafell</option>
						<option value='71705'>Castelldefels</option>
						<option value='71604'>Cubelles</option>
						<option value='71603'>Cunit</option>
						<option value='71707'>El Prat de Llobregat</option>
						<option value='71703'>Garraf</option>
						<option value='71706'>Gavà</option>
						<option value='71704'>Platja de Castelldefels</option>
						<option value='71600'>Sant Vicenç de Calders</option>
						<option value='71602'>Segur de Calafell</option>
						<option value='71701'>Sitges</option>
						<option value='71700'>Vilanova i la Geltrú</option>
					</select>
					
			
				<label for="fecha"><b>Data:</b></label>
				<input id="fecha" name="fecha" type="text" data-role="date">
			
				<label for="Entre" class="select"><p align="center"><b>Seleccioni Hora sortida:</b></p></label>
					<SELECT name="Entre" id="Entre">
						<OPTION selected value="00">- Totes -</OPTION>
						<OPTION value="05">05.00</OPTION>
						<OPTION value="06">06.00</OPTION>
						<OPTION value="07">07.00</OPTION>
						<OPTION value="08">08.00</OPTION>
						<OPTION value="09">09.00</OPTION>
						<OPTION value="10">10.00</OPTION>
						<OPTION value="11">11.00</OPTION>
						<OPTION value="12">12.00</OPTION>
						<OPTION value="13">13.00</OPTION>
						<OPTION value="14">14.00</OPTION>
						<OPTION value="15">15.00</OPTION>
						<OPTION value="16">16.00</OPTION>
						<OPTION value="17">17.00</OPTION>
						<OPTION value="18">18.00</OPTION>
						<OPTION value="19">19.00</OPTION>
						<OPTION value="20">20.00</OPTION>
						<OPTION value="21">21.00</OPTION>
						<OPTION value="22">22.00</OPTION>
						<OPTION value="23">23.00</OPTION>
					</SELECT>
			<input type="submit" name="submit" value="enviar" data-ajax="false">
			</form>
			</div>
		<div> <!--content-->
	</div><!--page-->
</body>
</html>