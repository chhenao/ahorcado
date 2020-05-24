<!DOCTYPE html>
<html >
<head>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ahorcado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  
  
    <!-- <link rel="stylesheet"   type="text/css" href="debug.css">    -->
     
    <script src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  
</head>
<body>   

<?php
require 'config.php';

/** Devuelve un título al azar del fichero pelis.txt
 * 
 * @return type string
 */
function elegirtitulo($fichero){
	
	if(!file_exists($fichero)) 
		die('No existe el fichero de peliculas: '.$fichero);
	
	$pelis=file($fichero);
	$ix=array_rand($pelis);
	return strtoupper(trim($pelis[$ix])); //La pasa a mayúsculas y le quita el salto de linea final
}

/**
 * Empieza el juego: Elige pelicula y pone contadores a 0
 */
function empezar($idioma='ES'){
	$fichero='pelis/'.$idioma.'.txt';

	$_SESSION['idioma']=$idioma;
	$_SESSION['peli']=elegirtitulo($fichero);
	$_SESSION['letrasjugadas']=array();
	$_SESSION['fallos']=0;
}
/** Comprueba si una letra ya se ha jugado
 * 
 * @param type $letra
 * @return type boolean true si ya se ha jugado
 */
function yajugada($letra){
	return in_array($letra,$_SESSION['letrasjugadas']);
}
/** Juega una letra y actualiza el estado del juego
 * 
 * @param type $letra
 * @return int  
 * 1=Ya se habia jugado esa letra
 * 2=No está en la película
 * 3=Letra incorrecta
 * 9=No está, y se ha terminado el juego por superar el máximo de jugadas
 * 0=Letra acertada!
 * -1=Película acertada! Fin de juego
 */
function jugar($letra){
	if(!$letra) return 3; //Incorrecta
	if(yajugada($letra)) return 1; //Repetida
	
	$_SESSION['letrasjugadas'][]=$letra;
	if(stripos($_SESSION['peli'],$letra)===false) {
		$_SESSION['fallos']++;
		if($_SESSION['fallos']<8)
			return 2; // No está
		else
			return 9; // Fin de juego por máximo de jugadas
	} else {
		for($i=0;$i<strlen($_SESSION['peli']);$i++){
			$letra=$_SESSION['peli'][$i];
			if($letra!=' ' && !yajugada($letra)) //Todavía quedan
					return 0; //Todavía quedan
		}
		return -1;  //Fin de juego. Adivinida!
	}
}

/** Convierte string en array de caracteres
 * Equivale a str_split pero funciona con utf-8  (resuelve problemas con la Ñ, Ç ..etc)
 * 
 * @param type $string
 * @return type
 */
function mbstr_split ($string) { 
    $strlen = mb_strlen($string); 
    while ($strlen) { 
        $array[] = mb_substr($string,0,1,"UTF-8"); 
        $string = mb_substr($string,1,$strlen,"UTF-8"); 
        $strlen = mb_strlen($string); 
    } 
    return $array; 
} ?>

</body>
</html>