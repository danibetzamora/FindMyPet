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
<head>
    <meta charset="utf-8" />
    <title>Registro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
</head>
<body style="overflow:hidden;height: 100%;width: 100%;margin: 0%;padding: 0%;">
    <div id ="main-container" style="height: 100%;width: 100%;margin: 0%;padding: 0%;display:flex;">
        <div id ="principal" style="width: 50%; min-height: 100vh;background-color: #FCDA68;display: flex;justify-content: center;flex-direction: column;">
            <div style="height:50%;">
                <div style="width: 100% ;height:50%;display: flex;justify-content: center;"><img style="max-width:50%" src="imagenes/FindMyPet.svg"></div>
                <div style="width: 60%;margin:auto;"><h3 style="font-family:Inter;color: #ffffff;text-align: center;">Ayuda a nuestros mas fieles compañeros a estar de vuelta con sus adorados dueños</h3></div>
            </div>
            <div style="width: 100% ;height:50%;display: flex;justify-content: center;margin-bottom: 0px;"><img style="max-width:80%" src="imagenes/perrosPortada.svg"></div>
        </div>
        <div id = "formulario"  style="background-color: #ffffff;width: 50%;  min-height: 100vh;  ">
            <div style="text-align: center;">
                <h3 style="font-family: 'Inter';color: #2D2B40">Te damos la bienvenida a nuestro portal</h3>
                <p style="font-family: Inter;font-weight:500;font-size: 13px;color: #2D2B40">Regístrese a la plataforma preferida de perros y gatos del mundo. </p>
            </div>
            <div id = "form" style = "height:80%;display:flex;font-family:'Inter';font-size: 13px;">
                <form method ="POST" action="" style="margin:auto; ">
                    <label for="fnombre">Nombre:</label><br>
                    <input required minlength="3" autocomplete="new-text" style = "font-size: 12px;font-family:'Inter';margin-top:1%;margin-bottom: 4%;border:none;border-radius:2px;background-color:EFEFEF;width:320px;padding:6px;outline:none;" type="text" id="fnombre" name="fnombre" placeholder="Introduzca su nombre"><br>
                    <label for="fape">Apellidos:</label><br>
                    <input required minlength="3" autocomplete="new-text" style = "font-size: 12px;font-family:'Inter';margin-top:1%;margin-bottom: 4%;border:none;border-radius:2px;background-color:EFEFEF;width:320px;padding:6px;outline:none;" type="text" id="fape" name="fape" placeholder="Introduzca sus apellidos"><br>
                    <label for="fcorreo">Correo:</label><br>
                    <input required minlength="8" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" autocomplete="new-text" style = "font-size: 12px;font-family:'Inter';margin-top:1%;margin-bottom: 4%;border:none;border-radius:2px;background-color:EFEFEF;width:320px;padding:6px;outline:none;" type="text" id="fcorreo" name="fcorreo" placeholder="Introduzca su correo"><br>
                    <label for="fdir">Dirección:</label><br>
                    <input required minlength="8" autocomplete="new-text" style = "font-size: 12px;font-family:'Inter';margin-top:1%;margin-bottom: 4%;border:none;border-radius:2px;background-color:EFEFEF;width:320px;padding:6px;outline:none;" type="text" id="fdir" name="fdir" placeholder="Introduzca su dirección"><br>
                    <label for="ffecha">Fecha de nacimiento:</label><br>
                    <input autocomplete="new-text" style = "font-size: 12px;font-family:'Inter';margin-top:1%;margin-bottom: 4%;border:none;border-radius:2px;background-color:EFEFEF;width:320px;padding:4px;font-family:'Inter';outline:none;color: grey;" type="date" id="ffecha" name="ffecha" placeholder="dd/mm/aaaa"><br>
                    <label for="fcon">Contraseña:</label><br>
                    <input pattern ="[0-9]+[A-Z]" required minlength="8"  alt="alphanumeric"  alt="strongPass" required autocomplete="new-password" style = "font-size: 12px;font-family:'Inter';margin-top:1%;margin-bottom: 10%;border:none;border-radius:2px;background-color:EFEFEF;width:320px;padding:6px;outline:none;" type="password" id="fcon" name="fcon" placeholder="Incluya una mayuscula y un número"><br>
                    <div style="text-align: center;">
                        <button style = "margin-bottom: 5%;border:none;border-radius:15px;width: 175px;background-color: #FCDA68;padding: 6px;color: #ffffff;font-family: 'Inter';font-size: 14px;" name="Registrarme" type="submit" value="Registrarme">Register</button><br>
                        <a href="login.php"><button style = "margin-bottom: 5%;border:solid 1px;border-radius:15px;border-color:#FCDA68;width: 175px;background-color: #ffffff;padding: 6px;color: #2D2B40;font-family: 'Inter';font-size: 13px;" name="Logear" type="submit" value="Iniciar sesión">Iniciar sesión</button></a>
                    </div>
                  </form> 
            </div>
        </div>
    </div>
    

</body>

