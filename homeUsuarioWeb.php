<?php
    session_start();
    if(!isset($_SESSION["user"])) header("Location: homeInvitado.php");

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
                <a href="">Buscar</a>
                <a href="">Se Busca</a>
                <a href="formPostEncontrado.php">Encontre</a>
                <a href="">Estoy Buscando</a>
                <a href="">Chats</a>
            </nav>

            <div class="user-image">
                <img onclick="menu();" src=<?php echo $row3 ?> alt="User profile image">
                <div id = "menud" class="menu">
                    <a href="">Perfil</a>
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
                    
                    <button class="botonamarillo" name="Filtrar" type="submit" value="Filtrar">Filtrar</button><br>
                </form>
            </div>
            <div id="list">

                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $row2 = $result2->fetch_assoc();
                        $post = file_get_contents("componentes/post.html");
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
@import url('https://fonts.googleapis.com/css?family=Poppins:400,700,900');

#main-content{
    height: 100%;
    width: 100%;
    margin: 0%;
    padding: 0%;
}


#container{
    height: 1000px;
    display: flex;
}

#aside{
    height: inherit;
    width: 20%;
    display: inline-flex;
}

#filter{
    margin-top:1.8%;
    margin-left: 10%;
    border: 1.5px solid #e5e5e5e5;
    padding:10px;
    height:37%;
    border-radius:6px;
}

.filtertext{
    font-size: 20px;
    font-family: 'Inter';
    font-weight: 550;
    color: #2D2B40;
    user-select: none;
    text-align: left;
}

input{
    margin-top:6px;
    background-color: #f5f5f5;
    border:none;
    border-radius:6px;
    padding:0.3vh;
    width: 170px;
    outline:none;
    color:grey;
}
select{
    margin-top:6px;
    background-color: #f5f5f5;
    border:none;
    border-radius: 6px;
    padding:0.5vh;
    width: 175px;
    outline:none;
    color:grey;
}
label{
    
}
#list{
    height: inherit;
    width: 80%;
    display: flex;
    flex-flow: wrap;
    align-content: flex-start;
}

.post{
    margin: 0;
}
.botonamarillo{
    margin-top:15px;
    border:none;
    border-radius:15px;
    width: 175px;
    background-color: #FCDA68;
    padding: 2px;
    color: #ffffff;
    font-family: 'Inter';
    font-size: 16px;
    font-weight:500;
}
.botonamarillo:hover{
    cursor:pointer;
}
</style>
</html>
