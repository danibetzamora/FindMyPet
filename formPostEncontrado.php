<?php

session_start();
if(!isset($_SESSION["user"])) header("Location: homeInvitado.php");

include('api/config.php');
include("api/usuarios.php");
include("api/postEncontrados.php");

$idUsuario = $_SESSION["user"]["id"];
$fotoUsuario= getFotoUsuario($idUsuario);


if (isset($_POST['publicar'])) {
    $fecha = $_POST['fecha'];
    $fechaGenerada= date('Y-m-d H:i:s'); 
    $separarFecha= explode(" ",$fechaGenerada);
    $horaSep = " " . $separarFecha[1];
    $fecha = $fecha . $horaSep;
    $adress = 'imagenes/postEncontrado/';
    $upload = $adress.basename($_FILES['fotos']['name']);
    addPost($_POST['animal'],$_POST['raza'],$_POST['sexo'],$_POST['direccion'], $_POST['descripcion'],$fecha,$upload,$idUsuario,$adress);
    header("Location: homeUsuarioWeb.php");

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

    <p class="mensajeDatosEncontrados">Introduzca los datos del animal que ha encontrado</p>
    <form  class= "formEncontrados" enctype="multipart/form-data" method ="POST" action="" name ="publicar">
    <div class="contentEncontrado">
        <div class="datos">
            <div class="f1">
                <div class="c1">
                    <p>Animal</p>

                    <select required name="animal" id="selectAnimales">
                        <option disabled selected>Selecciona una opción</option>

                        
                        <?php
                        $animalListJson = '{"Perro":0,"Gato":1,"Pájaro":2,"Caballo":3,"Conejo":4,"Reptil":5}';
                        
                        $animalList = json_decode($animalListJson);
                        

                        foreach($animalList as $key => $value) {
                        echo "<option>" . $key . "</option>" ;
                        }
                        
                        ?>

                    </select>
                </div>
                <div class="c2">
                    <p>Raza</p>
                    <select required name="raza" id="selectRazas" >
                    <option disabled selected>Selecciona una opción</option>
                    <option>Indefinido</option>
                    <option disabled selected>Selecciona una opción</option>
                            <option>Indefinido</option>
                            <option>Terrier</option>
                            <option>Husky</option>
                            <option>Pit bull</option>
                            <option>Stafford</option>
                            <option>Beagle</option>
                            <option>Doberman</option>
                            <option>Labrador</option>
                            <option>San bernardo</option>
                            <option>Caniche</option>
                            <option>Yorkshire</option>
                            <option>Salchicha</option>
                            <option>Shiba</option>
                            <option>Galgo</option>
                            <option>Vizsla</option>
                            <option>Egipcio</option>
                            <option>Persa</option>
                            <option>Siamés</option>
                            <option>Siberiano</option>
                            <option>Bengala</option>
                            <option>Periquito</option>
                            <option>Canario</option>
                            <option>Mirlo</option>
                            <option>Agaporni</option>
                            <option>Ninfa</option>
                            <option>Cacatua</option>
                            <option>Loro</option>
                            <option>Mini Lop</option>
                            <option>Holandés</option>
                            <option>Arlequín</option>
                            <option>Gigante</option>
                            <option>Lagarto</option>
                            <option>Serpiente</option>
                            <option>Iguana</option>
                            <option>Tortuga</option>
                            <option>Camaleón</option>
                            <option>Anolis</option>
                    </select>
                </div>
                <div class="c3">
                    <p>Sexo</p>
                    <select required name="sexo" >
                        <option disabled selected>Selecciona una opción</option>
                        <option>Indefinido</option>
                        <option>Macho</option>
                        <option >Hembra</option>
                        
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

</html>
