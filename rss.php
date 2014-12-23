<?php
include('class.php');//archivo donde este el class
$rss = new RssReader ("http://www.viladecans.cat/noticies.rss");//aqui donde esta http://dedydamy.com/feed  tienes que poner la url de tu feed o rss
foreach ($rss->get_items () as $item){ //aca hacemos un foreach para el array de las entradas que se muestren en el feed
echo($item->get_title()."<br />");//escribimos titulo
echo($item->get_url()."<br />");///url del post
echo($item->get_description()."<br />");//descripcion o lo principal del post
echo("<hr><br />");
}
?> 