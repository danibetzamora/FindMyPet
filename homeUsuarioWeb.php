
<?php
    session_start();
    if(!isset($_SESSION["user"])) header("Location: homeInvitado.php");
    include("api/postEncontrados.php");
    include("api/usuario.php");
    include("distancias.php");

    $result = getListPost();

    if(isset($_POST["range"]) && $_POST["range"]!=0){
        $distancia_flag=1;
    }
    $_SESSION['urlChat'] = "post_encontrado";
    $idUsuario = $_SESSION["user"]["id"];
    $fotoUsuario= getFotoUsuario($idUsuario);
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="estilos/homeUsuario.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos/header.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>FindMyPet Home</title>
</head>
<body>
    <div id="main-content">
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

        <div id="container">
            <div class="mostrar-filtros">
                <h1>Filtros FindMyPet</h1>

                <div id="selector-image"><img src="imagenes/sort-down-solid.svg" alt="Selector"></div>
            </div>
            <div id="aside">
                <form id="filter" action="homeUsuarioWeb.php" method="POST">
                    <div class="filtertext">
                        <label>Distancia</label><br>
                        <input id="slidebar" type="range" name="range" min="0" max="100" value="0" class="slider"><br>
                        <span id="demo"></span> Km<br>
                    </div>
                    <div class="filtertext">
                        <label>Animal</label><br>
                        <select name="animal">
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
                        </select><br>
                    </div>
                    <div class="filtertext">
                        <label>Raza</label><br>
                        <select name="raza">
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
                        </select><br>
                    </div>
                    <div class="filtertext">
                        <label>Fecha</label><br>
                        <input type="date" name="fecha" class="date"><br>
                    </div>
                    <button class="botonamarillo" name="Filtrar" type="submit" value="Filtrar">Filtrar</button>
                </form>
            </div>
            <div id="list">

                <?php
                if ($result->num_rows > 0) {
                    $table = [];
                    $delete_row_flag = 0;
                    while($row = $result->fetch_assoc()) {
                        if(isset($distancia_flag)){
                            $distancia=getDistance($row['ubicacion'], $_SESSION["user"]["ubicacion"]);
                            $distancia_explode=explode(" ", "$distancia");
                            $distancia=ceil($distancia_explode[0]);
                            $row["distancia"]=$distancia;
                        }
                        $table[] = $row;
                    }
                    if(isset($distancia_flag)) {
                        $columna_distancia = array_column($table, 'distancia');
                        array_multisort($columna_distancia, SORT_ASC, $table);
                    }
                    foreach ($table as &$row) {
                        //if(isset($distancia_flag) && $row["distancia"] > $_POST['range']+2) continue;
                        $separarFecha= explode(" ",$row["fecha"]);
                        $fechaSep = $separarFecha[0];
                        $horaSep = $separarFecha[1];
                        $horaSep = str_split($horaSep,5)[0];
                        $post = file_get_contents("componentes/post.html");
                        $post_distancia=$row["ubicacion"];
                        if(isset($distancia_flag)) $post_distancia.=" - ".$row['distancia']." Km";
                        $post = str_replace('[UBICACION]', $post_distancia, $post);
                        $post = str_replace('[FECHA]', $fechaSep, $post);
                        $post = str_replace('[HORA]', $horaSep, $post);
                        $post = str_replace('[DESCRIPCION]', $row["descripcion"], $post);
                        $post = str_replace('[NOMBRE]', $row["nombre"], $post);
                        $post = str_replace('[APELLIDO]', $row["apellidos"], $post);
                        $post = str_replace('[FOTOPERFIL]', $row["UsuarioFoto"], $post);
                        $post = str_replace('[FOTOANIMAL]', $row["PostFoto"], $post);
                        $post = str_replace('[IDPOST]', $row["id"], $post);
                        $post = str_replace('[IDUSUARIO]', $idUsuario, $post);
                        echo $post;
                    }
                }
                
                ?>

            </div>
        </div>
    </div>
</body>

<script src="scripts/desplegable.js"></script>

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

