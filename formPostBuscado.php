<?php

session_start();
if(!isset($_SESSION["user"])) header("Location: homeInvitado.php");

include("api/usuario.php");
include("api/postBuscados.php");

$idUsuario = $_SESSION["user"]["id"];
$fotoUsuario= getFotoUsuario($idUsuario);

if (isset($_POST['publicar'])){
    $fecha = $_POST['fecha'];
    $fechaGenerada= date('Y-m-d H:i:s'); 
    $separarFecha= explode(" ",$fechaGenerada);
    $horaSep = " " . $separarFecha[1];
    $fecha = $fecha . $horaSep;
    $adress = 'imagenes/postBuscado/';
    $upload = $adress.basename($_FILES['fotos']['name']);
    addPost($_POST['animal'],$_POST['raza'],$_POST['sexo'], $_POST['nombre'], $_POST['direccion'],$_POST['descripcion'],$fecha,$upload,$idUsuario,$adress);
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
    <link rel="stylesheet" href="estilos/header.css">
    <link rel="stylesheet" href="estilos/formPostBuscado.css">
    <script src="scripts/select.js"> </script>
    <title>Document</title>
    
</head>
<body>
    <header>
        <div class="normal-nav">
            <div id="responsive-menu">
                <div class="fas fa-bars"></div>
            </div>

            <nav>
                <a href="homeUsuarioWeb.php">Encontrados</a>
                <a href="buscados.php">Buscados</a>
                <a href="formPostEncontrado.php">Encontré</a>
                <a href="formPostBuscado.php">Estoy Buscando</a>
                <a href="chat.php">Chats</a>
            </nav>

            <div class="user-image">
                <img onclick="menu();" src=<?php echo $fotoUsuario ?> alt="User profile image">
                <div id = "menud" class="menu">
                    <a href="perfilUsuario.php">Perfil</a>
                    <a href="">Mis Posts</a>
                    <a href="logout.php">Cerrar Sesión</a>
                </div>
            </div>
        </div>

        <div id="responsive-nav">
            <div class="responsive-nav-inside">
                <a href="homeUsuarioWeb.php">Encontrados</a>
                <a href="buscados.php">Buscados</a>
                <a href="formPostEncontrado.php">Encontré</a>
                <a href="formPostBuscado.php">Estoy Buscando</a>
                <a href="chat.php">Chats</a>
            </div>
        </div>

        <script src="scripts/header-responsive.js"></script>
        <script src="https://kit.fontawesome.com/62ea397d3a.js"></script>
    </header>

    <p class="mensajePostBuscado">Introduzca los datos del animal que ha perdido</p>
    <form  class= "formBuscado" enctype="multipart/form-data" method ="POST" action="" name ="publicar">
    <div class="contentEncontrado">
        <div class="datos">
            <div class="f1">
                <div class="c1">
                    <p>Animal</p>


                

                    <select required name="animal" id="selectAnimales">
                        <option disabled selected>Selecciona una opción</option>

                        
                        <?php
                        
                        

                        $file = file_get_contents("./json/animals.json");

                        $animalList = json_decode($file, True);
                        var_dump($animalList);

                        

                        

                        foreach($animalList as $number => $array) {
                            foreach($array as $key => $value){
                                echo "<option>" . $value . "</option>" ;


                            }
                        
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
                            <?php
                        
                        

                        $file = file_get_contents("./json/razas.json");

                        $razasList = json_decode($file, True);
                        //var_dump($razasList);

                        

                        

                        foreach($razasList as $number => $array) {
                            var_dump($number);
                            foreach($array as $animal => $breed ){
                                var_dump($breed);
                                foreach($breed as $pos => $breedName ){
                                    echo "<option>" . $breedName . "</option>" ;

                                }
                                


                            }
                        
                        }
                        
                        ?>
                    </select>
                </div>
                <div class="c3" style= "display:flex;width:33%" >
                    <div class="c3f1" style= "width:25%">
                        <p class="sexo" >Sexo</p>
                        <select required name="sexo" >
                            <option disabled selected>Sexo</option>
                            <option>Indefinido</option>
                            <option>Macho</option>
                            <option >Hembra</option>
                        
                        </select>
                    </div>
                    <div class="c3f2" style= "width:75%">
                    <p class="nombre" >Nombre</p>
                    <input required minlength="3" autocomplete="new-text" class ="inp" type="new-message-input"  name="nombre"placeholder="Introduzca el nombre del animal ">
                    </div>
                    
                </div>
                

            </div>
            <div class="f2">
                <div class="c1">
                    <p>Lugar de pérdida</p>
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
