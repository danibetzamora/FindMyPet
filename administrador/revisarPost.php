<?php

include('../config.php');
session_start();
if(!isset($_SESSION["user"])) header("Location: homeInvitado.php");
$idUsuario = $_SESSION["user"]["id"];
$sql = "SELECT foto  FROM usuario WHERE id = '$idUsuario' ";
$result=$connection->query($sql);
$row = $result->fetch_assoc();
$fotoUsuario = "../" . $row["foto"];
$idPost =  $_GET["idpost"];
$tipoPost =  $_GET["tipopost"];
if ($tipoPost == 0){
    $sql1 = "SELECT post_encontrado.*, usuario.nombre, usuario.apellidos,
                 usuario.foto AS UsuarioFoto, foto_post_encontrado.foto AS PostFoto
            FROM post_encontrado 
            JOIN usuario ON usuario.id=post_encontrado.usuario 
            JOIN foto_post_encontrado WHERE post_encontrado.id=foto_post_encontrado.post AND post_encontrado.id=$idPost";
            $result1=$connection->query($sql1);
}else {
    $sql1 = "SELECT post_buscar.*, usuario.nombre, usuario.apellidos,
                    usuario.foto AS UsuarioFoto, foto_post_buscado.foto AS PostFoto
            FROM post_buscar
            JOIN usuario ON usuario.id=post_buscar.usuario 
            JOIN foto_post_buscado WHERE post_buscar.id=foto_post_buscado.post AND post_buscar.id=$idPost";
    $result1=$connection->query($sql1);
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
    <link rel="stylesheet" href="../componentes/header.css">
    <script src="scripts/select.js"> </script>
    <title>Administrador</title>
    
</head>
<body>
    <header>
        <nav>
            <a href="homeAdmin.php">Denuncias</a>
            <a href="postEncontrados.php">Encontrados</a>
            <a href="postBuscados.php">Buscados</a>
            <a href="usuarios.php">Usuarios</a>
        </nav>

        <div class="user-image">
            <img  onclick="menu();" src=<?php echo $fotoUsuario?> alt="User profile image">
                <div id = "menud" class="menu" >
                    <a href="">Perfil</a>
                    <a href="../homeUsuarioWeb">Modo Usuario</a>
                    <a href="../logout.php">Cerrar Sesión</a>
                </div>
        </div>
    </header>
    <div style= "display:flex;flex-direction:column;aling-content:center;justify-content:center;flex:wrap:wrap;align-items:center;">
        <?php
            $row1 = $result1->fetch_assoc();
            $separarFecha= explode(" ",$row1["fecha"]);
            $fechaSep = $separarFecha[0];
            $horaSep = $separarFecha[1];
            $horaSep = str_split($horaSep,5)[0];
            $post = file_get_contents("../componentes/post.html");
            $post = str_replace('[UBICACION]', $row1["ubicacion"], $post);
            $post = str_replace('[FECHA]', $fechaSep, $post);
            $post = str_replace('[HORA]', $horaSep, $post);
            $post = str_replace('[DESCRIPCION]', $row1["descripcion"], $post);
            $post = str_replace('[NOMBRE]', $row1["nombre"], $post);
            $post = str_replace('[APELLIDO]', $row1["apellidos"], $post);
            $post = str_replace('[FOTOPERFIL]', "../" . $row1["UsuarioFoto"], $post);
            $post = str_replace('[FOTOANIMAL]', "../" . $row1["PostFoto"], $post);
            $post = str_replace('[ID]', $row1["id"], $post);
            if($tipoPost== 0){
                $rutaEliminar ="eliminarEncontrado.php?id=";
            }else{
                $rutaEliminar= "eliminarBuscado.php?id=";
            }
            echo $post;
           
        ?>  
    </div>
    <div style= "display:flex;justify-content:center;">
        <a class="boton" href= <?php echo $rutaEliminar . $row1["id"] ?>><button style = "cursor:pointer;margin-top: 5vh;border:solid 0.1vw;border-radius:15px;width: 160px;background-color: #FCDA68;padding: 0.2vw;color: #ffffff;font-family: 'Inter';font-size: 12px;" name="Logear" type="button" value="Iniciar sesión">Eliminar</button></a>
    </div>

</body>
</html>
<script>
    function menu (){
        document.getElementById("menud").style.position="absolute";
        document.getElementById("menud").style.top="10%";
        if (document.getElementById("menud").style.display==="flex"){
            document.getElementById("menud").style.display="none";
        }else {
            document.getElementById("menud").style.display="flex";
        }
    }
</script>

</html>
