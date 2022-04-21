
<?php

include('config.php');
session_start();
if(!isset($_SESSION["user"])) header("Location: homeInvitado.php");
$idUsuario = $_SESSION["user"]["id"];
$sql = "SELECT foto  FROM usuario WHERE id = '$idUsuario' ";
$result=$connection->query($sql);
$row = $result->fetch_assoc();
$fotoUsuario = $row["foto"];
if (isset($_POST['publicar'])) {
    $nombre = $_POST['fnombre'];
    $dir = $_POST['fdir'];
    $apellidos = $_POST['fape'];
    $fecha = $_POST['ffecha'];
    $email = $_POST['fcorreo'];
    $con = $_POST['fcon'];
    
    $upload = $adress.basename($_FILES['fotos']['name']);

    $q="SELECT * FROM usuario WHERE email='$email'"; 
    $r = mysqli_query ($connection, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection));
    $qid ="SELECT id FROM post_encontrado WHERE usuario='$idUsuario' and fecha ='$fecha'";
    $r = mysqli_query ($connection, $qid) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection));
    $idPost=$r->fetch_assoc();
    $idPost =$idPost["id"];

    

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
            <a href="">Chats</a>
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
    <p>Introduzca los datos del animal que ha encontrado</p>
    <form  enctype="multipart/form-data" method ="POST" action="" name ="actualizar">
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
                    <?php
                        $razaListJson = '{"Indefinido":"perro","Terrier":0,"Husky":0,"Pitbull":0,"Stafford":4,"Beagle":5,"Doberman":0,"Labrador":0,"San Bernardo":0,"Caniche":0,"Yorkshire":0,"Salchicha":0,"Shiba":0,"Galgo":0,"Viszla":0,"Sphynx":1,"Persa":1, "Siamés":1}';
                        
                        $razaList = json_decode($razaListJson);
                        

                        foreach($razaList as $key => $value) {
                        echo "<option>" . $key . "</option>" ;
                        }
                        
                        ?>
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