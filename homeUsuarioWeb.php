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
                <form id="filter" action="">
                    <div class="filtertext">
                        <label>Distancia</label><br>
                        <input id="slidebar" type="range" min="1" max="100" value="50" class="slider"><br>
                        <span id="demo"></span> Km<br>
                    </div>
                    <div class="filtertext">
                        <label>Animal</label><br>
                        <select>
                            <option>Perro</option>
                            <option>Gato</option>
                            <option>Pajaro</option>
                            <option>Dinosaurio</option>
                        </select><br>
                    </div>
                    <div class="filtertext">
                        <label>Raza</label><br>
                        <select>
                            <option>Raza 1</option>
                            <option>Raza 2</option>
                            <option>Raza 3</option>
                            <option>Raza 4</option>
                        </select><br>
                    </div>
                    <div class="filtertext">
                        <label>Fecha</label><br>
                        <input type="date"><br>
                    </div>
                    <button class="botonamarillo" name="Filtrar" type="submit" value="Filtrar">Filtrar</button><br>
                </form>
            </div>
            <div id="list">
                <div class="post"><?php include("postencontrado.html"); ?></div>
                <div class="post"><?php include("postencontrado.html"); ?></div>
                <div class="post"><?php include("postencontrado.html"); ?></div>
                <div class="post"><?php include("postencontrado.html"); ?></div>
                <div class="post"><?php include("postencontrado.html"); ?></div>
                <div class="post"><?php include("postencontrado.html"); ?></div>
                <div class="post"><?php include("postencontrado.html"); ?></div>
                <div class="post"><?php include("postencontrado.html"); ?></div>
                <div class="post"><?php include("postencontrado.html"); ?></div>
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
