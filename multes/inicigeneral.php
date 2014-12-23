<?php
	session_start();
?>
<!doctype html>
<html>
  <head>
		<meta charset='UTF-8'>
		<title>Gestió de multes</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
		<style>
			html, body, #map-canvas {
				width: 100%;
				height: 150px;
				margin: 0px;
				padding: 0px
			}
		</style>
<script>
	var map;
	function initialize() {
			var mapOptions = {
				zoom: 17,
				zoomControl: false,
				scaleControl: false,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map(document.getElementById('map-canvas'),
			mapOptions);

			// Probamos la geolocalización HTML5
			if(navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(
					function(position) {
						var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
						//Cambiamos el market por defecto y añadimos una marca
						var image = new google.maps.MarkerImage(
							'http://guia.viladecans.cat/images/gpsloc.png',
							null, // size
							null, // origin
							new google.maps.Point( 8, 8 ), // Ancla (Coloca al centro el marcador)
							new google.maps.Size( 17, 17 ) // Tamaño escalado (Requerido para icono de pantalla Retina)
						);
						var marker = new google.maps.Marker({
							map: map,
							flat: true,
							position: pos,
							map: map,
							icon: image,
							title: "mapa",
							visible: true
						});
		
						map.setCenter(pos);
					}, function() {
						handleNoGeolocation(true);
					});
				} else {
				// El navegador no soporta la geolocalización
				handleNoGeolocation(false);
				}
					
		}

	function handleNoGeolocation(errorFlag) {
			if (errorFlag) {
				var content = 'Error: El servicio de geolocalización ha fallado.';
			} else {
			var content = 'Error: Su navegador no soporta geolocalización.';
			}

			var options = {
				map: map,
				position: new google.maps.LatLng(60, 105),
				content: content
			};
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);
    </script>

     <script type="text/javascript">
 
      function fileSelected() {
 
        var count = document.getElementById('fileToUpload').files.length;
 
              document.getElementById('details').innerHTML = "";
 
              for (var index = 0; index < count; index ++)
 
              {
 
                     var file = document.getElementById('fileToUpload').files[index];
 
                     var fileSize = 0;
 
                     if (file.size > 1024 * 1024)
 
                            fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
 
                     else
 
                            fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
 
                     document.getElementById('details').innerHTML += 'Name: ' + file.name + '<br>Size: ' + fileSize + '<br>Type: ' + file.type;
 
                     document.getElementById('details').innerHTML += '<p>';
 
              }
 
      }
 
      function uploadFile() {
 
        var fd = new FormData();
 
              var count = document.getElementById('fileToUpload').files.length;
 
              for (var index = 0; index < count; index ++)
 
              {
 
                     var file = document.getElementById('fileToUpload').files[index];
 
                     fd.append('myFile', file);
 
              }
 
        var xhr = new XMLHttpRequest();
 
        xhr.upload.addEventListener("progress", uploadProgress, false);
 
        xhr.addEventListener("load", uploadComplete, false);
 
        xhr.addEventListener("error", uploadFailed, false);
 
        xhr.addEventListener("abort", uploadCanceled, false);
 
        xhr.open("POST", "savetofile.php");
 
        xhr.send(fd);
 
      }
 
      function uploadProgress(evt) {
 
        if (evt.lengthComputable) {
 
          var percentComplete = Math.round(evt.loaded * 100 / evt.total);
 
          document.getElementById('progress').innerHTML = percentComplete.toString() + '%';
 
        }
 
        else {
 
          document.getElementById('progress').innerHTML = 'unable to compute';
 
        }
 
      }
 
      function uploadComplete(evt) {
 
        /* This event is raised when the server send back a response */
 
        alert(evt.target.responseText);
 
      }
 
      function uploadFailed(evt) {
 
        alert("Error provant de enviar el fitxer.");
 
      }
 
      function uploadCanceled(evt) {
 
        alert("El enviament ha sigut cancel·lat per l'usuari o el navegador ha desestimat la conexió.");
 
      }
 
    </script>  
  </head>
   <body>
			<div data-role="header">
				<h1>Sancions</h1>
				<a href="#nav-panel" data-icon="bars" data-iconpos="notext">Menu</a>
			</div><!-- /header -->
	
				<div data-role="content">
					<p>Sistema de recollida d'infraccions de trànsit</p>
					<p><b>Ubicació</b></p>
					<div id="map-canvas"></div>

					<div>
						<form action="./ldap.php" method="POST">
							<fieldset>
								<p><b>Dades bàsiques de la infracció</b></p>
								<label><b>Agent:</b></label>
								<input type="text" value="<?php echo $_SESSION['Variable']; ?>" />								
								<label><b>Vía/Carrer:</b></label>
								<input type="text" /> 
								<label ><b>KM/Num:</b></label>
								<input type="text" />
								<label ><b>Data:</b></label>
								<input type="text" value='<?php echo "" . date("d/m/Y"); ?>'/>
								<label ><b>Hora:</b></label>
								<input type="text" value='<?php date_default_timezone_set("Europe/Madrid"); echo "" . date("h:i:sa"); ?>' />
								<label ><b>Matrícula:</b></label>
								<input type="text" />
								<label ><b>Marca:</b></label>
								<input type="text" />
								<label ><b>Model:</b></label>
								<input type="text" />
								<label for="qualificacio" class="select">Qualificació infracció</label>
								<select name="qualificacio" id="qualificacio">
									<option value="Lleu">Lleu</option>
									<option value="Greu">Greu</option>
									<option value="Moltgreu">Molt greu</option>
								</select>
								<label ><b>Normativa infringida:</b></label>
								<input type="text" />
								<label ><b>Responsable infracció:</b></label>
								<input type="text" />
								<label for="slider">Punts a treure:</label>
								<input name="slider" id="slider" value="0" min="0" max="16" type="range">
								<label ><b>Fet constitutiu:</b></label>
								<textarea cols="40" rows="8" name="textarea" id="textarea"></textarea>
								<div class="ui-field-contain">
									<label for="fileToUpload">Fer foto des de la càmera o seleccionar foto des de arxiu</label><br />
									<input type="file" name="fileToUpload" id="fileToUpload" onchange="fileSelected();" accept="image/*" capture="camera" />
								</div>
								<input type="submit" name="submit" value="Enviar" />
							</fieldset>
						</form>
					</div>
	
				</div>

	</body>
	

</HTML>
