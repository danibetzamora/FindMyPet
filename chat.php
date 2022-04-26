<?php
    include_once "config.php";
    global $error;
    session_start();
    $view_chat = false;
    if(!isset($_SESSION["user"])) header("Location: homeInvitado.php");

    $error = false;
    $user = $_SESSION["user"];

    $query = "SELECT * FROM `chat` WHERE `usuario_uno` = '$user[0]';";
    $query_users_chat = "SELECT * FROM usuario JOIN chat ON usuario_uno = '$user[0]' OR usuario_dos = '$user[0]'
                            WHERE (usuario.id = chat.usuario_dos OR usuario.id = chat.usuario_uno) AND usuario.id != '$user[0]';";
    //$query_users_chat = "SELECT * FROM `usuario` as u JOIN `chat` ON chat.usuario_dos = '$user[0]' OR chat.usuario_uno = '$user[0]' WHERE u.id = chat.id;";
    //$query_users_chat = "SELECT * FROM `usuario` JOIN `chat` ON chat.usuario_dos = usuario.id AND chat.usuario_uno = '$user[0]';";

    //$chats = $connection->query($query);
    $users = $connection->query($query_users_chat);
    $sql2 = "SELECT foto  FROM usuario WHERE id = '$user[0]' ";
    $result2=$connection->query($sql2);
    $row2 = $result2->fetch_assoc();
    $row2 = $row2["foto"];

    if(isset($_GET['id'])){
        $view_chat = true;
        $_SESSION['chat_id'] = $_GET['id'];
        $sql_get_chat = "SELECT id FROM chat WHERE usuario_uno = '$user[0]' AND usuario_dos = ".$_GET['id'];
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos/chat.css">
    <link rel="stylesheet" href="componentes/header.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
        function ajax(){
            var req = new XMLHttpRequest();

            req.onreadystatechange = function (){
                if(req.readyState == 4 && req.status == 200){
                    document.getElementById('chat').innerHTML = req.responseText;
                }
            }

            req.open('GET', 'chatLoad.php', true);
            req.send();
        }

        setInterval(function (){ajax();}, 1000);
    </script>
</head>
<body style="overflow:hidden;height: 100%;width: 100%;margin: 0%;padding: 0%;" onLoad="ajax();">

    <header>
        <nav>
            <a href="homeUsuarioWeb.php">Encontrados</a>
            <a href="buscados.php">Buscados</a>
            <a href="formPostEncontrado.php">Encontré</a>
            <a href="formPostBuscado.php">Estoy Buscando</a>
            <a href="chat.php">Chats</a>
        </nav>

        <div class="user-image">
            <img onclick="menu();" src=<?php echo $row2 ?> alt="User profile image">
            <div id = "menud" class="menu">
                <a href="perfilUsuario.php">Perfil</a>
                <a href="">Mis Posts</a>
                <a href="logout.php">Cerrar Sesión</a>
            </div>
        </div>
    </header>
    <div class="container-users">
        <?php
            if ($users->num_rows > 0) {
                while ($row = $users->fetch_assoc()) {
                    echo '<a href="chat.php?id='.$row['id'].'">
                                <div class="details">
                                    <p>'.$row['nombre']." ". $row['apellidos'].'</p>
                                </div>
                          </a>';
                }
            }
        ?>
    </div>

    <div id="container">
        <div id="caja-chat">
            <div id="chat">

            </div>
        </div>
        <!-- action="chat.php" -->
        <?php
            if(isset($_GET['id'])){
        ?>
            <form method="post" >
                <textarea name="mensaje", placeholder="Escribe el mensaje..."></textarea>
                <input type="submit", name="enviar", value="Enviar">
            </form>
        <?php
            }else{
                $_SESSION['chat_id'] = null;
            }
        ?>

        <?php
            if (isset($_POST['enviar'])){
                $msg = $_POST['mensaje'];

                $ejecutar = $connection->query($sql_get_chat);

                while ($row = $ejecutar -> fetch_array()){
                    $id_chat = $row['id'];
                }
                $date = date('Y-m-d h:i:s', time());
                $sql = "INSERT INTO mensaje (date, texto, emisor, chat) VALUES ('$date', '$msg',
                                                       '$user[0]', '$_GET[id]')";

                $ejecutar = $connection->query($sql);
                if($ejecutar){
                    header("location: chat.php?id=".$_GET['id']);
                }

            }
        ?>
    </div>

</body>
</html>

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