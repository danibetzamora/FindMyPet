<?php

include('../api/config.php');
session_start();
if(!isset($_SESSION["user"])) header("Location: homeInvitado.php");
$idUsuario = $_SESSION["user"]["id"];
$sql = "SELECT foto  FROM usuario WHERE id = '$idUsuario' ";
$result=$connection->query($sql);
$row = $result->fetch_assoc();
$fotoUsuario = "../" . $row["foto"];

$sql="SELECT * from denuncia";
$result=$connection->query($sql);

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
        while($row = $result->fetch_assoc()) {
                        $idUsuarioDenunciante= $row['id_usuario'];
                        $postDenunciado= $row['id_post'];
                        $sql1="SELECT email FROM usuario WHERE id = '$idUsuarioDenunciante'";
                        $result1=$connection->query($sql1);
                        $row1 = $result1->fetch_assoc();
                        if ($row["tipo_post"]== 0){
                            $sql2="SELECT email,id from usuario where usuario.id in (select usuario from post_encontrado where id ='$postDenunciado') ";
                            $result2=$connection->query($sql2);
                            $row2 = $result2->fetch_assoc();
                            

                        }else {
                            $sql2="SELECT email,id from usuario where usuario.id in (select usuario from post_buscar where id ='$postDenunciado') ";
                            $result2=$connection->query($sql2);
                            $row2 = $result2->fetch_assoc();

                        }
                        $denuncia= file_get_contents("../componentes/denuncia.html");
                        $denuncia = str_replace('[ID]', $row["id"], $denuncia);
                        $denuncia = str_replace('[FECHA]', $row["date_upload"], $denuncia);
                        $denuncia = str_replace('[IDPOST]',$row["id_post"], $denuncia);
                        $denuncia = str_replace('[IDUSUARIO]', $row["id_usuario"], $denuncia);
                        $denuncia = str_replace('[CORREOUSUARIO]', $row1["email"], $denuncia);
                        $denuncia = str_replace('[IDDENUNCIADO]', $row["id"], $denuncia);
                        $denuncia = str_replace('[CORREODENUNCIADO]', $row2["email"], $denuncia);
                        $denuncia = str_replace('[TIPOPOST]', $row["tipo_post"], $denuncia);
                        echo $denuncia;

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
