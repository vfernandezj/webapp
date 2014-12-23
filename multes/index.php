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
  </head>
    <body>
		<div data-role="page">

			<p align="center"><img src="./images/escut_ajv.png"/><br/><b>Gestió de multes</b></p>
			<div data-role="content">
				<form action="./ldap.php" method="POST">
					<fieldset>
					<label for="username"><b>Usuari:</b></label>
					<input id="username" type="text" name="username" /> 
					<label for="password"><b>Contrasenya:</b></label>
					<input id="password" type="password" name="password" />
					<input type="submit" name="submit" value="Submit" />
					</fieldset>
				</form>
			<?php
				if (!(empty($_GET['error'])))
				{
						$error = $_GET['error'];
										if ($error == 1 ){
					echo '<h3><span style="color:#FF0000";>No hi ha conexió amb el servidor</span></h3>';
				} else if ($error == 2 ){
					echo '<h3><span style="color:#FF0000";>Contrasenya incorrecta</span></h3>';
				} else if ($error == 3 ){
					echo '<h3><span style="color:#FF0000";>Aquest usuari no existeix</span></h3>';
				}
				}
				
				
				

				
			?>
			</div>
		</div>


	</body>
</html>
