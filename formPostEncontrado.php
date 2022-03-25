<?php

include('config.php');
session_start();
if(!isset($_SESSION["user"])) header("Location: homeInvitado.html");
if (isset($_POST['publicar'])) {

$idUsuario = $_SESSION["user"]["id"];

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
    <link rel="stylesheet" href="header.css">
    <title>Document</title>
</head>
<style>
    body{
    overflow:hidden;
    height: 100%;
    width: 100%;
    margin: 0%;
    padding: 0%;
    font-family: 'Inter';
    font-style: normal;
    font-weight: 900;
    font-size: 1.23rem;
    color: #2D2B40
    
}


body p{
    margin-left: 5%;
    font-size: 20px;
    font-weight: 500;
    margin-bottom: 1%;

}

.contentEncontrado{
    height: 92%;
    width: 90%;
    margin: auto;
}



.datos{
    border: 1px solid rgb(206, 206, 206);
    border-radius: 6px;
    overflow: auto;
}

.datos p{
    font-size: 1rem;
    margin-left: 0;
    font-weight: 400;
    margin-bottom: 1%;
}

.datos select{
    height: 1.8rem;
    width: 81%;
    border-radius: 4px;
    border: none;
    background-color: #EFEFEF;
    font-size: 0.80rem;
    font-weight: 400;
    outline:none;
    color:grey;
}

.datos .inp{
    height: 1.7rem;
    width: 80%;
    border-radius: 4px;
    border: none;
    background-color: #EFEFEF;
    font-size: 0.80rem;
    font-weight: 400;
    outline:none;
    color:grey;
}
.f1{
    height: 5rem;
    margin: auto;
    display: flex;

    justify-content: center;
}
.f2{
    height: 5rem;
    
    display: flex;
}

.c1{
    width: 33%;
    margin-left: 6%;
}

.c2{
    width: 34%;
    
}

.c3{
    width: 33%;
    
    
}

.fechas{
    
    display: flex;
    

    
}
.fechas select{
    margin-left: 0;
    width: 60%;
    margin-right: 20%;
}
.fechas p{
    font-size: 00.80rem;
    font-weight: 400;
    width: 2rem;
    margin-left: 0rem;
    margin-top: 0.5rem;

}

.day{
    width: 26%;
    font-size: 0.80rem;
    font-weight: 400;
    display: flex;
}

.month{
    width: 35%;
    font-size: 0.80rem;
    font-weight: 400;
    display: flex;
}

.year{
    width: 29%;
    font-size: 0.80rem;
    font-weight: 300;
    display: flex;
}

.daySelect{
    width: 10%;
}

.monthSelect{
    width: 20%;
}

.yearSelect{
    width: 15%;
}

.f3{
    width: 88%;
    height: 10rem;
    text-align: center;
    margin-top: 1.5em;
    margin-bottom: 1.5em;
    margin-left: auto;
    margin-right: auto;
}

.f4{ 
    text-align: center;
    height: 4rem;
    justify-content: center;
}
.f4 button{
    color: #fff;
    background-color: #fcda69;
    margin-top: 1.2rem;
    width: 35rem;
    height: 1.5rem;
    border:none;
    border-radius: 2rem;
    cursor: pointer;
}


</style>
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
            <img src="http://localhost/FindMyPet/imagenes/fotoperfil.png" alt="User profile image">
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

