<?php

include('../api/config.php');
session_start();
if(!isset($_SESSION["user"])) header("Location: homeInvitado.php");
$idUsuario = $_SESSION["user"]["id"];
$sql = "SELECT foto  FROM usuario WHERE id = '$idUsuario' ";
$sql2 = "SELECT *  FROM usuario  ";
$result2=$connection->query($sql2);
$result=$connection->query($sql);
$row = $result->fetch_assoc();
$fotoUsuario = "../" . $row["foto"];


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
    <link rel="stylesheet" href="../estilos/header.css">
    <script src="scripts/select.js"> </script>
    <title>Administrador</title>

    <style>
        .menu{
            width: 120px;
            height: 170px;
            background-color: #EFEFEF;
            border-radius: 10px;
            display:flex ;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            font-family: 'Inter';
            display:none;
            position:absolute;
            margin-top: -1em;
        }
        .menu a{
            margin: auto;
        }
        .user-image{
            width:120px;
            display:flex;
            flex-direction:column;
            
        }
    </style>
    
</head>
<body>
    <header>
        <div class="normal-nav">
            <div id="responsive-menu">
                <div class="fas fa-bars"></div>
            </div>

            <nav>
                <a href="homeAdmin.php">Denuncias</a>
                <a href="postEncontrados.php">Encontrados</a>
                <a href="postBuscados.php">Buscados</a>
                <a href="usuarios.php">Usuarios</a>
            </nav>

            <div class="user-image">
                <img onclick="menu();" src=<?php echo $fotoUsuario ?> alt="User profile image">
                <div id = "menud" class="menu">
                    <a href="">Perfil</a>
                    <a href="../homeUsuarioWeb">Modo Usuario</a>
                    <a href="../logout.php">Cerrar Sesión</a>
                </div>
            </div>
        </div>

        <div id="responsive-nav">
            <div class="responsive-nav-inside">
                <a href="homeAdmin.php">Denuncias</a>
                <a href="postEncontrados.php">Encontrados</a>
                <a href="postBuscados.php">Buscados</a>
                <a href="usuarios.php">Usuarios</a>
            </div>
        </div>

        <script src="../scripts/header-responsive.js"></script>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </header>

    <div style= "display:flex;flex-direction:column;aling-content:center;justify-content:center;flex:wrap:wrap;align-items:center;">
    <?php
    if ($result2->num_rows > 0) {
        while($row2= $result2->fetch_assoc()) {
            $user = file_get_contents("../componentes/usuario.html");
                        $user = str_replace('[ID]', $row2["id"], $user);
                        $user= str_replace('[NOMBRE]',$row2["nombre"], $user);
                        $user = str_replace('[APELLIDO]',$row2["apellidos"], $user);
                        $user= str_replace('[EMAIL]', $row2["email"], $user);
                        echo $user;
                        

        }
        
    }
    ?>
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
