<?php
 
/* update your path accordingly */
include_once '../../simplehtmldom/simple_html_dom.php';
 
$url = "http://www.google.com";
 
$html = file_get_html($url);
 
$ret =  $html->find('li[id=horari0]');
 
foreach($ret as $story)
	echo $html;

    
 
?>