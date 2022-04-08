<script>
    function borrarBoton(){
        document.getElementById("ba").style.display="none";
    }
    function borrarBotonCon(){
        document.getElementById("bc").style.display="none";
    }
</script>
<?php

include('config.php');
if (isset($_POST['Registrarme'])) {
    
$nombre = $_POST['fnombre'];
$apellidos = $_POST['fape'];
$email = $_POST['fcorreo'];
$dir = $_POST['fdir'];
$fecha = $_POST['ffecha'];
$con = $_POST['fcon'];
$con2 = $_POST['fconn'];
$con_hash = SHA1($con);
$fecha_act= date('Y-m-d H:i:s'); 
$q="SELECT * FROM usuario WHERE email='$email'";
if ($con != $con2){
    echo '<div id ="bc" style ="width:30vw;height:18vh;background-color:#FFFFFF;border-radius:6px;border:solid 1.5px #E5E5E5;text-align:center;display:flex;flex-direction:column;justify-content:center;position:fixed;bottom:5vh;right:10vw;"><p style="font-family:Inter;color:#2D2B40;font-size: 1.2vw" class="error">Las contraseñas no coinciden</p><br><div><button style="width:13vw;padding:0.3vw;font-family:Inter;color:#2D2B40;font-size: 0.8vw;background-color:#FCDA68;#FCDA68;border-radius:12px;border:none;color:#ffffff" onclick= "borrarBotonCon()" >Intentar de nuevo</button></div></div>';
}else {
    $r = mysqli_query ($connection, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection)); 
if (mysqli_num_rows($r)> 0) {
    echo '<div id ="ba" style ="width:30vw;height:18vh;background-color:#FFFFFF;border-radius:6px;border:solid 1.5px #E5E5E5;text-align:center;display:flex;flex-direction:column;justify-content:center;position:fixed;bottom:5vh;right:10vw;"><p style="font-family:Inter;color:#2D2B40;font-size: 1.2vw" class="error">Ese correo ya esta siendo utilizado </p><br><div><button style="width:13vw;padding:0.3vw;font-family:Inter;color:#2D2B40;font-size: 0.8vw;background-color:#FCDA68;#FCDA68;border-radius:12px;border:none;color:#ffffff" onclick= "borrarBoton()" >Intentar de nuevo</button></div></div>';
 }
 if (mysqli_num_rows($r)== 0) {
     $q="INSERT INTO usuario(id,email,fecha_nacimiento,fecha_registro,contrasena,ubicacion,foto,activo,rol,nombre,apellidos) VALUES (null,'$email','$fecha','$fecha_act','$con_hash','$dir','imagenes/fotoPerfilGenerica.png',0,1,'$nombre','$apellidos')";  
     $r = mysqli_query ($connection, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection)); 

     if ($r) {
        header("Location:login.php");
     } else {
         //echo '<p class="error">Something went wrong!</p>';
     }
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
    <link href="estilos/registro.css" rel="stylesheet">
</head>
<body>
    <div id ="main-container" >
        <div id ="principal" >
            <div id = "titulo">
                <div id="huella1" ><img  style = "width:50%" src ="imagenes/huella.png"></div>
                <div id="huella2" ><img  style = "width:50%" src ="imagenes/huella.png"></div>
                <div id="huella3" ><img  style = "width:50%" src ="imagenes/huella.png"></div>
                <div id="huella4" ><img  style = "width:50%" src ="imagenes/huella.png"></div>
                <div  id="contenedor-foto-titulo"><img src="imagenes/FindMyPet.svg"></div>
                <div id = "contenedor-texto-titulo"><h3 >Ayuda a nuestros mas fieles compañeros a estar de vuelta con sus adorados dueños</h3></div>
            </div>
            <div id="contenedor-foto"><img  id ="foto-animales" src="imagenes/perrosPortada.svg"></div>
        </div>
        <div id = "formulario">
            <div  id= "cabecera-formulario">
                <p>Regístrese a la plataforma preferida de perros y gatos del mundo</p>
            </div>
            <div id = "form">
                <form method ="POST" action="" >
                    <label for="fnombre">Nombre:</label><br>
                    <input class ="campo" required minlength="3" autocomplete="new-text" type="text" id="fnombre" name="fnombre" placeholder="Introduzca su nombre"><br>
                    <label for="fape">Apellidos:</label><br>
                    <input class ="campo" required minlength="3" autocomplete="new-text" type="text" id="fape" name="fape" placeholder="Introduzca sus apellidos"><br>
                    <label for="fcorreo">Correo:</label><br>
                    <input class = "campo" required minlength="8" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" autocomplete="new-text" type="text" id="fcorreo" name="fcorreo" placeholder="Introduzca su correo"><br>
                    <label for="fdir">Dirección:</label><br>
                    <input class = "campo" required minlength="8" autocomplete="new-text" type="text" id="fdir" name="fdir" placeholder="Introduzca su dirección"><br>
                    <label for="ffecha">Fecha de nacimiento:</label><br>
                    <input id ="campo-date" autocomplete="new-text" type="date" id="ffecha" name="ffecha" placeholder="dd/mm/aaaa"><br>
                    <label for="fcon">Contraseña:</label><br>
                    <input class="campo" pattern ="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required minlength="8"  required autocomplete="new-password" type="password" id="fcon" name="fcon" placeholder="Incluya una mayuscula y un número"><br>
                    <label for="fconn">Contraseña:</label><br>
                    <input class="campo" pattern ="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required minlength="8"  required autocomplete="new-password"  type="password" id="fconn" name="fconn" placeholder="Repita la contraseña"><br>
                    <div style="text-align: center;">
                        <button id="boton-registro" name="Registrarme" type="submit" value="Registrarme">Registrarme</button><br>
                        <a href="login.php"><button id="boton-login"  name="Logear" type="button" value="Iniciar sesión">Iniciar sesión</button></a>
                    </div>
                  </form> 
            </div>
        </div>
    </div>
    

</body>

