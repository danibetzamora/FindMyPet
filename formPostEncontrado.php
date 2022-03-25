<?php

include('config.php');
session_start();
if(!isset($_SESSION["user"])) header("Location: homeInvitado.html");
$idUsuario = $_SESSION["user"]["id"];
$sql = "SELECT foto  FROM usuario WHERE id = '$idUsuario' ";
$result=$connection->query($sql);
$row = $result->fetch_assoc();
$fotoUsuario = $row["foto"];

if (isset($_POST['publicar'])) {



$animal = $_POST['animal'];
$raza = $_POST['raza'];
$sexo = $_POST['sexo'];
$direccion = $_POST['direccion'];
$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha'];
$fecha= date('Y-m-d H:i:s'); 

$adress = 'imagenes/postEncontrado/';
$upload = $adress.basename($_FILES['fotos']['name']);

$q="INSERT INTO post_encontrado(id,animal,raza,sexo,fecha,ubicacion,descripcion,usuario) VALUES (null,'$animal','$raza','$sexo','$fecha','$direccion','$descripcion','$idUsuario')"; 
$r = mysqli_query ($connection, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection));
$qid ="SELECT id FROM post_encontrado WHERE usuario='$idUsuario' and fecha ='$fecha'";
$r = mysqli_query ($connection, $qid) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection));
$idPost=$r->fetch_assoc();
$idPost =$idPost["id"];

if (move_uploaded_file($_FILES['fotos']['tmp_name'], $upload)) {
      $pathPhoto = $adress . $_FILES['fotos']['name'] ;
      ?>
      
      <?php 
      $query = $connection->query("INSERT INTO foto_post_encontrado VALUES (null ,$idPost,'$pathPhoto') ");
      header("Location: homeUsuarioWeb.php");

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
    <link rel="stylesheet" href="estilos/formPostEncontrado.css">
    <title>Document</title>
</head>
<body>
    <header>
        <nav>
            <a href="homeUsuarioWeb.php">Buscar</a>
            <a href="">Se Busca</a>
            <a href="">Encontre</a>
            <a href="">Estoy Buscando</a>
            <a href="">Chats</a>
        </nav>

        <div class="user-image">
            <img  onclick="menu();" src=<?php echo $fotoUsuario?> alt="User profile image">
                <div id = "menud" class="menu">
                    <a href="">Perfil</a>
                    <a href="">Mis Posts</a>
                    <a href="">Cerrar Sesión</a>
                </div>
        </div>
    </header>
    <p>Introduzca los datos del animal que ha encontrado</p>
    <form  enctype="multipart/form-data" method ="POST" action="" name ="publicar">
    <div class="contentEncontrado">
        <div class="datos">
            <div class="f1">
                <div class="c1">
                    <p>Animal</p>
                    <select required name="animal">
                        <option>perro</option>
                        <option >gato</option>
                        <option >serpiente</option>
                    </select>
                </div>
                <div class="c2">
                    <p>Raza</p>
                    <select required name="raza">
                        <option>perro</option>
                        <option >gato</option>
                        <option >serpiente</option>
                    </select>
                </div>
                <div class="c3">
                    <p>Sexo</p>
                    <select required name="sexo">
                        <option>macho</option>
                        <option >hembra</option>
                        
                    </select>
                </div>

            </div>
            <div class="f2">
                <div class="c1">
                    <p>Lugar de encuentro</p>
                    <input required minlength="8" autocomplete="new-text" class ="inp" type="text" name="direccion" placeholder="Introduzca aquí ">
                </div>
                <div class="c2">
                    <p>Descripción de los hechos</p>
                    <input required minlength="8" autocomplete="new-text" class ="inp" type="new-message-input"  name="descripcion"placeholder="Introduzca aquí ">

                
                </div>
                <div class="c3">
                    <p >Fecha</p>
                    <div  class="fechas">
                        <input required  class="inp" name ="fecha" type="date">
                    </div>
                </div>
            </div>
            <div   style="border:1px solid #EFEFEF;text-align: center" class="f3">
                <input  required style="margin-top: 6%;"  type="file" multiple name="fotos" value="fotos">
            </div>
            <div class="f4">
                <button name="publicar" type="submit" value="publicar">publicar</button>

            </div>
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
    margin-top:50px;
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
</html>
