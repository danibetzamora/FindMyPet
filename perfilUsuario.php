
<?php

include('api/config.php');
session_start();
if(!isset($_SESSION["user"])) header("Location: homeInvitado.php");
$user = $_SESSION["user"];
$idUsuario = $user['id'];
$fotoUsuario = $user["foto"];
$Umail=$user["email"];
$Ubicacion=$user["ubicacion"];
$Uapellidos=$user["apellidos"];
$Unacimiento=$user["fecha_nacimiento"];

$nombreUsuario = $user["nombre"];
if (isset($_POST['modificar'])) {
    $nombre = $_POST['fnombre'];
    $dir = $_POST['fdir'];
    $apellidos = $_POST['fape'];
    $fecha = $_POST['ffecha'];
    $email = $_POST['fcorreo'];
    $con = $_POST['fcon'];

    if($nombre != null){
    $q="UPDATE usuario SET nombre = '$nombre' WHERE id = '$idUsuario'"; 
    $r = mysqli_query ($connection, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection));
    }

    if($dir != null){
        $q="UPDATE usuario SET ubicacion = '$dir' WHERE id = '$idUsuario'"; 
        $r = mysqli_query ($connection, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection));
    }

    if($apellidos != null){
        $q="UPDATE usuario SET apellidos = '$apellidos' WHERE id = '$idUsuario'"; 
        $r = mysqli_query ($connection, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection));
    }
    
    if($fecha != null){
        $q="UPDATE usuario SET fecha_nacimiento = '$fecha' WHERE id = '$idUsuario'"; 
        $r = mysqli_query ($connection, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection));
    }

    if($email != null){
        $q="UPDATE usuario SET email = '$email' WHERE id = '$idUsuario'"; 
        $r = mysqli_query ($connection, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection));
    }

    if($con != null){
        $con_hash = SHA1($con);
        
        $q="UPDATE usuario SET contrasena = '$con_hash' WHERE id = '$idUsuario'"; 
        $r = mysqli_query ($connection, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection));
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="componentes/header.css">
    <link rel="stylesheet" href="estilos/perfilUsuarios.css">
    <script src="scripts/select.js"> </script>
    <title>Document</title>
    
</head>
<body>
    <header>
        <nav>
            <a href="homeUsuarioWeb.php">Encontrados</a>
            <a href="buscados.php">Buscados</a>
            <a href="">Encontré</a>
            <a href="formPostBuscado.php">Estoy Buscando</a>
            <a href="chat.php">Chats</a>
        </nav>

        <div class="user-image">
            <img  onclick="menu();" src=<?php echo $fotoUsuario?> alt="User profile image">
                <div id = "menud" class="menu">
                    <a href="perfilUsuario.php">Perfil</a>
                    <a href="">Mis Posts</a>
                    <a href="logout.php">Cerrar Sesión</a>
                </div>
        </div>
    </header>
    
    <form  enctype="multipart/form-data" method ="POST" action="" name ="actualizar">
    <div class="contentEncontrado">
        <div class="datos">
            <div class="f1">
                <img  onclick="menu();" src=<?php echo $fotoUsuario?> alt="User profile image" >
                <?php echo "<p>" . $nombreUsuario . "</p>"?>
            </div>
            <div class="f2" >
                <div class="nombre">
                    <p style= width:20% >Nombre</p>
                    <?php echo "<input  style=width:80% autocomplete=\"new-text\" class=\"inp\" type=\"text\" name=\"fnombre\" placeholder=\"". $nombreUsuario. "\">"?>
                     
                </div>
                <div class="direccion">
                    <p style= width:20%>Dirección</p>
                    
                    <?php echo "<input style= width:80% autocomplete=\"new-text\" class=\"inp\" type=\"text\" name=\"fdir\" placeholder=\"". $Ubicacion. "\">"?>
                </div>
            </div>
            <div class="f3">
                <div class="apellidos">
                    <p style= width:20%>Apellidos</p>
                    
                    <?php echo "<input  style= width:80% autocomplete=\"new-text\" class=\"inp\" type=\"text\" name=\"fape\" placeholder=\"". $Uapellidos. "\">"?>
                </div>
                <div class="fecha">
                    <p style= width:20%>Fecha</p>
                    
                    <?php echo "<input  style= width:80% autocomplete=\"new-text\" class=\"inp\" type=\"text\" name=\"ffecha\" placeholder=\"". $Unacimiento. "\">"?>
                </div>
            </div>
            <div class="f4">
            <div class="email">
                    <p style= width:20%>Correo Electrónico</p>
                    
                    <?php echo "<input style= width:80% autocomplete=\"new-text\" class=\"inp\" type=\"text\" name=\"fcorreo\" placeholder=\"". $Umail. "\">"?>
                </div>
                <div class="contraseña">
                    <p style= width:20%>Contraseña</p>
                    <input  style= width:80% autocomplete="new-text" class="inp" type="text" name="fcon" placeholder="**********" >
                </div>
            </div>
            <div class="f5"></div>
            <div class="f6"></div>
            
    </div>

    <div class="f7">
    <button name="modificar" type="submit" value="modificar">Modificar</button>


    </div>
    </form>
</body>
</html>
<script>
    function menu (){
        if (document.getElementById("menud").style.display==="flex"){
            document.getElementById("menud").style.display="none";
        }else {
            document.getElementById("menud").style.display="flex";
        }
    }
</script>

</html>