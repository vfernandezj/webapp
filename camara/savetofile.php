<?php


if (isset($_FILES['myFile'])) {
    // Example:
    move_uploaded_file($_FILES['myFile']['tmp_name'], "c:/wamp/www/guia/camara/" . $_FILES['myFile']['name']);
	
    echo 'Se ha enviat la seva foto';
}
?>