<?php
ini_set("SMTP","129.200.9.1");
ini_set("smtp_port",25);
ini_set("sendmail_from","seu@viladecans.cat");
$para      = 'vicentefj@viladecans.cat';
$mensaje   = 'Hola';
$cabeceras = 'From: webmaster@example.com';
mail($para, $titulo, $mensaje, $cabeceras);
<?