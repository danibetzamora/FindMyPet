<?php
    session_start();
    if(!isset($_SESSION["user"])) header("Location: homeInvitado.php");

    include("config.php");
    $sql="SELECT post_encontrado.ubicacion,  post_encontrado.fecha,
                 post_encontrado.descripcion, usuario.nombre, usuario.apellidos,
                 usuario.foto
            FROM post_encontrado 
            JOIN usuario WHERE usuario.id=post_encontrado.usuario ORDER BY post_encontrado.fecha desc ";
    $result=$connection->query($sql);

    $sql2="SELECT * 
            FROM post_encontrado
            JOIN foto_post_encontrado WHERE post_encontrado.id=foto_post_encontrado.post ORDER BY post_encontrado.fecha desc";
    $result2=$connection->query($sql2);
    $idUsuario = $_SESSION["user"]["id"];
    $sql3 = "SELECT foto  FROM usuario WHERE id = '$idUsuario' ";
    $result3=$connection->query($sql3);
    $row3 = $result3->fetch_assoc();
    $row3 = $row3["foto"];
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="estilos/homeUsuario.css" rel="stylesheet">
    <link rel="stylesheet" href="componentes/header.css">
    <title>FindMyPet Home</title>
</head>
<body>
    <div id="main-content">
        <header>
            <nav>
                <a href="">Encontrados</a>
                <a href="buscados.php">Buscados</a>
                <a href="formPostEncontrado.php">Encontré</a>
                <a href="formPostBuscado.php">Estoy Buscando</a>
                <a href="">Chats</a>
            </nav>

            <div class="user-image">
                <img onclick="menu();" src=<?php echo $row3 ?> alt="User profile image">
                <div id = "menud" class="menu">
                    <a href="perfilUsuario.php">Perfil</a>
                    <a href="">Mis Posts</a>
                    <a href="logout.php">Cerrar Sesión</a>
                </div>
            </div>
        </header>
        <div id="container">
            <div id="aside">
                <form id="filter" action="homeUsuarioWeb.php" method="GET">
                    <div class="filtertext">
                        <label>Distancia</label><br>
                        <input  style ="font-size:10px;"id="slidebar" type="range" name="range" min="1" max="100" value="50" class="slider"><br>
                        <span   style ="font-size:15px;font-weight:400" id="demo"></span> Km<br>
                    </div>
                    <div class="filtertext">
                        <label>Animal</label><br>
                        <select name="animal">
                            <option disabled selected>Selecciona una opción</option>
                            <option>Perro</option>
                            <option>Gato</option>
                            <option>Pájaro</option>
                            <option>Caballo</option>
                            <option>Tortuga</option>
                            <option>Conejo</option>
                            <option>Reptil</option>
                        </select><br>
                    </div>
                    <div class="filtertext">
                        <label>Raza</label><br>
                        <select name="raza">
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
                            <option>Camaleón</option>
                            <option>Anolis</option>
                        </select><br>
                    </div>
                    <div class="filtertext">
                        <label>Fecha</label><br>
                        <input type="date" name="fecha"><br>
                    </div>
                    
                    <button class="botonamarillo" name="Filtrar" type="submit" value="Filtrar">Filtrar</button><br>
                </form>
            </div>
            <div id="list">

                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $row2 = $result2->fetch_assoc();
                        $separarFecha= explode(" ",$row["fecha"]);
                        $fechaSep = $separarFecha[0];
                        $horaSep = $separarFecha[1];
                        $horaSep = str_split($horaSep,5)[0];
                        $post = file_get_contents("componentes/post.html");
                        $post = str_replace('[UBICACION]', $row["ubicacion"], $post);
                        $post = str_replace('[FECHA]', $fechaSep, $post);
                        $post = str_replace('[HORA]', $horaSep, $post);
                        $post = str_replace('[DESCRIPCION]', $row["descripcion"], $post);
                        $post = str_replace('[NOMBRE]', $row["nombre"], $post);
                        $post = str_replace('[APELLIDO]', $row["apellidos"], $post);
                        $post = str_replace('[FOTOPERFIL]', $row["foto"], $post);
                        $post = str_replace('[FOTOANIMAL]', $row2["foto"], $post);
                        echo $post;
                    }
                }
                $connection->close();
                ?>

            </div>
        </div>
    </div>
</body>

<script>
    var slider = document.getElementById("slidebar");
    var output = document.getElementById("demo");
    output.innerHTML = slider.value;

    slider.oninput = function() {
        output.innerHTML = this.value;
    }

    function menu (){
        if (document.getElementById("menud").style.display==="flex"){
            document.getElementById("menud").style.display="none";
        }else {
            document.getElementById("menud").style.display="flex";
        }
    }
</script>

</html>
