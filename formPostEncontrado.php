<?php

include('config.php');
if (isset($_POST['IniciarSesion'])) {
    

$email = $_POST['fcorreo'];

$con = $_POST['fcon'];
$con_hash = SHA1($con);

$q="SELECT * FROM usuario WHERE email='$email'";
$r = mysqli_query ($connection, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection)); 
if (mysqli_num_rows($r)> 0) {
//echo '<p class="error">The email address is already registered!</p>';
 }
 if (mysqli_num_rows($r)== 0) {
     $q="INSERT INTO usuario(id,email,fecha_nacimiento,fecha_registro,contrasena,ubicacion,activo,rol,nombre,apellidos) VALUES (null,'$email','$fecha','$fecha_act','$con_hash','$dir',0,1,'$nombre','$apellidos')";  
     $r = mysqli_query ($connection, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection)); 

     if ($r) {
        header("Location:login.php");
     } else {
         //echo '<p class="error">Something went wrong!</p>';
     }
 }
}

?>