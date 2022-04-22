<?php

include('../config.php');
session_start();
if(!isset($_SESSION["user"])) header("Location: homeInvitado.php");
$idUsuario = $_SESSION["user"]["id"];
$sql = "SELECT foto  FROM usuario WHERE id = '$idUsuario' ";
$result=$connection->query($sql);
$row = $result->fetch_assoc();
$fotoUsuario = "../" . $row["foto"];

$sql="SELECT post_buscar.ubicacion,  post_buscar.fecha, post_buscar.id,
post_buscar.descripcion,post_buscar.nombre, usuario.nombre, usuario.apellidos,
usuario.foto
FROM post_buscar 
JOIN usuario WHERE usuario.id=post_buscar.usuario ORDER BY post_buscar.fecha desc ";
$result=$connection->query($sql);

$sql2="SELECT * 
FROM post_buscar
JOIN foto_post_buscado WHERE post_buscar.id=foto_post_buscado.post ORDER BY post_buscar.fecha desc";
$result2=$connection->query($sql2);
$idUsuario = $_SESSION["user"]["id"];
$sql3 = "SELECT foto  FROM usuario WHERE id = '$idUsuario' ";
$result3=$connection->query($sql3);
$row3 = $result3->fetch_assoc();
$row3 = $row3["foto"];

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
                <div id = "menud" class="menu">
                    <a href="">Perfil</a>
                    <a href="../homeUsuarioWeb">Modo Usuario</a>
                    <a href="../logout.php">Cerrar Sesión</a>
                </div>
        </div>
    </header>
    <div id="contenedor" >
    <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $row2 = $result2->fetch_assoc();
                        $separarFecha= explode(" ",$row["fecha"]);
                        $fechaSep = $separarFecha[0];
                        $horaSep = $separarFecha[1];
                        $horaSep = str_split($horaSep,5)[0];
                        $postBack = file_get_contents("../componentes/postBackAdmin.html");
                        $postBack = str_replace('[UBICACION]', $row["ubicacion"], $postBack);
                        $postBack= str_replace('[FECHA]', $fechaSep, $postBack);
                        $postBack = str_replace('[HORA]', $horaSep, $postBack);
                        $postBack= str_replace('[DESCRIPCION]', $row["descripcion"], $postBack);
                        $postBack = str_replace('[NOMBREANIMAL]', $row["nombre"], $postBack);
                        $postBack = str_replace('[NOMBRE]', $row["nombre"], $postBack);
                        $postBack = str_replace('[APELLIDO]', $row["apellidos"], $postBack);
                        $postBack= str_replace('[FOTOPERFIL]', "../" . $row["foto"], $postBack);
                        $postBack = str_replace('[FOTOANIMAL]',"../" .  $row2["foto"], $postBack);
                        $postBack = str_replace('[ID]', $row["id"], $postBack);
                        echo $postBack;
                    }
                }
                
                ?>
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
<style>
    #contenedor{
        display:flex;
        flex-direction:row;
        flex-wrap:wrap;
    }
</style>