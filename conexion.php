<?php

$host ="127.0.0.1";
$dbname ="mi-sitio";
$username ="root";
$password ="";

try{
   //funcion conexion B.D.
   $conexion = new PDO ("mysql:host=$host;dbname=$dbname;chatset=utf8", $username, $password);
   

   $conexion -> setAttribute(PDO:: ATTR_)


} catch{
    
}

?>