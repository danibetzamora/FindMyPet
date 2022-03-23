<?php
    include("config.php");
    $sql="SELECT post_encontrado.ubicacion,  post_encontrado.fecha,
                 post_encontrado.descripcion, usuario.nombre, usuario.apellidos,
                 usuario.foto
            FROM post_encontrado
            JOIN usuario WHERE usuario.id=post_encontrado.usuario";
    $result=$connection->query($sql);

    $sql2="SELECT * 
            FROM post_encontrado
            JOIN foto_post_encontrado WHERE post_encontrado.id=foto_post_encontrado.post";
    $result2=$connection->query($sql2);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="homeUsuario.css" rel="stylesheet">
    <title>FindMyPet Home</title>
</head>
<body>
    <div id="main-content">
        <div id="header">
            <div id="logo"><a href="homeUsuarioWeb.php"><img id="imglogo" src="imagenes/logo.png"></a></div>
            <div id="navegacion">
                <div class="nav"><a href="homeUsuarioWeb.php">Buscar</a></div>
                <div class="nav"><a href="homeUsuarioWeb.php">Se Busca</a></div>
                <div class="nav"><a href="homeUsuarioWeb.php">Encontre</a></div>
                <div class="nav"><a href="homeUsuarioWeb.php">Estoy Buscando</a></div>
                <div class="nav"><a href="homeUsuarioWeb.php">Chats</a></div>
            </div>
            <div id="perfil"><a href="login.php"><img id="perfilimg" src="imagenes/fotoperfil.png"></a></div>
        </div>
        <div id="container">
            <div id="aside">
                <form id="filter" action="homeUsuarioWeb.php" method="GET">
                    <div class="filtertext">
                        <label>Distancia</label><br>
                        <input id="slidebar" type="range" name="range" min="1" max="100" value="50" class="slider"><br>
                        <span id="demo"></span> Km<br>
                    </div>
                    <div class="filtertext">
                        <label>Animal</label><br>
                        <select name="animal">
                            <option>Perro</option>
                            <option>Gato</option>
                            <option>Pajaro</option>
                            <option>Dinosaurio</option>
                        </select><br>
                    </div>
                    <div class="filtertext">
                        <label>Raza</label><br>
                        <select name="raza">
                            <option>Raza 1</option>
                            <option>Raza 2</option>
                            <option>Raza 3</option>
                            <option>Raza 4</option>
                        </select><br>
                    </div>
                    <div class="filtertext">
                        <label>Fecha</label><br>
                        <input type="date" name="fecha"><br>
                    </div>
                    <input type="submit">
                    <button class="botonamarillo" name="Filtrar" type="submit" value="Filtrar">Filtrar</button><br>
                </form>
            </div>
            <div id="list">

                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $row2 = $result2->fetch_assoc();
                        $post = file_get_contents("post.html");
                        $post = str_replace('[UBICACION]', $row["ubicacion"], $post);
                        $post = str_replace('[FECHA]', $row["fecha"], $post);
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
</script>

</html>
