<?php
$servidor = "localhost";
$usuario = "root"; 
$contrasenha = ""; 
$BD = "findmypet"; 

$connection = mysqli_connect($servidor, $usuario, $contrasenha,$BD,3308); 
 
if (!$connection) { 
    die('<strong>No pudo conectarse:</strong> ' . mysql_error());
}else{ 
   
} 
mysqli_select_db($connection,$BD) or die(mysqli_error($connection)); 



?>
