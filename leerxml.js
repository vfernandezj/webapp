// JavaScript Document
// Nombre del archivo: leerxml.js

$(document).ready(function(){//se empieza a ejecutar cuando el DOM esté listo

$.get("http://web.tursos.com/feed/",{},function(xml){ //Abrimos el archivo noticias.xml

//El ciclo se va repetir cada vez que se encuentre la etiqueta noticia
$('noticia',xml).each(function() {
etiqueta=$(this).children();//obtenemos el elemento hijo de noticia que se corresponde
// con el nombre de la clase en el código HTML (en este caso primera, segunda, tercera, etc...
etiqueta=etiqueta[0].nodeName.toLowerCase();//y conseguimos su nombre (nodeName) en minúsculas (toLowerCase)
titulo = $(this).find('titulo').text(); //buscamos el valor que contiene la etiqueta titulo y lo guardamos en la variable titulo
texto = $(this).find('texto').text(); //lo mismo con texto

//Llama a la función que retorna el título y texto que vamos a insertar en el DIV
datos = crearNoticiaHtml(titulo,texto);
$('.'+etiqueta).append(datos);//insertamos el titulo y el texto en el DIV correspondiente 
// (añadimos un punto antes del nombre de la etiqueta porque es una clase)
}); //final de leer cada etiqueta noticia
}); //fin de $.get
});//fin de document ready

function crearNoticiaHtml(titulo,texto){

// Construimos el string 'noticiaHTML' que contiene el titulo y el texto y lo retornamos
noticiaHTML = ' '; //inicializamos la variable
noticiaHTML += '<h4>'+ titulo + '</h4>';//le agregamos el título con formato
noticiaHTML += texto;//y el texto
return noticiaHTML;//y lo retornamos
}
//con esto la noticia etiquetada en el xml como <primera> quedará insertada 
//en el div con class=primera, la etiquetada como <segunda> en el div con la clase .segunda 
//y así sucesivamente