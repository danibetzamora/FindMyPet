<?php

include('config.php');
if (isset($_POST['Registrarme'])) {
$nombre = $_POST['fnombre'];
$apellidos = $_POST['fape'];
$email = $_POST['fcorreo'];
$dir = $_POST['fdir'];
$fecha = $_POST['ffecha'];
$con = $_POST['fcon'];
$con_hash = SHA1($con);
$fecha_act= date('Y-m-d H:i:s'); 
$q="SELECT * FROM usuario WHERE email='$email'";
$r = mysqli_query ($connection, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection)); 
if (mysqli_num_rows($r)> 0) {
echo '<p class="error">The email address is already registered!</p>';
 }
 if (mysqli_num_rows($r)== 0) {
     $q="INSERT INTO usuario(id,email,fecha_nacimiento,fecha_registro,contrasena,ubicacion,activo,rol,nombre,apellidos) VALUES (null,'$email','$fecha','$fecha_act','$con_hash','$dir',0,1,'$nombre','$apellidos')";  
     $r = mysqli_query ($connection, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection)); 

     if ($r) {
         //echo '<p class="success">Your registration was successful!</p>';
     } else {
         //echo '<p class="error">Something went wrong!</p>';
     }
 }
}

?>
    <head>
        <meta charset="utf-8" />
        <title>Registro</title>
    </head>
    <body style="overflow:hidden;height: 100%;width: 100%;margin: 0%;padding: 0%;">
        <div id ="main-container" style="height: 100%;width: 100%;margin: 0%;padding: 0%;display:flex;">
            <div id ="principal" style="width: 50%; min-height: 100vh;background-color: #FCDA68;">
            
            </div>
            <div id = "formulario"  style="background-color: #ffffff;width: 50%;  min-height: 100vh;  ">
                <div style="text-align: center;">
                    <h2 style="font-family: helvetica;">Te damos la bienvenida a nuestro portal</h2>
                </div>
                <div id = "form" style = "height:85%;display:flex;font-family: helvetica;font-size: 13px;">
                    <form method ="POST" action="" style="margin:auto; ">
                        <label for="fnombre">Nombre:</label><br>
                        <input style = "margin-top:1%;margin-bottom: 5%;border:none;border-radius:2px;background-color:EFEFEF;width:350px;padding:6px;outline:none;" type="text" id="fnombre" name="fnombre" placeholder="Introduzca su nombre"><br>
                        <label for="fape">Apellidos:</label><br>
                        <input style = "margin-top:1%;margin-bottom: 5%;border:none;border-radius:2px;background-color:EFEFEF;width:350px;padding:6px;outline:none;" type="text" id="fape" name="fape" placeholder="Introduzca sus apellidos"><br>
                        <label for="fcorreo">Correo:</label><br>
                        <input style = "margin-top:1%;margin-bottom: 5%;border:none;border-radius:2px;background-color:EFEFEF;width:350px;padding:6px;outline:none;" type="text" id="fcorreo" name="fcorreo" placeholder="Introduzca su correo"><br>
                        <label for="fdir">Dirección:</label><br>
                        <input style = "margin-top:1%;margin-bottom: 5%;border:none;border-radius:2px;background-color:EFEFEF;width:350px;padding:6px;outline:none;" type="text" id="fdir" name="fdir" placeholder="Introduzca su dirección"><br>
                        <label for="ffecha">Fecha de nacimiento:</label><br>
                        <input style = "margin-top:1%;margin-bottom: 5%;border:none;border-radius:2px;background-color:EFEFEF;width:350px;padding:4px;font-family:helvetica;outline:none;color: grey;" type="date" id="ffecha" name="ffecha" placeholder="dd/mm/aaaa"><br>
                        <label for="fcon">Contraseña:</label><br>
                        <input style = "margin-top:1%;margin-bottom: 5%;border:none;border-radius:2px;background-color:EFEFEF;width:350px;padding:6px;outline:none;" type="password" id="fcon" name="fcon" placeholder="Introduzca su contraseña"><br>
                        <label for="fcon2">Repita su contraseña:</label><br>
                        <input style = "margin-top:1%;margin-bottom: 10%;border:none;border-radius:2px;background-color:EFEFEF;width:350px;padding:6px;outline:none;" type="password" id="fcon2" name="fcon2" placeholder="Introduzca su contraseña de nuevo"><br>
                        <div style="text-align: center;">
                            <button style = "margin-bottom: 5%;border:none;border-radius:15px;width: 175px;background-color: #FCDA68;padding: 6px;color: #ffffff;font-family: helvetica;font-size: 14px;" name="Registrarme" type="submit" value="Registrarme">Register</button>
                        </div>
                      </form> 
                </div>
            </div>
        </div>
        

    </body>


